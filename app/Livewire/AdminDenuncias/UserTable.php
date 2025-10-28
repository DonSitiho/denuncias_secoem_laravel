<?php

namespace App\Livewire\AdminDenuncias;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserTable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortBy = 'name';
    public bool $sortAsc = true;

    // Se reinicia la paginación cuando cambia el término de búsqueda
    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    
    // Método para cambiar el orden de la tabla
    public function sortBy(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortBy = $field;
    }

    public function render()
    {
        // 1. Consulta base: Solo usuarios con área asignada
        $usuarios = User::query()
            ->with(['area'])
            ->whereNotNull('id_area') // ⬅️ FILTRO CRUCIAL: Solo usuarios con área
            
            // 2. Lógica de Búsqueda
            ->when($this->search, function (Builder $query, $search) {
                $query->where(function (Builder $q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%') // Usuario (email)
                      // Búsqueda en la relación 'area' (Requiere JOIN para eficiencia)
                      ->orWhereHas('area', function ($subQuery) use ($search) {
                          $subQuery->where('nombre_area', 'like', '%' . $search . '%');
                      });
                });
            })
            
            // 3. Lógica de Ordenación
            ->orderBy($this->sortBy, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(10);
            
        return view('livewire.admin-denuncias.user-table', [
            'usuarios' => $usuarios,
        ]);
    }
}