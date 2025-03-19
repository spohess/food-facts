<?php

namespace App\Providers;

use App\Models\ImportControl;
use App\Observers\ImportControlObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        ImportControl::observe(ImportControlObserver::class);
    }
}
