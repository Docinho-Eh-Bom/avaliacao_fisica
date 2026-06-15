<?php
namespace App\Http\Controllers;

use App\Models\TestBattery;
use App\Models\ReferenceValue;
use App\Models\TestType;
use App\Services\EvaluationService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller{
    public function show(TestBattery $battery, EvaluationService $service){
        $this->authorize('view', $battery);

        $battery->load([
            'student.classGroup',
            'results.testType'
        ]);

        $data = $this->buildReportData($battery, $service);

        return view(
            'reports.show',
            array_merge(
                ['battery' => $battery],
                $data
            )
        );
    }

    private function buildReportData(TestBattery $battery, EvaluationService $service){
        $body = collect();
        $health = collect();
        $motor = collect();
        $chartData = [];

        $derived = $service->getDerivedResult($battery);

        foreach($battery->results as $result){
        if($result->final_value === null){
            $evaluation = $service->evaluateDerived($result);

            $result->final_value = $evaluation['value'];
            $result->classification = $evaluation['classification'];
        }

        $result->referenceValues = ReferenceValue::where(
            'test_type_id',
            $result->test_type_id
        )
        ->where('gender', $battery->student->gender)
        ->where('age_min', '<=', $battery->student->age)
        ->where('age_max', '>=', $battery->student->age)
        ->orderBy('min_value')
        ->get();

        $result->chartData = $result->referenceValues
            ->map(function($ref){
                return [
                    'label' => $ref->label,
                    'value' => $ref->label === 'excellent'
                        ? $ref->min_value
                        : $ref->max_value,
                ];
            })
            ->values();

        switch($result->testType->calc_key){
            case 'weight':
            case 'height':
            case 'waist':
                $body->push($result);
                break;

            default:

                if(in_array($result->testType->name,
                    [
                        'Flexibilidade',
                        'Força Abdominal',
                        'Aptidão Cardiorrespiratória'
                    ]
                )){
                    $health->push($result);
                }else{
                    $motor->push($result);
                }
            }

            $chartData[] = [
                'label' => $result->testType->name,
                'score' => match($result->classification){
                    'weak' => 1,
                    'average' => 2,
                    'good' => 3,
                    'very_good' => 4,
                    'excellent' => 5,
                    default => 0
                }
            ];
        }

        $allDirectTests = TestType::where('is_active', true)
            ->where('calc_type', 'direct')
            ->get();

        foreach($allDirectTests as $testType){
            $exists =
                $body->contains(fn($r) => ($r->testType->id ?? null) === $testType->id)
                || $health->contains(fn($r) => ($r->testType->id ?? null) === $testType->id)
                || $motor->contains(fn($r) => ($r->testType->id ?? null) === $testType->id);

            if($exists){
                continue;
            }

            $fakeResult = (object)[
                'testType' => $testType,
                'final_value' => null,
                'classification_label' => 'Sem resultado',
            ];

            switch($testType->calc_key){
                case 'weight':
                case 'height':
                case 'waist':
                    $body->push($fakeResult);
                    break;

                default:
                    if(in_array($testType->name,[
                        'Flexibilidade',
                        'Força Abdominal',
                        'Aptidão Cardiorrespiratória'
                    ])){
                        $health->push($fakeResult);
                    }else{
                        $motor->push($fakeResult);
                    }
            }
        }

        return compact(
            'body',
            'derived',
            'health',
            'motor',
            'chartData'
        );
    }

    public function exportPdf(Request $request, TestBattery $battery, EvaluationService $service){
        $this->authorize('view', $battery);

        $battery->load([
            'student.classGroup',
            'results.testType'
        ]);

        $data = $this->buildReportData($battery, $service);

/*         $results = collect()
            ->merge($data['body'])
            ->merge($data['derived'])
            ->merge($data['health'])
            ->merge($data['motor']); */

        $charts = json_decode(
            $request->charts,
            true
        );

        return Pdf::loadView(
            'reports.pdf',
            [
                'battery' => $battery,
                'body' => $data['body'],
                'derived' => $data['derived'],
                'health' => $data['health'],
                'motor' => $data['motor'],
                'charts' => $charts
            ]
        )->download('relatorio-'.$battery->student->name.'-'.$battery->year.'.pdf');
    }
}
