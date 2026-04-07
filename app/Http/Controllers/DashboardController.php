<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DashboardController extends Controller
{
   public function index()
    {
      $user = auth()->user();

    if ($user->isAdmin()) {
        // Si eres admin, ves todo el panorama global
        $totalDevices = \App\Models\Device::count();
        $activeDevices = \App\Models\Device::where('status', 'activo')->count();
    } else {
        // Si es cliente, solo ve sus equipos a través de su relación
        $client = $user->client;
        $totalDevices = $client->devices()->count();
        $activeDevices = $client->devices()->where('status', 'activo')->count();
    }

    return view('dashboard', compact('totalDevices', 'activeDevices'));
    }
}
