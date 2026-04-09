<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Event; 
use App\Models\Incident;    
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function simulate(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'type' => 'required|string', 
        ]);

        //  Registrar el Evento
        $event = Event::create([
            'device_id' => $request->device_id,
            'type' => $request->type,
            'timestamp' => now(),
        ]);

        //  REGLA DE NEGOCIO (Punto 3 del requerimiento): Si el evento es de tipo 'desconexion', generar una incidencia automáticamente
        $incidentCreated = false;
       /*
        if ($request->type === 'desconexion') {
            Incident::create([
                'device_id' => $request->device_id,
                'type' => 'Falla de Conexión',
                'status' => 'pendiente',
                'description' => 'El dispositivo reportó una desconexión automática vía API.',
            ]);
            
            // Opcional: Cambiar el estado del dispositivo a 'alerta'
        //  Device::where('id', $request->device_id)->update(['status' => 'alerta']);
            $incidentCreated = true;
        }
        */
          // REGISTRO EN BITÁCORA (logs)
    \App\Models\Log::create([
        'user_id'     => 3, 
        'action'      => 'API-Simulación de Evento',
        'description' => "Se simuló un evento del tipo: {$request->type} para el dispositivo con ID: {$request->device_id} con IP: {$request->ip()}",
        'module'      => 'Eventos'
    
    ]);

        return response()->json([
            'message' => 'Evento procesado',
            'event' => $event,
            'incident_generated' => $incidentCreated
        ], 201);

        
    }
}