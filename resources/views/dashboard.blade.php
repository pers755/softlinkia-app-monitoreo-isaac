<x-app-layout>
    <div class="py-12 bg-[#0a0e17] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="text-center mb-16">
                <h1 class="text-4xl font-black text-white leading-tight tracking-tighter uppercase">
                    Estado de la Red
                </h1>
                <p class="text-slate-400 mt-3 text-lg font-medium">
                    @if(auth()->user()->hasRole('cliente'))
                        Monitoreo de tus servicios contratados y activos.
                    @else
                        Panel de control global y monitoreo de infraestructura.
                    @endif
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <div class="bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-4 right-4 h-1.5 w-1.5 rounded-full bg-cyan-400 shadow-[0_0_8px_4px_rgba(34,211,238,0.3)]"></div>
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 mr-5">
                            <div class="relative flex items-center justify-center h-16 w-16 bg-[#00bcd4]/10 rounded-2xl shadow-[0_0_40px_-5px_#00bcd4]">
                                <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h16"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-white text-2xl font-extrabold tracking-tight">Dispositivos</h3>
                    </div>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed mb-6">Equipos registrados bajo tu supervisión directa.</p>
                    <div class="flex items-end justify-between">
                        <p class="text-white text-6xl font-black leading-none tracking-tighter">{{ $stats['total_devices'] }}</p>
                        @if(!auth()->user()->hasRole('cliente'))
                            <a href="{{ route('devices.index') }}" class="px-5 py-2.5 bg-cyan-500 text-white text-xs font-black rounded-full uppercase tracking-wider hover:bg-cyan-400 transition transform hover:scale-105">
                                Gestionar
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl relative overflow-hidden">
                    <div class="absolute top-4 right-4 h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_4px_rgba(52,211,153,0.3)]"></div>
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 mr-5">
                            <div class="relative flex items-center justify-center h-16 w-16 bg-[#10b981]/10 rounded-2xl shadow-[0_0_40px_-5px_#10b981]">
                                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-white text-2xl font-extrabold tracking-tight">En Línea</h3>
                    </div>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed mb-6">Sistemas operando con normalidad en este momento.</p>
                    <div class="flex items-end justify-between">
                        <p class="text-white text-6xl font-black leading-none tracking-tighter">{{ $stats['online_devices'] }}</p>
                        <span class="px-4 py-1.5 bg-emerald-500/10 text-emerald-400 text-[10px] font-bold rounded-full border border-emerald-500/20 uppercase">Activo</span>
                    </div>
                </div>

                @if(auth()->user()->hasRole('admin'))
                    <div class="bg-[#111827] rounded-3xl border border-slate-800 shadow-2xl relative p-8 flex flex-col justify-center items-center group hover:border-purple-600 transition-all duration-300">
                         <div class="absolute top-4 right-4 h-1.5 w-1.5 rounded-full bg-purple-400 shadow-[0_0_8px_4px_rgba(168,85,247,0.3)]"></div>
                         <div class="relative flex items-center justify-center h-16 w-16 bg-[#9c27b0]/10 rounded-2xl shadow-[0_0_40px_-5px_#9c27b0] mb-6 group-hover:scale-110 transition">
                             <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                         </div>
                        <p class="text-slate-300 font-bold text-center text-sm uppercase tracking-widest mb-6">Nuevo Dispositivo</p>
                        <a href="{{ route('devices.create') }}" class="w-full text-center py-4 bg-gradient-to-r from-[#00bcd4] to-[#9c27b0] text-white text-xs font-black rounded-full tracking-widest uppercase shadow-lg hover:shadow-purple-500/20 transition duration-200">
                            REGISTRAR AHORA
                        </a>
                    </div>
                @else
                    <div class="bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl relative">
                        <div class="absolute top-4 right-4 h-1.5 w-1.5 rounded-full bg-red-400 shadow-[0_0_8px_4px_rgba(248,113,113,0.3)]"></div>
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 mr-5">
                                <div class="relative flex items-center justify-center h-16 w-16 bg-red-500/10 rounded-2xl shadow-[0_0_40px_-5px_#ef4444]">
                                    <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                            </div>
                            <h3 class="text-white text-2xl font-extrabold tracking-tight">Alertas</h3>
                        </div>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed mb-6">Dispositivos reportando fallas críticas actualmente.</p>
                        <div class="flex items-end justify-between">
                            <p class="text-white text-6xl font-black leading-none tracking-tighter">{{ $stats['devices_alert'] }}</p>
                            <span class="text-red-500 text-[10px] font-black uppercase animate-pulse italic">Revisión Urgente</span>
                        </div>
                    </div>
                @endif
            </div>
 <div class="mt-12">
                <div class="bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl">
                    <div class="flex items-center justify-between mb-8 border-b border-slate-800/50 pb-6">
                        <h2 class="text-white text-lg font-black uppercase tracking-tighter flex items-center">
                            <span class="flex h-3 w-3 mr-4 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-500"></span>
                            </span>
                            Incidencias recientes
                        </h2>
                        <span class="text-[9px] text-slate-500 font-bold uppercase tracking-widest bg-slate-950 px-3 py-1 rounded-full border border-slate-800">
                            Live Feed
                        </span>
                    </div>
                    
                    <div class="overflow-hidden">
                        @livewire('incident-dashboard')
                    </div>
                </div>
            </div>
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-12">
                
                <div class="bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl flex flex-col items-center justify-center">
                    <h3 class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-8">Salud de Infraestructura</h3>
                    
                    <div class="relative flex items-center justify-center w-48 h-48">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                            <circle class="text-slate-800" stroke-width="8" stroke="currentColor" fill="transparent" r="42" cx="50" cy="50" />
                            <circle class="text-cyan-500" stroke-width="8" 
                                stroke-dasharray="263.8" 
                                stroke-dashoffset="{{ 263.8 - (263.8 * $uptime) / 100 }}" 
                                stroke-linecap="round" stroke="currentColor" fill="transparent" r="42" cx="50" cy="50" 
                                style="filter: drop-shadow(0 0 5px rgba(34, 211, 238, 0.4)); transition: stroke-dashoffset 1.5s ease-in-out;" />
                        </svg>
                        
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-5xl font-black text-white leading-none tracking-tighter">
                                {{ round($uptime) }}<span class="text-lg text-cyan-400 ml-0.5">%</span>
                            </span>
                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest mt-1">ACTIVOS</p>
                        </div>
                    </div>

                    <p class="mt-8 text-white text-[10px] text-center max-w-[250px] italic leading-tight">
                        Disponibilidad calculada sobre el total de dispositivos registrados.
                    </p>
                </div>

                <div class="bg-[#111827] p-8 rounded-3xl border border-slate-800 shadow-2xl flex flex-col">
                    <h3 class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-8">Distribución de Incidencias</h3>
                    <div class="flex-1 flex flex-col justify-center space-y-7">
                        @forelse($eventDist as $item)
                            <div class="group">
                                <div class="flex justify-between mb-2 items-center">
                                    <span class="text-white text-[11px] font-black uppercase tracking-wider group-hover:text-cyan-400 transition">{{ $item->type }}</span>
                                    <div class="bg-slate-900 px-2 py-0.5 rounded border border-slate-800">
                                        <span class="text-cyan-400 text-[10px] font-bold">{{ $item->total }}</span>
                                    </div>
                                </div>
                                <div class="w-full bg-slate-900 rounded-full h-2 border border-slate-800/50 p-[1px] overflow-hidden">
                                    <div class="bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-600 h-full rounded-full transition-all duration-1000" 
                                         style="width: {{ ($item->total / ($eventDist->max('total') ?: 1)) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 opacity-30">
                                <p class="text-xs text-white uppercase font-bold tracking-widest">Sin datos de eventos</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

           

        </div>
    </div>   
</x-app-layout>