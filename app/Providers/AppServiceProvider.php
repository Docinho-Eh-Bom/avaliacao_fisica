<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Student;
use App\Models\TestBattery;
use App\Models\TestResult;
use App\Policies\StudentPolicy;
use App\Policies\TestBatteryPolicy;
use App\Policies\TestResultPolicy;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Student::class => StudentPolicy::class,
        TestBattery::class => TestBatteryPolicy::class,
        TestResult::class => TestResultPolicy::class
    ];


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
