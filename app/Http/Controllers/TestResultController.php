<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestBattery;
use App\Models\TestResult;
use App\Services\EvaluationService;
use App\Services\TestTypeService;

class TestResultController extends Controller
{
    protected $evaluationService;
    protected $testTypeService;

    public function __construct(EvaluationService $evaluationService, TestTypeService $testTypeService){
        $this->evaluationService = $evaluationService;
        $this->testTypeService = $testTypeService;
    }

    public function create(TestBattery $battery){
        $types = $this->testTypeService->getAllActive();

        return view('results.create', compact('battery', 'types'));
    }

    public function store(Request $request, TestBattery $battery){
        $data = $request->validate([
            'test_type_id' => 'required|exists:test_types,id',
            'value' => 'required|numeric'
        ]);

        $data['battery_id'] = $battery->id;

        $result = TestResult::create($data);

        $evaluation = $this->evaluationService->evaluate($result);

        return redirect()
                ->route('batteries.show', [
                    'student' => $battery->student_id,
                    'battery' => $battery->id
                ])
                ->with('success', 'Result added')
                ->with('evaluation');
    }

    public function destroy(TestBattery $battery, TestResult $result){
        $result->delete();

        return back()->with('success', 'Result deleted');
    }
}
