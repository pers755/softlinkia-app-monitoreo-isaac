<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    //tabla detalles
    public function details()
    {
        return $this->hasMany(IncidentDetail::class);
    }

    //relaciones
    public function device() { return $this->belongsTo(Device::class); }

    public function user() { return $this->belongsTo(User::class); }
}
