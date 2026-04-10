<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\GeneralAlert;
use Illuminate\Support\Facades\Notification;
class Device extends Model
{
    use SoftDeletes; // req pag 6

    protected $fillable = [
        'name', 
        'type', 
        'status', 
        'location', 
        'user_id', 
        'metadata'
    ];

    protected $casts = [
    'metadata' => 'array',
    ];

    // Relación: Un dispositivo pertenece a un Usuario (Cliente)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
        {
            // Un dispositivo pertenece a un cliente
            return $this->belongsTo(Client::class);
        }

        public function incidents()
        {
            // Un dispositivo tiene muchas incidencias
            return $this->hasMany(Incident::class);
        }

        /**
     * Lógica para notificar cambios de estado
     */
    public function notifyStatusChange()
    {
        // Si el estado es falla o alerta, preparamos la notificación
        if (in_array($this->status, ['falla', 'alerta'])) {
            
            $details = [
                'title'   => 'ATENCIÓN: ' . strtoupper($this->status),
                'message' => "El dispositivo {$this->name} en {$this->location} requiere revisión.",
                'level'   => $this->status == 'falla' ? 'error' : 'warning',
                'link'    => route('devices.show', $this->id)
            ];

            // 1. Notificar al Cliente dueño del equipo (si tiene usuario vinculado)
            if ($this->client && $this->client->users) {
                Notification::send($this->client->users, new GeneralAlert($details));
            }

            // 2. Notificar a los Administradores/Staff
            $staff = User::whereIn('role', ['admin', 'staff'])->get();
            Notification::send($staff, new GeneralAlert($details));
        }
    }
}

