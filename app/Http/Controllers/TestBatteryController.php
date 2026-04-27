<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\TestBattery;


class TestBatteryController extends Controller
{
    public function index(Student $student){
        $batteries = $student->batteries()
                            ->latest()
                            ->get();

        return view('batteries.index', compact('student', 'batteries'));
    }

    public function create(Student $student){
        return view('batteries.create', compact('student'));
    }

    public function store(Request $request, Student $student){
        $data = $request->validate([
            'year' => 'required|integer|min:2003|max:'.date('Y')
        ]);

        $data['student_id'] = $student->id;

        TestBattery::create($data);

        return redirect()->route('students.show', $student)->with('success', 'Battery created.');
    }
}
