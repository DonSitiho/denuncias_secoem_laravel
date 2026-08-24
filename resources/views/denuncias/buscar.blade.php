<x-auth-layout>
    @section('content')
        <style>
            body {
                background-image: url('/assets/media/auth/bg10.jpg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('/assets/media/auth/bg10-dark.jpeg');
            }
        </style>
        <link rel="stylesheet" href="/assets/css/botonesGob.css">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="https://michoacan.gob.mx/cdn/img/logos/dependencias/secoem.svg" alt="">
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="/assets/media/illustrations/sigma-1-dark.png" alt="">
                    <!--end::Image-->

                    <!--begin::Title-->
                    <h1 class=" fs-2qx fw-bold text-center mb-7" style="color: #6A0F49;">
                        Sistema de Seguimiento de Denuncias
                    </h1>
                    <!--end::Title-->

                    <!--begin::Text-->
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        Ingresa el <strong>folio</strong> y el <strong>código de seguimiento</strong> <br>
                        que se te proporcionó al momento de realizar tu denuncia <br>
                        para consultar su estado actual.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10"
                    style="
                            border-radius: 12px;
                            box-shadow: 0 6px 18px rgba(75, 43, 65, 0.15);
                            ">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

                            <!--begin::Form-->
                            <form class="form w-100 mb-13" novalidate="novalidate" id="kt_buscar_denuncia_form">
                                @csrf
                                <!--begin::Icon-->
                                {{-- <div class="text-center mb-10">
                                    <img alt="Logo" class="mh-125px"
                                        src="https://michoacan.gob.mx/cdn/img/logos/dependencias/secoem.svg">
                                </div> --}}
                                <!--end::Icon-->

                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class=" mb-5" style="color: #6A0F49;">
                                        Consulta tu Denuncia
                                    </h1>
                                    <!--end::Title-->

                                    @php
                                        $digitos = $codigo ? str_split($codigo) : [];
                                        $delQr = !empty($folio) && !empty($codigo);
                                    @endphp
                                    <!--begin::Folio Input-->
                                    <div class="mb-10">
                                        <label class="form-label fw-semibold text-gray-700 fs-6 mb-3">Folio de
                                            Denuncia</label>
                                        <input type="text" name="folio"
                                            class="form-control form-control-lg text-center"
                                            value="{{ old('folio', $folio) }}" {{ $delQr ? 'readonly' : '' }}
                                            placeholder="Ingresa el folio" required
                                            oninput="this.value = this.value.toUpperCase();">
                                        <div class="text-muted mt-2 fs-7">Ingresa el folio que se te asignó al registrar tu
                                            denuncia</div>
                                    </div>
                                    <!--end::Folio Input-->

                                    <!--begin::Code Input-->
                                    <div class="mb-5">
                                        <label class="form-label fw-semibold text-gray-700 fs-6 mb-3">Código de
                                            Seguimiento</label>
                                        <div class="d-flex justify-content-center gap-2 mb-3">
                                            <!-- solo conertir texto en mayusculas-->
                                            <input type="text" name="code_1" maxlength="1"
                                                value="{{ $digitos[0] ?? '' }}" {{ $delQr ? 'readonly' : '' }}
                                                class="form-control form-control-lg w-60px text-center code-input" required
                                                autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                            <input type="text" name="code_2" maxlength="1"
                                                value="{{ $digitos[1] ?? '' }}" {{ $delQr ? 'readonly' : '' }}
                                                class="form-control form-control-lg w-60px text-center code-input" required
                                                autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                            <input type="text" name="code_3" maxlength="1"
                                                value="{{ $digitos[2] ?? '' }}" {{ $delQr ? 'readonly' : '' }}
                                                class="form-control form-control-lg w-60px text-center code-input" required
                                                autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                            <input type="text" name="code_4" maxlength="1"
                                                value="{{ $digitos[3] ?? '' }}" {{ $delQr ? 'readonly' : '' }}
                                                class="form-control form-control-lg w-60px text-center code-input" required
                                                autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                            <input type="text" name="code_5" maxlength="1"
                                                value="{{ $digitos[4] ?? '' }}" {{ $delQr ? 'readonly' : '' }}
                                                class="form-control form-control-lg w-60px text-center code-input" required
                                                autocomplete="off" oninput="this.value = this.value.toUpperCase();">
                                        </div>
                                        <div class="text-muted mt-2 fs-7">Ingresa el código de 5 dígitos que se te
                                            proporcionó</div>
                                    </div>
                                    <!--end::Code Input-->
                                </div>
                                <!--end::Heading-->

                                <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                                <!--begin::Submit-->
                                <div class="d-flex flex-column align-items-center gap-3 mt-5">
                                    <button type="submit" id="kt_buscar_denuncia_submit"
                                        class="btn btn-lg btn-guinda fw-bold w-100">
                                        <span class="indicator-label">
                                            Buscar Denuncia
                                        </span>
                                        <span class="indicator-progress">
                                            Buscando... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>

                                    <a href="{{ route('inicio') }}" class="btn btn-light-guinda w-100">

                                        Volver al inicio
                                    </a>
                                </div>

                                <!--end::Submit-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
    @endsection

    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('kt_buscar_denuncia_form');
                const submitButton = document.getElementById('kt_buscar_denuncia_submit');
                const codeInputs = document.querySelectorAll('.code-input');

                // Función para manejar el movimiento automático entre inputs de código
                codeInputs.forEach((input, index) => {
                    input.addEventListener('input', function() {
                        if (this.value.length === 1 && index < codeInputs.length - 1) {
                            codeInputs[index + 1].focus();
                        }
                    });

                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
                            codeInputs[index - 1].focus();
                        }
                    });
                });

                // Manejar el envío del formulario
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const folio = form.querySelector('input[name="folio"]').value;
                    const code = Array.from(codeInputs).map(input => input.value).join('');

                    if (!folio || code.length !== 5) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Datos incompletos',
                            text: 'Por favor, ingresa el folio y el código completo de 5 dígitos.',
                            confirmButtonColor: '#009EF7'
                        });
                        return;
                    }

                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;

                    // Generamos el token de reCAPTCHA v3 justo antes de enviar

                    grecaptcha.ready(function() {
                        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                                action: 'buscarDenunciaFolio'
                            })
                            .then(function(token) {

                                fetch("{{ route('denuncias.buscarDenunciaFolio') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            folio: folio,
                                            codigo: code,
                                            recaptcha_token: token
                                        })
                                    })
                                    .then(async response => {
                                        // Intentar parsear JSON de forma segura
                                        const text = await response.text();
                                        let data;
                                        try {
                                            data = JSON.parse(text);
                                        } catch (err) {
                                            
                                            throw new Error(
                                                'Respuesta del servidor no válida.');
                                        }
                                        return data;
                                    })
                                    .then(data => {
                                        submitButton.removeAttribute('data-kt-indicator');
                                        submitButton.disabled = false;

                                        if (data.success) {
                                            window.location.href = data.redirect_url;
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Denuncia no encontrada',
                                                text: data.message ||
                                                    'No se encontró ninguna denuncia con los datos proporcionados.',
                                                confirmButtonColor: '#F64E60'
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        submitButton.removeAttribute('data-kt-indicator');
                                        submitButton.disabled = false;

                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error del sistema',
                                            text: 'Ocurrió un error al buscar la denuncia. Por favor, intenta nuevamente.',
                                            confirmButtonColor: '#F64E60'
                                        });
                                    });
                            });
                    });
                });
            });
        </script>
    @endpush
</x-auth-layout>
