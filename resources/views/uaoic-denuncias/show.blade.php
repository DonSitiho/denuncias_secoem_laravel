<x-default-layout>
    {{-- Título y Migas de Pan (Sección de metronic) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expediente de Denuncia') }} #{{ $denuncia->folio_seguimiento }}
        </h2>

        <a href="{{ route('uaoic.mis-denuncias') }}" class="btn btn-sm btn-secondary">
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
                    @if ($denuncia->areaResponsable)
                        <span class="badge badge-lg badge-light-success me-3 fs-6">
                            Área Asignada: [{{ $denuncia->areaResponsable->siglas ?? 'N/D' }}] {{ $denuncia->areaResponsable->nombre_area ?? 'N/D' }}
                        </span>
                    @endif
                    <span class="text-muted fs-7">
                        Recepción: {{ $denuncia->fecha_recepcion->format('d/m/Y H:i') }}
                    </span>
                </div>
                
                <div class="card-toolbar">
                    
                    {{-- 1. Botón de Exportación (Permiso: uaoic-denuncia-descargar) --}}
                    @can('uaoic-denuncia-descargar')
                        <a href="{{ route('uaoic.exportar.expediente', $denuncia->id_denuncia) }}" class="btn btn-sm btn-light-warning me-2">
                            <i class="fas fa-file-pdf me-1"></i> Exportar Expediente
                        </a>
                    @endcan

                    {{-- 2. Botón/Modal de Turno (Permiso: admin-denuncia-turnar) --}}
                    @can('uaoic-denuncia-turnar')
                        {{-- El modal debe estar incluido como partial --}}
                        @include('uaoic-denuncias.partials.modal_turnado', ['denuncia' => $denuncia]) 
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
                                    {{-- ⭐ ENLACE ACTUALIZADO AL MÉTODO DE DESCARGA SEGURA --}}
                                    @can('uaoic-denuncia-descarga')
                                        <a href="{{ route('uaoic.descargar.evidencia', ['id_archivo' => $archivo->id_archivo]) }}" 
                                        class="btn btn-icon btn-sm btn-info" 
                                        title="Descargar Evidencia">
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

    @push('scripts')
    <script>
        // 1. Mapa de todos los usuarios OIC para la lógica inversa (Usuario -> Área)
        // Se usa keyBy('id') para que el acceso sea rápido por ID de usuario.
        const ALL_USERS_OIC = @json($usuariosOIC->keyBy('id'));
        const areaSelect = $('#id_area_responsable');
        const userSelect = $('#id_responsable');
        const userSelectOriginalHtml = userSelect.html(); // Guardar el HTML original
        
        // Función para inicializar Select2 (necesario al abrir el modal)
        function initSelect2() {
            areaSelect.select2({
                dropdownParent: $('#modal_turno')
            });
            userSelect.select2({
                dropdownParent: $('#modal_turno')
            });
        }
        
        // Re-inicializar Select2 al abrir el modal
        $('#modal_turno').on('shown.bs.modal', function () {
            initSelect2();
        });

        // =========================================================================
        // Lógica 1: Área Seleccionada -> Filtrar Usuarios (AJAX)
        // =========================================================================
        areaSelect.on('select2:select', function (e) {
            const idArea = e.params.data.id;
            
            // Si se selecciona un área válida
            if (idArea) {
                // 1. Crear URL dinámica
                const url = '{{ route("areas.usuarios", ["id_area" => ":id_area"]) }}'.replace(':id_area', idArea);

                // 2. Preparar select de usuarios
                userSelect.empty().append('<option value="">Cargando usuarios...</option>');
                userSelect.prop('disabled', true);
                userSelect.select2('destroy');
                
                // 3. Llamada AJAX para obtener usuarios del área
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(users) {
                        userSelect.empty();
                        userSelect.append('<option value="">No asignar a usuario específico (Solo al Área)...</option>');
                        
                        // Rellenar el select con los usuarios filtrados
                        if (users.length > 0) {
                            $.each(users, function(index, user) {
                                // Selecciona al usuario previamente asignado (si existe)
                                const isSelected = (user.id == '{{ $denuncia->id_responsable }}');
                                userSelect.append(new Option(user.name + ' (' + user.email + ')', user.id, isSelected, isSelected));
                            });
                        } else {
                            userSelect.append('<option value="" disabled>No hay usuarios en esta área.</option>');
                        }

                        userSelect.prop('disabled', false);
                        userSelect.val(userSelect.find(':selected').val() || '').trigger('change'); // Mantener o limpiar
                        initSelect2(); // Re-inicializar Select2
                    },
                    error: function() {
                        userSelect.empty().append('<option value="">Error al cargar usuarios.</option>');
                        userSelect.prop('disabled', false);
                        initSelect2(); // Re-inicializar Select2
                    }
                });
            } else {
                // Si el área se deselecciona, restaurar todos los usuarios OIC
                userSelect.html(userSelectOriginalHtml);
                userSelect.val('').trigger('change');
                initSelect2();
            }
        });


        // =========================================================================
        // Lógica 2: Usuario Seleccionado -> Auto-seleccionar Área (Mapeo Rápido)
        // =========================================================================
        userSelect.on('select2:select', function (e) {
            const idUser = e.params.data.id;
            
            if (idUser) {
                const user = ALL_USERS_OIC[idUser];
                
                if (user && user.id_area) {
                    // Seleccionar el área del usuario en el otro select
                    areaSelect.val(user.id_area).trigger('change');
                    
                    // Disparar el evento de Select2 para forzar el filtrado de usuarios
                    areaSelect.trigger('select2:select'); 
                }
            }
            // Si se selecciona la opción "No asignar a usuario...", el área no cambia.
        });
        
        // Trigger inicial si ya hay un área seleccionada al cargar
        if (areaSelect.val()) {
            areaSelect.trigger('select2:select');
        }

    </script>
    @endpush

</x-default-layout>