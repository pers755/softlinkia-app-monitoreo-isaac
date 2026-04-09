<x-app-layout>
    <div class="py-12 bg-[#0a0e17] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="text-center mb-16">
                <h1 class="text-4xl font-black text-white leading-tight">Estado de la Red</h1>
                <p class="text-slate-400 mt-3 text-lg font-medium">Panel de control de dispositivos y monitoreo activo.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <div class="bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl relative">
                    <div class="absolute top-4 right-4 h-1.5 w-1.5 rounded-full bg-cyan-400 shadow-[0_0_8px_4px_rgba(34,211,238,0.3)]"></div>
                    
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 mr-5">
                            <div class="relative flex items-center justify-center h-16 w-16 bg-[#00bcd4]/10 rounded-2xl shadow-[0_0_40px_-5px_#00bcd4]">
                                <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h16"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-white text-2xl font-extrabold">Dispositivos</h3>
                    </div>
                    
                    <p class="text-slate-400 text-sm font-medium leading-relaxed mb-6">Equipos registrados actualmente en tu inventario de monitoreo.</p>
                    
                    <div class="flex items-end justify-between">
                        <p class="text-white text-6xl font-black leading-none">{{ $totalDevices }}</p>
                        <a href="{{ route('devices.index') }}" class="px-5 py-2.5 bg-cyan-500 text-white text-xs font-black rounded-full uppercase tracking-wider hover:opacity-90 transition">
                            Gestionar
                        </a>
                    </div>
                </div>

                <div class="bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl relative">
                    <div class="absolute top-4 right-4 h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_4px_rgba(52,211,153,0.3)]"></div>

                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 mr-5">
                            <div class="relative flex items-center justify-center h-16 w-16 bg-[#10b981]/10 rounded-2xl shadow-[0_0_40px_-5px_#10b981]">
                                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-white text-2xl font-extrabold">En Línea</h3>
                    </div>
                    
                    <p class="text-slate-400 text-sm font-medium leading-relaxed mb-6">Sistemas reportando actividad normal y sin fallas registradas.</p>
                    
                    <div class="flex items-end justify-between">
                        <p class="text-white text-6xl font-black leading-none">{{ $activeDevices }}</p>
                        <a href="#" class="px-5 py-2.5 bg-emerald-500 text-white text-xs font-black rounded-full uppercase tracking-wider hover:opacity-90 transition">
                            Ver Logs
                        </a>
                    </div>
                </div>

                <div class="bg-[#111827] rounded-3xl border border-slate-800 shadow-2xl relative p-8 flex flex-col justify-center items-center hover:border-purple-800 transition">
                     <div class="absolute top-4 right-4 h-1.5 w-1.5 rounded-full bg-purple-400 shadow-[0_0_8px_4px_rgba(168,85,247,0.3)]"></div>
                    
                     <div class="relative flex items-center justify-center h-16 w-16 bg-[#9c27b0]/10 rounded-2xl shadow-[0_0_40px_-5px_#9c27b0] mb-6">
                         <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                     </div>

                    <p class="text-slate-300 font-bold text-center text-sm uppercase tracking-wide mb-6">¿Nuevo equipo?</p>
                    
                    <a href="{{ route('devices.create') }}" class="w-full text-center py-4 bg-gradient-to-r from-[#00bcd4] to-[#9c27b0] text-white text-xs font-black rounded-full tracking-wider uppercase shadow-md hover:scale-105 transition duration-200">
                        REGISTRAR AHORA
                    </a>
                </div>

            </div>
            

        </div>
        <div class="p-6 border-b border-gray-200 font-bold">
             <!-- Sección de Incidentes Recientes -->
             <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-[#1e293b] p-6 rounded-lg border border-gray-700">
                        @livewire('incident-dashboard')
                    </div>
                </div>
            </div>    
            </div>    

        </div>  
    </div>  
   
</x-app-layout>