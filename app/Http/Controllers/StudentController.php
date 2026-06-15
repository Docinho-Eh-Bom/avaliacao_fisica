<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassGroup;
use App\Services\EvaluationService;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function index(Request $request){
        $query = Student::with(['classGroup'])->where('user_id', Auth::id());

        if($request->filled('gender')){
            $query->where('gender', $request->gender);
        }

        if($request->filled('class_group_id')){
            $query->where(
                'class_group_id',
                $request->class_group_id
            );
        }

        $students = $query->orderBy('name')->paginate(10)->withQueryString();
        $classes = ClassGroup::where('user_id',Auth::id())->orderBy('name')->get();

        return view('students.index', compact('students', 'classes'));
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
        try{
            $data = $request->validate([
            'name' => 'required|string|max:150',
            'gender' => 'required|in:M,F',
            'birth_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail){
                    $age = Carbon::parse($value)->age;

                    if($age < 6 || $age > 17){
                        $fail('O aluno deve ter entre 6 e 17 anos.');
                    }
                }
            ],
            'class_group_id' => 'nullable|exists:class_groups,id'
        ]);

        $data['user_id'] = Auth::id();

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Aluno adicionado com sucesso!');
        }catch(\Exception $e){
            return redirect()->route('students.index')->with('error', 'Ocorreu um erro ao salvar');
        }
    }

    public function edit(Student $student){
        $this->authorize('update', $student);

        $classes = ClassGroup::where('user_id', Auth::id())->get();

        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student){
        try{
                    $this->authorize('update', $student);

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'gender' => 'required|in:M,F',
            'birth_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail){
                    $age = Carbon::parse($value)->age;

                    if($age < 6 || $age > 17){
                        $fail('O aluno deve ter entre 6 e 17 anos.');
                    }
                }
            ],
            'class_group_id' => [
                'nullable',
                Rule::exists('class_groups', 'id')
                    ->where('user_id', Auth::id())]
            ]);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Dados do aluno atualizados com sucesso!');
        }catch(\Exception $e){
            return redirect()->route('students.index')->with('error', 'Ocorreu um erro ao atualizar.');
        }
    }

    public function destroy(Student $student){
        $this->authorize('delete', $student);

        $student->delete();

        return back()->with('success', 'Aluno deletado com sucesso!');
    }
}
