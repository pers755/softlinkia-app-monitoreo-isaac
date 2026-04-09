<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Listado de Clientes</h3>
                    <a href="{{ route('clients.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                        + Agregar Cliente
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
                                <th class="p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>

                                <th class="p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Simulación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($clients as $client)
                            
                                <tr>
                                    <td class="p-3 whitespace-nowrap">{{ $client->name }}</td>
                                
                                    <td class="p-3 whitespace-nowrap text-gray-600">{{ $client->type }}</td>
                                    <td class="p-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $client->status == 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                            {{ strtoupper($client->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $client->location }}</td>
                                        <td>
                                        <a href="{{ route('clients.edit', $client->id) }}" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                            Editar
                                        </a>

                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('¿Seguro?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                    
                                    <td class="p-3 whitespace-nowrap text-center">
                                        <form action="{{ route('simulate.event') }}" method="POST" onsubmit="return confirm('¿Simular pérdida de conexión?')">
                                            @csrf
                                            <input type="hidden" name="client_id" value="{{ $client->id }}">
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
        {{ $clients->links() }} 
                </div>

            </div>
        </div>
    </div>
</x-app-layout>