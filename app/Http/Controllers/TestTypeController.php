<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestType;
use App\Services\TestTypeService;


class TestTypeController extends Controller
{
    protected $service;

    public function __construct(TestTypeService $service){
        $this->service = $service;
    }

    public function index(){
        $types = $this->service->getAll();

        return view('test-types.index', compact('types'));
    }

    public function create(){
        return view('test_types.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'unit'=> 'required|string',
            'calc_type' => 'required|in:direct,derived',
            'calc_key'=> 'nullable|string'
        ]);

        //if calc type derived = they need a specific calc to get the result
        if($data['calc_type'] === 'derived' && empty($data['calc_key'])){
            return back()->withErrors('Derived tests require calc_key');
        }

        $this->service->create($data);

        return redirect()->route('test-types.index');
    }

    public function update(Request $request, TestType $testType){
        $data = $request->validate([
            'name' => 'required|string',
            'unit'=> 'required|string',
            'calc_type' => 'required|in:direct,derived',
            'calc_key'=> 'nullable|string'
        ]);

        if($data['calc_type'] === 'derived' && empty($data['calc_key'])){
            return back()->withErrors('Derived tests require calc_key');
        }

        $this->service->update($testType, $data);

        return redirect()->route('test-types.index');
    }

    public function destroy(TestType $testType){
        $this->service->deactivate($testType);

        return back();
    }

    public function activate(TestType $testType){
        $this->service->activate($testType);

        return back();
    }
}
