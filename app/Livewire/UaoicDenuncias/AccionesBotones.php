<?php

namespace App\Livewire\UaoicDenuncias;

use App\Repositories\DenunciasRepository;
use Livewire\Component;

class AccionesBotones extends Component
{

    //public $denuncia;
    public $id_denuncia;
    public $estatus;
    protected $denunciaRepository;

    public function boot(DenunciasRepository $denunciaRepository)
    {
        $this->denunciaRepository = $denunciaRepository;
    }

    public function mount($estatus, $id_denuncia)
    {
        $this->estatus = $estatus;
        $this->id_denuncia = $id_denuncia;
    }

    public function render()
    {
        return view('livewire.uaoic-denuncias.acciones-botones');
    }

    // Funcion que cambia el estatus a en tramite.
    public function cambiarEnTramite()
    {

        //$this->authorize('oic-denuncia-tramite'); // igual que en un controlador
        try {

            $this->denunciaRepository->cambiarDenunciaATramite($this->id_denuncia, 3);
            $this->dispatch('success', 'Denuncia en proceso de trámite correctamente.');

            // Refresca el componente actual
            $this->redirect(request()->header('Referer'));

        } catch (\Exception $e) {

            $this->dispatch('danger', 'Error al pasar la denuncia a trámite.');
        }
    }


    // Funcion que cambia el estatus a en tramite.
    public function finalizar()
    {

        //$this->authorize('oic-denuncia-tramite'); // igual que en un controlador
        try {

            $this->denunciaRepository->cambiarDenunciaATramite($this->id_denuncia, 4);
            $this->dispatch('success', 'Denuncia finalizada correctamente.');
            // Refresca el componente actual
            $this->dispatch('$refresh');
        } catch (\Exception $e) {

            $this->dispatch('danger', 'Error al finalizada la denuncia.');
        }
    }
}
