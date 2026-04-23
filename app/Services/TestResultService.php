<?php
namespace App\Services;

use App\Models\TestResult;

class TestResultService{
    //cria result indivdual
    public function create($batteryId, $testTypeId, $value){
        return TestResult::create([
            'battery_id' => $batteryId,
            'test_type_id' => $testTypeId,
            'value' => $value
        ]);
    }

    //att result (erro na hora de digitar/inserir etc)
    public function update(TestResult $result, $value){
        $result->update([
            'value' => $value
        ]);
        return $result;
    }

    //cria|update batch result
    public function upsertResults($batteryId, array $results){
        foreach($results as $testTypeId => $value){
            if($value === null || $value === ''){
                continue;
            }

            TestResult::updateOrCreate([
                'battery_id' => $batteryId,
                'test_type_id' => $testTypeId
            ],
            [
                'value' => $value
            ]);
        }
    }

    //remove
    public function delete(TestResult $result){
        return $result->delete();
    }

    //search specific test within a battery
    public function getByBattery($batteryId){
        return TestResult::with('testType')
            ->where('battery_id', $batteryId)
            ->get();
    }

}
