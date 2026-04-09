<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
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
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">email</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">telefono</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">direccion</th>
                                <th class="p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">rfc</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($clients as $client)
                            
                                <tr>
                                    <td class="p-3 whitespace-nowrap">{{ $client->name }}</td>
                                
                                    <td class="p-3 whitespace-nowrap text-gray-600">{{ $client->email }}</td>
                                    <td class="p-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $client->status == 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                            {{ strtoupper($client->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $client->phone }}</td>
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $client->address }}</td>
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $client->rfc }}</td>
                                   
                                  
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