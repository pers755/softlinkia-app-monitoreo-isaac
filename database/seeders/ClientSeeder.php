<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Device;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        //ADMINIS

        // Admin Softlinkia
        $adminSoft = User::create([
            'name' => 'Admin Softlinkia',
            'email' => 'admin@softlinkia.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        //  Admin Isaac
        User::create([
            'name' => 'Isaac Pérez',
            'email' => 'isaacdaniel755@gmail.com', // Cambialo por el tuyo
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // CLIOENTE VINCULADO A SOFTLINKIA
        //  para que Softlinkia aparezca tambien como "dueño" de equipos
        $clientDemo = Client::create([
            'user_id' => $adminSoft->id,
            'name' => 'Softlinkia Corp',
            'email' => 'softlinkia@softlinkia.com',
            'phone' => '6621000000',
            'address' => 'Blvd. Colosio 123, Hermosillo',
            'rfc' => 'SLK260407123',
        ]);

        // --- 3. DISPOSITIVOS DE PRUEBA ---
        Device::create([
            'client_id' => $clientDemo->id,
            'name' => 'Cámara Exterior Acceso',
            'type' => 'Cámara IP',
            'location' => 'Entrada Principal',
            'status' => 'activo'
        ]);

        Device::create([
            'client_id' => $clientDemo->id,
            'name' => 'Sensor Movimiento Almacén',
            'type' => 'Sensor PIR',
            'location' => 'Bodega A',
            'status' => 'falla'
        ]);

        // --- 4. 20 CLIENTES FAKES (CON SUS PROPIOS USUARIOS ROL 'CLIENT') ---
        Client::factory(20)->create();
        
        $this->command->info('Se han creado 2 Admins, 1 Cliente Demo y 20 Clientes aleatorios.');
    }
}