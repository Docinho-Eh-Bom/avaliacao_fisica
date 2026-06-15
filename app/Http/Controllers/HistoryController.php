<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function show(Student $student){
        $this->authorize('view', $student);

        $student->load(['batteries.results.testType']);

        $historyCharts = [];

        foreach($student->batteries as $battery){
            foreach($battery->results as $result){
                if(in_array($result->testType->calc_key, ['weight', 'height', 'waist'])){
                    continue;
                }

                $historyCharts[$result->testType->name][] = [
                    'year' => $battery->year,
                    'value' => $result->final_value
                ];
            }
        }

        return view('students.history',compact('student','historyCharts'));
    }
}
