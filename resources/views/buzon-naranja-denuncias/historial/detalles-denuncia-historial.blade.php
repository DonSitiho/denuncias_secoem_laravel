<x-default-layout>
    {{-- Título y Migas de Pan (Sección de metronic) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expediente de Denuncia') }} #{{ $denuncia->folio }}
        </h2>

        <a href="{{ route('admin.denuncias.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> {{ __('Regresar a la Bandeja') }}
        </a>
    </x-slot>

    <div class="container-fluid py-5">

        <div class="card shadow-sm">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <span class="badge badge-lg badge-light-primary me-3 fs-6">
                        Estado: {{ $denuncia->status ?? 'PENDIENTE DE ASIGNACIÓN' }}
                    </span>
                    @if ($denuncia->areaResponsable)
                        <span class="badge badge-lg badge-light-success me-3 fs-6">
                            Área Asignada: [{{ $denuncia->areaResponsable->siglas ?? 'N/D' }}]
                            {{ $denuncia->areaResponsable->nombre_area ?? 'N/D' }}
                        </span>
                    @endif
                    <span class="text-muted fs-7">
                        Recepción: {{ $denuncia->date }}
                    </span>
                </div>
            </div>

            <div class="card-body pt-0">
                {{-- Navegación principal por PESTAÑAS (UX: Agrupación Lógica) --}}
                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab_contacto_info"><i
                                class="fas fa-id-card me-2"></i> Denuncia</a></li>
                </ul>
                <div class="tab-content" id="denunciaTabsContent">
                    {{-- ========================================================================= --}}
                    {{-- PESTAÑA 1: DATOS GENERALES DE LA DENUNCIA --}}
                    {{-- ========================================================================= --}}
                    <div class="tab-pane fade show active" id="tab_contacto_info" role="tabpanel">
                        <div class="card card-dashed shadow-sm">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('Datos de la Denuncia de Buzon Naranja') }}</h4>
                            </div>
                            <div class="card-body">

                                <div class="fs-5 py-2"><strong>{{ __('Folio:') }}</strong>
                                    {{ $denuncia->folio }}</div>
                                <div class="fs-5 py-2"><strong>{{ __('Fecha:') }}</strong>
                                    {{ $denuncia->date }}</div>
                                <div class="fs-5 py-2"><strong>{{ __('Hora:') }}</strong>
                                    {{ $denuncia->hora }}</div>
                                <div class="fs-5 py-2"><strong>{{ __('Nombre de Municipio:') }}</strong>
                                    {{ $denuncia->municipio->nombre_municipio }}</div>
                                <div class="fs-5 py-2"><strong>{{ __('Dependencia:') }}</strong>
                                    {{ $denuncia->dependencia }}</div>
                                <div class="fs-5 py-2"><strong>{{ __('Localidad:') }}</strong>
                                    {{ $denuncia->localidad }}</div>
                                <div class="fs-5 py-2"><strong>{{ __('Tramite:') }}</strong>
                                    {{ $denuncia->tramite }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-default-layout>
