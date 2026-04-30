<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassGroupController;
use App\Http\Controllers\TestTypeController;
use App\Http\Controllers\TestBatteryController;
use App\Http\Controllers\TestResultController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function (){
    //studentes
    Route::resource('students', StudentController::class);

    //classes
    Route::resource('classes', ClassGroupController::class);

    //test types
    Route::resource('test-types', TestTypeController::class);

    //activate tests
    Route::patch('test-types/{testType}/activate', [TestTypeController::class, 'activate'])->name('test-types.activate');

    //batteries in student
    Route::resource('students.batteries', TestBatteryController::class)->shallow();

    //results in battery
    Route::resource('batteries.results', TestResultController::class)->shallow();
});
