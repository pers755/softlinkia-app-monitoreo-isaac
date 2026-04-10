<div class="relative" x-data="{ openNotify: false }" wire:poll.30s>
  <button @click="openNotify = !openNotify" @click.outside="openNotify = false" class="relative p-2 text-gray-400 hover:text-cyan-500 focus:outline-none">
    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>
    
  @if($unreadCount > 0)
    <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-[11px] font-bold text-white border-2 border-white shadow-sm z-10">
        {{ $unreadCount }}
    </span>
@endif
</button>

    <div x-show="openNotify" x-transition class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-xl z-50 overflow-hidden" style="display: none;">
        <div class="p-3 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <span class="text-xs font-black uppercase text-gray-500">Notificaciones</span>
        </div>

        <div class="max-h-64 overflow-y-auto">
            @forelse($notifications as $notification)
                <a href="{{ $notification->data['link'] ?? '#' }}" class="block p-4 border-b border-gray-50 hover:bg-cyan-50 transition">
                    <p class="text-xs font-bold text-gray-800 uppercase">{{ $notification->data['title'] }}</p>
                    <p class="text-[10px] text-gray-500 mt-1">{{ $notification->data['message'] }}</p>
                </a>
            @empty
                <div class="p-6 text-center text-gray-400 italic text-xs">Sin avisos nuevos</div>
            @endforelse
        </div>

        @if($unreadCount > 0)
            <button wire:click="markAllAsRead" class="w-full p-2 text-center text-[10px] font-bold text-cyan-600 bg-gray-50 hover:bg-gray-100 border-t uppercase tracking-widest">
                Marcar todas como leídas
            </button>
        @endif
    </div>
</div>