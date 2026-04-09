<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Livewire\IncidentDashboard;

use Livewire\Livewire; // <--- TE FALTA ESTA LÍNEA
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
        Livewire::component('incident-dashboard', IncidentDashboard::class);
    }
}
