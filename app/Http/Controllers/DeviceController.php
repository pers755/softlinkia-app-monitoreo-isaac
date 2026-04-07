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
