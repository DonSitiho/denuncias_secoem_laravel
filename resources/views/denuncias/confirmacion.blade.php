<x-auth-layout>
    @section('content')
        <style>
            body {
                background-image: url('/assets/media/auth/bg10.jpeg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('/assets/media/auth/bg10-dark.jpeg');
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
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-250px mb-8 mb-lg-15"
                        src="/assets/media/illustrations/sigma-1/8.png" alt="">
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-250px mb-8 mb-lg-15"
                        src="/assets/media/illustrations/sigma-1/8-dark.png" alt="">
                    <!--end::Image-->

                    <!--begin::Title-->
                    <h1 class=" fs-2qx fw-bold text-center mb-6" style="color: #6A0F49;">
                        Su denuncia ha sido procesada
                    </h1>
                    <!--end::Title-->

                    <!--begin::Text-->
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        Su compromiso con la <strong class="text-primary">transparencia</strong> y la
                        <strong class="text-primary">integridad</strong> es fundamental para nosotros.<br>
                        Hemos registrado su denuncia de manera <strong class="text-success">confidencial y segura</strong>.
                    </div>
                    <!--end::Text-->
                </div>
            </div>
            <!--end::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-8">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-550px p-8">
                    <!--begin::Icon-->

                    <!--end::Icon-->

                    <!--begin::Title-->
                    <h1 class="fw-bolder text-gray-900 mb-4">¡Denuncia registrada con éxito!</h1>
                    <!--end::Title-->

                    <!--begin::Description-->
                    <div class="fs-6 text-gray-700 mb-6">
                        Hemos recibido tu denuncia correctamente.<br>
                        <strong class="text-danger">Guarda tu número de folio y código</strong> para futuras consultas.
                    </div>
                    <!--end::Description-->

                    <!--begin::Folio Section-->
                    <div class="d-flex flex-column flex-center mb-6">
                        <div class="mb-3">
                            <div class="fw-bold fs-5 text-gray-600 mb-1">Folio de denuncia:</div>
                            <div class="fs-2hx fw-bolder" style="color: #6A0F49;">{{ $folio }}</div>
                        </div>
                        <div class="mb-4 text-center">
                            <div class="fw-bold fs-5 text-gray-600 mb-1">Código de seguimiento:</div>
                            <div class="fs-2hx fw-bolder text-danger">{{ $codigo }}</div>
                        </div>
                    </div>
                    <!--end::Folio Section-->

                    <!--begin::QR Section-->
                    <div class="mb-8 p-5 rounded-2" style="background-color: #fcfaff;">
                        <div class="d-flex flex-column align-items-center">
                            <div class="mb-2">
                                {!! $qrCode !!}
                            </div>
                            <p class="text-gray-700 fw-semibold mb-1">Escanea para consultar el estatus</p>
                            <p class="text-muted fs-7">o visita: {{ route('denuncias.seguimiento', $folio) }}</p>
                        </div>
                    </div>
                    <!--end::QR Section-->

                    <!--begin::Alert-->
                    {{-- <div class="alert alert-dismissible bg-light-warning border border-warning border-dashed d-flex flex-column flex-sm-row w-100 p-4 mb-6">
                        <span class="svg-icon svg-icon-2hx svg-icon-warning me-3 mb-3 mb-sm-0">
                            <i class="fas fa-shield-alt fs-2x text-warning"></i>
                        </span>
                        <div class="d-flex flex-stack flex-grow-1">
                            <div class="fw-semibold">
                                <h4 class="text-gray-900 fw-bold mb-1">Información importante</h4>
                                <div class="fs-6 text-gray-700">
                                    Conserva este comprobante. Tu folio y código son necesarios para dar seguimiento a tu denuncia.
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--end::Alert-->

                    <!--begin::Buttons-->
                    <div class="d-flex flex-center gap-3">
                        <a href="{{ route('denuncias.pdf', $folio) }}" class="btn btn-guinda">
                            <i class="ki-duotone ki-file-down fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Descargar PDF
                        </a>
                        <a href="{{ route('inicio') }}" class="btn btn-light-guinda">
                            <i class="ki-duotone ki-home-2 fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Volver al inicio
                        </a>
                    </div>
                    <!--end::Buttons-->
                </div>
            </div>
            <!--end::Body-->
        </div>
    @endsection
</x-auth-layout>
