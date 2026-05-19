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
        $this->authorize('update', $battery);

        $types = $this->testTypeService->getAllActive();

        return view('results.create', compact('battery', 'types'));
    }

    public function store(Request $request, TestBattery $battery){
        $this->authorize('update', $battery);

        $data = $request->validate([
            'results' => 'required|array',
            'results.*' => 'nullable|numeric'
        ]);

        foreach($data['results'] as $testTypeId => $value){

            if($value === null || $value === ''){
                continue;
            }

            $result = TestResult::updateOrCreate(
                [
                    'battery_id' => $battery->id,
                    'test_type_id' => $testTypeId
                ],
                [
                    'value' => $value
                ]
            );

            $this->evaluationService->evaluate($result);
        }

        return redirect()
            ->route('batteries.show', $battery)
            ->with('success', 'Resultados salvos.');
    }

    public function destroy(TestResult $result){
        $this->authorize('delete', $result);

        $result->delete();

        return back()->with('success', 'Resultado removido');
    }
}
