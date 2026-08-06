<?php

namespace App\Livewire\UaoicDenuncias;

use App\Repositories\DenunciasRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class MisDenunciasBnTable extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'fecha_recepcion';
    public bool $sortAsc = false;
    public int $id_denuncia;
    public int $status;

    protected $denunciaRepository;

    public function boot(DenunciasRepository $denunciaRepository)
    {
        $this->denunciaRepository = $denunciaRepository;
    }

    public function updatingSearch(): void 
    {
        $this->resetPage();
    }

    public function render()
    {
        $denuncias = $this->denunciaRepository->denunciasBNPorResponsable($this->search, $this->sortBy, $this->sortAsc);

        //return json_encode($denuncias);

        return view('livewire.uaoic-denuncias.mis-denuncias-bn-table', ['denuncias' => $denuncias]);
    }

    public function sortBy(string $field): void 
    {
        if ($this->sortBy == $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortBy = $field;
    }

    // Funcion que cambia el estatus a en tramite.
    public function cambiarATramite($id_denuncia) 
    {
        $this->id_denuncia = $id_denuncia;
        $this->status = 3;

        try {
            $this->denunciaRepository->cambiarDenunciaATramite($this->id_denuncia, $this->status);
            $this->dispatch('success', 'La denuncia ha sido enviada a trámite correctamente.');
        } catch (\Exception $e) {
            $this->dispatch('danger', 'Ocurrió un error al enviar la denuncia a trámite');
        }
    }

}
