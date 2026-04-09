<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight uppercase tracking-tighter">
                Expediente: <span class="text-cyan-400">{{ $device->name }}</span>
            </h2>
            <a href="{{ route('devices.index') }}" class="text-white hover:text-cyan-400 font-black text-xs border border-cyan-500/30 px-3 py-1 rounded transition">
                &larr; VOLVER AL LISTADO
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-1 space-y-6">
                    
                   <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 {{ $device->client ? 'border-cyan-500' : 'border-gray-300' }}">
    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6 flex items-center">
        <svg class="w-4 h-4 mr-2 {{ $device->client ? 'text-cyan-500' : 'text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
        Información del Cliente
    </h3>
    
    <div class="space-y-5">
        @if($device->client)
            <div>
                <p class="text-[10px] text-cyan-600 uppercase font-black tracking-widest">Empresa / Cliente</p>
                <p class="text-xl font-bold text-slate-900 leading-none mt-1">
                    {{ $device->client->name }}
                </p>
            </div>
            
            <div>
                <p class="text-[10px] text-gray-500 uppercase font-bold">Responsable</p>
                <p class="text-base font-semibold text-gray-800">{{ $device->client->contact_name ?? 'Sin contacto' }}</p>
            </div>
        @else
            <div class="bg-gray-50 p-4 rounded border border-dashed border-gray-200">
                <p class="text-xs text-gray-400 font-bold uppercase italic">Dispositivo sin cliente asignado</p>
                <p class="text-[10px] text-gray-400 mt-1">Vaya a edición para vincular este equipo a una empresa.</p>
            </div>
        @endif
    </div>
</div>

  <div class="rounded-lg shadow-inner overflow-hidden">
    <div class="p-6 {{ $device->status == 'activo' ? 'bg-slate-900' : ($device->status == 'falla' ? 'bg-red-600' : 'bg-orange-500') }} transition-colors duration-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] {{ $device->status == 'activo' ? 'text-gray-400' : 'text-white/80' }} uppercase font-black tracking-widest">
                    Estado del Sistema
                </p>
                <div class="flex items-center mt-2 gap-2">
                    <span class="relative flex h-4 w-4 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $device->status == 'activo' ? 'bg-green-400' : 'bg-white' }} opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 {{ $device->status == 'activo' ? 'bg-green-500 ' : 'bg-white' }}"></span>
                    </span>
                    
                    <span class="text-2xl font-black uppercase tracking-tighter {{ $device->status == 'activo' ? 'text-white' : 'text-white' }}">
                        {{ $device->status }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                <p class="text-[10px] {{ $device->status == 'activo' ? 'text-gray-400' : 'text-white/80' }} uppercase font-bold tracking-widest">Tipo</p>
                <p class="font-bold text-sm mt-1 uppercase {{ $device->status == 'activo' ? 'text-white' : 'text-white' }}">
                    {{ $device->type }}
                </p>
            </div>
        </div>
        
        @if($device->status != 'activo')
            <div class="mt-4 pt-3 border-t border-white/20">
                <p class="text-[10px] text-white font-black uppercase flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Atención inmediata requerida
                </p>
            </div>
        @endif
    </div>
</div>

                <div class="md:col-span-2">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest">Logs de Actividad e Incidencias</h3>
                            <span class="text-[10px] bg-gray-100 px-2 py-1 rounded text-gray-500 font-bold uppercase">Últimos 30 días</span>
                        </div>
                        
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="text-left text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">
                                        <th class="pb-4">Timestamp</th>
                                        <th class="pb-4">Descripción del Evento</th>
                                        <th class="pb-4 text-right">Prioridad / Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @forelse($device->incidents as $incident)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-4 text-xs font-mono text-gray-500">{{ $incident->created_at->format('d/m/Y H:i:s') }}</td>
                                            <td class="py-4 text-sm font-semibold text-slate-700">{{ $incident->description }}</td>
                                            <td class="py-4 text-right">
                                                <span class="px-2 py-1 text-[10px] font-black rounded uppercase {{ $incident->status == 'pendiente' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                                    {{ $incident->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-16 text-center">
                                                <p class="text-gray-400 text-sm italic italic">No se han detectado anomalías en este dispositivo.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>