<?php
namespace App\Services;

use App\Models\TestResult;
use App\Models\TestType;
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
    public function evaluate(TestResult $result){
        $testType = $result->testType;
        $student = $result->battery->student;

        //base value
        $value = $result->value;

        //calcs if percentile
        if($testType->calc_type === 'derived'){
            $data = $this->buildMetricData($result);
            $value = $this->metricService->calculate($testType->calc_key, $data);
        }

        //search ref
        $reference = $this->referenceService->getReferencyByType(
            $testType->id,
            $student->age,
            $student->gender,
            $this->resolveReferenceType($testType)
        );

        //if not found
        if(!$reference){
            return [
                'value' => $value,
                'classification' => null,
                'error' => 'Reference not found'
            ];
        }

        //classify
        $classification = $this->classify($value, $reference);

        return [
            'value' => $value,
            'classification' => $classification,
            'reference_type' => $reference->type
        ];
    }

    //prepare data for the calcs
    public function buildMetricData(TestResult $result){
        return [
            'weight' => $result->weight ?? null,
            'height' => $result->height ?? null,
            'waist' => $result->waist ?? null
        ];
    }

    //just a func to tell what type of ref it is
    public function resolveReferenceType($testType){
        return $testType->calc_type === 'derived' ? 'absolute' : 'percentile';
    }

    public function classify(float $value, $reference){
        return match($reference->type){
            'percentile' => $this->classifyPercentile($value, $reference),
            'absolute' => $this->classifyAbsolute($value, $reference),
            default => null
        };
    }

    public function calcClassPercentile($result){
        $testTypeId = $result->test_type_id;
        $classId = $result->battery->student->class_group_id;

        $results = TestResult::whereHas('battery.student',
            function ($q) use ($classId){
                $q->where('class_group_id', $classId);
            })
            ->where('test_type_id', $testTypeId)
            ->pluck('value')
            ->sort()
            ->values();

            $count = $results->count();

            if($count === 0){
                return null;
            }

            $position = $results->search($result->value);

            if($position === false){
                return null;
            }

            return ($position/$count)*100;
    }

    public function classifyPercentile(float $value, $reference): string{
        if($value < $reference->p40){
            return 'weak';
        }

        if($value < $reference->p60){
            return 'average';
        }

        if($value < $reference->p80){
            return 'good';
        }

        if($value < $reference->p98){
            return 'very_good';
        }

        return 'excellent';
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

    public function classifyAbsolute(float $value, $reference){
        if($reference->min_value !== null &&
            $reference->max_value !== null &&
            $value >= $reference->min_value &&
            $value <= $reference->max_value){
                return $reference->label;
            }

        return null;
    }
}
