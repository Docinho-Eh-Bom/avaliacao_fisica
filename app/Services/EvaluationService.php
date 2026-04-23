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
        $value = $result->v

        //calcs if percentile

        //get ref

        //classify

        //return the avaliation [
        //(final value(if percentile)
        //the type of reference
        //and the final classification]
    }

    //prepare data for the calcs
    public function buildMetricData(TestResult $result){
        return [
            'weight' => $result->weight ?? null,
            //height
            //waist
        ];
    }

    //just a func to tell what type of ref it is
    public function resolveReferenceType($testType){
        return $testType->calc_type === 'derived' ? 'absolute' : 'percentile';
    }

    public function classify(float $value, $reference){
        return match($reference->type){
            'percentile' => $this->classifyPercentile($value, $reference),
            //absolute
        };
    }

    public function calcClassPercentile($result){
        $testTypeId = $result->test_type_id;
        $classId = $result->battery->student->class_group_id;

        $results = TestResult::whereHas('battery.student',
            function ($q) use ($classId)){
                $q->where('class_group_id', $classId);
            }
    }

    public function classifyPercentile(float $value, $reference){
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
