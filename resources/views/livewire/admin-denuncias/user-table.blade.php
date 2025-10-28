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
    
    {{-- Tabla de Usuarios --}}
    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-150px cursor-pointer" wire:click="sortBy('name')">{{ __('Nombre') }}</th>
                    <th class="min-w-150px cursor-pointer" wire:click="sortBy('email')">{{ __('Usuario (Correo)') }}</th>
                    <th class="min-w-150px">{{ __('Área de Adscripción') }}</th>
                    <th class="min-w-100px">{{ __('Rol') }}</th>
                    <th class="min-w-80px">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @forelse ($usuarios as $user)
                    <tr>
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
                            {{-- Acciones (Editar/Eliminar) --}}
                            <a href="#" class="btn btn-icon btn-light-warning btn-sm me-1" title="{{ __('Editar') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            {{-- Botón de eliminar --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">{{ __('No se encontraron usuarios activos con área asignada.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-end">
        {{ $usuarios->links() }}
    </div>
</div>