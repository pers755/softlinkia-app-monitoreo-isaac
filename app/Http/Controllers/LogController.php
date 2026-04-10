<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
      public function index()
    {
         $logs = Log:: paginate(20)->withQueryString(); // Mantiene los parámetros de búsqueda en la paginación
        return view('logs.index', compact('logs'));
    
    }
}
