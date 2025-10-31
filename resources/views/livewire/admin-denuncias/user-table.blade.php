<div>
    {{-- Caja de Búsqueda --}}
    <div class="d-flex justify-content-end align-items-center mb-5">
        <div class="d-flex align-items-center position-relative my-1">
            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" wire:model.live.debounce.300ms="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{ __('Buscar por nombre o correo...') }}" />
        </div>
    </div>
    
    {{-- Mensajes de Notificación de Livewire (para el toggle) --}}
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    {{-- Tabla de Usuarios --}}
    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-150px cursor-pointer" wire:click="sortBy('name')">{{ __('Nombre') }}</th>
                    <th class="min-w-150px cursor-pointer" wire:click="sortBy('email')">{{ __('Usuario (Correo)') }}</th>
                    <th class="min-w-150px">{{ __('Área de Adscripción') }}</th>
                    <th class="min-w-100px">{{ __('Rol') }}</th>
                    <th class="min-w-80px">{{ __('Estado') }}</th> 
                    <th class="min-w-100px">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @forelse ($usuarios as $user)
                    <tr wire:key="{{ $user->id }}">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{-- Se usa la relación 'area' --}}
                            <span class="badge badge-light-primary">
                                [{{ $user->area->siglas ?? 'N/D' }}] {{ $user->area->nombre_area ?? 'Sin Área' }}
                            </span>
                        </td>
                        <td>
                            {{-- Muestra los roles asignados por Spatie --}}
                            @foreach ($user->getRoleNames() as $role)
                                <span class="badge badge-light-info me-1">{{ $role }}</span>
                            @endforeach
                        </td>
                        <td>
                            {{-- 1. SWITCH PARA ACTIVAR/DESACTIVAR --}}
                            {{-- wire:click llama al método de Livewire y pasa el ID --}}
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="status_{{ $user->id }}" 
                                    value="1" 
                                    {{ $user->is_active ? 'checked' : '' }}
                                    wire:click="toggleActive({{ $user->id }})"
                                    wire:confirm="¿Estás seguro de que deseas {{ $user->is_active ? 'desactivar' : 'activar' }} a este usuario?"
                                />
                                <label class="form-check-label" for="status_{{ $user->id }}">
                                    <span class="badge badge-light-{{ $user->is_active ? 'success' : 'danger' }}">
                                        {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </label>
                            </div>
                        </td>
                        <td>
                            {{-- 2. Botón de Edición (dispara el evento Livewire que abre el modal) --}}
                            <a href="{{ route('admin.usuarios.edit', $user) }}" 
    class="btn btn-icon btn-light-warning btn-sm me-1" 
    title="{{ __('Editar Usuario') }}"
>
    <i class="fas fa-edit"></i>
</a>
                            
                            {{-- Opcional: Botón para restablecer contraseña --}}
                            {{-- <button wire:click="resetPassword({{ $user->id }})" class="btn btn-icon btn-light-info btn-sm" title="{{ __('Restablecer Contraseña') }}">
                                <i class="fas fa-lock"></i>
                            </button> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">{{ __('No se encontraron usuarios activos con área asignada.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-end">
        {{ $usuarios->links() }}
    </div>

    {{-- NOTA: El modal de edición debe estar incluido en la vista principal --}}
</div>