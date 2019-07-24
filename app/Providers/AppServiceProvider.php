<?php

namespace App\Providers;

use App\Composers\KioskComposer;
use App\Composers\LayoutComposer;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;
use App\Models\Lokalen;
use App\Observers\LokalenObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Model observers
        Lokalen::observe(LokalenObserver::class);

        // View composers
        view()->composer('*', LayoutComposer::class);
        view()->composer('kiosk', KioskComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
