<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function show(Request $request, Student $student, EvaluationService $service){
        $student->load(['batteries.results.testType']);

        $batteries = $student->batteries()->orderBy('year')->whereHas('results')->get();

        $battery1 = $batteries->firstWhere('id', $request->battery1);
        $battery2 = $batteries->firstWhere('id', $request->battery2);

        $comparison = collect();

        $improved = 0;
        $same = 0;
        $worse = 0;

        if($battery1 && $battery2){
            foreach($battery1->results as $result1){
                if(in_array($result1->testType->calc_key,['weight', 'height', 'waist'])){
                    continue;
                }

                $result2 = $battery2->results->firstWhere('test_type_id', $result1->test_type_id);

                if(!$result2){
                    continue;
                }

                $isReverse = in_array($result1->testType->name, ['Agilidade', 'Velocidade']);
                $difference = round($result2->final_value - $result1->final_value,2);

                if($isReverse){
                    $difference *= -1;
                }

                $comparison->push([
                    'test' => $result1->testType->name,
                    'unit' => $result1->testType->unit,
                    'old_value' => $result1->final_value,
                    'new_value' => $result2->final_value,
                    'old_classification' => $result1->classification_label,
                    'new_classification' => $result2->classification_label,
                    'difference' => $difference
                ]);
            }

            $derived1 = $service->getDerivedResult($battery1);
            $derived2 = $service->getDerivedResult($battery2);

            foreach($derived1 as $result1){
                $result2 = collect($derived2)->firstWhere('name', $result1->name);

                if(!$result2){
                    continue;
                }

                $comparison->push([
                    'test' => $result1->name,
                    'unit' => $result1->unit,
                    'old_value' => $result1->final_value,
                    'new_value' => $result2->final_value,
                    'old_classification' => $result1->classification_label,
                    'new_classification' =>$result2->classification_label,
                    'difference' => round($result2->final_value - $result1->final_value, 2)
                ]);
            }

            $improved = $comparison->where('difference', '>', 0)->count();
            $same = $comparison->where('difference', 0)->count();
            $worse = $comparison->where('difference', '<', 0)->count();
        }

        return view('comparison.show', compact(
            'student',
            'batteries',
            'battery1',
            'battery2',
            'comparison',
            'improved',
            'same',
            'worse'
        ));
    }
}
