<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(){
        $students = Student::with(['classGroup'])
                            ->where('user_id', Auth::id())
                            ->get();

        return view('students.index', compact('students'));
    }

    public function create(){
        $classes = ClassGroup::where('user_id', Auth::id())->get();

        return view('students.create', compact('classes'));
    }

    public function show(Student $student){
        $this->authorize('view', $student);

        $student->load(['classGroup', 'batteries', 'batteries.results']);

        return view('students.show', compact('student'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'gender' => 'required|in:M,F',
            'birth_date' => 'required|date',
            'class_group_id' => 'nullable|exists:class_groups,id'
        ]);

        $data['user_id'] = Auth::id();

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Aluno adicionado com sucesso!');
    }

    public function edit(Student $student){
        $this->authorize('update', $student);

        $classes = ClassGroup::where('user_id', Auth::id())->get();

        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student){
        $this->authorize('update', $student);

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'gender' => 'required|in:M,F',
            'birth_date' => 'required|date',
            'class_group_id' => [
                'nullable',
                Rule::exists('class_groups', 'id')
                    ->where('user_id', Auth::id())]
            ]);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Dados do aluno atualizados com sucesso!');
    }

    public function destroy(Student $student){
        $this->authorize('delete', $student);

        $student->delete();

        return back()->with('success', 'Aluno deletado com sucesso!');
    }
}
