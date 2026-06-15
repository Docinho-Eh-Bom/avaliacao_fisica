<?php
namespace App\Services;

use App\Models\TestResult;
use App\Models\TestType;
use App\Models\TestBattery;
use App\Services\ReferenceValueService;
use App\Services\MetricService;

class EvaluationService{
    protected $referenceService;
    protected $metricService;

    public function __construct(ReferenceValueService $referenceService, MetricService $metricService){
        $this->referenceService = $referenceService;
        $this->metricService = $metricService;
    }

    //avaliate the results (basically the final return where everything is calcd and classified)
    public function evaluateDirect(TestType $testType, $student, float $value){
        $reference = $this->referenceService
        ->findClassification(
            $testType->id,
            $student->age,
            $student->gender,
            $value
            );


        //no ref found
        if(!$reference){
            return [
                'value' => $value,
                'classification' => null,
                'error' => 'Referência não encontrada.'
            ];
        }

        return [
            'value' => $value,
            'classification' => $reference->label,
        ];
    }

    public function evaluateDerived(TestResult $result){
        $testType = $result->testType;
        $student = $result->battery->student;

        //base value
        $value = $result->value;

        //calcs if derived
        if($testType->calc_type === 'derived'){
            $data = $this->buildMetricData($result);
            $value = $this->metricService->calculate($testType->calc_key, $data);
        }

        if($testType->calc_key === 'bmi'){
            return $this->evaluateBMI($value, $student);
        }

        if($testType->calc_key === 'wtr'){
            return $this->evaluateWTR($value);
        }

        return $this->evaluateDirect($testType, $student, $value);
    }

    private function getResultValue($battery, $key){
        return $battery->results
            ->firstWhere('testType.calc_key', $key)?->value;
    }

    //prepare data for the calcs
    public function buildMetricData(TestResult $result){
        $battery = $result->battery;

        return [
            'weight' => $this->getResultValue($battery, 'weight'),
            'height' => $this->getResultValue($battery, 'height'),
            'waist' => $this->getResultValue($battery, 'waist'),
        ];
    }

    public function evaluateBMI(float $value, $student){
        $testType = TestType::where('calc_key', 'bmi')->first();

        $reference = $this->referenceService
            ->findClassificationDerived(
                $testType->id,
                $student->age,
                $student->gender,
                $value
            );

        return [
            'value' => $value,
            'classification' => $reference->label
        ];
    }

    public function evaluateWTR(float $value){
        return [
            'value' => $value,
            'classification' => $value < 0.5 ? 'healthy' : 'risk'
        ];
    }

    public function getDerivedResult(TestBattery $battery){
        $data = [
            'weight' => $this->getResultValue($battery, 'weight'),
            'height' => $this->getResultValue($battery, 'height'),
            'waist' => $this->getResultValue($battery, 'waist')
        ];

        $bmi = $this->metricService->calculate('bmi', $data);
        $wtr = $this->metricService->calculate('wtr', $data);

        $bmiEvaluation = $this->evaluateBMI($bmi, $battery->student);
        $wtrEvaluation = $this->evaluateWTR($wtr);

        return [
            (object)[
                'derived' => true,
                'name' => 'IMC',
                'final_value' => $bmi,
                'unit' => 'kg/m²',
                'classification' => $bmiEvaluation['classification'],
                'classification_label' => match($bmiEvaluation['classification']){
                    'healthy' => 'Saudável',
                    'risk' => 'Risco à Saúde',
                    default => 'Não classificado'
                }
            ],

            (object)[
                'derived' => true,
                'name' => 'Razão Cintura Estatura',
                'final_value' => $wtr,
                'unit' => 'razão cintura estatura',
                'classification' => $wtrEvaluation['classification'],
                'classification_label' => match($wtrEvaluation['classification']){
                    'healthy' => 'Saudável',
                    'risk' => 'Risco à Saúde',
                    default => 'Não classificado'
                }
            ]
        ];
    }

    public function calcClassPercentile(TestResult $result): ?float{
        $testType = $result->testType;

        $results = TestResult::whereHas('battery.student', function ($q) use ($result){
                $q->where(
                    'class_group_id',
                    $result->battery->student->class_group_id
                );
            })
            ->where('test_type_id', $result->test_type_id)
            ->get()
            ->map(fn ($r) => $r->final_value ?? $r->value)
            ->filter()
            ->values();

        $count = $results->count();

        if($count === 0){
            return null;
        }

        if($testType->higher){
            $betterThan = $results->filter(
                fn ($v) => $v <= $result->final_value
            )->count();
        }else{
            $betterThan = $results->filter(
                fn ($v) => $v >= $result->final_value
            )->count();
        }

        return round(($betterThan / $count) * 100, 2);
    }

        //same as above but without the percentile refs
        public function classifyPercentileClass(float $value): string{
        if($value < 40){
            return 'weak';
        }

        if($value < 60){
            return 'average';
        }

        if($value < 80){
            return 'good';
        }

        if($value < 98){
            return 'very_good';
        }

        return 'excellent';
    }
}
