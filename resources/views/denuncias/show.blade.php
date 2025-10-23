<x-auth-layout>
    @section('title', 'Detalles de Denuncia - ' . $denuncia->folio)

    @section('content')
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
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
                                <span class="card-label fw-bold text-gray-800">Resumen</span>
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
                                <span class="badge badge-lg {{ 
                                    $denuncia->estado->nombre == 'Recibida' ? 'badge-light-primary' : 
                                    ($denuncia->estado->nombre == 'En trámite' ? 'badge-light-warning' : 
                                    ($denuncia->estado->nombre == 'Cerrada' ? 'badge-light-success' : 
                                    'badge-light-danger'))
                                }}">
                                    {{ ucfirst(str_replace('_', ' ', $denuncia->estado->nombre   )) }}
                                </span>
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->

                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <span class="text-gray-600 fw-semibold">Fecha registro:</span>
                                <span class="text-gray-800 fw-bold">{{ $denuncia->fecha_recepcion ? $denuncia->fecha_recepcion->format('d/m/Y') : 'No registrada' }}</span>
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->

                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <span class="text-gray-600 fw-semibold">Prioridad:</span>
                                <span class="badge badge-lg {{
                                    $denuncia->prioridad == 'alta' ? 'badge-light-danger' : 
                                    ($denuncia->prioridad == 'media' ? 'badge-light-warning' : 
                                    'badge-light-success')
                                }}">
                                    {{-- {{ ucfirst($denuncia->prioridad) }} --}}
                                    ver si se ocupara
                                </span>
                            </div>
                            <!--end::Item-->

                            @if($denuncia->circunstancia && $denuncia->circunstancia->municipio)
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->

                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <span class="text-gray-600 fw-semibold">Municipio:</span>
                                <span class="text-gray-800 fw-bold">{{ $denuncia->circunstancia->municipio->nombre_municipio }}</span>
                            </div>
                            <!--end::Item-->
                            @endif

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->

                            <!--begin::Actions-->
                            <div class="d-flex flex-column">
                                <button class="btn btn-light-primary fw-bold" onclick="window.print()">
                                    <i class="ki-duotone ki-printer fs-2"></i>
                                    Imprimir resumen
                                </button>
                                <button type="button" class="btn btn-primary fw-bold mt-3" id="btn-ver-detalles">
                                    <i class="ki-duotone ki-eye fs-2"></i>
                                    Acceder a información confidencial
                                </button>
                                <a href="{{ route('inicio') }}" class="btn btn-light">
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
                                <h2 class="fw-bold">Información General de la Denuncia</h2>
                            </div>
                            <!--end::Card title-->

                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end">
                                    <span class="badge badge-lg {{ 
                                        $denuncia->estado->nombre == 'Recibida' ? 'badge-light-primary' : 
                                        ($denuncia->estado->nombre == 'En trámite' ? 'badge-light-warning' : 
                                        ($denuncia->estado->nombre == 'Cerrada' ? 'badge-light-success' : 
                                        'badge-light-danger'))
                                    }} fs-6 px-4 py-2">
                                        {{ ucfirst(str_replace('_', ' ', $denuncia->estado->nombre)) }}
                                        {{-- poner el estado --}}
                                    </span>
                                </div>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Información General-->
                            <div class="mb-10" id="informacion-general">
                                <div class="row mb-6">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-gray-600">Folio de denuncia</label>
                                        <div class="text-gray-800 fw-bold fs-5">{{ $denuncia->folio_seguimiento ?? 'No registrado' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-gray-600">Fecha de registro</label>
                                        <div class="text-gray-800 fw-bold fs-5">{{ $denuncia->fecha_recepcion ? $denuncia->fecha_recepcion->format('d/m/Y H:i') : 'No registrada' }}</div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-gray-600">Estado actual</label>
                                        <div>
                                            <span class="badge badge-lg {{ 
                                    $denuncia->estado->nombre == 'Recibida' ? 'badge-light-primary' : 
                                    ($denuncia->estado->nombre == 'En trámite' ? 'badge-light-warning' : 
                                    ($denuncia->estado->nombre == 'Cerrada' ? 'badge-light-success' : 
                                    'badge-light-danger'))
                                }}">
                                    {{ ucfirst(str_replace('_', ' ', $denuncia->estado->nombre   )) }}
                                </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-gray-600">Nivel de prioridad</label>
                                        <div>
                                            <span class="badge badge-lg {{
                                                $denuncia->prioridad == 'alta' ? 'badge-danger' : 
                                                ($denuncia->prioridad == 'media' ? 'badge-warning' : 
                                                'badge-success')
                                            }} fs-6">
                                                {{-- {{ ucfirst($denuncia->prioridad) }} --}}
                                                ver si se ocupara
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if($denuncia->circunstancia && $denuncia->circunstancia->municipio)
                                <div class="row mb-6">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-gray-600">Municipio de los hechos</label>
                                        <div class="text-gray-800 fw-bold fs-5">{{ $denuncia->circunstancia->municipio->nombre_municipio }}</div>
                                    </div>
                                    @if($denuncia->circunstancia->fecha_hechos)
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-gray-600">Fecha de los hechos</label>
                                        <div class="text-gray-800 fw-bold fs-5">{{ \Carbon\Carbon::parse($denuncia->circunstancia->fecha_hechos)->format('d/m/Y') }}</div>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <!--begin::Aviso de Confidencialidad-->
                                <div class="alert alert-warning d-flex align-items-center p-5 mt-8">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <h4 class="mb-1 text-warning">Información Confidencial</h4>
                                        <!--end::Title-->

                                        <!--begin::Content-->
                                        <span>
                                            La información detallada de esta denuncia (datos de contacto, involucrados, testigos y archivos adjuntos) 
                                            está protegida por medidas de seguridad. Para acceder a esta información confidencial, 
                                            utilice el botón "Acceder a información confidencial" e ingrese la credencial de seguridad correspondiente.
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
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
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
                                   name="token_validacion" placeholder="Ingrese la credencial de seguridad" 
                                   required autocomplete="off" />
                            <!--end::Input-->

                            <!--begin::Hint-->
                            <div class="text-muted fs-7 mt-2">
                                Ingrese la credencial de seguridad que se le proporcionó al momento de registrar la denuncia.
                            </div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="d-flex flex-stack">
                            <button type="button" class="btn btn-light btn-active-light-primary me-2" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" id="kt_modal_acceso_confidencial_submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    Validar Acceso
                                </span>
                                <span class="indicator-progress">
                                    Verificando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
    <!--end::Modal - Acceso Confidencial-->
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
                            text: data.message || 'La credencial de seguridad ingresada no es válida.',
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
                        informacionConfidencial.innerHTML = data.html;
                        // Inicializar cualquier componente necesario
                        inicializarComponentes();
                    }
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
            }

            function inicializarComponentes() {
                // Inicializar tooltips si es necesario
                const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                tooltips.forEach(tooltip => {
                    new bootstrap.Tooltip(tooltip);
                });
            }

            // Limpiar el modal cuando se cierre
            document.getElementById('kt_modal_acceso_confidencial').addEventListener('hidden.bs.modal', function () {
                form.reset();
                submitButton.removeAttribute('data-kt-indicator');
                submitButton.disabled = false;
            });
        });
    </script>
    @endpush
</x-auth-layout>