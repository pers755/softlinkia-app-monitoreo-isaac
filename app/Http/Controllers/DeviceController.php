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
        $user = auth()->user();
        
        // Si el usuario tiene un client_id o una relación client, 
        // asumimos que es un usuario tipo cliente.
        if ($user->client) {
            $clients = collect([$user->client]); // Solo mandamos su propio cliente
        } else {
            $clients = \App\Models\Client::all(); // Admin ve todos
        }      return view('devices.create', compact('clients'));
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

    //metadata fijo de ejemplo
    $validated['metadata'] = [
        'firmware' => 'v1.0.12',
        'last_ping' => now()->toDateTimeString(),
        'connection_mode' => 'TCP/IP',
        'system_check' => 'passed'
    ];

    // Guardamos usando la relación con el cliente o directamente
    $device = Device::create($validated);

    // REGISTRO EN BITÁCORA (logs)
    \App\Models\Log::create([
        'user_id'     => auth()->id(), 
        'action'      => 'Creación de Dispositivo',
        'description' => "Se creó el equipo: {$device->name} con ID: {$device->id} con IP: {$request->ip()}",
        'module'      => 'Dispositivos'
    ]);

    return redirect()->route('devices.index')->with('success', 'Equipo registrado.');
}

    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    // Cargamos 'client' para saber de quién es y 'incidents' para el historial
    $device = Device::with(['client', 'incidents'])->findOrFail($id);

    // Si el usuario logueado tiene un client_id asignado...
    if (auth()->user()->client_id) {
        // ...y ese ID no coincide con el dueño del dispositivo, bloqueamos
        if ($device->client_id !== auth()->user()->client_id) {
            abort(403, 'No tienes permiso para ver este equipo.');
        }
    }

    // 3. Pasamos todo a la vista
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

        //actualizar metadata sin perder la info previa, solo de ejemplo
        $validated['metadata'] = array_merge($device->metadata ?? [], [
        'updated_by_system' => true,
        'last_audit' => now()->toDateString()
        ]);

         $device->update($validated);

         // REGISTRO EN BITÁCORA (logs)
    \App\Models\Log::create([
        'user_id'     => auth()->id(), 
        'action'      => 'Actualización de Dispositivo',
        'description' => "Se actualizó el equipo: {$device->name} con ID: {$device->id} con IP: {$request->ip()}",
        'module'      => 'Dispositivos'
    ]);
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
