<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\EvaluationService;
use App\Models\TestBattery;


class TestBatteryController extends Controller{

    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService){
        $this->evaluationService = $evaluationService;
    }

    public function index(Student $student){
        $this->authorize('view', $student);

        $batteries = $student->batteries()
                            ->latest()
                            ->get();

        return view('batteries.index', compact('student', 'batteries'));
    }

    public function create(Student $student){
        $this->authorize('view', $student);

        return view('batteries.create', compact('student'));
    }

    public function show(Request $request,TestBattery $battery){
        $this->authorize('view', $battery);

        $battery->load([
            'student',
            'results.testType'
        ]);

        $classificationMode = $request->get('classification','general');

        foreach($battery->results as $result){
            $evaluation = $this->evaluationService->evaluateDerived($result);


            $result->final_value = $evaluation['value'];

            if($classificationMode === 'class'){
                $percentile = $this->evaluationService->calcClassPercentile($result);

                $result->classification =
                    $percentile !== null
                        ? $this->evaluationService
                            ->classifyPercentileClass($percentile)
                        : null;
            }else{
                $result->classification =
                    $evaluation['classification'];
            }
        }

        return view('batteries.show', compact(
            'battery',
            'classificationMode'
        ));
    }

    public function store(Request $request, Student $student){
        $this->authorize('view', $student);

        $data = $request->validate([
            'year' => 'required|integer|min:2003|max:'.date('Y')
        ],
        [
            'year.min' => 'O ano não pode ser menor que 2003.',
            'year.max' => 'O ano não pode ser maior que o ano atual.',
        ]);

        $data['student_id'] = $student->id;

        $exists = TestBattery::where('student_id', $student->id)
            ->where('year', $data['year'])
            ->exists();

        if($exists){
            return back()
                ->withErrors([
                    'year' => 'Já existe uma bateria cadastrada para este aluno neste ano.'
                ])
                ->withInput()
                ->with('openModal', 'create-battery');
        }

        TestBattery::create($data);

        return redirect()->route('students.show', $student)->with('success', 'Bateria de testes criada.');
    }

    public function destroy(TestBattery $battery){
        $this->authorize('delete', $battery);

        $battery->results()->delete();
        $battery->delete();

        return redirect()
            ->route('students.show', $battery->student_id)
            ->with('success', 'Bateria de testes removida.');
    }
}
