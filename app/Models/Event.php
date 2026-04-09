<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Incident;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Event extends Model
{

protected $fillable = [
        'device_id',
        'type',
        'description'
    ];
    protected static function booted()
{
    static::created(function ($event) {
        // REGLA: Si el evento es 'desconexion', disparamos la incidencia
        if ($event->type === 'desconexion') {
            
            $incident = Incident::create([
                'device_id'   => $event->device_id,
                'type'        => 'Desconexión Detectada',
                'status'      => 'pendiente',
                'description' => 'Incidencia generada automáticamente por pérdida de señal.',
            ]);

            // Ajusta 'incidentDetails' al nombre real de tu relación
          $incident->details()->create([
                'user_id'     => auth()->id() ?? 1,
                'status_from' => 'nuevo',       // O el estado inicial que manejes
                'status_to'   => 'pendiente',   // El estado al que pasa
                'description' => 'Sistema detectó evento de desconexión. Ticket abierto.',
            ]);

                if ($event->device) {
                    $event->device->update(['status' => 'alerta']);
                    
                }        
                
            }
    });

    static::updated(function ($incident) {
        if ($incident->isDirty('status')) { // Solo si el campo 'status' cambió
            \App\Models\Log::create([
                'user_id'     => auth()->id(),
                'action'      => 'Cambio de Estado en Incidencia',
                'description' => "Incidencia #{$incident->id} cambió de {$incident->getOriginal('status')} a {$incident->status}",
                'ip_address'  => request()->ip(),
            ]);
        }
    });
}
public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
