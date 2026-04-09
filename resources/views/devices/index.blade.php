<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Mis Dispositivos de Seguridad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Listado de Equipos</h3>
                    <a href="{{ route('devices.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                        + Agregar Dispositivo
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</th>
                                <th class="p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-48">
                                    Acciones
                                </th>
                                <th class="p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Simulación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($devices as $device)
                            
                                <tr>
                                    <td class="p-3 whitespace-nowrap">{{ $device->name }}</td>
                                
                                    <td class="p-3 whitespace-nowrap text-gray-600">{{ $device->type }}</td>
                                    <td class="p-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $device->status == 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                            {{ strtoupper($device->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $device->location }}</td>
                                        
                                  <td class="p-3">
    <div class="flex items-center justify-center gap-2 flex-nowrap">
        <a href="{{ route('devices.show', $device->id) }}" 
           class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded shadow-sm transition-all whitespace-nowrap">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            VER
        </a>

        <a href="{{ route('devices.edit', $device->id) }}" 
           class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded shadow-sm transition-all whitespace-nowrap">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            EDITAR
        </a>

        <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                onclick="return confirm('¿Seguro?')"
                class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold rounded border border-red-200 shadow-sm transition-all whitespace-nowrap">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                BORRAR
            </button>
        </form>
    </div>
</td>
                                    
                                    <td class="p-3 whitespace-nowrap text-center">
                                        <form action="{{ route('simulate.event') }}" method="POST" onsubmit="return confirm('¿Simular pérdida de conexión?')">
                                            @csrf
                                            <input type="hidden" name="device_id" value="{{ $device->id }}">
                                            <input type="hidden" name="type" value="desconexion">
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-orange-500 hover:bg-orange-600 text-black text-xs font-bold rounded shadow-sm transition">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                                FALLA
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500 italic">Aún no tienes dispositivos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
        {{ $devices->links() }} 
                </div>

            </div>
        </div>
    </div>
</x-app-layout>