<?php
namespace App\Services;

use App\Models\TestType;

class TestTypeService{
    //return all
    public function getAll(){
        return TestType::orderBy('name')->get();
    }

    //by type
    public function findById($id){
        return TestType::findOrFail($id);
    }

    //by active
    public function getAllActive(){
        return TestType::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    //calc direct
    public function getDirect(){
        return TestType::where('calc_type', 'direct')
            ->where('is_active', true)
            ->get();
    }

    //calc derived
    public function getDerived(){
        return TestType::where('calc_type', 'derived')
            ->where('is_active', true)
            ->get();
    }

    //create new
    public function create(array $data){
        return TestType::create([
            'name' => $data['name'],
            'unit' => $data['unit'],
            'calc_type' => $data['calc_type'],
            'calc_key' => $data['calc_key'] ?? null,
        ]);
    }

    //update
    public function update(TestType $testType, array $data){
        $testType->update(([
            'name' => $data['name'],
            'unit' => $data['unit'],
            'calc_type' => $data['calc_type'],
            'calc_key' => $data['calc_key']
        ]));
        return $testType;
    }

    //'remove'
    public function deactivate(TestType $testType){
        $testType->update(['is_active' => false]);
        return $testType;
    }

    //activate 'removed' test (no need to create the same test again)
    public function activate(TestType $testType){
        $testType->update(['is_active' => true]);
        return $testType;
    }

    //select input opt
    public function getFormatForSelect(){
        return TestType::where('is_active', true)
            ->get()
            ->map(function ($type){
            return  [
                'id' => $type->id,
                'label' => "{$type->name} ({$type->unit})"
            ];
        });
    }
}
