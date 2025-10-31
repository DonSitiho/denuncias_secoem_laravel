<x-auth-layout>

    @section('title', 'Detalles de Denuncia - ' . $denuncia->folio)

    @section('content')
        <!--begin::Container-->


        <style>
            #container {
                margin-top: 8%;
                /* ajusta según la altura de tu navbar */
            }

            @media (max-width:991px) {

                .navbar-expand-lg>.container,
                .navbar-expand-lg>.container-fluid {
                    padding-right: 0;
                    padding-left: 0
                }
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(74, 0, 31, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            .navbar {
                border-bottom: 5px solid #6A0F49;
                padding: .5rem 1rem;
                background-color: #F6F6F6;
            }


            .navbar-collapse {
                flex-grow: 0 !important;
            }

            .transition,
            .main-nav,
            .main-nav .navbar-brand {
                transition: .3s ease;
            }

            .main-nav .navbar-brand {
                padding: 0;
            }

            .main-nav .navbar-nav .nav-item {
                position: relative;
            }

            .main-nav .navbar-nav .nav-item .nav-link {
                position: relative;
                text-align: center;
                font-size: 14px;
                font-weight: bold;
                text-transform: uppercase;
                color: var(--morado);
                padding-left: 15px;
                padding-right: 15px;
                transition: 0.5s
            }

            .main-nav .navbar-nav .nav-item .nav-link:hover {
                background-color: var(--rosa-claro);
            }

            .navbar-toggler:focus,
            .navbar-toggler:hover {
                outline: none;
            }

            .bg-guinda-lith {
                background-color: #ffe3f0 !important;
                color: #6A0F49 !important;
            }

            .h1-guinda {
                color: #6A0F49 !important;
            }

            .textoGuinda,
            .textoGuinda span {
                color: #6A0F49;
            }

            .btn-primary {
                background-color: #6A0F49;
                border-color: #6A0F49;
            }

            .btn-guinda {
                background-color: #6A0F49 !important;
                border-color: #6A0F49 !important;
                color: #fff !important;
            }

            /* Hover */
            .btn-guinda:hover {
                background-color: #470c31 !important;
                border-color: #470c31 !important;
            }

            /* Active / Focus */
            .btn-guinda:active,
            .btn-guinda:focus {
                background-color: #470c31 !important;
                border-color: #470c31 !important;
                box-shadow: 0 0 0 0.25rem rgba(106, 15, 73, 0.25) !important;
            }

            .btn-light-guinda {
                background-color: #f7eaf3 !important;
                /* fondo claro tipo guinda */
                color: #6A0F49 !important;
                /* texto guinda */
                border-color: #f7eaf3 !important;
            }

            /* Hover */
            .btn-light-guinda:hover {
                background-color: #6A0F49 !important;
                color: #fff !important;
                border-color: #6A0F49 !important;
            }

            /* Active / Focus */
            .btn-light-guinda:active,
            .btn-light-guinda:focus {
                background-color: #470c31 !important;
                border-color: #470c31 !important;
                color: #fff !important;
                box-shadow: 0 0 0 0.25rem rgba(106, 15, 73, 0.25) !important;
            }

            .badge-light-guinda {
                background-color: #f7eaf3 !important;
                color: #470c31 !important;
                border-color: #470c31 !important;
            }

            .badge-light-guinda {
                background-color: #f7eaf3 !important;
                color: #470c31 !important;
                border: 1px solid #6A0F49 !important;
            }

            /* Guinda intenso - para estados importantes o altos */
            .badge-guinda {
                background-color: #6A0F49 !important;
                color: #fff !important;
                border: 1px solid #6A0F49 !important;
            }

            /* Guinda oscuro - para estado cerrado o completado */
            .badge-guinda-dark {
                background-color: #470c31 !important;
                color: #fff !important;
                border: 1px solid #470c31 !important;
            }

            /* Guinda medio - aviso o en trámite */
            .badge-guinda-medium {
                background-color: #9a3e70 !important;
                color: #fff !important;
                border: 1px solid #9a3e70 !important;
            }

            /* Guinda claro - recibido o pendiente */
            .badge-guinda-light {
                background-color: #ffe3f0 !important;
                color: #6A0F49 !important;
                border: 1px solid #f2cde3 !important;
            }

            /* Éxito en tono guinda (no verde tradicional) */
            .badge-guinda-success {
                background-color: #e9f5ec !important;
                color: #1f7a4d !important;
                border: 1px solid #1f7a4d !important;
            }

            /* Advertencia en tono rosado */
            .badge-guinda-warning {
                background-color: #fff3f8 !important;
                color: #b04c75 !important;
                border: 1px solid #b04c75 !important;
            }

            /* Error en tono guinda fuerte */
            .badge-guinda-danger {
                background-color: #f5d2e1 !important;
                color: #8a0d3d !important;
                border: 1px solid #8a0d3d !important;
            }
        </style>

        @php
            $badgeClass = match ($denuncia->estado->nombre) {
                'Recibida' => 'badge-guinda-light',
                'En trámite' => 'badge-guinda-warning',
                'Cerrada' => 'badge-guinda-success',
                default => 'badge-guinda-danger',
            };
        @endphp

        <nav class="navbar main-nav fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://secoem.michoacan.gob.mx">
                    <img src="https://michoacan.gob.mx/cdn/img/logos/dependencias/secoem.svg" height="85px;"
                        alt="Logo SECOEM">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="/inicio">Pagina Principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="#contacto">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/contraloriamich/" target="_blank"
                                title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://twitter.com/contraloriamich/" target="_blank" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <!-- Ajuste dinámico de padding -->
        <div
            style="background-color: #F6F6F6; background: url(https://michoacan.gob.mx/images/backgrounds/bg.png) fixed no-repeat;  background-size: cover; padding:20px; 0px;">


            <div id="container" class="d-flex flex-column-fluid align-items-start container-xxl">
                <!--begin::Post-->
                <div class="content flex-row-fluid" id="kt_content">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10">
                            <!--begin::Card-->
                            <div class="card card-flush mb-0">
                                <!--begin::Card header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold h1-guinda">Resumen</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Información general</span>
                                    </h3>
                                    <!--end::Title-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-4">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <span class="text-gray-600 fw-semibold">Folio:</span>
                                        <span class="text-gray-800 fw-bold">{{ $denuncia->folio_seguimiento }}</span>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->

                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <span class="text-gray-600 fw-semibold">Estado:</span>
                                        <span class="badge badge-lg {{ $badgeClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $denuncia->estado->nombre)) }}
                                        </span>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->

                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <span class="text-gray-600 fw-semibold">Fecha registro:</span>
                                        <span
                                            class="text-gray-800 fw-bold">{{ $denuncia->fecha_recepcion ? $denuncia->fecha_recepcion->format('d/m/Y') : 'No registrada' }}</span>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->

                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <span class="text-gray-600 fw-semibold">Prioridad:</span>
                                        <span
                                            class="badge badge-lg {{ $denuncia->prioridad == 'alta'
                                                ? 'badge-guinda-danger'
                                                : ($denuncia->prioridad == 'media'
                                                    ? 'badge-guinda-warning'
                                                    : 'badge-guinda-success') }}">
                                            {{-- {{ ucfirst($denuncia->prioridad) }} --}}
                                            ver si se ocupa
                                        </span>
                                    </div>
                                    <!--end::Item-->

                                    @if ($denuncia->circunstancia && $denuncia->circunstancia->municipio)
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-4"></div>
                                        <!--end::Separator-->

                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <span class="text-gray-600 fw-semibold">Municipio:</span>
                                            <span
                                                class="text-gray-800 fw-bold">{{ $denuncia->circunstancia->municipio->nombre_municipio }}</span>
                                        </div>
                                        <!--end::Item-->
                                    @endif

                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->

                                    <!--begin::Actions-->
                                    <div class="d-flex flex-column">
                                        <button class="btn btn-light-guinda fw-bold" onclick="window.print()">
                                            <i class="ki-duotone ki-printer fs-2"></i>
                                            Imprimir resumen
                                        </button>
                                        <button type="button" class="btn btn-guinda fw-bold mt-3" id="btn-ver-detalles">
                                            <i class="ki-duotone ki-eye fs-2"></i>
                                            Acceder a información confidencial
                                        </button>
                                        <a href="{{ route('inicio') }}" class="btn  btn-light-guinda mt-3">
                                            <i class="ki-duotone ki-home-2 fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            Volver al inicio
                                        </a>
                                        {{-- <a href="{{ route('denuncias.buscar.form') }}" class="btn btn-light btn-active-light-primary fw-bold mt-3">
                                        <i class="ki-duotone ki-magnifier fs-2"></i>
                                        Nueva búsqueda
                                    </a> --}}
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Sidebar-->

                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-10">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-6">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold textoGuinda">Información General de la Denuncia</h2>
                                    </div>

                                    <!--end::Card title-->

                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <div class="d-flex justify-content-end">
                                            <span class="badge badge-lg {{ $badgeClass }}">
                                                {{ ucfirst(str_replace('_', ' ', $denuncia->estado->nombre)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <div class="separator separator-dashed my-4"></div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Información General-->
                                    <div class="mb-10" id="informacion-general">
                                        <div class="row mb-6">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold text-gray-600">Folio de
                                                    denuncia</label>
                                                <div class="text-gray-800 fw-bold fs-5">
                                                    {{ $denuncia->folio_seguimiento ?? 'No registrado' }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold text-gray-600">Fecha de
                                                    registro</label>
                                                <div class="text-gray-800 fw-bold fs-5">
                                                    {{ $denuncia->fecha_recepcion ? $denuncia->fecha_recepcion->format('d/m/Y H:i') : 'No registrada' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold text-gray-600">Estado actual</label>
                                                <div>
                                                    <span class="badge badge-lg {{ $badgeClass }}">
                                                        {{ ucfirst(str_replace('_', ' ', $denuncia->estado->nombre)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold text-gray-600">Nivel de
                                                    prioridad</label>
                                                <div>
                                                    <span
                                                        class="badge badge-lg {{ $denuncia->prioridad == 'alta'
                                                            ? 'badge-guinda-danger'
                                                            : ($denuncia->prioridad == 'media'
                                                                ? 'badge-guinda-warning'
                                                                : 'badge-guinda-success') }}">
                                                        {{-- {{ ucfirst($denuncia->prioridad) }} --}}
                                                        ver si se ocupa
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($denuncia->circunstancia && $denuncia->circunstancia->municipio)
                                            <div class="row mb-6">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold text-gray-600">Municipio de los
                                                        hechos</label>
                                                    <div class="text-gray-800 fw-bold fs-5">
                                                        {{ $denuncia->circunstancia->municipio->nombre_municipio }}</div>
                                                </div>
                                                @if ($denuncia->circunstancia->fecha_hechos)
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold text-gray-600">Fecha de los
                                                            hechos</label>
                                                        <div class="text-gray-800 fw-bold fs-5">
                                                            {{ \Carbon\Carbon::parse($denuncia->circunstancia->fecha_hechos)->format('d/m/Y') }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        <!--begin::Aviso de Confidencialidad-->
                                        <div class="alert bg-guinda-lith d-flex align-items-center p-5 mt-8">
                                            <!--begin::Icon-->
                                            <i class="ki-duotone ki-shield-tick fs-2hx h1-guinda me-4">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <!--end::Icon-->

                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Title-->
                                                <h4 class="mb-1 h1-guinda">Información Confidencial</h4>
                                                <!--end::Title-->

                                                <!--begin::Content-->
                                                <span>
                                                    La información detallada de esta denuncia (datos de contacto,
                                                    involucrados,
                                                    testigos y archivos adjuntos)
                                                    está protegida por medidas de seguridad. Para acceder a esta información
                                                    confidencial,
                                                    utilice el botón "Acceder a información confidencial" e ingrese la
                                                    credencial de seguridad correspondiente.
                                                </span>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Aviso de Confidencialidad-->
                                    </div>
                                    <!--end::Información General-->

                                    <!--begin::Información Confidencial (se mostrará después de la validación)-->
                                    <div id="informacion-confidencial" style="display: none;">
                                        <!-- El contenido se cargará dinámicamente -->
                                    </div>
                                    <!--end::Información Confidencial-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Container-->

            <!--begin::Modal - Acceso Confidencial-->
            <div class="modal fade" id="kt_modal_acceso_confidencial" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-500px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Acceso a Información Confidencial</h2>
                            <!--end::Modal title-->

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->

                        <!--begin::Modal body-->
                        <div class="modal-body py-10 px-lg-17">
                            <!--begin::Form-->
                            <form id="kt_modal_acceso_confidencial_form" class="form" action="#">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fs-6 fw-bold text-gray-700">Credencial de Seguridad</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="password" class="form-control form-control-lg form-control-solid"
                                        name="token_validacion" placeholder="Ingrese la credencial de seguridad" required
                                        autocomplete="off" />
                                    <!--end::Input-->

                                    <!--begin::Hint-->
                                    <div class="text-muted fs-7 mt-2">
                                        Ingrese la credencial de seguridad que se le proporcionó al momento de registrar la
                                        denuncia.
                                    </div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <button type="button" class="btn btn-light btn-active-light-primary me-2"
                                        data-bs-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <button type="submit" id="kt_modal_acceso_confidencial_submit"
                                        class="btn btn-primary">
                                        <span class="indicator-label">
                                            Validar Acceso
                                        </span>
                                        <span class="indicator-progress">
                                            Verificando... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
        </div>
        <!--end::Modal - Acceso Confidencial-->

        <!-- modal solventar informacion-->
        <!-- Modal con estilo Metronic 8 -->
        <div class="modal fade" id="modalSolventar" tabindex="-1" aria-labelledby="modalSolventarLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Header del modal con estilo Metronic -->
                    <div class="modal-header">
                        <div class="d-flex align-items-center w-100">
                            <!-- Icono de advertencia -->
                            <i class="ki-duotone ki-information-5 fs-2x text-warning me-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>

                            <!-- Título del modal -->
                            <h5 class="modal-title text-gray-800 fw-bolder" id="modalSolventarLabel">
                                Información pendiente por solventar
                            </h5>
                        </div>

                        <!-- Botón de cierre -->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>

                    <!-- Cuerpo del modal -->
                    <div class="modal-body py-10 px-5">
                        <div
                            class="alert alert-dismissible bg-light-warning border border-warning border-dashed d-flex flex-column flex-sm-row p-5 mb-10">
                            <!-- Icono de alerta -->
                            <i class="ki-duotone ki-information fs-2hx text-warning me-4 mb-5 mb-sm-0">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>

                            <!-- Contenido de la alerta -->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h5 class="mb-3 text-warning">Información requerida</h5>
                                <span>Por favor, complete la siguiente información solicitada para proceder con el análisis
                                    de la denuncia.</span>
                            </div>
                        </div>

                        <!-- Contenedor del formulario -->
                        <div id="formContainer">
                            <!-- El formulario se cargará dinámicamente aquí -->
                        </div>
                    </div>

                    <!-- Footer del modal -->
                    <div class="modal-footer flex-center">
                        <!-- Botón de cancelar -->
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <!-- Botón de guardar -->
                        <button type="button" class="btn btn-success" id="btnGuardarSolventar">
                            <i class="ki-duotone ki-check-square fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            Guardar información
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin del modal -->

    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('kt_modal_acceso_confidencial'));
                const form = document.getElementById('kt_modal_acceso_confidencial_form');
                const submitButton = document.getElementById('kt_modal_acceso_confidencial_submit');
                const btnVerDetalles = document.getElementById('btn-ver-detalles');
                const informacionGeneral = document.getElementById('informacion-general');
                const informacionConfidencial = document.getElementById('informacion-confidencial');

                // Abrir modal al hacer clic en el botón
                btnVerDetalles.addEventListener('click', function() {
                    modal.show();
                });

                // Manejar el envío del formulario
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const tokenValidacion = form.querySelector('input[name="token_validacion"]').value;

                    if (!tokenValidacion) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Credencial requerida',
                            text: 'Por favor, ingrese la credencial de seguridad.',
                            confirmButtonColor: '#009EF7'
                        });
                        return;
                    }

                    // Mostrar estado de carga
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;

                    // Enviar petición AJAX para verificar el token
                    fetch("{{ route('denuncias.verificar-palabra-clave', $denuncia->id_denuncia) }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                token_validacion: tokenValidacion
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Ocultar estado de carga
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;

                            if (data.success) {
                                // Cerrar el modal
                                modal.hide();

                                // Ocultar información general y mostrar confidencial
                                informacionGeneral.style.display = 'none';
                                informacionConfidencial.style.display = 'block';

                                // Cargar el contenido confidencial
                                cargarInformacionConfidencial();

                                // Ocultar el botón de acceso
                                btnVerDetalles.style.display = 'none';

                                // Mostrar mensaje de éxito
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Acceso autorizado',
                                    text: 'Ahora tiene acceso a la información confidencial de la denuncia.',
                                    confirmButtonColor: '#50CD89',
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                // Limpiar el formulario
                                form.reset();
                            } else {
                                // Mostrar error
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Credencial incorrecta',
                                    text: data.message ||
                                        'La credencial de seguridad ingresada no es válida.',
                                    confirmButtonColor: '#F64E60'
                                });
                            }
                        })
                        .catch(error => {
                            // Ocultar estado de carga
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;

                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error del sistema',
                                text: 'Ocurrió un error al verificar la credencial. Por favor, intente nuevamente.',
                                confirmButtonColor: '#F64E60'
                            });
                        });
                });

                // Función para cargar la información confidencial
                function cargarInformacionConfidencial() {
                    fetch("{{ route('denuncias.detalles-completos', $denuncia->id_denuncia) }}", {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error al cargar los detalles');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                console.log(data);
                                informacionConfidencial.innerHTML = data.html;

                                if (data.info_solicitada && data.info_solicitada.length > 0) {
                                    // Abrir modal después de medio segundo
                                    setTimeout(() => {
                                        const modal = new bootstrap.Modal(document.getElementById(
                                            'modalSolventar'));
                                        modal.show();
                                    }, 500);

                                    // Limpiar contenido anterior del formulario
                                    const formContainer = document.getElementById('formContainer');
                                    formContainer.innerHTML = '';

                                    // Crear formulario dinámico
                                    let formHtml = `
                    <form id="formSolventarInfo" class="form" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_denuncia" value="${data.info_solicitada[0].id_denuncia}">
                        <div class="row g-5">
                `;

                                    // Generar campos según tipo_campo
                                    data.info_solicitada.forEach((item, index) => {
                                        formHtml += `
                        <div class="col-md-12 fv-row">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                ${item.observacion_responsable}
                                ${item.is_required ? '<span class="text-danger">*</span>' : ''}
                            </label>
                    `;

                                        // Manejar diferentes tipos de campo
                                        switch (item.tipo_campo) {
                                            case 'date':
                                                formHtml += `
                                <input type="date" class="form-control form-control-solid" 
                                    name="info_solicitada[${item.id}]" 
                                    value="${item.info_solicitada || ''}"
                                    ${item.is_required ? 'required' : ''}
                                    placeholder="Seleccione una fecha">
                            `;
                                                break;

                                            case 'text':
                                                formHtml += `
                                <input type="text" class="form-control form-control-solid" 
                                    name="info_solicitada[${item.id}]" 
                                    value="${item.info_solicitada || ''}"
                                    ${item.is_required ? 'required' : ''}
                                    placeholder="Ingrese la información solicitada">
                            `;
                                                break;

                                            case 'archivo':
                                                formHtml += `
                                <div class="d-flex align-items-center">
                                    <input type="file" class="form-control form-control-solid" 
                                        name="archivos[${item.id}]"
                                        ${item.is_required ? 'required' : ''}
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xls,.xlsx">
                                    <small class="text-muted ms-2">Formatos: PDF, Word, Excel, JPG, PNG</small>
                                </div>
                                ${item.info_solicitada ? `
                                            <div class="mt-2">
                                                <small class="text-success">Archivo actual: ${item.info_solicitada}</small>
                                            </div>
                                        ` : ''}
                            `;
                                                break;

                                            case 'entero':
                                                formHtml += `
                                <input type="number" class="form-control form-control-solid" 
                                    name="info_solicitada[${item.id}]" 
                                    value="${item.info_solicitada || ''}"
                                    ${item.is_required ? 'required' : ''}
                                    step="1"
                                    placeholder="Ingrese un número entero">
                            `;
                                                break;

                                            default:
                                                formHtml += `
                                <textarea class="form-control form-control-solid" 
                                    name="info_solicitada[${item.id}]"
                                    rows="3"
                                    ${item.is_required ? 'required' : ''}
                                    placeholder="Ingrese la información solicitada">${item.info_solicitada || ''}</textarea>
                            `;
                                        }

                                        formHtml += `</div>`;
                                    });

                                    formHtml += `
                        </div>
                    </form>
                `;

                                    // Insertar el formulario dentro del contenedor
                                    formContainer.innerHTML = formHtml;

                                    // Inicializar componentes de Metronic si es necesario
                                    if (typeof KTFormControls !== 'undefined') {
                                        KTFormControls.init();
                                    }
                                } // <-- ESTA ES LA LLAVE DE CIERRE DEL IF PRINCIPAL QUE FALTABA

                                // Inicializar cualquier componente necesario
                                inicializarComponentes();
                            } // <-- CIERRE del if (data.success)
                        })
                        .catch(error => {
                            console.error('Error al cargar información confidencial:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudieron cargar los detalles confidenciales.',
                                confirmButtonColor: '#F64E60'
                            });
                        });
                } // <-- CIERRE de la función cargarInformacionConfidencial

                // Función para inicializar componentes (puedes agregar lo que necesites aquí)
                function inicializarComponentes() {
                    // Inicializar tooltips si es necesario
                    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                }

                function inicializarComponentes() {
                    // Inicializar tooltips si es necesario
                    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                    tooltips.forEach(tooltip => {
                        new bootstrap.Tooltip(tooltip);
                    });
                }

                // Limpiar el modal cuando se cierre
                document.getElementById('kt_modal_acceso_confidencial').addEventListener('hidden.bs.modal', function() {
                    form.reset();
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                });
            });
        </script>

        <!-- modal informacion a solventar-->

        <script>
            $('#btnGuardarSolventar').on('click', function() {
                const $btn = $(this);
                const originalText = $btn.html();

                // Validar formulario antes de enviar
                const form = document.getElementById('formSolventarInfo');
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                // Mostrar estado de carga
                $btn.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
        Guardando...
    `);

                let formData = new FormData($('#formSolventarInfo')[0]);

                $.ajax({
                    url: "{{ route('denuncias.solventar.guardar') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Información guardada',
                                text: response.message ||
                                    'Se ha completado correctamente la información solicitada.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#modalSolventar').modal('hide');

                            
                            // setTimeout(() => {
                            //     location.reload();
                            // }, 2000);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'No se pudo guardar la información.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error completo:', xhr.responseJSON);

                        let errorMessage = 'Ocurrió un error al guardar la información.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.status === 422) {
                            errorMessage = 'Error de validación. Verifique los datos ingresados.';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage
                        });
                    },
                    complete: function() {
                        // Restaurar el botón a su estado original
                        $btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        </script>
    @endpush
</x-auth-layout>
