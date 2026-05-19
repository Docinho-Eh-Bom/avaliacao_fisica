<?php

use App\Models\Student;
use App\Models\ClassGroup;
use App\Models\TestBattery;
use App\Models\TestType;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassGroupController;
use App\Http\Controllers\TestTypeController;
use App\Http\Controllers\TestBatteryController;
use App\Http\Controllers\TestResultController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function (){
    return view('welcome');
});

//dashboard
Route::get('/dashboard', function (){

    $studentCount = Student::where('user_id', Auth::id())->count();

    $classCount = ClassGroup::where('user_id', Auth::id())->count();

    $batteryCount = TestBattery::where('user_id', Auth::id())->count();

    $testCount = TestType::where('user_id', Auth::id())->count();

    $studentsWithoutClass = Student::where('user_id', Auth::id())
        ->whereNull('class_group_id')
        ->get();

    return view('dashboard', compact(
        'studentCount',
        'classCount',
        'batteryCount',
        'testCount',
        'studentsWithoutClass'
    ));

})->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::put('/classes/{classGroup}/students',[ClassGroupController::class, 'updateStudents'])->name('classes.students.update');

    //test types
    Route::resource('test-types', TestTypeController::class);

    //activate tests
    Route::patch('test-types/{testType}/activate', [TestTypeController::class, 'activate'])->name('test-types.activate');

    //batteries in student
    Route::resource('students.batteries', TestBatteryController::class)->shallow();

    //results in battery
    Route::resource('batteries.results', TestResultController::class)->shallow();
});


require __DIR__.'/auth.php';
