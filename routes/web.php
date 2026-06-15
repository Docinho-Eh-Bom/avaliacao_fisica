<?php

use App\Models\Student;
use App\Models\ClassGroup;
use App\Models\TestBattery;
use App\Models\TestType;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassGroupController;
use App\Http\Controllers\TestTypeController;
use App\Http\Controllers\TestBatteryController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TestResultController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function (){
    return view('auth.login');
});

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function (){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function (){
    //studentes
    Route::resource('students', StudentController::class);

    //classes
    Route::resource('classes', ClassGroupController::class)->parameters(['classes' => 'classGroup']);
    Route::put('/classes/{classGroup}/students', [ClassGroupController::class, 'updateStudents'])->name('classes.students.update');

    //test types
    Route::resource('test-types', TestTypeController::class);

    //activate tests
    Route::patch('test-types/{testType}/activate', [TestTypeController::class, 'activate'])->name('test-types.activate');

    //batteries in student
    Route::resource('students.batteries', TestBatteryController::class)->shallow();

    //battery comparison
    Route::get('/students/{student}/comparison', [ComparisonController::class, 'show'])->name('comparison.show');

    //results in battery
    Route::resource('batteries.results', TestResultController::class)->shallow();

    //all results(history)
    Route::get('/students/{student}/history', [HistoryController::class, 'show'])->name('students.history');

    //report view
    Route::get('/batteries/{battery}/report', [ReportController::class, 'show'])->name('reports.show');

    //export pdf
    Route::post('/reports/{battery}/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
});

require __DIR__.'/auth.php';
