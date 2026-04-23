<?php
namespace App\Services;

use App\Models\ReferenceValue;

class ReferenceValueService{
    //search by test,age, gender
    public function getReference($testTypeId, $age, $gender){
        return ReferenceValue::where('test_type_id', $testTypeId)
            ->where('age_min', '<=', $age)
            ->where('age_max', '>=', $age)
            ->where('gender', $gender)
            ->first();
    }

    //search by percentil | absolute
    public function getReferencyByType($testTypeId, $age, $gender, $type){
        return ReferenceValue::where('test_type_id', $testTypeId)
            ->where('age_min', '<=', $age)
            ->where('age_max', '>=', $age)
            ->where('gender', $gender)
            ->where('type', $type)
            ->first();
    }

    //all ref by type
    public function getByTestTypes($testTypeId){
        return ReferenceValue::where('test_type_id', $testTypeId)->get();
    }

    //create for custom ref
    public function create(array $data){
        if($data['type'] === 'percentile'){
            $data['min_value'] = null;
            $data['max_value'] = null;
            $data['label'] = null;
        }

        if($data['type'] === 'absolute'){
            $data['p0'] = null;
            $data['p40'] = null;
            $data['p60'] = null;
            $data['p80'] = null;
            $data['p98'] = null;
        }

        return ReferenceValue::create($data);
    }

    //remove ref
    public function delete(ReferenceValue $reference){
        return $reference->delete();
    }
}
