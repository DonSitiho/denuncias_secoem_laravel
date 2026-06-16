<div>
    {{-- Caja de Búsqueda --}}
    <div class="d-flex justify-content-end align-items-center mb-5">
        <div class="d-flex align-items-center position-relative my-1">
            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                <i class="fas fa-search"></i>
            </span>
            {{-- ENLACE EN TIEMPO REAL: wire:model.live.debounce.300ms se actualiza al escribir --}}
            <input type="text" wire:model.live.debounce.300ms="search"
                class="form-control form-control-solid w-250px ps-15"
                placeholder="{{ __('Buscar en todas las denuncias...') }}" />
        </div>
    </div>

    {{-- Tabla de Denuncias --}}
    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-100px cursor-pointer" wire:click="sortBy('id')">{{ __('Folio') }}
                    </th>
                    <th class="min-w-120px cursor-pointer" wire:click="sortBy('fecha_hecho')">{{ __('Fecha y hora de los hechos') }}
                    </th>
                    <th class="min-w-120px cursor-pointer" wire:click="sortBy('fecha_hecho')">{{ __('Denuncia realizada el dia y hora') }}</th>
                    <th class="min-w-150px">{{ __('Servidor denunciado') }}</th>
                    <th class="min-w-150px">{{ __('Dependencia') }}</th>
                    <th class="min-w-100">{{ __('Datos del denunciante') }}</th>
                    <th class="min-w-80px">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @forelse ($interquejas as $denuncia)
                    <tr>
                        <td>
                            {{ $denuncia->id }}
                        </td>
                        <td>
                            {{ $denuncia->fecha_hecho }}
                        </td>
                        <td>
                            {{ $denuncia->created_at }}
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="text-gray-800 mb-1">{{ $denuncia->nombre_serv }}</span>
                                <span class="text-muted fs-7">{{ $denuncia->cargo_serv ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-gray-800">{{ $denuncia->dependencia_hecho }}</span>
                        </td>
                        <td>
                            <span class="text-gray-800 mb-1">{{ $denuncia->qjs_nombre ?? 'N/D' }}</span>
                            <span class="text-muted fs-7 d-block">{{ $denuncia->qjs_tel ?? 'N/D' }}</span>
                            <span class="text-muted fs-7 d-block">{{ $denuncia->qjs_email ?? 'N/D' }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.denuncias.interqueja', $denuncia->id) }}"
                                class="btn btn-icon btn-light-primary btn-sm me-1" title="{{ __('Revisar Detalle') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            {{ __('No se encontraron denuncias que coincidan con la búsqueda.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-end">
        {{ $interquejas->links() }}
    </div>
</div>
