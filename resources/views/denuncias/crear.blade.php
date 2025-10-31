<x-auth-layout>
    @section('content')
        <link rel="stylesheet" href="/assets/css/botonesGob.css">

        <body id="kt_body" class="app-blank">
            <!--begin::Root-->
            <div class="d-flex flex-column flex-root" id="kt_app_root">
                <!--begin::Authentication - Multi-steps-->
                <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column stepper-multistep"
                    id="kt_denuncia_stepper">
                    <!--begin::Aside-->
                    <div class="d-flex flex-column flex-lg-row-auto w-lg-350px w-xl-500px">
                        <div class="d-flex flex-column position-lg-fixed top-0 bottom-0 w-lg-350px w-xl-500px scroll-y bgi-size-cover bgi-position-center"
                            style="background-image: url(/assets/media/auth/bg15.png)">
                            <!--begin::Header-->
                            <div class="d-flex flex-center py-1 py-lg-5 mt-lg-5">
                                <!--begin::Logo-->
                                <a href="#">
                                    <img alt="Logo" src="/assets/media/auth/secoem_blanco.svg" class="h-90px">
                                </a>
                                <!--end::Logo-->
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="d-flex flex-row-fluid justify-content-center p-10">
                                <!--begin::Nav-->
                                <div class="stepper-nav">
                                    <!--begin::Step 1-->
                                    <div class="stepper-item current" data-step="1">
                                        <!--begin::Wrapper-->
                                        <div class="stepper-wrapper">
                                            <!--begin::Icon-->
                                            <div class="stepper-icon rounded-3">
                                                <span class="stepper-number">1</span>
                                            </div>
                                            <!--end::Icon-->

                                            <!--begin::Label-->
                                            <div class="stepper-label">
                                                <h3 class="stepper-title fs-2">
                                                    Datos del Denunciante
                                                </h3>

                                                <div class="stepper-desc fw-normal">
                                                    Información personal o anónima
                                                </div>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Wrapper-->

                                        <!--begin::Line-->
                                        <div class="stepper-line h-40px"></div>
                                        <!--end::Line-->
                                    </div>
                                    <!--end::Step 1-->

                                    <!--begin::Step 2-->
                                    <div class="stepper-item" data-step="2">
                                        <!--begin::Wrapper-->
                                        <div class="stepper-wrapper">
                                            <!--begin::Icon-->
                                            <div class="stepper-icon rounded-3">
                                                <span class="stepper-number">2</span>
                                            </div>
                                            <!--end::Icon-->

                                            <!--begin::Label-->
                                            <div class="stepper-label">
                                                <h3 class="stepper-title fs-2">
                                                    Hechos Denunciados
                                                </h3>
                                                <div class="stepper-desc fw-normal">
                                                    Detalles de los hechos ocurridos
                                                </div>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Wrapper-->

                                        <!--begin::Line-->
                                        <div class="stepper-line h-40px"></div>
                                        <!--end::Line-->
                                    </div>
                                    <!--end::Step 2-->

                                    <!--begin::Step 3-->
                                    <div class="stepper-item" data-step="3">
                                        <!--begin::Wrapper-->
                                        <div class="stepper-wrapper">
                                            <!--begin::Icon-->
                                            <div class="stepper-icon">
                                                <span class="stepper-number">3</span>
                                            </div>
                                            <!--end::Icon-->

                                            <!--begin::Label-->
                                            <div class="stepper-label">
                                                <h3 class="stepper-title fs-2">
                                                    Personas Involucradas
                                                </h3>
                                                <div class="stepper-desc fw-normal">
                                                    Involucrados y testigos
                                                </div>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Wrapper-->

                                        <!--begin::Line-->
                                        <div class="stepper-line h-40px"></div>
                                        <!--end::Line-->
                                    </div>
                                    <!--end::Step 3-->

                                    <!--begin::Step 4-->
                                    <div class="stepper-item" data-step="4">
                                        <!--begin::Wrapper-->
                                        <div class="stepper-wrapper">
                                            <!--begin::Icon-->
                                            <div class="stepper-icon">
                                                <span class="stepper-number">4</span>
                                            </div>
                                            <!--end::Icon-->

                                            <!--begin::Label-->
                                            <div class="stepper-label">
                                                <h3 class="stepper-title">
                                                    Evidencias
                                                </h3>
                                                <div class="stepper-desc fw-normal">
                                                    Archivos y documentación
                                                </div>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Wrapper-->

                                        <!--begin::Line-->
                                        <div class="stepper-line h-40px"></div>
                                        <!--end::Line-->
                                    </div>
                                    <!--end::Step 4-->

                                    <!--begin::Step 5-->
                                    <div class="stepper-item" data-step="5">
                                        <!--begin::Wrapper-->
                                        <div class="stepper-wrapper">
                                            <!--begin::Icon-->
                                            <div class="stepper-icon">
                                                <span class="stepper-number">5</span>
                                            </div>
                                            <!--end::Icon-->

                                            <!--begin::Label-->
                                            <div class="stepper-label">
                                                <h3 class="stepper-title">
                                                    Confirmación
                                                </h3>
                                                <div class="stepper-desc fw-normal">
                                                    Revisión y envío final
                                                </div>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Step 5-->
                                </div>
                                <!--end::Nav-->
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            {{-- <div class="d-flex flex-center flex-wrap px-5 py-10">
                                <!--begin::Links-->
                                <div class="d-flex fw-normal">
                                    <a href="#" class="text-success px-5" target="_blank">Términos</a>
                                    <a href="#" class="text-success px-5" target="_blank">Privacidad</a>
                                    <a href="#" class="text-success px-5" target="_blank">Ayuda</a>
                                </div>
                                <!--end::Links-->
                            </div> --}}
                            <!--end::Footer-->
                        </div>
                    </div>
                    <!--begin::Aside-->

                    <!--begin::Body-->
                    <div class="d-flex flex-column flex-lg-row-fluid py-10">
                        <!--begin::Content-->
                        <div class="d-flex flex-center flex-column flex-column-fluid">
                            <!--begin::Wrapper-->
                            <div class="w-lg-750px w-xl-900px p-10 p-lg-15 mx-auto">
                                <!--begin::Form-->
                                <form class="my-auto pb-5" novalidate="novalidate" id="kt_denuncia_form"
                                    action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!--begin::Step 1-->
                                    <div class="current step-content" data-step="1">
                                        <!--begin::Wrapper-->
                                        <div class="w-100">
                                            <!--begin::Heading-->
                                            <div class="pb-10 pb-lg-15">
                                                <!--begin::Title-->
                                                <h2 class="fw-bold d-flex align-items-center text-gray-900">
                                                    Datos del Denunciante
                                                </h2>
                                                <!--end::Title-->

                                                <!--begin::Notice-->
                                                <div class="text-muted fw-semibold fs-6">
                                                    Complete su información personal o realice una denuncia anónima
                                                </div>
                                                <!--end::Notice-->
                                            </div>
                                            <!--end::Heading-->

                                            <!--begin::Alert-->
                                            <div
                                                class="notice d-flex align-items-center rounded border border-dashed p-6 mb-10 bg-guinda-light border-guinda">

                                                <div class="d-flex flex-column">
                                                    <h4 class="mb-1 fw-bold text-guinda">Aviso importante</h4>
                                                    <div class="fs-6 text-gray-700">
                                                        Su colaboración contribuye al fortalecimiento de la integridad
                                                        institucional.
                                                        <span class='fw-bold text-guinda'>La información que proporcione
                                                            será tratada con estricta reserva</span>
                                                        y utilizada únicamente para el análisis y seguimiento de los hechos
                                                        reportados.
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Alert-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <div class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="es_anonima"
                                                        name="es_anonima" value="1"
                                                        {{ old('es_anonima', $denuncia->es_anonima ?? 0) == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-bold fs-6 text-gray-700"
                                                        for="es_anonima">
                                                        Realizar denuncia anónima
                                                    </label>
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <div id="contactoContainer"
                                                style="display: {{ old('es_anonima', 1) ? 'none' : 'block' }};">
                                                <!--begin::Input group-->
                                                <div class="row mb-10">
                                                    <div class="col-md-4 fv-row">
                                                        <label class="form-label required-label fs-6 fw-bold mb-3">Nombre
                                                            completo</label>
                                                        <input type="text"
                                                            class="form-control form-control-solid @error('nombre_completo') is-invalid @enderror"
                                                            name="nombre_completo" placeholder="Ingrese su nombre completo"
                                                            value="{{ old('nombre_completo') }}" />
                                                        @error('nombre_completo')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 fv-row">
                                                        <label
                                                            class="form-label required-label fs-6 fw-bold mb-3">Teléfono</label>
                                                        <input type="text"
                                                            class="form-control form-control-solid @error('telefono') is-invalid @enderror"
                                                            name="telefono" placeholder="Ingrese su número telefónico"
                                                            value="{{ old('telefono') }}" />
                                                        @error('telefono')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 fv-row">
                                                        <label class="form-label required-label fs-6 fw-bold mb-3">Correo
                                                            electrónico</label>
                                                        <input type="email"
                                                            class="form-control form-control-solid @error('correo_electronico') is-invalid @enderror"
                                                            name="correo_electronico"
                                                            placeholder="Ingrese su correo electrónico"
                                                            value="{{ old('correo_electronico') }}" />
                                                        @error('correo_electronico')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Step 1-->

                                    <!--begin::Step 2-->
                                    <div class="step-content" data-step="2" style="display: none;">
                                        <!--begin::Wrapper-->
                                        <div class="w-100">
                                            <!--begin::Heading-->
                                            <div class="pb-10 pb-lg-15">
                                                <!--begin::Title-->
                                                <h2 class="fw-bold text-gray-900">Hechos Denunciados</h2>
                                                <!--end::Title-->

                                                <!--begin::Notice-->
                                                <div class="text-muted fw-semibold fs-6">
                                                    Proporcione todos los detalles sobre los hechos que desea denunciar
                                                </div>
                                                <!--end::Notice-->
                                            </div>
                                            <!--end::Heading-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <label class="form-label required-label fs-6 fw-bold mb-3">Motivo de la
                                                    denuncia</label>
                                                <textarea class="form-control form-control-solid @error('motivo_denuncia') is-invalid @enderror"
                                                    name="motivo_denuncia" rows="3" placeholder="Describa el motivo principal de su denuncia" required>{{ old('motivo_denuncia') }}</textarea>
                                                @error('motivo_denuncia')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-10">
                                                <div class="col-md-4 fv-row">
                                                    <label class="form-label required-label fs-6 fw-bold mb-3">Fecha de los
                                                        hechos</label>
                                                    <input type="date"
                                                        class="form-control form-control-solid @error('fecha_hechos') is-invalid @enderror"
                                                        name="fecha_hechos" value="{{ old('fecha_hechos') }}" required />
                                                    @error('fecha_hechos')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 fv-row">
                                                    <label class="form-label fs-6 fw-bold mb-3">Hora de los hechos</label>
                                                    <input type="time" class="form-control form-control-solid"
                                                        name="hora_hechos" value="{{ old('hora_hechos') }}"
                                                        placeholder="HH:MM" />
                                                </div>
                                                <div class="col-md-4 fv-row">
                                                    <label class="form-label fs-6 fw-bold mb-3">Municipio</label>
                                                    <select class="form-select form-select-solid" name="id_municipio">
                                                        <option value="">Seleccione un municipio...</option>
                                                        @foreach ($municipios as $mun)
                                                            <option value="{{ $mun->id_municipio }}"
                                                                {{ old('id_municipio') == $mun->id_municipio ? 'selected' : '' }}>
                                                                {{ $mun->nombre_municipio }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-10">
                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label required-label fs-6 fw-bold mb-3">Dirección
                                                        exacta</label>
                                                    <input type="text"
                                                        class="form-control form-control-solid @error('direccion_exacta') is-invalid @enderror"
                                                        name="direccion_exacta"
                                                        placeholder="Dirección exacta donde ocurrieron los hechos"
                                                        value="{{ old('direccion_exacta') }}" required />
                                                    @error('direccion_exacta')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label fs-6 fw-bold mb-3">Localidad</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="localidad" placeholder="Localidad o colonia"
                                                        value="{{ old('localidad') }}" />
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row mb-10">
                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label fs-6 fw-bold mb-3">Dependencia
                                                        involucrada</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="dependencia_involucrada"
                                                        placeholder="Dependencia gubernamental involucrada"
                                                        value="{{ old('dependencia_involucrada') }}" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label fs-6 fw-bold mb-3">Trámite solicitado</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="tramite_solicitado"
                                                        placeholder="Trámite o servicio relacionado"
                                                        value="{{ old('tramite_solicitado') }}" />
                                                </div>


                                            </div>
                                            <div class="row mb-10">
                                                <div class="col-md-6 fv-row">
                                                    <input type="hidden" name="programa_publico" value="0">
                                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="programa_publico" name="programa_publico" value="1"
                                                            {{ old('programa_publico', 0) ? 'checked="checked"' : '' }}>
                                                        <label class="form-check-label fw-bold fs-6 text-gray-700"
                                                            for="programa_publico">
                                                            ¿Es un programa público?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label fs-6 fw-bold mb-3">Monto de dinero solicitado
                                                        (si aplica)</label>
                                                    <input type="number" step="0.01" min="0"
                                                        class="form-control form-control-solid @error('dinero_solicitado') is-invalid @enderror"
                                                        name="dinero_solicitado" placeholder="Ejemplo: 1500.00"
                                                        value="{{ old('dinero_solicitado') }}" />
                                                    @error('dinero_solicitado')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Campo dinámico: Nombre del programa público-->
                                            <div id="campo_programa" class="fv-row mb-10" style="display: none;">
                                                <label class="form-label required-label fs-6 fw-bold mb-3">Nombre del
                                                    programa público</label>
                                                <input type="text"
                                                    class="form-control form-control-solid @error('nombre_programa_publico') is-invalid @enderror"
                                                    name="nombre_programa_publico"
                                                    placeholder="Escriba el nombre del programa público"
                                                    value="{{ old('nombre_programa_publico') }}" />
                                                @error('nombre_programa_publico')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Campo dinámico-->

                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-0">
                                                <label class="form-label fs-6 fw-bold mb-3">Circunstancias
                                                    detalladas</label>
                                                <textarea class="form-control form-control-solid" name="circunstancias_detalladas" rows="4"
                                                    placeholder="Describa con el mayor detalle posible los hechos ocurridos, incluyendo personas involucradas, testigos, y cualquier información relevante">{{ old('circunstancias_detalladas') }}</textarea>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Step 2-->

                                    <!--begin::Step 3: Personas Involucradas -->
                                    <div class="step-content" data-step="3" style="display: none;">
                                        <div class="w-100">
                                            <!--begin::Heading-->
                                            <div class="pb-10 pb-lg-15">
                                                <!--begin::Title-->
                                                <h2 class="fw-bold text-gray-900">Personas Involucradas</h2>
                                                <!--end::Title-->

                                                <!--begin::Notice-->
                                                <div class="text-muted fw-semibold fs-6">
                                                    Agregue información sobre las personas involucradas y testigos de los
                                                    hechos
                                                </div>
                                                <!--end::Notice-->
                                            </div>
                                            <!--end::Heading-->

                                            <!-- Involucrados -->
                                            <div class="mb-15">
                                                <h4 class="fw-bold text-gray-700 mb-6">Involucrados</h4>
                                                <div id="involucrados-container">
                                                    @php
                                                        $oldInvolucrados = old('involucrados', [
                                                            [
                                                                'nombre_denunciado' => '',
                                                                'puesto_denunciado' => '',
                                                                'es_servidor_publico' => 0,
                                                                'sexo' => '',
                                                                'tez' => '',
                                                                'estatura_aprox' => '',
                                                                'edad_aprox' => '',
                                                                'complexion' => '',
                                                                'color_ojos' => '',
                                                                'tipo_cabello' => '',
                                                                'senas_particulares' => '',
                                                                'descripcion_fisica' => '',
                                                            ],
                                                        ]);
                                                    @endphp

                                                    @foreach ($oldInvolucrados as $index => $involucrado)
                                                        <div
                                                            class="involucrado-group card card-flush bg-light-default mb-6">
                                                            <div class="card-header">
                                                                <h5 class="card-title text-primary">Involucrado
                                                                    #{{ $index + 1 }}</h5>
                                                                @if ($index > 0)
                                                                    <button type="button"
                                                                        class="btn btn-icon btn-light-danger remove-involucrado">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Nombre
                                                                                completo</label>
                                                                            <input type="text" class="form-control"
                                                                                name="involucrados[{{ $index }}][nombre_denunciado]"
                                                                                placeholder="Nombre del involucrado"
                                                                                value="{{ $involucrado['nombre_denunciado'] ?? '' }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Puesto</label>
                                                                            <input type="text" class="form-control"
                                                                                name="involucrados[{{ $index }}][puesto_denunciado]"
                                                                                placeholder="Puesto del involucrado"
                                                                                value="{{ $involucrado['puesto_denunciado'] ?? '' }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="form-check form-check-custom form-check-solid mb-8">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="involucrados[{{ $index }}][es_servidor_publico]"
                                                                        value="1"
                                                                        {{ isset($involucrado['es_servidor_publico']) && $involucrado['es_servidor_publico'] ? 'checked' : '' }} />
                                                                    <label
                                                                        class="form-check-label fw-semibold text-gray-700">
                                                                        ¿Es servidor público?
                                                                    </label>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Sexo</label>
                                                                            <select class="form-select"
                                                                                name="involucrados[{{ $index }}][sexo]">
                                                                                <option value="">Seleccione...
                                                                                </option>
                                                                                <option value="H"
                                                                                    {{ ($involucrado['sexo'] ?? '') == 'H' ? 'selected' : '' }}>
                                                                                    Hombre</option>
                                                                                <option value="M"
                                                                                    {{ ($involucrado['sexo'] ?? '') == 'M' ? 'selected' : '' }}>
                                                                                    Mujer</option>
                                                                                <option value="N/I"
                                                                                    {{ ($involucrado['sexo'] ?? '') == 'N/I' ? 'selected' : '' }}>
                                                                                    No identificado</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Tez</label>
                                                                            <input type="text" class="form-control"
                                                                                name="involucrados[{{ $index }}][tez]"
                                                                                placeholder="Ej: Morena clara, Blanca, etc."
                                                                                value="{{ $involucrado['tez'] ?? '' }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Estatura
                                                                                aproximada (m)</label>
                                                                            <input type="number" step="0.01"
                                                                                class="form-control"
                                                                                name="involucrados[{{ $index }}][estatura_aprox]"
                                                                                placeholder="Ej: 1.75"
                                                                                value="{{ $involucrado['estatura_aprox'] ?? '' }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Edad
                                                                                aproximada</label>
                                                                            <input type="number" class="form-control"
                                                                                name="involucrados[{{ $index }}][edad_aprox]"
                                                                                placeholder="Edad aproximada"
                                                                                value="{{ $involucrado['edad_aprox'] ?? '' }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Complexión</label>
                                                                            <input type="text" class="form-control"
                                                                                name="involucrados[{{ $index }}][complexion]"
                                                                                placeholder="Ej: Delgada, Robusta, etc."
                                                                                value="{{ $involucrado['complexion'] ?? '' }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Color
                                                                                de ojos</label>
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
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Tipo
                                                                                de cabello</label>
                                                                            <input type="text" class="form-control"
                                                                                name="involucrados[{{ $index }}][tipo_cabello]"
                                                                                placeholder="Ej: Lacio, Rizado, Calvo, etc."
                                                                                value="{{ $involucrado['tipo_cabello'] ?? '' }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Señas
                                                                                particulares</label>
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
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Descripción
                                                                                física adicional</label>
                                                                            <textarea class="form-control" name="involucrados[{{ $index }}][descripcion_fisica]" rows="3"
                                                                                placeholder="Describa cualquier característica física adicional del involucrado">{{ $involucrado['descripcion_fisica'] ?? '' }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-light-guinda" id="add-involucrado">
                                                    <i class="fas fa-plus me-2"></i>Agregar otro involucrado
                                                </button>
                                            </div>

                                            <!-- Testigos -->
                                            <div class="mb-15">
                                                <h4 class="fw-bold text-gray-700 mb-6">Testigos</h4>
                                                <div id="testigos-container">
                                                    @php
                                                        $oldTestigos = old('testigos', [
                                                            [
                                                                'nombre_testigo' => '',
                                                                'datos_contacto' => '',
                                                                'observaciones' => '',
                                                            ],
                                                        ]);
                                                    @endphp

                                                    @foreach ($oldTestigos as $index => $testigo)
                                                        <div class="testigo-group card card-flush bg-light-default mb-6">
                                                            <div class="card-header">
                                                                <h5 class="card-title text-success">Testigo
                                                                    #{{ $index + 1 }}</h5>
                                                                @if ($index > 0)
                                                                    <button type="button"
                                                                        class="btn btn-icon btn-light-danger remove-testigo">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Nombre
                                                                                del testigo</label>
                                                                            <input type="text" class="form-control"
                                                                                name="testigos[{{ $index }}][nombre_testigo]"
                                                                                placeholder="Nombre completo del testigo"
                                                                                value="{{ $testigo['nombre_testigo'] ?? '' }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="fv-row mb-8">
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Datos
                                                                                de contacto</label>
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
                                                                            <label
                                                                                class="form-label fs-6 fw-bold text-gray-700">Observaciones</label>
                                                                            <textarea class="form-control" name="testigos[{{ $index }}][observaciones]" rows="3"
                                                                                placeholder="Observaciones adicionales sobre el testigo">{{ $testigo['observaciones'] ?? '' }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-light-guinda" id="add-testigo">
                                                    <i class="fas fa-plus me-2"></i>Agregar otro testigo
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Step 3-->

                                    <!--begin::Step 4: Evidencias -->
                                    <div class="step-content" data-step="4" style="display: none;">
                                        <div class="w-100">
                                            <!--begin::Heading-->
                                            <div class="pb-10 pb-lg-15">
                                                <!--begin::Title-->
                                                <h2 class="fw-bold text-gray-900">Evidencias y Archivos</h2>
                                                <!--end::Title-->

                                                <!--begin::Notice-->
                                                <div class="text-muted fw-semibold fs-6">
                                                    Adjunte cualquier evidencia que respalde su denuncia
                                                </div>
                                                <!--end::Notice-->
                                            </div>
                                            <!--end::Heading-->

                                            <div class="fv-row mb-8">
                                                <label class="form-label fs-6 fw-bold text-gray-700">Adjuntar
                                                    archivos</label>
                                                <input type="file" name="archivos[]"
                                                    class="form-control form-control-solid" multiple
                                                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.mp4,.avi,.mov" />
                                                <div class="text-muted mt-2 fs-7">
                                                    <i class="fas fa-info-circle text-info me-2"></i>
                                                    Formatos permitidos: PDF, JPG, PNG, DOC, DOCX, MP4, AVI, MOV. Tamaño
                                                    máximo por archivo: 10MB.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Step 4-->

                                    <!--begin::Step 5: Confirmación -->
                                    <div class="step-content" data-step="5" style="display: none;">
                                        <div class="w-100">
                                            <!--begin::Heading-->
                                            <div class="pb-10 pb-lg-15">
                                                <!--begin::Title-->
                                                <h2 class="fw-bold text-gray-900">Confirmación Final</h2>
                                                <!--end::Title-->

                                                <!--begin::Notice-->
                                                <div class="text-muted fw-semibold fs-6">
                                                    Revise y confirme la información antes de enviar su denuncia
                                                </div>
                                                <!--end::Notice-->
                                            </div>
                                            <!--end::Heading-->

                                            <!--begin::Security Notice-->
                                            <div
                                                class="notice d-flex align-items-center rounded border border-dashed p-6 mb-10 bg-guinda-light border-guinda">


                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <!--begin::Content-->
                                                    <div class="fw-semibold">
                                                        <div class="fs-6 text-gray-700">
                                                            <strong class="text-guinda">PROTECCIÓN DE SU DENUNCIA -
                                                                ATENCIÓN
                                                                IMPORTANTE</strong><br>
                                                            Establezca una contraseña de seguridad para proteger el acceso a
                                                            la información completa de su denuncia.
                                                            <span class="text-danger fw-bold">ESTA CONTRASEÑA NO PODRÁ SER
                                                                RECUPERADA NI MODIFICADA</span> una vez enviada la denuncia.
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Security Notice-->

                                            <!--begin::Security Fields-->
                                            <div class="row mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="form-label required-label fs-6 fw-bold mb-3">
                                                        Contraseña de Seguridad
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <div class="position-relative">
                                                        <input type="password"
                                                            class="form-control form-control-solid @error('contrasena_seguridad') is-invalid @enderror"
                                                            name="contrasena_seguridad" id="contrasena_seguridad"
                                                            placeholder="Ingrese una contraseña segura"
                                                            value="{{ old('contrasena_seguridad') }}" minlength="6"
                                                            required />
                                                        <span
                                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                            onclick="togglePasswordVisibility('contrasena_seguridad', this)">
                                                            <i class="ki-duotone ki-eye-slash fs-2"></i>
                                                            <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                                        </span>
                                                    </div>
                                                    <!--end::Input-->

                                                    <!--begin::Hint-->
                                                    <div class="text-muted fs-7 mt-1">
                                                        Mínimo 6 caracteres. Esta contraseña le permitirá acceder a la
                                                        información completa de su denuncia.
                                                    </div>
                                                    <!--end::Hint-->

                                                    @error('contrasena_seguridad')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="form-label required-label fs-6 fw-bold mb-3">
                                                        Confirmar Contraseña
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <div class="position-relative">
                                                        <input type="password"
                                                            class="form-control form-control-solid @error('confirmar_contrasena') is-invalid @enderror"
                                                            name="confirmar_contrasena" id="confirmar_contrasena"
                                                            placeholder="Confirme su contraseña"
                                                            value="{{ old('confirmar_contrasena') }}" minlength="6"
                                                            required />
                                                        <span
                                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                            onclick="togglePasswordVisibility('confirmar_contrasena', this)">
                                                            <i class="ki-duotone ki-eye-slash fs-2"></i>
                                                            <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                                        </span>
                                                    </div>
                                                    <!--end::Input-->

                                                    <!--begin::Hint-->
                                                    <div class="text-muted fs-7 mt-1">
                                                        Repita la contraseña para verificar que sea correcta.
                                                    </div>
                                                    <!--end::Hint-->

                                                    <!--begin::Validation Message-->
                                                    <div id="password-match-error" class="text-danger fs-7 mt-1 d-none">
                                                        <i class="ki-duotone ki-cross-circle fs-4 text-danger me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        Las contraseñas no coinciden
                                                    </div>
                                                    <div id="password-match-success"
                                                        class="text-success fs-7 mt-1 d-none">
                                                        <i class="ki-duotone ki-check-circle fs-4 text-success me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        Las contraseñas coinciden
                                                    </div>
                                                    <!--end::Validation Message-->

                                                    @error('confirmar_contrasena')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end::Security Fields-->

                                            <!--begin::Password Strength Meter-->
                                            <div class="mb-10" id="password-strength-meter">
                                                <!--begin::Meter-->
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"
                                                        id="strength-bar-1"></div>
                                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"
                                                        id="strength-bar-2"></div>
                                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"
                                                        id="strength-bar-3"></div>
                                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"
                                                        id="strength-bar-4"></div>
                                                </div>
                                                <!--end::Meter-->

                                                <!--begin::Hint-->
                                                <div class="text-muted fs-7" id="password-hint">
                                                    La contraseña debe contener al menos 6 caracteres entre letras, números
                                                    y símbolos.
                                                </div>
                                                <!--end::Hint-->
                                            </div>
                                            <!--end::Password Strength Meter-->

                                            <!--begin::Irreversible Warning-->
                                            <div
                                                class="notice d-flex align-items-center rounded border border-dashed p-6 mb-10 bg-guinda-light border-guinda">
                                                <!--begin::Icon-->

                                                <!--end::Icon-->

                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                    <!--begin::Title-->
                                                    <h4 class="fw-bold text-danger">CONTRASEÑA IRREVERSIBLE</h4>
                                                    <!--end::Title-->

                                                    <!--begin::Content-->
                                                    <span class="text-gray-700 fw-semibold fs-6">
                                                        Por razones de seguridad, <strong class="text-danger">NO PODRÁ
                                                            RECUPERAR NI CAMBIAR ESTA CONTRASEÑA</strong> una vez enviada la
                                                        denuncia.
                                                        Le recomendamos guardarla en un lugar seguro. Sin esta contraseña no
                                                        podrá acceder a la información completa de su denuncia.
                                                    </span>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Irreversible Warning-->

                                            <!--begin::Confirmation Checkbox-->
                                            <div class="fv-row mb-8">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input
                                                        class="form-check-input @error('confirmacion_datos') is-invalid @enderror"
                                                        type="checkbox" id="confirmacion_datos" name="confirmacion_datos"
                                                        value="1" {{ old('confirmacion_datos') ? 'checked' : '' }}
                                                        required />
                                                    <label class="form-check-label fw-semibold fs-6 text-gray-700"
                                                        for="confirmacion_datos">
                                                        Confirmo bajo protesta de decir verdad que toda la información
                                                        proporcionada es verídica, exacta y completa.
                                                        Acepto los términos y condiciones del sistema de denuncias y
                                                        comprendo que proporcionar información falsa
                                                        puede tener consecuencias legales.
                                                    </label>
                                                    @error('confirmacion_datos')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end::Confirmation Checkbox-->
                                        </div>
                                    </div>
                                    <!--end::Step 5-->

                                    <!--begin::Actions-->
                                    <div class="d-flex flex-stack pt-15">
                                        <div class="mr-2">
                                            <button type="button" class="btn btn-lg btn-light-guinda me-3"
                                                id="prev-btn">
                                                ‹ Anterior
                                            </button>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-lg btn-guinda" id="submit-btn"
                                                style="display: none;">
                                                Enviar Denuncia
                                            </button>

                                            <button type="button" class="btn btn-lg btn-guinda" id="next-btn">
                                                Siguiente ›
                                            </button>
                                        </div>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Authentication - Multi-steps-->
            </div>
            <!--end::Root-->

            <!-- Scripts simplificados para evitar dependencias externas -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let currentStep = 1;
                    const totalSteps = 5;
                    let involucradoCount = {{ count(old('involucrados', [0])) }};
                    let testigoCount = {{ count(old('testigos', [0])) }};

                    // Inicializar navegación
                    function updateNavigation() {
                        // Mostrar/ocultar botones
                        document.getElementById('prev-btn').style.display = currentStep > 1 ? 'block' : 'none';
                        document.getElementById('next-btn').style.display = currentStep < totalSteps ? 'block' : 'none';
                        document.getElementById('submit-btn').style.display = currentStep === totalSteps ? 'block' : 'none';

                        // Actualizar stepper visual
                        updateStepperVisual();
                    }

                    function updateStepperVisual() {
                        // Remover clase current de todos los items
                        document.querySelectorAll('.stepper-item').forEach(item => {
                            item.classList.remove('current');
                        });

                        // Agregar clase current al step actual
                        const currentStepperItem = document.querySelector(`.stepper-item[data-step="${currentStep}"]`);
                        if (currentStepperItem) {
                            currentStepperItem.classList.add('current');
                        }

                        // Mostrar solo el contenido del step actual
                        document.querySelectorAll('.step-content').forEach(content => {
                            content.style.display = 'none';
                        });
                        const currentContent = document.querySelector(`.step-content[data-step="${currentStep}"]`);
                        if (currentContent) {
                            currentContent.style.display = 'block';
                        }
                    }

                    // Event listeners para botones
                    document.getElementById('next-btn').addEventListener('click', function() {
                        if (validateStep(currentStep)) {
                            if (currentStep < totalSteps) {
                                currentStep++;
                                updateNavigation();
                            }
                        }
                    });

                    document.getElementById('prev-btn').addEventListener('click', function() {
                        if (currentStep > 1) {
                            currentStep--;
                            updateNavigation();
                        }
                    });

                    // Validación de steps
                    function validateStep(step) {
                        let isValid = true;

                        switch (step) {
                            case 1:
                                // Validar datos de contacto si no es anónima
                                const esAnonima = document.getElementById('es_anonima').checked;
                                if (!esAnonima) {
                                    const nombre = document.querySelector('[name="nombre_completo"]');
                                    const telefono = document.querySelector('[name="telefono"]');
                                    const email = document.querySelector('[name="correo_electronico"]');

                                    if (!nombre.value.trim()) {
                                        showError(nombre, 'Nombre completo es requerido');
                                        isValid = false;
                                    }
                                    if (!telefono.value.trim()) {
                                        showError(telefono, 'Teléfono es requerido');
                                        isValid = false;
                                    }
                                    if (!email.value.trim() || !isValidEmail(email.value)) {
                                        showError(email, 'Correo electrónico válido es requerido');
                                        isValid = false;
                                    }
                                }
                                break;

                            case 2:
                                // Validar campos requeridos del paso 2
                                const camposRequeridos = [{
                                        field: document.querySelector('[name="motivo_denuncia"]'),
                                        name: "Motivo de la denuncia"
                                    },
                                    {
                                        field: document.querySelector('[name="fecha_hechos"]'),
                                        name: "Fecha de los hechos"
                                    },
                                    {
                                        field: document.querySelector('[name="direccion_exacta"]'),
                                        name: "Dirección exacta"
                                    }
                                ];

                                camposRequeridos.forEach(campo => {
                                    if (!campo.field.value.trim()) {
                                        showError(campo.field, `${campo.name} es requerido`);
                                        isValid = false;
                                    }
                                });
                                break;

                            case 5:
                                // Validar confirmación
                                const confirmacion = document.getElementById('confirmacion_datos');
                                if (!confirmacion.checked) {
                                    showError(confirmacion, 'Debe confirmar que la información es verídica');
                                    isValid = false;
                                }
                                break;
                        }

                        if (!isValid) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Campos requeridos',
                                text: 'Por favor complete todos los campos obligatorios',
                                confirmButtonText: 'Entendido'
                            });
                        }

                        return isValid;
                    }

                    function showError(field, message) {
                        field.classList.add("is-invalid");

                        let existingError = field.parentNode.querySelector('.invalid-feedback');
                        if (existingError) {
                            existingError.remove();
                        }

                        let errorMessage = document.createElement('div');
                        errorMessage.className = 'invalid-feedback';
                        errorMessage.textContent = message;
                        errorMessage.style.display = 'block';

                        field.parentNode.appendChild(errorMessage);
                    }

                    function isValidEmail(email) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        return emailRegex.test(email);
                    }

                    // Toggle para denuncia anónima (código existente)
                    const esAnonimaCheckbox = document.getElementById("es_anonima");
                    const contactoContainer = document.getElementById("contactoContainer");

                    if (esAnonimaCheckbox && contactoContainer) {
                        function toggleContactoFields() {
                            if (esAnonimaCheckbox.checked) {
                                contactoContainer.style.display = "none";
                            } else {
                                contactoContainer.style.display = "block";
                            }
                        }

                        toggleContactoFields();
                        esAnonimaCheckbox.addEventListener("change", toggleContactoFields);
                    }

                    // Funcionalidad para campos dinámicos de involucrados
                    const addInvolucradoBtn = document.getElementById('add-involucrado');
                    const involucradosContainer = document.getElementById('involucrados-container');

                    if (addInvolucradoBtn && involucradosContainer) {
                        addInvolucradoBtn.addEventListener('click', function() {
                            involucradoCount++;
                            const newInvolucrado = document.createElement('div');
                            newInvolucrado.className = 'involucrado-group card card-flush bg-light-default mb-6';
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
                                                <input type="number"
                                                    step="0.01"
                                                    min="1.00"
                                                    max="2.50"
                                                    class="form-control estatura-aprox"
                                                    name="involucrados[${involucradoCount-1}][estatura_aprox]"
                                                    placeholder="Ej: 1.75"
                                                />
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
                                if (involucradoGroup && involucradosContainer.querySelectorAll('.involucrado-group')
                                    .length > 1) {
                                    involucradoGroup.remove();
                                    // Actualizar números de secuencia
                                    updateInvolucradoNumbers();
                                }
                            }
                        });
                    }

                    // Funcionalidad para campos dinámicos de testigos
                    const addTestigoBtn = document.getElementById('add-testigo');
                    const testigosContainer = document.getElementById('testigos-container');

                    if (addTestigoBtn && testigosContainer) {
                        addTestigoBtn.addEventListener('click', function() {
                            testigoCount++;
                            const newTestigo = document.createElement('div');
                            newTestigo.className = 'testigo-group card card-flush bg-light-default mb-6';
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
                                if (testigoGroup && testigosContainer.querySelectorAll('.testigo-group').length >
                                    1) {
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

                    // Inicializar navegación
                    updateNavigation();
                });
            </script>

            <script>
                // Función para mostrar/ocultar contraseña
                function togglePasswordVisibility(inputId, element) {
                    const input = document.getElementById(inputId);
                    const eyeIcon = element.querySelector('.ki-eye-slash');
                    const eyeSlashIcon = element.querySelector('.ki-eye');

                    if (input.type === 'password') {
                        input.type = 'text';
                        eyeIcon.classList.add('d-none');
                        eyeSlashIcon.classList.remove('d-none');
                    } else {
                        input.type = 'password';
                        eyeIcon.classList.remove('d-none');
                        eyeSlashIcon.classList.add('d-none');
                    }
                }

                // Validación de coincidencia de contraseñas
                function validatePasswordMatch() {
                    const password = document.getElementById('contrasena_seguridad');
                    const confirmPassword = document.getElementById('confirmar_contrasena');
                    const errorElement = document.getElementById('password-match-error');
                    const successElement = document.getElementById('password-match-success');

                    if (password.value && confirmPassword.value) {
                        if (password.value !== confirmPassword.value) {
                            errorElement.classList.remove('d-none');
                            successElement.classList.add('d-none');
                            confirmPassword.classList.add('is-invalid');
                            confirmPassword.classList.remove('is-valid');
                            return false;
                        } else {
                            errorElement.classList.add('d-none');
                            successElement.classList.remove('d-none');
                            confirmPassword.classList.remove('is-invalid');
                            confirmPassword.classList.add('is-valid');
                            return true;
                        }
                    }
                    return null;
                }

                // Medidor de fortaleza de contraseña
                function checkPasswordStrength(password) {
                    let strength = 0;
                    const bars = [
                        document.getElementById('strength-bar-1'),
                        document.getElementById('strength-bar-2'),
                        document.getElementById('strength-bar-3'),
                        document.getElementById('strength-bar-4')
                    ];
                    const hint = document.getElementById('password-hint');

                    // Reset bars
                    bars.forEach(bar => {
                        bar.classList.remove('bg-success', 'bg-warning', 'bg-danger');
                        bar.classList.add('bg-secondary');
                    });

                    if (!password) {
                        hint.textContent = "La contraseña debe contener al menos 6 caracteres entre letras, números y símbolos.";
                        return;
                    }

                    // Longitud mínima
                    if (password.length >= 6) strength++;
                    // Contiene números
                    if (/\d/.test(password)) strength++;
                    // Contiene letras minúsculas y mayúsculas
                    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
                    // Contiene caracteres especiales
                    if (/[^a-zA-Z0-9]/.test(password)) strength++;

                    // Actualizar barras y mensaje
                    bars.forEach((bar, index) => {
                        if (index < strength) {
                            bar.classList.remove('bg-secondary');
                            if (strength <= 2) {
                                bar.classList.add('bg-danger');
                            } else if (strength === 3) {
                                bar.classList.add('bg-warning');
                            } else {
                                bar.classList.add('bg-success');
                            }
                        }
                    });

                    // Actualizar mensaje
                    switch (strength) {
                        case 0:
                        case 1:
                            hint.textContent = "Contraseña débil - agregue más caracteres y variedad";
                            hint.className = "text-danger fs-7";
                            break;
                        case 2:
                            hint.textContent = "Contraseña moderada - puede mejorar";
                            hint.className = "text-warning fs-7";
                            break;
                        case 3:
                            hint.textContent = "Contraseña buena";
                            hint.className = "text-info fs-7";
                            break;
                        case 4:
                            hint.textContent = "Contraseña fuerte";
                            hint.className = "text-success fs-7";
                            break;
                    }
                }

                // Event listeners cuando el DOM esté listo
                document.addEventListener('DOMContentLoaded', function() {
                    const passwordInput = document.getElementById('contrasena_seguridad');
                    const confirmPasswordInput = document.getElementById('confirmar_contrasena');

                    if (passwordInput) {
                        passwordInput.addEventListener('input', function() {
                            checkPasswordStrength(this.value);
                            validatePasswordMatch();
                        });
                    }

                    if (confirmPasswordInput) {
                        confirmPasswordInput.addEventListener('input', validatePasswordMatch);
                    }

                    // Validar antes de enviar el formulario
                    const form = document.querySelector('form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            if (!validatePasswordMatch()) {
                                e.preventDefault();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Contraseñas no coinciden',
                                    text: 'Por favor, verifique que las contraseñas coincidan antes de enviar la denuncia.',
                                    confirmButtonText: 'Entendido',
                                    confirmButtonColor: '#3699FF'
                                });
                            }
                        });
                    }
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkboxPrograma = document.getElementById('programa_publico');
                    const campoPrograma = document.getElementById('campo_programa');

                    function toggleCampoPrograma() {
                        if (checkboxPrograma.checked) {
                            campoPrograma.style.display = 'block';
                        } else {
                            campoPrograma.style.display = 'none';
                        }
                    }

                    // Ejecutar al cargar y cuando cambie el switch
                    toggleCampoPrograma();
                    checkboxPrograma.addEventListener('change', toggleCampoPrograma);
                });
            </script>
            <script>
                document.addEventListener('input', function(e) {
                    if (e.target.classList.contains('estatura-aprox')) {
                        let valor = parseFloat(e.target.value);

                        // Si no es número, no hacemos nada
                        if (isNaN(valor)) return;

                        // Limitar entre 1.00 y 2.50
                        if (valor < 1) valor = 1.00;
                        if (valor > 2.5) valor = 2.50;

                        // Redondear a dos decimales
                        e.target.value = valor.toFixed(2);
                    }
                });
            </script>
        @endsection
</x-auth-layout>
