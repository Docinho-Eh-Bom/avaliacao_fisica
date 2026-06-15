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
            ->get();
    }

/*     //search by percentil | absolute
    public function getReferencyByType($testTypeId, $age, $gender, $type){
        return ReferenceValue::where('test_type_id', $testTypeId)
            ->where('age_min', '<=', $age)
            ->where('age_max', '>=', $age)
            ->where('gender', $gender)
            ->where('type', $type)
            ->first();
    } */

    //all ref by type
    public function getByTestTypes($testTypeId){
        return ReferenceValue::where('test_type_id', $testTypeId)->get();
    }

    //create for custom ref
    public function create(array $data){
        return ReferenceValue::create($data);
    }

    //find classification for the age gaps
    public function findClassification($testTypeId,$age,$gender,$value){
        return ReferenceValue::where('test_type_id', $testTypeId)
            ->where('age_min', '<=', $age)
            ->where('age_max', '>=', $age)
            ->where('gender', $gender)
            ->where('type', 'absolute')
            ->where('min_value', '<=', $value)
            ->where('max_value', '>=', $value)
            ->first();
    }

        public function findClassificationDerived($testTypeId,$age,$gender,$value){
        return ReferenceValue::where('test_type_id', $testTypeId)
            ->where('age_min', '<=', $age)
            ->where('age_max', '>=', $age)
            ->where('gender', $gender)
            ->where('type', 'derived')
            ->where('min_value', '<=', $value)
            ->where('max_value', '>=', $value)
            ->first();
    }


    //remove ref
    public function delete(ReferenceValue $reference){
        return $reference->delete();
    }
}
