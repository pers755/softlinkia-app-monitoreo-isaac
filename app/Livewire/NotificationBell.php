<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    // Renderiza la vista y obtiene el conteo actual
    public function render()
    {
        return view('livewire.notification_bel', [
            'unreadCount' => Auth::user()->unreadNotifications->count(),
            'notifications' => Auth::user()->unreadNotifications()->take(5)->get()
        ]);
    }

    // Método para marcar todas como leídas vía AJAX
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        // Livewire se encarga de refrescar la vista automáticamente
    }
}