<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Dispositivos de Seguridad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Listado de Equipos</h3>
                    <a href="{{ route('devices.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                        + Agregar Dispositivo
                    </a>
                </div>

                <table class="min-w-full border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Tipo</th>
                            <th class="p-3 text-left">Estado</th>
                            <th class="p-3 text-left">Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($devices as $device)
                            <tr class="border-t">
                                <td class="p-3">{{ $device->name }}</td>
                                <td class="p-3">{{ $device->type }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded text-xs {{ $device->status == 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ strtoupper($device->status) }}
                                    </span>
                                </td>
                                <td class="p-3">{{ $device->location }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 text-center text-gray-500">Aún no tienes dispositivos. ¡Crea el primero!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>