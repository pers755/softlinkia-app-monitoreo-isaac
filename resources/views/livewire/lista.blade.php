
<div wire:poll.2s> {{-- <--- REFRESH AUTOMATICO --}}
    <h3 class="text-cyan-400 font-bold mb-4 uppercase">Incidencias Críticas</h3>
    
    <div class="space-y-4">
        @forelse($incidents as $incident)
            <div class="bg-[#0f172a] border-l-4 border-red-500 p-4 rounded shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-white font-bold">{{ $incident->device->name }}</p>
                        <p class="text-gray-400 text-sm">{{ $incident->description }}</p>
                    </div>
                    <span class="px-2 py-1 bg-red-900 text-red-200 text-xs rounded">
                        {{ $incident->status }}
                    </span>
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">No hay incidencias pendientes. ¡Todo bajo control!</p>
        @endforelse
    </div>
</div>