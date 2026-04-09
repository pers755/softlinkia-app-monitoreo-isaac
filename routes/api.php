<?php


use App\Http\Controllers\Api\EventController;

// Le cambiamos el nombre a algo más específico para la API
Route::post('/v1/device-event', [EventController::class, 'simulate']);