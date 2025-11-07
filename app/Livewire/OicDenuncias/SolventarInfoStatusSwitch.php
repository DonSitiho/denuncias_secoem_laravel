<?php

namespace App\Livewire\OicDenuncias;

use App\Models\SolventarInfo;
use Livewire\Component;

class SolventarInfoStatusSwitch extends Component
{
    public $infoId;
    public $activa;

    public function mount($infoId, $activa){

        $this->infoId = $infoId;
        $this->activa = $activa;
    }

    public function toggle(){
        // Asumimos que la columna 'is_active' existe en la tabla 'solventar_info'
        $solventarInfo = SolventarInfo::findOrFail($this->infoId);

        if (!$solventarInfo) {
            session()->flash('error', 'No se encontró la solventación.');
            return;
        }

        $solventarInfo->is_active = !$solventarInfo->is_active;
        $solventarInfo->save();

        $this->activa = $solventarInfo->is_active;

        // Emitir evento de notificación (opcional)
        $status = $solventarInfo->is_active ? 'activado' : 'desactivado';
        session()->flash('success', "Ha sido {$status} con éxito.");

    }

    public function render()
    {
        return view('livewire.oic-denuncias.solventar-info-status-switch');
    }
}
