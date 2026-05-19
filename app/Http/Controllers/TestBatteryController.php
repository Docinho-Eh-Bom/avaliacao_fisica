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

    public function show(TestBattery $battery){
        $this->authorize('view', $battery);

        $battery->load([
            'student',
            'results.testType'
        ]);

        $evaluations = [];

        foreach($battery->results as $result){
            $evaluations[$result->id] =
                $this->evaluationService->evaluate($result);
        }

        return view('batteries.show', compact(
            'battery',
            'evaluations'
        ));
    }

    public function store(Request $request, Student $student){
        $this->authorize('view', $student);

        $data = $request->validate([
            'year' => 'required|integer|min:2003|max:'.date('Y')
        ]);

        $data['student_id'] = $student->id;

        TestBattery::create($data);

        return redirect()->route('students.show', $student)->with('success', 'Bateria de testes criada.');
    }

    public function destroy(TestBattery $battery){
        $this->authorize('delete', $battery);

        $battery->delete();

        return back()->with(
            'success',
            'Bateria de testes deletada.'
        );
    }
}
