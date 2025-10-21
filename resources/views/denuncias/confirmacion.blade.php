<x-auth-layout>
    @section('content')
        <!--begin::Root-->

        <!--end::Root-->



        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="/metronic8/demo1/assets/media/auth/agency.png" alt="">
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="/metronic8/demo1/assets/media/auth/agency-dark.png" alt="">
                    <!--end::Image-->

                    <!--begin::Title-->
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                        Fast, Efficient and Productive
                    </h1>
                    <!--end::Title-->

                    <!--begin::Text-->
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        In this kind of post, <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>

                        introduces a person they’ve interviewed <br> and provides some background information about

                        <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>
                        and their <br> work following this is a transcript of the interview.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->

                <!--begin::Content-->


                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <!--begin::Icon-->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <span class="svg-icon svg-icon-8tx svg-icon-success">
                            <svg width="100" height="100" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.7664 4.44177 16.5944L11.3435 22.6213C11.7672 22.9866 12.2328 22.9866 12.6565 22.6213L19.5582 16.5944C20.5149 15.7664 21 14.6914 21 13.569V4.93945C21 4.6807 20.8188 4.45258 20.5543 4.37824Z"
                                    fill="currentColor" />
                                <path
                                    d="M12.0006 11.1545C10.8584 11.1545 9.93353 10.2296 9.93353 9.0874C9.93353 7.94519 10.8584 7.02026 12.0006 7.02026C13.1428 7.02026 14.0677 7.94519 14.0677 9.0874C14.0677 10.2296 13.1428 11.1545 12.0006 11.1545ZM8.75904 16.5157C8.25395 16.5157 7.84416 16.1059 7.84416 15.6008C7.84416 15.0957 8.25395 14.6859 8.75904 14.6859H15.2422C15.7473 14.6859 16.1571 15.0957 16.1571 15.6008C16.1571 16.1059 15.7473 16.5157 15.2422 16.5157H8.75904Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                    <!--end::Icon-->

                    <!--begin::Title-->
                    <h1 class="fw-bolder text-gray-900 mb-5">¡Denuncia registrada con éxito!</h1>
                    <!--end::Title-->

                    <!--begin::Description-->
                    <div class="fs-6 text-gray-700 mb-8">
                        Hemos recibido tu denuncia correctamente.<br>
                        <strong class="text-danger">Guarda tu número de folio y código</strong> para futuras consultas.
                    </div>
                    <!--end::Description-->

                    <!--begin::Folio Section-->
                    <div class="d-flex flex-column flex-center mb-8">
                        <!--begin::Folio-->
                        <div class="mb-4">
                            <div class="fw-bold fs-5 text-gray-600 mb-2">Folio de denuncia:</div>
                            <div class="fs-2hx fw-bolder text-primary">{{ $folio }}</div>
                        </div>
                        <!--end::Folio-->

                        <!--begin::Código-->
                        <div class="mb-6">
                            <div class="fw-bold fs-5 text-gray-600 mb-2">Código de seguimiento:</div>
                            <div class="fs-2hx fw-bolder text-danger">{{ $codigo }}</div>
                        </div>
                        <!--end::Código-->
                    </div>
                    <!--end::Folio Section-->

                    <!--begin::QR Section-->
                    <div class="mb-10 p-6 bg-light-success rounded-2">
                        <div class="d-flex flex-column align-items-center">
                            <div class="mb-3">
                                {!! $qrCode !!}
                            </div>
                            <p class="text-gray-700 fw-semibold mb-2">Escanea para consultar el estatus</p>
                            <p class="text-muted fs-7">o visita: {{ route('denuncias.seguimiento', $folio) }}</p>
                        </div>
                    </div>
                    <!--end::QR Section-->

                    <!--begin::Alert-->
                    <div
                        class="alert alert-dismissible bg-light-warning border border-warning border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-2hx svg-icon-warning me-4 mb-5 mb-sm-0">
                            <i class="fas fa-shield-alt fs-2x text-warning"></i>
                        </span>
                        <!--end::Icon-->

                        <!--begin::Content-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <div class="fw-semibold">
                                <h4 class="text-gray-900 fw-bold">Información importante</h4>
                                <div class="fs-6 text-gray-700">
                                    Conserva este comprobante. Tu folio y código son necesarios para dar seguimiento a tu
                                    denuncia.
                                </div>
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Alert-->

                    <!--begin::Buttons-->
                    <div class="d-flex flex-center gap-4">
                        <a href="{{ route('denuncias.pdf', $folio) }}" class="btn btn-primary">
                            <i class="ki-duotone ki-file-down fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Descargar comprobante PDF
                        </a>
                        <a href="{{ route('inicio') }}" class="btn btn-light">
                            <i class="ki-duotone ki-home-2 fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Volver al inicio
                        </a>
                    </div>
                    <!--end::Buttons-->
                </div>
                <!--end::Content-->

                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
    @endsection
</x-auth-layout>
