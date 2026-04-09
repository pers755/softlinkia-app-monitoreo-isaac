<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}

