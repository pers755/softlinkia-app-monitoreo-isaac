<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function user()
        {
            return $this->belongsTo(User::class);
        }

public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
