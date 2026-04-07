<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Registrar Dispositivo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1e293b] p-8 rounded-lg shadow-lg border border-gray-700">
                
                <form action="{{ route('devices.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-cyan-400 text-sm font-bold mb-2 uppercase">Nombre</label>
                        <input type="text" name="name" required
                            class="w-full bg-[#0f172a] border-gray-600 text-white rounded-md focus:border-cyan-500 focus:ring-cyan-500">
                    </div>

                    <div class="mb-5">
                        <label class="block text-cyan-400 text-sm font-bold mb-2 uppercase">Tipo de Equipo</label>
                        <select name="type" required
                            class="w-full bg-[#0f172a] border-gray-600 text-white rounded-md focus:border-cyan-500 focus:ring-cyan-500">
                            <option value="Cámara IP">Cámara IP</option>
                            <option value="Sensor PIR">Sensor PIR</option>
                            <option value="Control de Acceso">Control de Acceso</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="block text-cyan-400 text-sm font-bold mb-2 uppercase">Cliente Responsable</label>
                        <select name="client_id" required
                            class="w-full bg-[#0f172a] border-gray-600 text-white rounded-md focus:border-cyan-500 focus:ring-cyan-500">
                            <option value="">Seleccione un cliente...</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-8">
                        <label class="block text-cyan-400 text-sm font-bold mb-2 uppercase">Ubicación</label>
                        <input type="text" name="location" required
                            class="w-full bg-[#0f172a] border-gray-600 text-white rounded-md focus:border-cyan-500 focus:ring-cyan-500">
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-bold rounded-full hover:opacity-90 transition">
                            GUARDAR DISPOSITIVO
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>