<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $devices = Device::with('user')->get();
        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    var_dump($request->all()); // Debug: Verificar datos recibidos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string',
        'location' => 'required|string',
    ]);

    // Creamos el dispositivo y le pegamos el ID del usuario actual
    auth()->user()->devices()->create($validated);

    return redirect()->route('devices.index')->with('success', 'Equipo registrado.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
