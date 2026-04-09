<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Incident; // IMPORTANTE: Importa el modelo
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Consultamos eventos con su dispositivo relacionado
        $events = Event::with('device')->orderBy('created_at', 'desc')->paginate(15);

        // Consultamos incidencias activas o relacionadas para mostrar en la misma página
        $recentIncidents = Incident::with('device')
            ->where('status', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('events.index', compact('events', 'recentIncidents'));
    }

    }
