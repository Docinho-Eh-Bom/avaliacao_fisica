<?php
namespace App\Services;

use App\Models\TestBattery;
use App\Models\TestResult;

use Illuminate\Support\Facades\DB;

class TestBatteryService{
    protected $resultService;

    public function __construct(TestResultService $resultService){
        $this->resultService = $resultService;
    }

    public function createBatteryWithResults($studentId, $weight, $height, $year, $results){
    return DB::transaction(function () use ($studentId, $weight, $height, $year, $results){
        //battery
        $battery = TestBattery::create([
            'student_id' => $studentId,
            'weight' => $weight,
            'height' => $height,
            'year' => $year
        ]);

        $this->resultService->upsertResults($battery->id, $results);

        return $battery;
    });
}
}
