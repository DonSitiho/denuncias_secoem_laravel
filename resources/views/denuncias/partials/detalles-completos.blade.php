<!--begin::Información Confidencial-->
<div class="informacion-confidencial-content">
    <!--begin::Encabezado-->
    <div class="d-flex align-items-center mb-10">
        <!--begin::Icono-->
        <span class="svg-icon svg-icon-2hx h1-guinda me-4">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                    fill="currentColor" />
                <path opacity="0.3"
                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C13.3 16 13.3 16 13.3 16C13.3 16 13.2 15.9 13.2 15.9C13.2 15.9 13.1 15.8 13.1 15.8C12.7 15.4 12.1 15 10 15C8.9 15 8 15.9 8 17H12.7C12.9 16.7 13.1 16.3 13.3 16Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Icono-->

        <!--begin::Título-->
        <div class="flex-grow-1">
            <h1 class="h1-guinda fw-bolder fs-2qx mb-1">INFORMACIÓN CONFIDENCIAL DE DENUNCIA</h1>
            <span class="text-muted fw-semibold fs-6">Detalles completos protegidos por seguridad</span>
        </div>
        <!--end::Título-->

        <!--begin::Badge de Estado-->
        <div class="badge badge-lg badge-light-{{ $denuncia->es_anonima == 1 ? 'warning' : 'primary' }}">
            <i class="ki-duotone ki-{{ $denuncia->es_anonima == 1 ? 'shield-cross' : 'user-tick' }} fs-4 me-2"></i>
            {{ $denuncia->es_anonima == 1 ? 'ANÓNIMA' : 'CON IDENTIFICACIÓN' }}
        </div>
        <!--end::Badge de Estado-->
    </div>
    <!--end::Encabezado-->

    <!--begin::Sección de Folio-->
    <div class="card card-flush mb-10" style="background-color: #ffe3f0;">
        <div class="card-body py-8">
            <div class="text-center">
                <div class="text-gray-600 fw-semibold fs-5 mb-2">NÚMERO DE FOLIO DE SEGUIMIENTO</div>
                <div class=" fw-bolder fs-1" style="color: #6A0F49;">{{ $denuncia->folio_seguimiento }}</div>
                <div class="text-gray-500 fs-6 mt-2">
                    <i class="ki-duotone ki-magnifier fs-4 me-1"></i>
                    Utilice este folio para consultar el estado de su denuncia
                </div>
            </div>
        </div>
    </div>
    <!--end::Sección de Folio-->

    <!--begin::Layout de 2 columnas-->
    <div class="row g-10 mb-10">
        <!--begin::Fila 1: Información General-->
        <div class="col-12">
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Información General</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Datos básicos del registro</span>
                    </h3>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-4">
                    <!--begin::Grid para información general-->
                    <div class="row g-5">
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <span class="text-gray-600 fw-semibold mb-2">Folio de seguimiento:</span>
                                <span class="text-gray-800 fw-bold fs-5">{{ $denuncia->folio_seguimiento }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <span class="text-gray-600 fw-semibold mb-2">Fecha de registro:</span>
                                <span
                                    class="text-gray-800 fw-bold fs-5">{{ $denuncia->fecha_recepcion->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <span class="text-gray-600 fw-semibold mb-2">Tipo de denuncia:</span>
                                <span class="badge badge-lg badge-{{ $denuncia->es_anonima == 1 ? 'warning' : 'primary' }}">
                                    {{ $denuncia->es_anonima == 1 ? 'ANÓNIMA' : 'CON IDENTIFICACIÓN' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--end::Grid para información general-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Fila 1: Información General-->

        <!--begin::Fila 2: Datos del Denunciante-->
        @if ($datosContactoDenunciante && $denuncia->es_anonima == 0)
            <div class="col-12">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Datos del Denunciante</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">Información de contacto</span>
                        </h3>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-4">
                        <!--begin::Grid para datos del denunciante-->
                        <div class="row g-5">
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <span class="text-gray-600 fw-semibold mb-2">Nombre completo:</span>
                                    <span
                                        class="text-gray-800 fw-bold fs-5">{{ $datosContactoDenunciante->nombre_completo }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <span class="text-gray-600 fw-semibold mb-2">Teléfono:</span>
                                    <span
                                        class="text-gray-800 fw-bold fs-5">{{ $datosContactoDenunciante->telefono }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column">
                                    <span class="text-gray-600 fw-semibold mb-2">Correo electrónico:</span>
                                    <span
                                        class="text-gray-800 fw-bold fs-5">{{ $datosContactoDenunciante->correo_electronico }}</span>
                                </div>
                            </div>
                        </div>
                        <!--end::Grid para datos del denunciante-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        @elseif ($denuncia->es_anonima == 1)
            <div class="col-12">
                <div class="card card-flush bg-light">
                    <div class="card-body text-center py-10">
                        <i class="ki-duotone ki-shield-cross fs-2hx text-warning mb-4"></i>
                        <h4 class="text-gray-900 mb-3">Denuncia Anónima</h4>
                        <p class="text-gray-600">
                            Esta denuncia fue registrada de forma anónima. No se cuenta con información de contacto del
                            denunciante.
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <!--end::Fila 2: Datos del Denunciante-->

        <!--begin::Fila 3: Hechos Denunciados-->
        <div class="col-12">
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header pt-7">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Hechos Denunciados</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Circunstancias del caso</span>
                    </h3>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-4">
                    <!--begin::Motivo-->
                    <div class="mb-8">
                        <label class="form-label fw-semibold text-gray-600">Motivo de la denuncia</label>
                        <div class="bg-light rounded p-5">
                            <p class="text-gray-800 fs-6 mb-0">{{ $denuncia->motivo_denuncia }}</p>
                        </div>
                    </div>
                    <!--end::Motivo-->

                    <!--begin::Grid de información-->
                    <div class="row g-5 mb-8">
                        <div class="col-sm-6 col-md-3">
                            <label class="form-label fw-semibold text-gray-600">Fecha de los hechos</label>
                            <div class="text-gray-800 fw-bold">
                                {{ \Carbon\Carbon::parse($denuncia->fecha_hechos)->format('d/m/Y') }}</div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <label class="form-label fw-semibold text-gray-600">Hora de los hechos</label>
                            <div class="text-gray-800 fw-bold">
                                {{ $datosCircunstancia->hora_hechos ?? 'No especificada' }}</div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <label class="form-label fw-semibold text-gray-600">Municipio</label>
                            <div class="text-gray-800 fw-bold">
                                {{ $datosMunicipio->nombre_municipio ?? 'No especificado' }}</div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <label class="form-label fw-semibold text-gray-600">Localidad</label>
                            <div class="text-gray-800 fw-bold">
                                {{ $datosCircunstancia->localidad ?? 'No especificada' }}</div>
                        </div>
                    </div>

                    <div class="row g-10 mb-10">
                        <!--begin::Fila 1: Información General-->

                        <!--end::Fila 1: Información General-->




                    </div>





                    @if ($datosCircunstancia->circunstancias_detalladas)
                        <div class="row g-5 mb-0">
                            <div class="col-12">
                                <label class="form-label fw-semibold text-gray-600">Circunstancias detalladas</label>
                                <div class="bg-light rounded p-5">
                                    <p class="text-gray-800 fs-6 mb-0">
                                        {{ $datosCircunstancia->circunstancias_detalladas }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--end::Grid de información-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Fila 3: Hechos Denunciados-->
    </div>
    <!--end::Layout de 2 columnas-->

    <!--begin::Personas Involucradas-->
    @if ($datosDenunciaInvolucrado && $datosDenunciaInvolucrado->count() > 0)
        <div class="card card-flush mb-10">
            <!--begin::Card header-->
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Personas Involucradas</span>
                    <span class="text-gray-500 mt-1 fw-semibold fs-6">Involucrados y testigos del caso</span>
                </h3>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-4">
                <!--begin::Involucrados-->
                <div class="mb-10">
                    <h4 class="text-gray-900 mb-6">Involucrados Principales</h4>
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="min-w-150px">Nombre</th>
                                    <th class="min-w-120px">Puesto</th>
                                    <th class="min-w-100px">Edad Aprox.</th>
                                    <th class="min-w-120px">Estatura</th>
                                    <th class="min-w-150px">Señas Particulares</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datosDenunciaInvolucrado as $involucrado)
                                    <tr>
                                        <td>
                                            <span
                                                class="text-gray-800 fw-bold">{{ $involucrado->nombre_denunciado ?? 'Sin nombre' }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-gray-600">{{ $involucrado->puesto_denunciado ?? 'Sin puesto' }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-gray-600">{{ $involucrado->edad_aprox ?? 'No especificada' }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-gray-600">{{ $involucrado->estatura_aprox ?? 'No especificada' }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-gray-600">{{ $involucrado->senas_particulares ?? 'No especificadas' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Involucrados-->

                <!--begin::Detalles Físicos-->
                <div class="mb-10">
                    <h4 class="text-gray-900 mb-6">Descripciones Físicas Detalladas</h4>
                    <div class="row g-6">
                        @foreach ($datosDenunciaInvolucrado as $involucrado)
                            <div class="col-xl-6">
                                <div class="card card-flush bg-light">
                                    <div class="card-header">
                                        <h5 class="card-title text-gray-800 fw-bold">
                                            {{ $involucrado->nombre_denunciado ?? 'Involucrado' }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <span class="text-gray-600 fw-semibold">Tipo de tez:</span>
                                                <span
                                                    class="text-gray-800">{{ $involucrado->tipo_tez ?? 'No especificado' }}</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="text-gray-600 fw-semibold">Complexión:</span>
                                                <span
                                                    class="text-gray-800">{{ $involucrado->complexion ?? 'No especificada' }}</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="text-gray-600 fw-semibold">Color de ojos:</span>
                                                <span
                                                    class="text-gray-800">{{ $involucrado->color_ojo ?? 'No especificado' }}</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="text-gray-600 fw-semibold">Tipo de cabello:</span>
                                                <span
                                                    class="text-gray-800">{{ $involucrado->tipo_cabello ?? 'No especificado' }}</span>
                                            </div>
                                            @if ($involucrado->descripcion_fisica)
                                                <div class="col-12">
                                                    <span class="text-gray-600 fw-semibold">Descripción
                                                        adicional:</span>
                                                    <p class="text-gray-800 mt-1">
                                                        {{ $involucrado->descripcion_fisica }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!--end::Detalles Físicos-->

                <!--begin::Testigos-->
                @if ($datosTestigos && $datosTestigos->count() > 0)
                    <div class="mb-0">
                        <h4 class="text-gray-900 mb-6">Testigos del Hecho</h4>
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="min-w-200px">Nombre del Testigo</th>
                                        <th class="min-w-150px">Datos de Contacto</th>
                                        <th class="min-w-250px">Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datosTestigos as $testigo)
                                        <tr>
                                            <td>
                                                <span
                                                    class="text-gray-800 fw-bold">{{ $testigo->nombre_testigo ?? 'Sin nombre' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-gray-600">{{ $testigo->datos_contacto ?? 'Sin datos de contacto' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-gray-600">{{ $testigo->observaciones ?? 'Sin observaciones' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                <!--end::Testigos-->
            </div>
            <!--end::Card body-->
        </div>
    @endif
    <!--end::Personas Involucradas-->

    <!--begin::Información de Seguimiento-->
    <div class="card card-flush bg-light-info">
        <div class="card-body p-8">
            <div class="d-flex align-items-center">
                <i class="ki-duotone ki-information-2 fs-2hx text-info me-4"></i>
                <div class="flex-grow-1">
                    <h4 class="text-gray-900 mb-2">Información de Contacto para Seguimiento</h4>
                    <p class="text-gray-700 mb-0">
                        Para cualquier consulta sobre el estado de su denuncia, puede contactarnos a través de:<br>
                        <strong>• Teléfono:</strong> [Número de contacto] •
                        <strong>• Correo electrónico:</strong> [correo@ejemplo.com] •
                        <strong>• Página web:</strong> [www.ejemplo.com]
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--end::Información de Seguimiento-->

    <!--begin::Aviso de Confidencialidad-->
    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mt-10">
        <i class="ki-duotone ki-shield-tick fs-2tx text-warning me-4"></i>
        <div class="d-flex flex-stack flex-grow-1">
            <div class="fw-semibold">
                <h4 class="text-gray-900 mb-1">Información Confidencial</h4>
                <div class="fs-6 text-gray-700">
                    Este documento contiene información confidencial protegida por la ley.
                    La divulgación no autorizada de esta información está prohibida.
                </div>
            </div>
        </div>
    </div>
    <!--end::Aviso de Confidencialidad-->
</div>
<!--end::Información Confidencial-->
