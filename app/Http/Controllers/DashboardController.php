<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DashboardController extends Controller
{
   public function index()
    {
      $user = auth()->user();

    $user = auth()->user();

// Verificamos si es personal interno (Admin u Operador)
if ($user->role === 'admin' || $user->role === 'operador') {
    
    // Vista Global: Acceso a todos los registros de la base de datos
    $totalDevices = \App\Models\Device::count();
    $activeDevices = \App\Models\Device::where('status', 'activo')->count();
    $pendingIncidents = \App\Models\Incident::where('status', 'pendiente')->count();

} else {
    
    // Vista Restringida: Solo lo que pertenece a su empresa (Relación User -> Client -> Devices)
    // Asegúrate de que el modelo User tenga la relación 'client' definida
    $client = $user->client;

    if ($client) {
        $totalDevices = $client->devices()->count();
        $activeDevices = $client->devices()->where('status', 'activo')->count();
        $pendingIncidents = $client->incidents()->where('incidents.status', 'pendiente')->count();
    } else {
        // Fallback por si un usuario tipo cliente no tiene empresa asignada aún
        $totalDevices = 0;
        $activeDevices = 0;
        $pendingIncidents = 0;
    }
}

    return view('dashboard', compact('totalDevices', 'activeDevices'));
    }
}
