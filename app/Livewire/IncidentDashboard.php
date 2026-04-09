<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Incident;

class IncidentDashboard extends Component
{   
    public function render()
    {
        $incidents = Incident::with('device')
            ->where('status', 'pendiente')
            ->latest()
            ->take(5)
            ->get();

        // asegúrate que el nombre aquí sea EXACTAMENTE igual al del archivo.
        return view('livewire.lista', [
            'incidents' => $incidents
        ]);
    }
}
