<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Bitacora de logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Listado</h3>
                 
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
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripcion</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modulo</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($logs as $log)
                            
                                <tr>
                                    <td class="p-3 whitespace-nowrap">{{ $log->user->name ?? 'N/A' }}</td>
                                
                                    <td class="p-3 whitespace-nowrap text-gray-600">{{ $log->action }}</td>
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $log->description }}</td>
                                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $log->module }}</td> 
                                    
                                  
                                   
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
        {{ $logs->links() }} 
                </div>

            </div>
        </div>
    </div>
</x-app-layout>