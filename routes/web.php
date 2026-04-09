<?php
namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ClientController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    //rutas que requieren autenticacion
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   Route::resource('devices', DeviceController::class);
   Route::resource('clients', ClientController::class);
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
   Route::post('/simulate-event', function (Illuminate\Http\Request $request) {
    Event::create([
        'device_id' => $request->device_id,
        'type'      => $request->type,
        'timestamp' => now(),
    ]);

    // rutas roles
    // Solo el Admin puede ver la Bitácora (Logs)
        Route::get('/logs', [LogController::class, 'index'])
            ->middleware('can:admin-only');

        // El CRUD de Clientes es solo para el Admin
        Route::resource('clients', ClientController::class)
            ->middleware('can:admin-only');

        // Dispositivos y Eventos: Accesible para Admin y Operador
       Route::get('/devices/{device}', [DeviceController::class, 'show'])->name('devices.show')
            ->middleware('can:staff-access');

        Route::get('/events', [EventController::class, 'index'])
            ->middleware('can:staff-access');

    return back()->with('success', 'Evento procesado: Incidencia generada automáticamente.');
})->name('simulate.event');


});

require __DIR__.'/auth.php';
