<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Principal
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- GRUPO DE RUTAS PROTEGIDAS (Requieren Login) ---
Route::middleware('auth')->group(function () {

    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // DISPOSITIVOS: Simulación de Falla (IMPORTANTE: Debe ir antes del Resource)
    Route::post('/devices/{device}/simulate-fail', [DeviceController::class, 'simulateFail'])
        ->name('devices.simulate-fail');

    // CRUD de Dispositivos (Solo accesible para Staff/Admin según tus Gates)
    Route::resource('devices', DeviceController::class);

    // EVENTOS: Listado y Simulación rápida
    Route::get('/events', [EventController::class, 'index'])
        ->middleware('can:staff-access')
        ->name('events.index');

    Route::post('/simulate-event', function (Request $request) {
        Event::create([
            'device_id' => $request->device_id,
            'type'      => $request->type,
            'timestamp' => now(),
        ]);
        return back()->with('success', 'Evento procesado: Incidencia generada automáticamente.');
    })->name('simulate.event');

    // CLIENTES: Solo Administradores
    Route::resource('clients', ClientController::class)
        ->middleware('can:admin-only');

    // LOGS: Solo Administradores
    Route::get('/logs', [LogController::class, 'index'])
        ->middleware('can:admin-only')
        ->name('logs.index');

    // NOTIFICACIONES: Marcar como leídas (Para la campanita)
    Route::post('/notifications/read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markAsRead');

});

require __DIR__.'/auth.php';