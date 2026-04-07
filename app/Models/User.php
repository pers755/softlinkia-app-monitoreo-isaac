<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Un usuario puede tener muchos dispositivos.
     */
    public function devices()
    {
        // Esto le dice a Laravel que busque en la tabla 'devices' 
        // los registros que tengan el 'user_id' de este usuario.
        return $this->hasMany(Device::class);
    }

    public function client()
    {
        // Un usuario puede tener un perfil de cliente
        return $this->hasOne(Client::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
