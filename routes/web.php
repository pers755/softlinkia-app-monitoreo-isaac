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

   Route::post('/simulate-event', function (Illuminate\Http\Request $request) {
    Event::create([
        'device_id' => $request->device_id,
        'type'      => $request->type,
        'timestamp' => now(),
    ]);

    return back()->with('success', 'Evento procesado: Incidencia generada automáticamente.');
})->name('simulate.event');


});

require __DIR__.'/auth.php';
