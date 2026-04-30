<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassGroupController;
use App\Http\Controllers\TestTypeController;
use App\Http\Controllers\TestBatteryController;
use App\Http\Controllers\TestResultController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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


require __DIR__.'/auth.php';
