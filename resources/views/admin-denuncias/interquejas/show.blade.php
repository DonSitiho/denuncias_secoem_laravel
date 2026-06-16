<x-default-layout>
    {{-- Título y Migas de Pan (Sección de metronic) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expediente de Denuncia') }} #{{ $interqueja->id }}
        </h2>

        <a href="{{ route('admin.denuncias.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> {{ __('Regresar a la Bandeja') }}
        </a>
    </x-slot>

    <div class="container-fluid py-5">
        
        <div class="card shadow-sm">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <span class="text-muted fs-7">
                        Recepción: {{ $interqueja->created_at }}
                    </span>
                </div>
            </div>

            <div class="card-body pt-0">
                {{-- Navegación principal por PESTAÑAS (UX: Agrupación Lógica) --}}
                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab_hechos"><i
                                class="fas fa-map-marker-alt me-2"></i> Circunstancias y Hechos</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_involucrados"><i
                                class="fas fa-users me-2"></i> Involucrados</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_contacto_info"><i
                                class="fas fa-id-card me-2"></i> Denunciante</a></li>
                </ul>
                <div class="tab-content" id="denunciaTabsContent">
                    {{-- ========================================================================= --}}
                    {{-- PESTAÑA 1: CIRCUNSTANCIAS Y HECHOS --}}
                    {{-- ========================================================================= --}}
                    <div class="tab-pane fade show active" id="tab_hechos" role="tabpanel">
                        <div class="row g-5">

                            {{-- Columna 1: Datos Generales --}}
                            <div class="col-md-6">
                                <div class="card card-dashed shadow-sm">
                                    <div class="card-header">
                                        <h4 class="card-title">{{ __('Detalles del Suceso') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Fecha / Hora de Hechos:') }}</strong>
                                            <span class="ms-2">{{ $interqueja->fecha_hecho ?? 'N/A' }}
                                            </span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Lugar (Municipio):') }}</strong>
                                            <span
                                                class="ms-2">{{ $denuncia->municipio->nombre_municipio ?? 'No Especificado' }}</span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Localidad / Colonia:') }}</strong>
                                            <span class="ms-2">{{ $interqueja->localidad_hecho ?? 'N/A' }}</span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Dirección Exacta:') }}</strong>
                                            <span class="ms-2">{{ $interqueja->hechos_donde ?? 'N/A' }}</span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Dependencia Señalada:') }}</strong>
                                            <span class="ms-2">{{ $interqueja->dependencia_hecho ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Columna 2: Descripción y Monto --}}
                            <div class="col-md-6">
                                <div class="card card-dashed shadow-sm mb-5">
                                    <div class="card-header">
                                        <h4 class="card-title">{{ __('Motivo de la Denuncia') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-gray-700">{{ $interqueja->hechos_como }}</p>
                                    </div>
                                </div>

                                <div class="card card-dashed shadow-sm">
                                    <div class="card-header">
                                        <h4 class="card-title">{{ __('Contexto Adicional') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>{{ __('Daño Económico:') }}</strong> <span
                                                class="badge badge-light-danger fs-5">${{ number_format($interqueja->cantidad, 2) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- ========================================================================= --}}
                    {{-- PESTAÑA 2: INVOLUCRADOS --}}
                    {{-- ========================================================================= --}}
                    <div class="tab-pane fade" id="tab_involucrados" role="tabpanel">
                        
                        <h3 class="fs-4 fw-bold mb-5">{{ __('Personas Denunciadas') }}</h3>

                            <div class="card card-dashed mb-5 bg-light-primary">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        {{ $interqueja->nombre_serv ?? 'Involucrado Desconocido' }}
                                        @if($interqueja->es_servidor_publico)
                                            <span class="badge badge-light-danger ms-2">Servidor Público</span>
                                        @endif
                                    </h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="row fs-6">
                                        <div class="col-md-4"><strong>Puesto:</strong> {{ $interqueja->cargo_serv ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Sexo:</strong> {{ $interqueja->carac_sexo ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Edad Aprox:</strong> {{ $interqueja->carac_edad ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Tez:</strong> {{ $interqueja->carac_tez ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Ojos:</strong> {{ $interqueja->carac_ojos ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Pelo:</strong> {{ $interqueja->carac_pelo ?? 'N/A' }}</div>
                                        <div class="col-md-12 mt-3"><strong>Descripción Física:</strong> {{ $interqueja->carac_part ?? 'Sin descripción adicional.' }}</div>
                                    </div>
                                </div>
                            </div>


                        <h3 class="fs-4 fw-bold mt-10 mb-5">{{ __('Testigos') }}</h3>
                        
                        @if ($interqueja->hechos_testigos != 'No')
                            <div class="card card-dashed mb-5 bg-light-success">
                                <div class="card-header"><h5 class="card-title">{{ $interqueja->nombre_testigo ?? 'Testigo Anónimo/Sin Nombre' }}</h5></div>
                                <div class="card-body py-3">
                                    <p><strong>Contacto:</strong> {{ $interqueja->datos_contacto ?? 'N/A' }}</p>
                                    <p><strong>Observaciones:</strong> {{ $interqueja->observaciones ?? 'Sin observaciones.' }}</p>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">{{ __('El denunciante no proporcionó información sobre testigos.') }}</div>
                        @endif

                    </div>


                    {{-- ========================================================================= --}}
                    {{-- PESTAÑA 4: CONTACTO DEL DENUNCIANTE --}}
                    {{-- ========================================================================= --}}
                    <div class="tab-pane fade" id="tab_contacto_info" role="tabpanel">
                        <div class="card card-dashed shadow-sm">
                            <div class="card-header"><h4 class="card-title">{{ __('Datos de Contacto del Ciudadano') }}</h4></div>
                            <div class="card-body">
                                @if ($interqueja->qjs_mombre == 'Anonimo')
                                    <div class="alert alert-danger text-center fs-4">
                                        <i class="fas fa-mask me-2"></i>
                                        {{ __('DENUNCIA ANÓNIMA: La identidad y los datos de contacto están protegidos.') }}
                                    </div>
                                @elseif ($interqueja->qjs_nombre != 'xxx')
                                    <div class="fs-5 py-2"><strong>{{ __('Nombre Completo:') }}</strong> {{ $interqueja->qjs_nombre }}</div>
                                    <div class="fs-5 py-2"><strong>{{ __('Correo Electrónico:') }}</strong> {{ $interqueja->qjs_email }}</div>
                                    <div class="fs-5 py-2"><strong>{{ __('Teléfono:') }}</strong> {{ $interqueja->qjs_tel }}</div>
                                    <div class="fs-5 py-2"><strong>{{ __('Calle y número:') }}</strong> {{ $interqueja->qjs_dom }}</div>
                                    <div class="fs-5 py-2"><strong>{{ __('Colonia:') }}</strong> {{ $interqueja->qjs_col }}</div>
                                    <div class="fs-5 py-2"><strong>{{ __('Código postal:') }}</strong> {{ $interqueja->qjs_cp }}</div>
                                @else
                                    <div class="alert alert-warning">{{ __('Denuncia identificada, pero los datos de contacto no fueron guardados o son nulos.') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</x-default-layout>