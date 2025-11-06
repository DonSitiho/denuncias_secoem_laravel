<?php

namespace App\Livewire\OicDenuncias;

use App\Repositories\DenunciasRepository;
use Livewire\Component;

class AccionesBotones extends Component
{
    public $denuncia;
    public int $id_denuncia;
    public int $status;

    protected $denunciaRepository;

    public function boot(DenunciasRepository $denunciaRepository){
        $this->denunciaRepository = $denunciaRepository;
    }

    public function mount($denuncia)
    {
        $this->denuncia = $denuncia;
    }

    public function render()
    {
        return view('livewire.oic-denuncias.acciones-botones');
    }

    // Funcion que cambia el estatus a en tramite.
    public function cambiarEnTramite($id){

        $this->authorize('oic-denuncia-tramite'); // igual que en un controlador
        $this->id_denuncia = $id;
        $this->status = 3;

        try {

            $this->denunciaRepository->cambiarDenunciaATramite($this->id_denuncia, $this->status);
            $this->dispatch('success', 'Denuncia en proceso de trámite correctamente.');

        } catch (\Exception $e){

            $this->dispatch('danger', 'Error al pasar la denuncia a trámite.');
        }

    }


    // Funcion que cambia el estatus a en tramite.
    public function finalizar($id){

        $this->authorize('oic-denuncia-tramite'); // igual que en un controlador
        $this->id_denuncia = $id;
        $this->status = 4;

        try {

            $this->denunciaRepository->cambiarDenunciaATramite($this->id_denuncia, $this->status);
            $this->dispatch('success', 'Denuncia finalizada correctamente.');

        } catch (\Exception $e){

            $this->dispatch('danger', 'Error al finalizada la denuncia.');
        }

    }
}
