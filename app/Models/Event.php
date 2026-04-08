<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Incident;
class Event extends Model
{
    protected static function booted()
{
    static::created(function ($event) {
        // REGLA: Si el evento es 'desconexion', disparamos la incidencia
        if ($event->type === 'desconexion') {
            
            // 1. Creamos la incidencia en tu tabla existente
            $incident = Incident::create([
                'device_id'   => $event->device_id,
                'type'        => 'Desconexión Detectada',
                'status'      => 'pendiente',
                'description' => 'Incidencia generada automáticamente por pérdida de señal.',
            ]);

            // 2. Creamos el registro en tu tabla de DETALLE (Histórico)
            // Ajusta 'incidentDetails' al nombre real de tu relación
            $incident->details()->create([
                'status'      => 'pendiente',
                'description' => 'Sistema detectó evento de desconexión. Ticket abierto.',
                'user_id'     => auth()->id() ?? null, 
            ]);

            // 3. Actualizamos el estado del dispositivo a 'alerta' o 'inactivo'
            $event->device->update(['status' => 'alerta']);
        }
    });
}
}
