<x-default-layout>
    {{-- Título y Migas de Pan (Sección de metronic) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expediente de Denuncia') }} #{{ $denuncia->folio_seguimiento }}
        </h2>

        <a href="{{ route('admin.denuncias.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> {{ __('Regresar a la Bandeja') }}
        </a>
    </x-slot>

    <div class="container-fluid py-5">
        {{-- Mensajes de Éxito o Error --}}
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                <i class="fas fa-check-circle fs-2 me-3"></i>
                <div class="d-flex flex-column">
                    <h5 class="mb-1 text-success">{{ __('Éxito') }}</h5>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center p-5 mb-5">
                <i class="fas fa-times-circle fs-2 me-3"></i>
                <div class="d-flex flex-column">
                    <h5 class="mb-1 text-danger">{{ __('Error de Operación') }}</h5>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    {{-- Etiqueta de Estado Principal --}}
                    <span class="badge badge-lg badge-light-primary me-3 fs-6">
                        Estado: {{ $denuncia->estado->nombre ?? 'PENDIENTE DE ASIGNACIÓN' }}
                    </span>
                    <span class="text-muted fs-7">
                        Recepción: {{ $denuncia->fecha_recepcion->format('d/m/Y H:i') }}
                    </span>
                </div>
                
                <div class="card-toolbar">
                    {{-- ACCIONES CLAVE DEL ADMINISTRADOR (D2) --}}
                    
                    {{-- 1. Botón de Exportación (Permiso: admin-denuncia-descarga) --}}
                    @can('admin-denuncia-descarga')
                        <a href="{{ route('admin.denuncias.exportar.expediente', $denuncia->id_denuncia) }}" class="btn btn-sm btn-light-warning me-2">
                            <i class="fas fa-file-pdf me-1"></i> Exportar Expediente
                        </a>
                    @endcan

                    {{-- 2. Botón/Modal de Turno (Permiso: admin-denuncia-turnar) --}}
                    @can('admin-denuncia-turnar')
                        {{-- El modal debe estar incluido como partial --}}
                        @include('admin-denuncias.partials.modal_turno', ['denuncia' => $denuncia]) 
                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_turno">
                            <i class="fas fa-arrow-right-rotate me-1"></i> Turnar a OIC
                        </button>
                    @endcan
                </div>
            </div>
            
            <div class="card-body pt-0">
                
                {{-- Navegación principal por PESTAÑAS (UX: Agrupación Lógica) --}}
                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab_hechos"><i class="fas fa-map-marker-alt me-2"></i> Circunstancias y Hechos</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_involucrados"><i class="fas fa-users me-2"></i> Involucrados</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_evidencia"><i class="fas fa-paperclip me-2"></i> Evidencia ({{ $denuncia->archivos->count() }})</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_contacto_info"><i class="fas fa-id-card me-2"></i> Denunciante</a></li>
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
                                    <div class="card-header"><h4 class="card-title">{{ __('Detalles del Suceso') }}</h4></div>
                                    <div class="card-body">
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Fecha / Hora de Hechos:') }}</strong> 
                                            <span class="ms-2">{{ $denuncia->circunstancia->fecha_hechos->format('d/m/Y') ?? 'N/A' }} 
                                                <small class="text-muted">({{ $denuncia->circunstancia->hora_hechos ?? 'Sin hora' }})</small>
                                            </span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Lugar (Municipio):') }}</strong> 
                                            <span class="ms-2">{{ $denuncia->circunstancia->municipio->nombre_municipio ?? 'No Especificado' }}</span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Localidad / Colonia:') }}</strong> 
                                            <span class="ms-2">{{ $denuncia->circunstancia->localidad ?? 'N/A' }}</span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Dirección Exacta:') }}</strong> 
                                            <span class="ms-2">{{ $denuncia->circunstancia->direccion_exacta ?? 'N/A' }}</span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Dependencia Señalada:') }}</strong> 
                                            <span class="ms-2">{{ $denuncia->circunstancia->dependencia_involucrada ?? 'N/A' }}</span>
                                        </div>
                                        <div class="fs-6 py-2">
                                            <strong>{{ __('Trámite / Solicitud:') }}</strong> 
                                            <span class="ms-2">{{ $denuncia->circunstancia->tramite_solicitado ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Columna 2: Descripción y Monto --}}
                            <div class="col-md-6">
                                <div class="card card-dashed shadow-sm mb-5">
                                    <div class="card-header"><h4 class="card-title">{{ __('Motivo de la Denuncia') }}</h4></div>
                                    <div class="card-body">
                                        <p class="text-gray-700">{{ $denuncia->motivo_denuncia }}</p>
                                    </div>
                                </div>
                                
                                <div class="card card-dashed shadow-sm">
                                    <div class="card-header"><h4 class="card-title">{{ __('Contexto Adicional') }}</h4></div>
                                    <div class="card-body">
                                        <p><strong>{{ __('Circunstancias Detalladas:') }}</strong> {{ $denuncia->circunstancia->circunstancias_detalladas ?? 'Sin detalle adicional' }}</p>
                                        <p><strong>{{ __('Programa Público:') }}</strong> {{ $denuncia->programa_publico ?? 'No relacionado a programa' }}</p>
                                        <p><strong>{{ __('Daño Económico:') }}</strong> <span class="badge badge-light-danger fs-5">${{ number_format($denuncia->dinero_solicitado, 2) }}</span></p>
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

                        @forelse ($denuncia->involucrados as $involucrado)
                            <div class="card card-dashed mb-5 bg-light-primary">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        {{ $involucrado->nombre_denunciado ?? 'Involucrado Desconocido' }}
                                        @if($involucrado->es_servidor_publico)
                                            <span class="badge badge-light-danger ms-2">Servidor Público</span>
                                        @endif
                                    </h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="row fs-6">
                                        <div class="col-md-4"><strong>Puesto:</strong> {{ $involucrado->puesto_denunciado ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Sexo:</strong> {{ $involucrado->sexo ?? 'N/A' }}</div>
                                        <div class="col-md-4"><strong>Edad Aprox:</strong> {{ $involucrado->edad_aprox ?? 'N/A' }}</div>
                                        <div class="col-md-12 mt-3"><strong>Descripción Física:</strong> {{ $involucrado->descripcion_fisica ?? 'Sin descripción adicional.' }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">{{ __('No se proporcionó información detallada sobre personas involucradas o denunciadas.') }}</div>
                        @endforelse

                        <h3 class="fs-4 fw-bold mt-10 mb-5">{{ __('Testigos') }}</h3>
                        
                        @forelse ($denuncia->testigos as $testigo)
                            <div class="card card-dashed mb-5 bg-light-success">
                                <div class="card-header"><h5 class="card-title">{{ $testigo->nombre_testigo ?? 'Testigo Anónimo/Sin Nombre' }}</h5></div>
                                <div class="card-body py-3">
                                    <p><strong>Contacto:</strong> {{ $testigo->datos_contacto ?? 'N/A' }}</p>
                                    <p><strong>Observaciones:</strong> {{ $testigo->observaciones ?? 'Sin observaciones.' }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light">{{ __('El denunciante no proporcionó información sobre testigos.') }}</div>
                        @endforelse

                    </div>

                    {{-- ========================================================================= --}}
                    {{-- PESTAÑA 3: EVIDENCIA --}}
                    {{-- ========================================================================= --}}
                    <div class="tab-pane fade" id="tab_evidencia" role="tabpanel">
                        @forelse ($denuncia->archivos as $archivo)
                            <div class="d-flex align-items-center bg-light-info rounded p-5 mb-3">
                                <span class="svg-icon svg-icon-2hx svg-icon-info me-5">
                                    <i class="fas fa-file-{{ $archivo->tipo_archivo == 'imagen' ? 'image' : ($archivo->tipo_archivo == 'documento' ? 'alt' : 'video') }} fs-1 text-info"></i>
                                </span>
                                <div class="flex-grow-1">
                                    <a href="#" class="fw-bold text-gray-800 text-hover-primary fs-6">{{ $archivo->nombre_original }}</a>
                                    <span class="text-muted fw-semibold d-block">Tipo: {{ strtoupper($archivo->tipo_archivo) }} | Carga: {{ $archivo->fecha_carga->format('d/m/Y') }}</span>
                                </div>
                                <span class="ms-2">
                                    {{-- Botón de descarga SEGURA (D2.W.08) --}}
                                    @can('admin-denuncia-descarga')
                                        <a href="{{ route('admin.denuncias.descargar.evidencia', $archivo->id_archivo) }}" class="btn btn-icon btn-sm btn-info" title="Descargar">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endcan
                                </span>
                            </div>
                        @empty
                            <div class="alert alert-warning">{{ __('No se adjuntaron archivos de evidencia en esta denuncia.') }}</div>
                        @endforelse
                    </div>

                    {{-- ========================================================================= --}}
                    {{-- PESTAÑA 4: CONTACTO DEL DENUNCIANTE --}}
                    {{-- ========================================================================= --}}
                    <div class="tab-pane fade" id="tab_contacto_info" role="tabpanel">
                        <div class="card card-dashed shadow-sm">
                            <div class="card-header"><h4 class="card-title">{{ __('Datos de Contacto del Ciudadano') }}</h4></div>
                            <div class="card-body">
                                @if ($denuncia->es_anonima)
                                    <div class="alert alert-danger text-center fs-4">
                                        <i class="fas fa-mask me-2"></i>
                                        {{ __('DENUNCIA ANÓNIMA: La identidad y los datos de contacto están protegidos.') }}
                                    </div>
                                @elseif ($denuncia->contacto)
                                    <div class="fs-5 py-2"><strong>{{ __('Nombre Completo:') }}</strong> {{ $denuncia->contacto->nombre_completo }}</div>
                                    <div class="fs-5 py-2"><strong>{{ __('Correo Electrónico:') }}</strong> {{ $denuncia->contacto->correo_electronico }}</div>
                                    <div class="fs-5 py-2"><strong>{{ __('Teléfono:') }}</strong> {{ $denuncia->contacto->telefono }}</div>
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

{{-- NOTA: El partial modal_turno.blade.php debe ser creado por el D2 --}}