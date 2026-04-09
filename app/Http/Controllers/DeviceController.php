<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\Client;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $devices = Device::paginate(10); 
        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $clients = \App\Models\Client::all(); //listado de clientes
      return view('devices.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
  $validated = $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string',
        'location' => 'required|string',
        'client_id' => 'required|exists:clients,id', // Validamos que el cliente exista
    ]);

    // Guardamos usando la relación con el cliente o directamente
    Device::create($validated);

    return redirect()->route('devices.index')->with('success', 'Equipo registrado.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $device = Device::with('client')->findOrFail($id);

         return view('devices.show', compact('device'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
     $device = Device::findOrFail($id); // Buscamos el equipo o lanzamos 404
        $clients = Client::all();
        return view('devices.edit', compact('device', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $device = Device::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'location' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:activo,inactivo,alerta',
        ]);

        $device->update($validated);

        return redirect()->route('devices.index')->with('success', 'Equipo actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $device = Device::findOrFail($id);

        // softdelete
        $device->delete();

        return redirect()->route('devices.index')
            ->with('success', 'El dispositivo ha sido desactivado correctamente.');
    }
}
