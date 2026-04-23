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
        //base value

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

    }

    //just a func to tell what type of ref it is
    public function resolveReferenceType($testType){

    }

    public function classify(float $value, $reference){

    }

    public function classifyPercentile(float $value, $reference){

    }

    public function classifyAbsolute(float $value, $reference){

    }

}
