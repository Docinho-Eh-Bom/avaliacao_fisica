<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassGroupController extends Controller
{
    public function index(){
        $classes = ClassGroup::with('students')->get();

        return view('classes.index', compact('classes'));
    }

    public function create(){
        return view('classes.create');
    }

    public function show(ClassGroup $classGroup){
        $classGroup->load('students');

        return view('classes.show', compact('classgroup'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'description' => "nullable|"
        ]);

        $data['user_id'] = Auth::id();

        ClassGroup::create($data);

        return redirect()->route('classes.index');
    }

    public function update(Request $request, ClassGroup $classGroup){
        $data = $request->validate([
            'name' => 'required|string',
            'description' => "nullable|"
        ]);

        $classGroup->update($data);

        return redirect()->route(('classes.index'));
    }

    public function destroy(ClassGroup $classGroup){
        $classGroup->delete();

        return back();
    }
}
