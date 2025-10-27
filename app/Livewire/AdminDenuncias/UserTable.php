<?php

namespace App\Livewire\AdminDenuncias;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Area;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class UserTable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortBy = 'name';
    public bool $sortAsc = true;
    public $editingUser = null; // Almacenará el ID del usuario en edición
    public $areas; // Para el catálogo en el modal de edición

    // Se reinicia la paginación cuando cambia el término de búsqueda
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function mount()
    {
        // Cargar áreas una vez para el modal de edición
        $this->areas = Area::where('is_active', true)->orderBy('nombre_area')->get();
    }
    
    /**
     * Muestra los datos del usuario en un modal de edición.
     */
    public function editUser($userId)
    {
        // Emitir evento para que el JS abra el modal y cargue los datos
        $this->editingUser = User::with('area')->findOrFail($userId);
        $this->dispatch('open-edit-modal', ['user' => $this->editingUser]);
    }

    /**
     * Guarda los cambios de edición de un usuario.
     */
    public function saveEdit(Request $request)
    {
        // NOTA: La lógica de guardado es compleja y normalmente se maneja en el controlador principal
        // o con un método AJAX/Livewire más robusto que reciba los datos del modal de edición.
    }


    /**
     * Cambia el estado 'activo' del usuario.
     */
    public function toggleActive($userId)
    {
        // Asumimos que la columna 'is_active' existe en la tabla 'users'
        $user = User::findOrFail($userId);
        
        // Cambia el valor actual
        $user->is_active = !$user->is_active; 
        $user->save();
        
        // Emitir evento de notificación (opcional)
        $status = $user->is_active ? 'activado' : 'desactivado';
        session()->flash('success', "El usuario {$user->name} ha sido {$status} con éxito.");
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