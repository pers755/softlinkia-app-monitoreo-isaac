<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DashboardController extends Controller
{
   public function index()
    {
        $userId = auth()->id();
        
        $data = [
            'x'=> 10, // Ejemplo de dato adicional
            'totalDevices'  => Device::where('user_id', $userId)->count(),
            'activeDevices' => Device::where('user_id', $userId)->where('status', 'activo')->count(),
        ];

        return view('dashboard', $data);
    }
}
