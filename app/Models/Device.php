<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes; // requerimiento pag 6

    protected $fillable = [
        'name', 
        'type', 
        'status', 
        'location', 
        'user_id', 
        'metadata'
    ];

    // Relación: Un dispositivo pertenece a un Usuario (Cliente)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

