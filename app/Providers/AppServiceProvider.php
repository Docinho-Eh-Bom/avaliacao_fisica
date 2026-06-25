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
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
/*     public function boot(): void
    {
        URL::forceScheme('https');

        URL::forceRootUrl(config('app.url'));

        if (config('app.asset_url')) {
            URL::forceRootUrl(config('app.asset_url'));
        }
    } */
}

