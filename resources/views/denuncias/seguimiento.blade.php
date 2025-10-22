<x-auth-layout>
    @section('content')
        <!--begin::Container-->
        <div class="container py-10">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <div class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Seguimiento de Denuncia</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">Consulte el estado de su denuncia</span>
                    </div>
                    <div class="card-toolbar">
                        <div class="badge badge-light-{{ $denuncia->estado_color }} fs-7 fw-bold p-4">
                            <i class="fas fa-circle text-{{ $denuncia->estado_color }} me-2 fs-8"></i>
                            {{ $denuncia->estado }}
                        </div>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Alert de folio-->
                    <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
                        <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                            <i class="fas fa-file-invoice fs-2x text-primary"></i>
                        </span>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-primary">Folio de Seguimiento: <strong>{{ $denuncia->folio }}</strong></h4>
                            <span class="fs-6">Utilice este folio para consultar el estado de su denuncia en cualquier momento.</span>
                        </div>
                    </div>
                    <!--end::Alert de folio-->

                    <!--begin::Sección 1: Información General -->
                    <div class="mb-15">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-8">
                            <span class="svg-icon svg-icon-primary svg-icon-2hx me-4">
                                <i class="fas fa-info-circle fs-2 text-primary"></i>
                            </span>
                            <h2 class="fw-bolder text-gray-800 mb-0">Información General</h2>
                        </div>
                        <!--end::Heading-->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Folio</label>
                                    <div class="form-control form-control-solid bg-light">{{ $denuncia->folio }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Fecha de Registro</label>
                                    <div class="form-control form-control-solid bg-light">
                                        {{ $denuncia->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Estado Actual</label>
                                    <div class="form-control form-control-solid bg-light-{{ $denuncia->estado_color }}">
                                        <span class="text-{{ $denuncia->estado_color }} fw-bold">
                                            <i class="fas fa-circle me-2 fs-8"></i>
                                            {{ $denuncia->estado }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Tipo de Denuncia</label>
                                    <div class="form-control form-control-solid bg-light">
                                        @if($denuncia->es_anonima)
                                            <span class="text-danger fw-bold">ANÓNIMA</span>
                                        @else
                                            <span class="text-success fw-bold">CON IDENTIFICACIÓN</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Última Actualización</label>
                                    <div class="form-control form-control-solid bg-light">
                                        {{ $denuncia->updated_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Sección 1-->

                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-10"></div>
                    <!--end::Separator-->

                    <!--begin::Sección 2: Datos del Denunciante -->
                    <div class="mb-15">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-8">
                            <span class="svg-icon svg-icon-primary svg-icon-2hx me-4">
                                <i class="fas fa-user fs-2 text-primary"></i>
                            </span>
                            <h2 class="fw-bolder text-gray-800 mb-0">Datos del Denunciante</h2>
                        </div>
                        <!--end::Heading-->

                        @if($denuncia->es_anonima)
                            <div class="alert alert-warning d-flex align-items-center p-5">
                                <span class="svg-icon svg-icon-2hx svg-icon-warning me-4">
                                    <i class="fas fa-user-secret fs-2x text-warning"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-warning">Denuncia Anónima</h4>
                                    <span class="fs-6">Esta denuncia fue registrada de forma anónima. No se cuenta con información de contacto del denunciante.</span>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Nombre completo</label>
                                        <div class="form-control form-control-solid bg-light">{{ $denuncia->nombre_completo }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Teléfono</label>
                                        <div class="form-control form-control-solid bg-light">{{ $denuncia->telefono }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Correo electrónico</label>
                                        <div class="form-control form-control-solid bg-light">{{ $denuncia->correo_electronico }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--end::Sección 2-->

                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-10"></div>
                    <!--end::Separator-->

                    <!--begin::Sección 3: Hechos Denunciados -->
                    <div class="mb-15">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-8">
                            <span class="svg-icon svg-icon-warning svg-icon-2hx me-4">
                                <i class="fas fa-exclamation-triangle fs-2 text-warning"></i>
                            </span>
                            <h2 class="fw-bolder text-gray-800 mb-0">Hechos Denunciados</h2>
                        </div>
                        <!--end::Heading-->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Motivo de la denuncia</label>
                                    <div class="form-control form-control-solid bg-light" style="min-height: 80px;">{{ $denuncia->motivo_denuncia }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Fecha de los hechos</label>
                                    <div class="form-control form-control-solid bg-light">
                                        {{ \Carbon\Carbon::parse($denuncia->fecha_hechos)->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Hora de los hechos</label>
                                    <div class="form-control form-control-solid bg-light">
                                        {{ $denuncia->hora_hechos ?? 'No especificada' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Municipio</label>
                                    <div class="form-control form-control-solid bg-light">
                                        {{ $denuncia->municipio->nombre ?? 'No especificado' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Dirección exacta</label>
                                    <div class="form-control form-control-solid bg-light">{{ $denuncia->direccion_exacta }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Localidad</label>
                                    <div class="form-control form-control-solid bg-light">{{ $denuncia->localidad ?? 'No especificada' }}</div>
                                </div>
                            </div>
                        </div>

                        @if($denuncia->dependencia_involucrada || $denuncia->tramite_solicitado)
                        <div class="row">
                            @if($denuncia->dependencia_involucrada)
                            <div class="col-md-6">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Dependencia involucrada</label>
                                    <div class="form-control form-control-solid bg-light">{{ $denuncia->dependencia_involucrada }}</div>
                                </div>
                            </div>
                            @endif
                            @if($denuncia->tramite_solicitado)
                            <div class="col-md-6">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Trámite solicitado</label>
                                    <div class="form-control form-control-solid bg-light">{{ $denuncia->tramite_solicitado }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($denuncia->circunstancias_detalladas)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Circunstancias detalladas</label>
                                    <div class="form-control form-control-solid bg-light" style="min-height: 120px;">{{ $denuncia->circunstancias_detalladas }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!--end::Sección 3-->

                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-10"></div>
                    <!--end::Separator-->

                    <!--begin::Sección 4: Personas Involucradas -->
                    @if($denuncia->involucrados || $denuncia->testigos)
                    <div class="mb-15">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-8">
                            <span class="svg-icon svg-icon-danger svg-icon-2hx me-4">
                                <i class="fas fa-users fs-2 text-danger"></i>
                            </span>
                            <h2 class="fw-bolder text-gray-800 mb-0">Personas Involucradas</h2>
                        </div>
                        <!--end::Heading-->

                        <div class="row">
                            @if($denuncia->involucrados)
                            <div class="col-md-6">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Involucrados</label>
                                    <div class="form-control form-control-solid bg-light" style="min-height: 100px;">
                                        @foreach(json_decode($denuncia->involucrados) as $involucrado)
                                            • {{ $involucrado }}<br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($denuncia->testigos)
                            <div class="col-md-6">
                                <div class="fv-row mb-8">
                                    <label class="form-label fs-6 fw-bold text-gray-700">Testigos</label>
                                    <div class="form-control form-control-solid bg-light" style="min-height: 100px;">
                                        @foreach(json_decode($denuncia->testigos) as $testigo)
                                            • {{ $testigo }}<br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--end::Sección 4-->

                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-10"></div>
                    <!--end::Separator-->
                    @endif

                    <!--begin::Sección 5: Historial de Seguimiento -->
                    <div class="mb-15">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-8">
                            <span class="svg-icon svg-icon-info svg-icon-2hx me-4">
                                <i class="fas fa-history fs-2 text-info"></i>
                            </span>
                            <h2 class="fw-bolder text-gray-800 mb-0">Historial de Seguimiento</h2>
                        </div>
                        <!--end::Heading-->

                        @if($denuncia->seguimientos && $denuncia->seguimientos->count() > 0)
                            <div class="timeline">
                                @foreach($denuncia->seguimientos->sortByDesc('created_at') as $seguimiento)
                                <!--begin::Timeline item-->
                                <div class="timeline-item">
                                    <!--begin::Timeline line-->
                                    <div class="timeline-line w-40px"></div>
                                    <!--end::Timeline line-->

                                    <!--begin::Timeline icon-->
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-{{ $seguimiento->estado_color }}">
                                            <i class="fas fa-{{ $seguimiento->icono }} text-{{ $seguimiento->estado_color }} fs-2"></i>
                                        </div>
                                    </div>
                                    <!--end::Timeline icon-->

                                    <!--begin::Timeline content-->
                                    <div class="timeline-content mb-10 mt-n1">
                                        <!--begin::Timeline heading-->
                                        <div class="pe-3 mb-5">
                                            <!--begin::Title-->
                                            <div class="fs-5 fw-bold mb-2">
                                                {{ $seguimiento->titulo }}
                                                <span class="text-muted fs-7 fw-semibold ms-2">
                                                    {{ $seguimiento->created_at->format('d/m/Y H:i') }}
                                                </span>
                                            </div>
                                            <!--end::Title-->

                                            <!--begin::Description-->
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">
                                                    {{ $seguimiento->descripcion }}
                                                </div>
                                            </div>
                                            <!--end::Description-->

                                            @if($seguimiento->observaciones)
                                            <!--begin::Observaciones-->
                                            <div class="d-flex align-items-center mt-3 fs-6">
                                                <div class="text-gray-600 fw-semibold me-2">Observaciones:</div>
                                                <div class="text-muted">{{ $seguimiento->observaciones }}</div>
                                            </div>
                                            <!--end::Observaciones-->
                                            @endif
                                        </div>
                                        <!--end::Timeline heading-->
                                    </div>
                                    <!--end::Timeline content-->
                                </div>
                                <!--end::Timeline item-->
                                @endforeach

                                <!--begin::Timeline item (creación)-->
                                <div class="timeline-item">
                                    <!--begin::Timeline line-->
                                    <div class="timeline-line w-40px"></div>
                                    <!--end::Timeline line-->

                                    <!--begin::Timeline icon-->
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-success">
                                            <i class="fas fa-plus text-success fs-2"></i>
                                        </div>
                                    </div>
                                    <!--end::Timeline icon-->

                                    <!--begin::Timeline content-->
                                    <div class="timeline-content mb-10 mt-n1">
                                        <!--begin::Timeline heading-->
                                        <div class="pe-3 mb-5">
                                            <!--begin::Title-->
                                            <div class="fs-5 fw-bold mb-2">
                                                Denuncia Registrada
                                                <span class="text-muted fs-7 fw-semibold ms-2">
                                                    {{ $denuncia->created_at->format('d/m/Y H:i') }}
                                                </span>
                                            </div>
                                            <!--end::Title-->

                                            <!--begin::Description-->
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">
                                                    La denuncia fue registrada en el sistema con folio {{ $denuncia->folio }}
                                                </div>
                                            </div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Timeline heading-->
                                    </div>
                                    <!--end::Timeline content-->
                                </div>
                                <!--end::Timeline item-->
                            </div>
                        @else
                            <div class="alert alert-info d-flex align-items-center p-5">
                                <span class="svg-icon svg-icon-2hx svg-icon-info me-4">
                                    <i class="fas fa-info-circle fs-2x text-info"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-info">Sin seguimientos registrados</h4>
                                    <span class="fs-6">Aún no se han registrado actualizaciones en el seguimiento de esta denuncia. Por favor, verifique más tarde.</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--end::Sección 5-->

                    <!--begin::Acciones-->
                    <div class="d-flex justify-content-between pt-10">
                        <a href="{{ route('denuncias.consultar') }}" class="btn btn-lg btn-light">
                            <i class="fas fa-search me-2"></i>
                            Consultar Otra Denuncia
                        </a>
                        <div>
                            <button onclick="window.print()" class="btn btn-lg btn-secondary me-5">
                                <i class="fas fa-print me-2"></i>
                                Imprimir
                            </button>
                            <a href="{{ route('inicio') }}" class="btn btn-lg btn-primary">
                                <i class="fas fa-home me-2"></i>
                                Volver al Inicio
                            </a>
                        </div>
                    </div>
                    <!--end::Acciones-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->

        <!--begin::Modal de ayuda-->
        <div class="modal fade" id="kt_modal_ayuda" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="fw-bold">Ayuda - Seguimiento de Denuncias</h2>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times fs-1"></i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-10">
                        <div class="mb-10">
                            <h4 class="fw-semibold mb-3">Estados de la Denuncia</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Estado</th>
                                            <th>Descripción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="badge badge-light-primary">Registrada</span></td>
                                            <td>La denuncia ha sido recibida y está en espera de revisión inicial</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-light-warning">En Revisión</span></td>
                                            <td>La denuncia está siendo analizada por el personal correspondiente</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-light-info">En Proceso</span></td>
                                            <td>Se han iniciado las acciones correspondientes para atender la denuncia</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-light-success">Resuelta</span></td>
                                            <td>La denuncia ha sido atendida y se han tomado las medidas necesarias</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-light-danger">Cerrada</span></td>
                                            <td>La denuncia ha sido concluida según los procedimientos establecidos</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mb-0">
                            <h4 class="fw-semibold mb-3">Información Importante</h4>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    <span>Guarde su folio para futuras consultas</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <i class="fas fa-clock text-warning me-2"></i>
                                    <span>El tiempo de respuesta puede variar según la complejidad del caso</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fas fa-shield-alt text-success me-2"></i>
                                    <span>Toda la información es confidencial y protegida</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal de ayuda-->

        <style>
            @media print {
                .btn, .card-toolbar, .separator {
                    display: none !important;
                }
                .card {
                    border: none !important;
                    box-shadow: none !important;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Botón de ayuda
                const helpButton = document.createElement('button');
                helpButton.className = 'btn btn-icon btn-active-light-primary position-fixed bottom-0 end-0 m-5';
                helpButton.innerHTML = '<i class="fas fa-question fs-2"></i>';
                helpButton.setAttribute('data-bs-toggle', 'modal');
                helpButton.setAttribute('data-bs-target', '#kt_modal_ayuda');
                helpButton.style.zIndex = '1000';
                document.body.appendChild(helpButton);
            });
        </script>
    @endsection
</x-auth-layout>