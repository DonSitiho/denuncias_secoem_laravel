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
                    <th class="min-w-100px cursor-pointer" wire:click="sortBy('folio_seguimiento')">{{ __('Folio') }}
                    </th>
                    <th class="min-w-120px cursor-pointer" wire:click="sortBy('fecha_recepcion')">{{ __('Recepción') }}
                    </th>
                    <th class="min-w-120px cursor-pointer" wire:click="sortBy('fecha_hechos')">{{ __('Hechos') }}</th>
                    <th class="min-w-150px">{{ __('Datos de Contacto') }}</th>
                    <th class="min-w-150px">{{ __('Dependencia / Municipio') }}</th>
                    <th class="min-w-100px">{{ __('Estatus') }}</th>
                    <th class="min-w-80px">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                @forelse ($denuncias as $denuncia)
                    <tr>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="text-gray-800 mb-1">{{ $denuncia->folio_seguimiento }}</span>
                                <span class="text-muted fs-7">{{ $denuncia->no_expediente_inter ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td>{{ $denuncia->fecha_recepcion->format('d/m/Y H:i') }}</td>
                        <td>
                            {{ $denuncia->circunstancia->fecha_hechos?->format('d/m/Y') }}
                            <span class="text-muted fs-7">({{ $denuncia->circunstancia->hora_hechos ?? 'N/A' }})</span>
                        </td>
                        <td>
                            @if ($denuncia->es_anonima)
                                <span class="badge badge-light-danger">{{ __('Anónima') }}</span>
                            @else
                                <span>{{ $denuncia->contacto->nombre_completo ?? 'N/D' }}</span>
                                <span
                                    class="text-muted fs-7 d-block">{{ $denuncia->contacto->correo_electronico ?? 'N/D' }}</span>
                            @endif
                        </td>
                        <td>
                            <span
                                class="text-gray-800">{{ $denuncia->circunstancia->dependencia_involucrada ?? 'Ciudadano General' }}</span>
                            <span
                                class="text-muted fs-7 d-block">{{ $denuncia->circunstancia->municipio->nombre_municipio ?? 'No Especificado' }}</span>
                        </td>
                        <td>
                            <span class="badge badge-lg badge-light-primary">
                                {{ $denuncia->estado->nombre ?? 'PENDIENTE DE ASIGNACIÓN' }}
                            </span>
                            @if ($denuncia->areaResponsable)
                                <span class="text-muted fs-7 d-block">
                                    [{{ $denuncia->areaResponsable->siglas ?? 'N/D' }}]
                                    {{ $denuncia->areaResponsable->nombre_area ?? 'N/D' }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.denuncias.show', $denuncia->id_denuncia) }}"
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
    <div class="justify-content-end">
        {{ $denuncias->links() }}
    </div>
</div>
