<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Livewire\IncidentDashboard;

use Livewire\Livewire; 
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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

            //  Administrador
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });

        //  Operador
        // 
        Gate::define('staff-access', function (User $user) {
            return in_array($user->role, ['admin', 'operador']);
        });

        // Cliente
        Gate::define('client-only', function (User $user) {
            return $user->role === 'cliente';
        });

    }
}
