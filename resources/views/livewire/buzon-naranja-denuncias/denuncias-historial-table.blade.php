<div>
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    {{-- Caja de Búsqueda --}}
    <div class="d-flex justify-content-end align-items-center mb-5">
        <div class="d-flex align-items-center position-relative my-1">
            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                <i class="fas fa-search"></i>
            </span>
            {{-- ENLACE EN TIEMPO REAL: wire:model.live.debounce.300ms se actualiza al escribir --}}
            <input type="text" wire:model.live.debounce.300ms="search"
                class="form-control form-control-solid w-300px ps-15"
                placeholder="{{ __('Buscar en todas las denuncias...') }}" />
        </div>
    </div>

    {{-- Tabla de Denuncias --}}
    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-100px cursor-pointer" wire:click="sortBy('folio')">{{ __('Folio') }}
                    </th>
                    <th class="min-w-150px cursor-pointer" wire:click="sortBy('date')">{{ __('Fecha') }}
                    </th>
                    <th class="min-w-140px cursor-pointer" wire:click="sortBy('fecha_hechos')">{{ __('Dependencia') }}</th>
                    <th class="min-w-150px">{{ __('Localidad') }}</th>
                    <th class="min-w-100px">{{ __('Estatus') }}</th>
                    <th class="min-w-80px">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @forelse ($denuncias as $denuncia)
                <tr>
                    <td>
                        <div class="d-flex flex-column">
                            <span class="text-gray-800 mb-1">{{ $denuncia->folio }}</span>
                            <span class="text-muted fs-7">{{ $denuncia->no_expediente_inter ?? 'N/A' }}</span>
                        </div>
                    </td>
                    
                    <td>{{ $denuncia->date }}</td>
                    <td>{{ $denuncia->dependencia }}</td>
                    <td>{{ $denuncia->localidad }}</td>
                    <td>{{ $denuncia->status }}</td>
                    <td>
                        <a href="{{ route('buzon-naranja.denuncias.ver-denuncia-historial', $denuncia->id) }}"
                            class="btn btn-icon btn-light-primary btn-sm me-1" title="{{ __('Revisar Detalle') }}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">{{ __('No se encontraron denuncias que coincidan con
                        la búsqueda.') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-end">
        {{ $denuncias->links() }}
    </div>
</div>