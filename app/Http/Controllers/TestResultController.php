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

        $types = $this->testTypeService->getAllDirect();

        $battery->load('student');

        return view('results.create', compact(
            'battery',
            'types'
        ));
    }

    public function store(Request $request, TestBattery $battery){
        $this->authorize('update', $battery);

        $isFirstInsert = !$battery->results()->exists();

        $requiredTests = ['Peso', 'Estatura', 'Cintura'];

        $data = $request->validate([
            'results' => 'required|array',
            'results.*.test_type_id' => [
                'required',
                'exists:test_types,id'
            ],
            'results.*.value' => [
                'nullable',
                'numeric'
            ]
        ]);

        if($isFirstInsert){
            $types = $this->testTypeService
                ->getAllDirect()
                ->keyBy('id');

            foreach($data['results'] as $result){
                $type = $types[$result['test_type_id']] ?? null;

                if($type && in_array($type->name, $requiredTests) && blank($result['value'])){
                    return back()
                        ->with([
                            'error' => "O resultado de {$type->name} é obrigatório."
                        ])
                        ->withInput();
                }
            }
        }

        foreach ($data['results'] as $resultData){
            if(
                !isset($resultData['value']) ||
                $resultData['value'] === null ||
                $resultData['value'] === ''
            ){
                continue;
            }

            $result = TestResult::updateOrCreate(
                [
                    'battery_id' => $battery->id,
                    'test_type_id' => $resultData['test_type_id']
                ],
                [
                    'value' => $resultData['value']
                ]
            );

            $evaluation = $this->evaluationService->evaluateDerived($result);

            $result->update([
                'final_value' => $evaluation['value'] ?? null,
                'classification' => $evaluation['classification'] ?? null
            ]);
        }

        return redirect()
            ->route('batteries.show', $battery)
            ->with('success', 'Resultados salvos.');
    }

    public function update(Request $request, TestResult $result){
        $this->authorize('update', $result);

        $data = $request->validate([
            'value' => 'required|numeric'
        ]);

        $result->update([
            'value' => $data['value']
        ]);

        $evaluation = $this->evaluationService->evaluateDerived($result);

        $result->update([
            'final_value' => $evaluation['value'],
            'classification' => $evaluation['classification']
        ]);

        return back()->with(
            'success',
            'Resultado atualizado.'
        );
    }

    public function destroy(TestResult $result){
        $this->authorize('delete', $result);

        $result->delete();

        return back()->with('success', 'Resultado removido');
    }
}
