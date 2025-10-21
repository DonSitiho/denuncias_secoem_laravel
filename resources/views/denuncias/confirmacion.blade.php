<x-auth-layout>
    @section('content')
        <div class="d-flex flex-column flex-center flex-column-fluid p-10">
            <!--begin::Wrapper-->
            <div class="card w-md-550px shadow-sm">
                <div class="card-body py-15 px-10 text-center">
                    <!--begin::Icon-->
                    {{-- <div class="mb-7">
                        <img src="{{ asset('assets/media/illustrations/unitedpalms-1/4.png') }}" alt="confirmado" class="w-100px">
                    </div> --}}

                    <!--begin::Title-->
                    <h1 class="fw-bolder text-success mb-5">¡Denuncia registrada con éxito!</h1>

                    <p class="text-muted mb-10">
                        Hemos recibido tu denuncia correctamente.<br>
                        Guarda tu número de folio para futuras consultas.
                    </p>

                    <!--begin::Folio-->
                    <div class="mb-2">
                        <div class="fw-bold fs-3 mb-1">Folio de denuncia:</div>
                        <div class="fs-2hx fw-bolder text-gray-800">{{ $folio }}</div>
                    </div>

                    <!--begin::QR-->
                    <div class="mb-12 d-flex flex-column align-items-center">
                        <div class="w-100px text-center">
                            {!! $qrCode !!}
                        </div>
                        <p class="text-muted mt-3 text-center">
                            Escanea para consultar el estatus de tu denuncia
                        </p>
                    </div>

                    <!--begin::Buttons-->
                    <div class="d-flex flex-center gap-3">
                        <a href="{{ route('denuncias.pdf', $folio) }}" class="btn btn-primary">
                            <i class="ki-duotone ki-file fs-2 me-2"></i> Descargar comprobante PDF
                        </a>
                        <a href="{{ route('inicio') }}" class="btn btn-light">Volver al inicio</a>
                    </div>
                </div>
            </div>
            <!--end::Wrapper-->
        </div>
    @endsection
</x-auth-layout>
