<x-auth-layout>
    @section('content')
    
        <!--begin::Container-->
        <div class="container py-10">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Sistema de Denuncias Ciudadanas</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">Complete el siguiente formulario para registrar su denuncia</span>
                    </h3>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!-- Mostrar errores generales -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_denuncia_form"
                        action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!--begin::Sección 1: Datos del Denunciante -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-primary svg-icon-2hx me-4">
                                    <i class="fas fa-user fs-2 text-primary"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Datos del Denunciante</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="es_anonima" value="0">
                                    <div class="form-check form-switch form-check-custom form-check-solid mb-10">
                                        <input class="form-check-input" type="checkbox" id="es_anonima"
                                            name="es_anonima" value="1" {{ old('es_anonima', 1) ? 'checked="checked"' : '' }}>
                                        <label class="form-check-label fw-bold fs-6 text-gray-700" for="es_anonima">
                                            Realizar denuncia anónima
                                        </label>
                                    </div>

                                    <div id="contactoContainer" style="display: {{ old('es_anonima', 1) ? 'none' : 'block' }};">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="fv-row mb-8">
                                                    <label class="form-label fs-6 fw-bold text-gray-700 required">Nombre completo</label>
                                                    <input type="text" class="form-control form-control-solid @error('nombre_completo') is-invalid @enderror"
                                                        name="nombre_completo" placeholder="Ingrese su nombre completo" 
                                                        value="{{ old('nombre_completo') }}" />
                                                    @error('nombre_completo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row mb-8">
                                                    <label class="form-label fs-6 fw-bold text-gray-700 required">Teléfono</label>
                                                    <input type="text" class="form-control form-control-solid @error('telefono') is-invalid @enderror"
                                                        name="telefono" placeholder="Ingrese su número telefónico" 
                                                        value="{{ old('telefono') }}" />
                                                    @error('telefono')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row mb-8">
                                                    <label class="form-label fs-6 fw-bold text-gray-700 required">Correo electrónico</label>
                                                    <input type="email" class="form-control form-control-solid @error('correo_electronico') is-invalid @enderror"
                                                        name="correo_electronico" placeholder="Ingrese su correo electrónico" 
                                                        value="{{ old('correo_electronico') }}" />
                                                    @error('correo_electronico')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 1-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->

                        <!--begin::Sección 2: Datos del Hecho -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-warning svg-icon-2hx me-4">
                                    <i class="fas fa-exclamation-triangle fs-2 text-warning"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Hechos Denunciados</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700 required">Motivo de la denuncia</label>
                                        <textarea class="form-control form-control-solid @error('motivo_denuncia') is-invalid @enderror" 
                                            name="motivo_denuncia" rows="3" placeholder="Describa el motivo principal de su denuncia" 
                                            required>{{ old('motivo_denuncia') }}</textarea>
                                        @error('motivo_denuncia')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700 required">Fecha de los hechos</label>
                                        <input type="date" class="form-control form-control-solid @error('fecha_hechos') is-invalid @enderror" 
                                            name="fecha_hechos" value="{{ old('fecha_hechos') }}" required />
                                        @error('fecha_hechos')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Hora de los hechos</label>
                                        <input type="time" class="form-control form-control-solid" 
                                            name="hora_hechos" value="{{ old('hora_hechos') }}" placeholder="HH:MM" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Municipio</label>
                                        <select class="form-select form-select-solid" name="id_municipio">
                                            <option value="">Seleccione un municipio...</option>
                                            @foreach ($municipios as $mun)
                                                <option value="{{ $mun->id_municipio }}" {{ old('id_municipio') == $mun->id_municipio ? 'selected' : '' }}>
                                                    {{ $mun->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700 required">Dirección exacta</label>
                                        <input type="text" class="form-control form-control-solid @error('direccion_exacta') is-invalid @enderror"
                                            name="direccion_exacta" placeholder="Dirección exacta donde ocurrieron los hechos" 
                                            value="{{ old('direccion_exacta') }}" required />
                                        @error('direccion_exacta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Localidad</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="localidad" placeholder="Localidad o colonia" 
                                            value="{{ old('localidad') }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Dependencia involucrada</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="dependencia_involucrada" placeholder="Dependencia gubernamental involucrada" 
                                            value="{{ old('dependencia_involucrada') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Trámite solicitado</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="tramite_solicitado" placeholder="Trámite o servicio relacionado" 
                                            value="{{ old('tramite_solicitado') }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Circunstancias detalladas</label>
                                        <textarea class="form-control form-control-solid" name="circunstancias_detalladas" rows="4"
                                            placeholder="Describa con el mayor detalle posible los hechos ocurridos, incluyendo personas involucradas, testigos, y cualquier información relevante">{{ old('circunstancias_detalladas') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 2-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->

                        <!--begin::Sección 3: Personas Involucradas -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-danger svg-icon-2hx me-4">
                                    <i class="fas fa-users fs-2 text-danger"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Personas Involucradas</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <!-- Involucrados -->
                            <div class="mb-15">
                                <h4 class="fw-bold text-gray-700 mb-6">Involucrados</h4>
                                <div id="involucrados-container">
                                    @php
                                        $oldInvolucrados = old('involucrados', [['nombre_denunciado' => '', 'puesto_denunciado' => '', 'es_servidor_publico' => 0, 'sexo' => '', 'tez' => '', 'estatura_aprox' => '', 'edad_aprox' => '', 'complexion' => '', 'color_ojos' => '', 'tipo_cabello' => '', 'senas_particulares' => '', 'descripcion_fisica' => '']]);
                                    @endphp
                                    
                                    @foreach($oldInvolucrados as $index => $involucrado)
                                    <div class="involucrado-group card card-flush bg-light-primary mb-6">
                                        <div class="card-header">
                                            <h5 class="card-title text-primary">Involucrado #{{ $index + 1 }}</h5>
                                            @if($index > 0)
                                            <button type="button" class="btn btn-icon btn-light-danger remove-involucrado">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Nombre completo</label>
                                                        <input type="text" class="form-control" 
                                                            name="involucrados[{{ $index }}][nombre_denunciado]" 
                                                            placeholder="Nombre del involucrado" 
                                                            value="{{ $involucrado['nombre_denunciado'] ?? '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Puesto</label>
                                                        <input type="text" class="form-control" 
                                                            name="involucrados[{{ $index }}][puesto_denunciado]" 
                                                            placeholder="Puesto del involucrado" 
                                                            value="{{ $involucrado['puesto_denunciado'] ?? '' }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-check form-check-custom form-check-solid mb-8">
                                                <input class="form-check-input" type="checkbox" 
                                                    name="involucrados[{{ $index }}][es_servidor_publico]" 
                                                    value="1" {{ isset($involucrado['es_servidor_publico']) && $involucrado['es_servidor_publico'] ? 'checked' : '' }} />
                                                <label class="form-check-label fw-semibold text-gray-700">
                                                    ¿Es servidor público?
                                                </label>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Sexo</label>
                                                        <select class="form-select" name="involucrados[{{ $index }}][sexo]">
                                                            <option value="">Seleccione...</option>
                                                            <option value="H" {{ ($involucrado['sexo'] ?? '') == 'H' ? 'selected' : '' }}>Hombre</option>
                                                            <option value="M" {{ ($involucrado['sexo'] ?? '') == 'M' ? 'selected' : '' }}>Mujer</option>
                                                            <option value="N/I" {{ ($involucrado['sexo'] ?? '') == 'N/I' ? 'selected' : '' }}>No identificado</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Tez</label>
                                                        <input type="text" class="form-control" 
                                                            name="involucrados[{{ $index }}][tez]" 
                                                            placeholder="Ej: Morena clara, Blanca, etc." 
                                                            value="{{ $involucrado['tez'] ?? '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Estatura aproximada (m)</label>
                                                        <input type="number" step="0.01" class="form-control" 
                                                            name="involucrados[{{ $index }}][estatura_aprox]" 
                                                            placeholder="Ej: 1.75" 
                                                            value="{{ $involucrado['estatura_aprox'] ?? '' }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Edad aproximada</label>
                                                        <input type="number" class="form-control" 
                                                            name="involucrados[{{ $index }}][edad_aprox]" 
                                                            placeholder="Edad aproximada" 
                                                            value="{{ $involucrado['edad_aprox'] ?? '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Complexión</label>
                                                        <input type="text" class="form-control" 
                                                            name="involucrados[{{ $index }}][complexion]" 
                                                            placeholder="Ej: Delgada, Robusta, etc." 
                                                            value="{{ $involucrado['complexion'] ?? '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Color de ojos</label>
                                                        <input type="text" class="form-control" 
                                                            name="involucrados[{{ $index }}][color_ojos]" 
                                                            placeholder="Ej: Cafés, Verdes, etc." 
                                                            value="{{ $involucrado['color_ojos'] ?? '' }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Tipo de cabello</label>
                                                        <input type="text" class="form-control" 
                                                            name="involucrados[{{ $index }}][tipo_cabello]" 
                                                            placeholder="Ej: Lacio, Rizado, Calvo, etc." 
                                                            value="{{ $involucrado['tipo_cabello'] ?? '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Señas particulares</label>
                                                        <input type="text" class="form-control" 
                                                            name="involucrados[{{ $index }}][senas_particulares]" 
                                                            placeholder="Ej: Tatuajes, Cicatrices, etc." 
                                                            value="{{ $involucrado['senas_particulares'] ?? '' }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Descripción física adicional</label>
                                                        <textarea class="form-control" 
                                                            name="involucrados[{{ $index }}][descripcion_fisica]" 
                                                            rows="3" 
                                                            placeholder="Describa cualquier característica física adicional del involucrado">{{ $involucrado['descripcion_fisica'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-light-primary" id="add-involucrado">
                                    <i class="fas fa-plus me-2"></i>Agregar otro involucrado
                                </button>
                            </div>

                            <!-- Testigos -->
                            <div class="mb-15">
                                <h4 class="fw-bold text-gray-700 mb-6">Testigos</h4>
                                <div id="testigos-container">
                                    @php
                                        $oldTestigos = old('testigos', [['nombre_testigo' => '', 'datos_contacto' => '', 'observaciones' => '']]);
                                    @endphp
                                    
                                    @foreach($oldTestigos as $index => $testigo)
                                    <div class="testigo-group card card-flush bg-light-success mb-6">
                                        <div class="card-header">
                                            <h5 class="card-title text-success">Testigo #{{ $index + 1 }}</h5>
                                            @if($index > 0)
                                            <button type="button" class="btn btn-icon btn-light-danger remove-testigo">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Nombre del testigo</label>
                                                        <input type="text" class="form-control" 
                                                            name="testigos[{{ $index }}][nombre_testigo]" 
                                                            placeholder="Nombre completo del testigo" 
                                                            value="{{ $testigo['nombre_testigo'] ?? '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Datos de contacto</label>
                                                        <input type="text" class="form-control" 
                                                            name="testigos[{{ $index }}][datos_contacto]" 
                                                            placeholder="Teléfono, correo, etc." 
                                                            value="{{ $testigo['datos_contacto'] ?? '' }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Observaciones</label>
                                                        <textarea class="form-control" 
                                                            name="testigos[{{ $index }}][observaciones]" 
                                                            rows="3" 
                                                            placeholder="Observaciones adicionales sobre el testigo">{{ $testigo['observaciones'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-light-success" id="add-testigo">
                                    <i class="fas fa-plus me-2"></i>Agregar otro testigo
                                </button>
                            </div>
                        </div>
                        <!--end::Sección 3-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->

                        <!--begin::Sección 4: Evidencias -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-info svg-icon-2hx me-4">
                                    <i class="fas fa-paperclip fs-2 text-info"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Evidencias y Archivos</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="fv-row mb-8">
                                <label class="form-label fs-6 fw-bold text-gray-700">Adjuntar archivos</label>
                                <input type="file" name="archivos[]" class="form-control form-control-solid"
                                    multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.mp4,.avi,.mov" />
                                <div class="text-muted mt-2 fs-7">
                                    <i class="fas fa-info-circle text-info me-2"></i>
                                    Formatos permitidos: PDF, JPG, PNG, DOC, DOCX, MP4, AVI, MOV. Tamaño máximo por archivo: 10MB.
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 4-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->

                        <!--begin::Sección 5: Confirmación -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-success svg-icon-2hx me-4">
                                    <i class="fas fa-check-circle fs-2 text-success"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Confirmación Final</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="fv-row mb-8">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input @error('confirmacion_datos') is-invalid @enderror" 
                                        type="checkbox" id="confirmacion_datos" name="confirmacion_datos" 
                                        value="1" {{ old('confirmacion_datos') ? 'checked' : '' }} required />
                                    <label class="form-check-label fw-semibold fs-6 text-gray-700" for="confirmacion_datos">
                                        Confirmo bajo protesta de decir verdad que toda la información proporcionada es verídica, exacta y completa. 
                                        Acepto los términos y condiciones del sistema de denuncias y comprendo que proporcionar información falsa 
                                        puede tener consecuencias legales.
                                    </label>
                                    @error('confirmacion_datos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 5-->

                        <!--begin::Acciones-->
                        <div class="d-flex justify-content-end pt-10">
                            <button type="reset" class="btn btn-lg btn-light me-5">
                                <i class="fas fa-eraser me-2"></i>
                                Limpiar Formulario
                            </button>
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>
                                Enviar Denuncia
                            </button>
                        </div>
                        <!--end::Acciones-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Toggle para denuncia anónima
                const esAnonimaCheckbox = document.getElementById("es_anonima");
                const contactoContainer = document.getElementById("contactoContainer");

                if (esAnonimaCheckbox && contactoContainer) {
                    function toggleContactoFields() {
                        const contactoInputs = contactoContainer.querySelectorAll("input");

                        if (esAnonimaCheckbox.checked) {
                            contactoContainer.style.display = "none";
                            contactoInputs.forEach(input => {
                                input.value = "";
                                input.removeAttribute("required");
                                input.classList.remove("is-invalid");
                                
                                // Limpiar mensajes de error
                                const errorMsg = input.parentNode.querySelector('.invalid-feedback');
                                if (errorMsg) errorMsg.remove();
                            });
                        } else {
                            contactoContainer.style.display = "block";
                            contactoInputs.forEach(input => {
                                input.setAttribute("required", "");
                            });
                        }
                    }

                    // Ejecutar en carga inicial
                    toggleContactoFields();

                    // Ejecutar al cambiar el checkbox
                    esAnonimaCheckbox.addEventListener("change", toggleContactoFields);
                }

                // Funcionalidad para campos dinámicos de involucrados
                let involucradoCount = {{ count(old('involucrados', [0])) }};
                const addInvolucradoBtn = document.getElementById('add-involucrado');
                const involucradosContainer = document.getElementById('involucrados-container');

                if (addInvolucradoBtn && involucradosContainer) {
                    addInvolucradoBtn.addEventListener('click', function() {
                        involucradoCount++;
                        const newInvolucrado = document.createElement('div');
                        newInvolucrado.className = 'involucrado-group card card-flush bg-light-primary mb-6';
                        newInvolucrado.innerHTML = `
                            <div class="card-header">
                                <h5 class="card-title text-primary">Involucrado #${involucradoCount}</h5>
                                <button type="button" class="btn btn-icon btn-light-danger remove-involucrado">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Nombre completo</label>
                                            <input type="text" class="form-control" name="involucrados[${involucradoCount-1}][nombre_denunciado]" placeholder="Nombre del involucrado" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Puesto</label>
                                            <input type="text" class="form-control" name="involucrados[${involucradoCount-1}][puesto_denunciado]" placeholder="Puesto del involucrado" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-check form-check-custom form-check-solid mb-8">
                                    <input class="form-check-input" type="checkbox" name="involucrados[${involucradoCount-1}][es_servidor_publico]" value="1" />
                                    <label class="form-check-label fw-semibold text-gray-700">
                                        ¿Es servidor público?
                                    </label>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Sexo</label>
                                            <select class="form-select" name="involucrados[${involucradoCount-1}][sexo]">
                                                <option value="">Seleccione...</option>
                                                <option value="H">Hombre</option>
                                                <option value="M">Mujer</option>
                                                <option value="N/I">No identificado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Tez</label>
                                            <input type="text" class="form-control" name="involucrados[${involucradoCount-1}][tez]" placeholder="Ej: Morena clara, Blanca, etc." />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Estatura aproximada (m)</label>
                                            <input type="number" step="0.01" class="form-control" name="involucrados[${involucradoCount-1}][estatura_aprox]" placeholder="Ej: 1.75" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Edad aproximada</label>
                                            <input type="number" class="form-control" name="involucrados[${involucradoCount-1}][edad_aprox]" placeholder="Edad aproximada" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Complexión</label>
                                            <input type="text" class="form-control" name="involucrados[${involucradoCount-1}][complexion]" placeholder="Ej: Delgada, Robusta, etc." />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Color de ojos</label>
                                            <input type="text" class="form-control" name="involucrados[${involucradoCount-1}][color_ojos]" placeholder="Ej: Cafés, Verdes, etc." />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Tipo de cabello</label>
                                            <input type="text" class="form-control" name="involucrados[${involucradoCount-1}][tipo_cabello]" placeholder="Ej: Lacio, Rizado, Calvo, etc." />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Señas particulares</label>
                                            <input type="text" class="form-control" name="involucrados[${involucradoCount-1}][senas_particulares]" placeholder="Ej: Tatuajes, Cicatrices, etc." />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Descripción física adicional</label>
                                            <textarea class="form-control" name="involucrados[${involucradoCount-1}][descripcion_fisica]" rows="3" placeholder="Describa cualquier característica física adicional del involucrado"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        involucradosContainer.appendChild(newInvolucrado);
                    });

                    // Delegación de eventos para eliminar involucrados
                    involucradosContainer.addEventListener('click', function(e) {
                        if (e.target.closest('.remove-involucrado')) {
                            const involucradoGroup = e.target.closest('.involucrado-group');
                            if (involucradoGroup && involucradosContainer.querySelectorAll('.involucrado-group').length > 1) {
                                involucradoGroup.remove();
                                // Actualizar números de secuencia
                                updateInvolucradoNumbers();
                            }
                        }
                    });
                }

                // Funcionalidad para campos dinámicos de testigos
                let testigoCount = {{ count(old('testigos', [0])) }};
                const addTestigoBtn = document.getElementById('add-testigo');
                const testigosContainer = document.getElementById('testigos-container');

                if (addTestigoBtn && testigosContainer) {
                    addTestigoBtn.addEventListener('click', function() {
                        testigoCount++;
                        const newTestigo = document.createElement('div');
                        newTestigo.className = 'testigo-group card card-flush bg-light-success mb-6';
                        newTestigo.innerHTML = `
                            <div class="card-header">
                                <h5 class="card-title text-success">Testigo #${testigoCount}</h5>
                                <button type="button" class="btn btn-icon btn-light-danger remove-testigo">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Nombre del testigo</label>
                                            <input type="text" class="form-control" name="testigos[${testigoCount-1}][nombre_testigo]" placeholder="Nombre completo del testigo" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Datos de contacto</label>
                                            <input type="text" class="form-control" name="testigos[${testigoCount-1}][datos_contacto]" placeholder="Teléfono, correo, etc." />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fv-row mb-8">
                                            <label class="form-label fs-6 fw-bold text-gray-700">Observaciones</label>
                                            <textarea class="form-control" name="testigos[${testigoCount-1}][observaciones]" rows="3" placeholder="Observaciones adicionales sobre el testigo"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        testigosContainer.appendChild(newTestigo);
                    });

                    // Delegación de eventos para eliminar testigos
                    testigosContainer.addEventListener('click', function(e) {
                        if (e.target.closest('.remove-testigo')) {
                            const testigoGroup = e.target.closest('.testigo-group');
                            if (testigoGroup && testigosContainer.querySelectorAll('.testigo-group').length > 1) {
                                testigoGroup.remove();
                                // Actualizar números de secuencia
                                updateTestigoNumbers();
                            }
                        }
                    });
                }

                // Función para actualizar números de involucrados
                function updateInvolucradoNumbers() {
                    const involucradoGroups = involucradosContainer.querySelectorAll('.involucrado-group');
                    involucradoGroups.forEach((group, index) => {
                        const title = group.querySelector('.card-title');
                        title.textContent = `Involucrado #${index + 1}`;
                    });
                }

                // Función para actualizar números de testigos
                function updateTestigoNumbers() {
                    const testigoGroups = testigosContainer.querySelectorAll('.testigo-group');
                    testigoGroups.forEach((group, index) => {
                        const title = group.querySelector('.card-title');
                        title.textContent = `Testigo #${index + 1}`;
                    });
                }

                // Validación del formulario
                const form = document.getElementById("kt_denuncia_form");
                if (form) {
                    form.addEventListener("submit", function(e) {
                        e.preventDefault();

                        // Limpiar errores previos
                        clearErrors();

                        // Validar formulario
                        if (validateForm()) {
                            // Mostrar confirmación
                            Swal.fire({
                                title: "¿Confirmar envío de denuncia?",
                                text: "Una vez enviada, recibirá un folio de seguimiento para consultar el estado de su denuncia.",
                                icon: "question",
                                showCancelButton: true,
                                confirmButtonText: "Sí, enviar denuncia",
                                cancelButtonText: "Revisar información",
                                reverseButtons: true,
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                    cancelButton: 'btn btn-light'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Enviar el formulario
                                    form.submit();
                                }
                            });
                        }
                    });
                }

                // Función para validar el formulario completo
                function validateForm() {
                    let isValid = true;

                    // Validar datos del denunciante si NO es anónima
                    const esAnonima = document.getElementById('es_anonima').checked;
                    if (!esAnonima) {
                        const camposContacto = [
                            { field: document.querySelector('[name="nombre_completo"]'), name: "Nombre completo" },
                            { field: document.querySelector('[name="telefono"]'), name: "Teléfono" },
                            { field: document.querySelector('[name="correo_electronico"]'), name: "Correo electrónico" }
                        ];

                        camposContacto.forEach(campo => {
                            if (!campo.field.value.trim()) {
                                showError(campo.field, `${campo.name} es requerido`);
                                isValid = false;
                            } else if (campo.name === "Correo electrónico" && !isValidEmail(campo.field.value)) {
                                showError(campo.field, "Ingrese un correo electrónico válido");
                                isValid = false;
                            }
                        });
                    }

                    // Validar campos requeridos principales
                    const camposRequeridos = [
                        { field: document.querySelector('[name="motivo_denuncia"]'), name: "Motivo de la denuncia" },
                        { field: document.querySelector('[name="fecha_hechos"]'), name: "Fecha de los hechos" },
                        { field: document.querySelector('[name="direccion_exacta"]'), name: "Dirección exacta" }
                    ];

                    camposRequeridos.forEach(campo => {
                        if (!campo.field.value.trim()) {
                            showError(campo.field, `${campo.name} es requerido`);
                            isValid = false;
                        }
                    });

                    // Validar fecha no futura
                    const fechaHechos = document.querySelector('[name="fecha_hechos"]');
                    if (fechaHechos.value) {
                        const fechaIngresada = new Date(fechaHechos.value);
                        const hoy = new Date();
                        hoy.setHours(0, 0, 0, 0);
                        
                        if (fechaIngresada > hoy) {
                            showError(fechaHechos, "La fecha no puede ser futura");
                            isValid = false;
                        }
                    }

                    // Validar confirmación
                    const confirmacionCheckbox = document.getElementById("confirmacion_datos");
                    if (!confirmacionCheckbox.checked) {
                        showError(confirmacionCheckbox, "Debe confirmar que la información es verídica");
                        isValid = false;
                    }

                    if (!isValid) {
                        // Scroll al primer error
                        const firstError = document.querySelector('.is-invalid');
                        if (firstError) {
                            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }

                        Swal.fire({
                            icon: "warning",
                            title: "Campos requeridos",
                            text: "Por favor complete todos los campos obligatorios marcados en rojo.",
                            confirmButtonText: "Entendido"
                        });
                    }

                    return isValid;
                }

                // Función para mostrar errores
                function showError(field, message) {
                    field.classList.add("is-invalid");
                    
                    // Remover mensaje de error previo
                    let existingError = field.parentNode.querySelector('.invalid-feedback');
                    if (existingError) {
                        existingError.remove();
                    }
                    
                    // Crear nuevo mensaje de error
                    let errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = message;
                    errorMessage.style.display = 'block';
                    
                    field.parentNode.appendChild(errorMessage);
                }

                // Función para limpiar errores
                function clearErrors() {
                    const invalidFields = document.querySelectorAll('.is-invalid');
                    invalidFields.forEach(field => {
                        field.classList.remove('is-invalid');
                        const errorMsg = field.parentNode.querySelector('.invalid-feedback');
                        if (errorMsg) errorMsg.remove();
                    });
                }

                // Función para validar email
                function isValidEmail(email) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }

                // Botón limpiar formulario
                const resetButton = form.querySelector('button[type="reset"]');
                if (resetButton) {
                    resetButton.addEventListener("click", function() {
                        Swal.fire({
                            title: "¿Limpiar formulario?",
                            text: "Se perderán todos los datos ingresados.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí, limpiar",
                            cancelButtonText: "Cancelar",
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.reset();
                                clearErrors();
                                // Restablecer el estado de denuncia anónima
                                if (esAnonimaCheckbox) {
                                    esAnonimaCheckbox.checked = true;
                                    toggleContactoFields();
                                }
                                // Limpiar campos dinámicos (dejar solo uno de cada tipo)
                                involucradosContainer.innerHTML = `
                                    <div class="involucrado-group card card-flush bg-light-primary mb-6">
                                        <div class="card-header">
                                            <h5 class="card-title text-primary">Involucrado #1</h5>
                                            <button type="button" class="btn btn-icon btn-light-danger remove-involucrado">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Nombre completo</label>
                                                        <input type="text" class="form-control" name="involucrados[0][nombre_denunciado]" placeholder="Nombre del involucrado" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Puesto</label>
                                                        <input type="text" class="form-control" name="involucrados[0][puesto_denunciado]" placeholder="Puesto del involucrado" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-check form-check-custom form-check-solid mb-8">
                                                <input class="form-check-input" type="checkbox" name="involucrados[0][es_servidor_publico]" value="1" />
                                                <label class="form-check-label fw-semibold text-gray-700">
                                                    ¿Es servidor público?
                                                </label>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Sexo</label>
                                                        <select class="form-select" name="involucrados[0][sexo]">
                                                            <option value="">Seleccione...</option>
                                                            <option value="H">Hombre</option>
                                                            <option value="M">Mujer</option>
                                                            <option value="N/I">No identificado</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Tez</label>
                                                        <input type="text" class="form-control" name="involucrados[0][tez]" placeholder="Ej: Morena clara, Blanca, etc." />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Estatura aproximada (m)</label>
                                                        <input type="number" step="0.01" class="form-control" name="involucrados[0][estatura_aprox]" placeholder="Ej: 1.75" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Edad aproximada</label>
                                                        <input type="number" class="form-control" name="involucrados[0][edad_aprox]" placeholder="Edad aproximada" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Complexión</label>
                                                        <input type="text" class="form-control" name="involucrados[0][complexion]" placeholder="Ej: Delgada, Robusta, etc." />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Color de ojos</label>
                                                        <input type="text" class="form-control" name="involucrados[0][color_ojos]" placeholder="Ej: Cafés, Verdes, etc." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Tipo de cabello</label>
                                                        <input type="text" class="form-control" name="involucrados[0][tipo_cabello]" placeholder="Ej: Lacio, Rizado, Calvo, etc." />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Señas particulares</label>
                                                        <input type="text" class="form-control" name="involucrados[0][senas_particulares]" placeholder="Ej: Tatuajes, Cicatrices, etc." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Descripción física adicional</label>
                                                        <textarea class="form-control" name="involucrados[0][descripcion_fisica]" rows="3" placeholder="Describa cualquier característica física adicional del involucrado"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                
                                testigosContainer.innerHTML = `
                                    <div class="testigo-group card card-flush bg-light-success mb-6">
                                        <div class="card-header">
                                            <h5 class="card-title text-success">Testigo #1</h5>
                                            <button type="button" class="btn btn-icon btn-light-danger remove-testigo">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Nombre del testigo</label>
                                                        <input type="text" class="form-control" name="testigos[0][nombre_testigo]" placeholder="Nombre completo del testigo" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Datos de contacto</label>
                                                        <input type="text" class="form-control" name="testigos[0][datos_contacto]" placeholder="Teléfono, correo, etc." />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="fv-row mb-8">
                                                        <label class="form-label fs-6 fw-bold text-gray-700">Observaciones</label>
                                                        <textarea class="form-control" name="testigos[0][observaciones]" rows="3" placeholder="Observaciones adicionales sobre el testigo"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                
                                // Reset counters
                                involucradoCount = 1;
                                testigoCount = 1;
                                
                                Swal.fire({
                                    icon: "success",
                                    title: "Formulario limpiado",
                                    text: "Todos los campos han sido restablecidos.",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    });
                }
            });
        </script>
    @endsection
</x-auth-layout>