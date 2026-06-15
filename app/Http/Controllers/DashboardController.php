<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Student;
use App\Models\TestBattery;
use App\Models\TestResult;
use App\Models\TestType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function index(){
        $studentCount = Student::where('user_id', Auth::id())->count();

        $classCount = ClassGroup::where('user_id', Auth::id())->count();

        $batteryCount = TestBattery::whereHas(
            'student',
            fn($q) => $q->where('user_id', Auth::id()))
        ->count();

        $studentsWithoutClass = Student::where('user_id', Auth::id())
        ->whereNull('class_group_id')
        ->get();

        $classDistribution = ClassGroup::where('user_id', Auth::id())
        ->withCount('students')
        ->get();

        $batteriesPerYear = TestBattery::whereHas(
            'student',
            fn($q) => $q->where('user_id', Auth::id()))
        ->selectRaw('year, COUNT(*) as total')
        ->groupBy('year')
        ->orderBy('year')
        ->get();

        $currentYear = now()->year;
        $studentsWithoutBattery = Student::where('user_id', Auth::id())
        ->whereDoesntHave(
            'batteries',
            fn($q) => $q->where('year', $currentYear))
        ->get();

        $classifications = TestResult::whereHas(
            'battery.student',
            fn($q) => $q->where('user_id', Auth::id()))
        ->whereNotNull('classification')
        ->selectRaw('classification, COUNT(*) as total')
        ->groupBy('classification')
        ->get();

        return view('dashboard.index', compact(
            'studentCount',
            'classCount',
            'batteryCount',
            'studentsWithoutClass',
            'classDistribution',
            'batteriesPerYear',
            'studentsWithoutBattery',
            'classifications'
        ));
    }
}
