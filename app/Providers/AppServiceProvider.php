<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\SubmissionSaved;
use App\Listeners\LogSubmissionSaved;

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
    public function boot(): void
    {
        //
    }
}
