<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Incident;
use App\Models\DeviceEvent;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
{
    $user = auth()->user();
    $isCliente = $user->hasRole('cliente');

    // Estadísticas base (mantenemos las que ya tienes)
    $stats = [
        'total_devices'    => Device::when($isCliente, fn($q) => $q->where('client_id', $user->id))->count(),
        'active_incidents' => Incident::where('status', 'pendiente')
                                ->when($isCliente, fn($q) => $q->whereHas('device', fn($d) => $d->where('client_id', $user->id)))
                                ->count(),
        'devices_alert'    => Device::where('status', 'alerta')
                                ->when($isCliente, fn($q) => $q->where('client_id', $user->id))
                                ->count(),
        'online_devices'   => Device::where('status', 'activo')
                                ->when($isCliente, fn($q) => $q->where('client_id', $user->id))
                                ->count(),
    ];

    // DATOS PRO: Distribución de Eventos por Gravedad (Para la gráfica)
    // Esto agrupa por tipo de evento para ver qué falla más
    $eventDist = \App\Models\Event::selectRaw('type, count(*) as total')
        ->when($isCliente, fn($q) => $q->whereHas('device', fn($d) => $d->where('client_id', $user->id)))
        ->groupBy('type')
        ->get();

    // DATOS PRO: Porcentaje de Eficiencia (Uptime)
    $total = $stats['total_devices'] ?: 1;
    $uptime = ($stats['online_devices'] / $total) * 100;

    return view('dashboard', compact('stats', 'eventDist', 'uptime'));
}
}
