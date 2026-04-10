<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Mis Dispositivos de Seguridad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h3 class="text-lg font-bold uppercase tracking-tighter">Listado de Equipos</h3>
                    
                    <form method="GET" action="{{ route('devices.index') }}" class="flex flex-wrap gap-2 w-full md:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Buscar por nombre..." 
                               class="text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        
                        <select name="status" class="text-sm border-gray-300 rounded-lg focus:ring-blue-500">
                            <option value="">Todos los estados</option>
                            <option value="activo" {{ request('status') == 'activo' ? 'selected' : '' }}>ACTIVO</option>
                            <option value="falla" {{ request('status') == 'falla' ? 'selected' : '' }}>FALLA</option>
                        </select>

                        <button type="submit" class="bg-slate-800 text-blue px-4 py-2 rounded-lg hover:bg-slate-900 transition text-sm font-bold">
                            FILTRAR
                        </button>
                        
                        @if(request()->anyFilled(['search', 'status']))
                            <a href="{{ route('devices.index') }}" class="text-gray-500 hover:text-red-500 flex items-center text-xs underline">
                                Limpiar
                            </a>
                        @endif
                    </form>

                    <a href="{{ route('devices.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition font-bold text-sm">
                        + AGREGAR DISPOSITIVO
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
                                <th class="p-3 text-left text-xs font-black text-gray-500 uppercase tracking-widest">Nombre</th>
                                <th class="p-3 text-left text-xs font-black text-gray-500 uppercase tracking-widest">Cliente</th> <th class="p-3 text-left text-xs font-black text-gray-500 uppercase tracking-widest">Tipo</th>
                                <th class="p-3 text-left text-xs font-black text-gray-500 uppercase tracking-widest">Estado</th>
                                <th class="p-3 text-left text-xs font-black text-gray-500 uppercase tracking-widest">Ubicación</th>
                                <th class="p-3 text-center text-xs font-black text-gray-500 uppercase tracking-widest w-48">Acciones</th>
                                <th class="p-3 text-center text-xs font-black text-gray-500 uppercase tracking-widest">Simulación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($devices as $device)
                                <tr>
                                    <td class="p-3 whitespace-nowrap font-bold">{{ $device->name }}</td>
                                    
                                    <td class="p-3 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-semibold text-blue-600">{{ $device->client->name ?? 'Sin Cliente' }}</span>
                                            <span class="text-[10px] text-gray-400 font-mono">{{ $device->client->rfc ?? '' }}</span>
                                        </div>
                                    </td>

                                    <td class="p-3 whitespace-nowrap text-gray-600">{{ $device->type }}</td>
                                    <td class="p-3 whitespace-nowrap text-center">
                                        <span class="px-2 inline-flex text-[10px] leading-5 font-black rounded-full 
                                            {{ $device->status == 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                            {{ strtoupper($device->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $device->location }}</td>
                                    
                                    <td class="p-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('devices.show', $device->id) }}" class="text-xs font-bold text-slate-600 hover:text-blue-600">VER</a>
                                            <a href="{{ route('devices.edit', $device->id) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800">EDITAR</a>
                                            <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('¿Seguro?')" class="text-xs font-bold text-red-600 hover:text-red-800">BORRAR</button>
                                            </form>
                                        </div>
                                    </td>
                                    
                                    <td class="p-3 text-center">
                                        <form action="{{ route('devices.simulate-fail', $device->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-orange-500 text-white text-[9px] px-2 py-1 rounded font-black uppercase tracking-tighter shadow-sm hover:bg-orange-600 transition">Falla</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-gray-500 italic">No se encontraron dispositivos con esos criterios.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $devices->withQueryString()->links() }} 
                </div>

            </div>
        </div>
    </div>
</x-app-layout>