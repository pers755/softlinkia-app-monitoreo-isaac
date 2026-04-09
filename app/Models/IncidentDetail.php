<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentDetail extends Model
{
    // Definimos los campos que se pueden llenar masivamente
 protected $fillable = [
    'incident_id',
    'user_id',
    'status_from',
    'status_to',
    'description',
];

    /**
     * Relación inversa: Un detalle pertenece a una incidencia.
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }

    /**
     * Relación con el usuario que creó el detalle (si aplica).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}