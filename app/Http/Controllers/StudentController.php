<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(){
        $students = Student::with(['classGroup', 'user'])->get();

        return view('students.index', compact('students'));
    }

    public function create(){
        $classes = ClassGroup::all();

        return view('students.create', compact('classes'));
    }

    public function show(Student $student){
        $student->load(['classGroup', 'batteries']);

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

        return redirect()->route('students.index')->with('success', 'Student added with success.');
    }

    public function update(Request $request, Student $student){
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'gender' => 'required|in:M,F',
            'birth_date' => 'required|date',
            'class_group_id' => 'nullable|exists:class_groups,id'
            ]);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated with success.');
    }

    public function destroy(Student $student){
        $student->delete();

        return back()->with('sucess', 'Student deleted with success.');
    }
}
