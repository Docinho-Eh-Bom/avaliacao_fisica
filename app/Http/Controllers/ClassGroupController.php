<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Student;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassGroupController extends Controller
{
    public function index(){
        $classes = ClassGroup::with('students')
                ->where('user_id', Auth::id())
                ->get();

        return view('classes.index', compact('classes'));
    }

    public function create(){
        $allStudents = Student::where('user_id', Auth::id())->whereNull('class_group_id')->get();

        return view('classes.create', compact('allStudents'));
    }

    public function show(ClassGroup $classGroup){
        $classGroup->load('students');

        return view('classes.show', compact('classGroup'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'description' => "nullable|string",
            'students' => 'nullable|array',
            'students.*' => 'exists:students,id'
        ],
        [
            'name.required' => 'O nome da turma é obrigatório.'
        ]);

        $data['user_id'] = Auth::id();

        $classGroup = ClassGroup::create($data);
        if(isset($data['students'])){
            Student::whereIn('id', $data['students'])
                ->update([
                    'class_group_id' => $classGroup->id
                ]);
        }

        return redirect()->route('classes.index')->with('success', 'Turma criada com sucesso!');
    }

    public function edit(ClassGroup $classGroup){
        $students = $classGroup->students;

        $classes = ClassGroup::where('user_id', Auth::id())
            ->where('id', '!=', $classGroup->id)
            ->get();

        $availableStudents = Student::where('user_id', Auth::id())
            ->whereNull('class_group_id')
            ->get();

        return view('classes.edit', compact(
            'classGroup',
            'students',
            'classes',
            'availableStudents'
        ));
    }

    public function update(Request $request, ClassGroup $classGroup){
        $data = $request->validate([
            'name' => 'required|string',
            'description' => "nullable|"
        ],
        [
            'name.required' => 'O nome da turma é obrigatório.'
        ]);

        $classGroup->update($data);

        return redirect()->route(('classes.index'))->with('success', 'Dados da turma atualizados com sucesso!');
    }

    public function updateStudents(Request $request, ClassGroup $classGroup){
        $data = $request->validate([
                'students' => 'nullable|array',
                'new_students' => 'nullable|array'
            ]);

        $newStudents = $request->input('new_students', []);

        foreach(($data['students'] ?? []) as $studentId => $newClassId){
            $student = Student::find($studentId);

            if($student && $student->user_id === Auth::id()){
                $student->update([
                    'class_group_id' => $newClassId ?: null
                ]);
            }
        }

        if(!empty($newStudents)){
            Student::whereIn('id', $newStudents)
                ->whereNull('class_group_id')
                ->update([
                    'class_group_id' => $classGroup->id
                ]);
        }

        return back()->with(
            'success',
            'Alunos atualizados com sucesso!'
        );
    }

    public function destroy(ClassGroup $classGroup){
        $classGroup->delete();

        return back()->with('success', 'Turma deletada com sucesso!');
    }
}
