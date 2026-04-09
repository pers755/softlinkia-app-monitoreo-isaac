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
        //ADMINS

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
        // Operador de Turno
        \App\Models\User::factory()->create([
        'name' => 'Operador de Turno',
        'email' => 'operador@test.com',
        'role' => 'operador',
        'password' => bcrypt('password123'),
    ]);

      // user demo
      $userdemo =  \App\Models\User::factory()->create([
        'name' => 'Cliente Demo',
        'email' => 'demo@test.com',
        'role' => 'cliente',
        'password' => bcrypt('password123'),
    ]);
        // CLIENTE VINCULADO A ADMIN SOFTLINKIA
        //  para que Softlinkia aparezca tambien como "dueño" de equipos
        $clienteAdmin = Client::create([
            'user_id' => $adminSoft->id,
            'name' => 'Softlinkia Corp',
            'email' => 'softlinkia@softlinkia.com',
            'phone' => '6621000000',
            'address' => 'Blvd. Colosio 123, Hermosillo',
            'rfc' => 'SLK260407123',
        ]);

          // CLIENTE VINCULADO A CLIENTE DEMO 
        //  para que Softlinkia aparezca tambien como "dueño" de equipos
        $clientDemo = Client::create([
            'user_id' => $userdemo->id,
            'name' => 'cliente demo test',
            'email' => 'demo@test.com',
            'phone' => '6621000000',
            'address' => 'Blvd. Colosio 1234, Puerto Peñasco',
            'rfc' => 'SLK260407122',
        ]);

        // DISPOSITIVOS DE PRUEBA ---
        Device::create([
            'client_id' => $clienteAdmin->id,
            'name' => 'Cámara Exterior Acceso',
            'type' => 'Cámara IP',
            'location' => 'Entrada Principal',
            'status' => 'activo'
        ]);

        Device::create([
            'client_id' => $clienteAdmin->id,
            'name' => 'Sensor Movimiento Almacén',
            'type' => 'Sensor PIR',
            'location' => 'Bodega A',
            'status' => 'falla'
        ]);

        //  20 CLIENTES FAKES (CON SUS PROPIOS USUARIOS ROL 'CLIENT') 
        Client::factory(20)->create();
        
        $this->command->info('Se han creado 2 Admins, 1 Cliente Demo y 20 Clientes aleatorios.');
    }
}