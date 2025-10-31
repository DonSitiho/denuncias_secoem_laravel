{{--
MODAL DE SOLICITAR INFORMACION FALTANTE DE DENUNCIA
--}}

<div class="modal fade" tabindex="-1" id="modal_solicitar_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Solicitar Informacion Faltante de la Denuncia') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Formulario que llama a la ruta POST de turno --}}
            <form action="{{ route('oic.solicitar-informacion', $denuncia->id_denuncia) }}" method="POST">
                @csrf

                <div class="modal-body">
                    <p class="mb-4">
                        {{ __('Ingrese la observación del responsable y el tipo de campo del que desea solicitar mas información de la denuncia.') }}
                        <br><br>
                        <span class="fw-bold">{{ __('Folio:') }} {{ $denuncia->folio_seguimiento }}.</span>
                        <span class="fw-bold">{{ __('Area Responsable:') }} {{ $areaResponsable->siglas }}.</span>
                    </p>

                    <div class="mb-3">
                        <label for="observacion_responsable" class="form-label required">{{ __('Observación 
                            Responsable') }}</label>
                        <textarea class="form-control form-control-solid" name="observacion_responsable" rows="3"
                            placeholder="Describa con el mayor detalle posible los campos faltantes de la denuncia" required></textarea>

                        @error('observacion_responsable')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror

                        {{-- 2. CAMPO OPCIONAL: USUARIO ESPECÍFICO --}}
                        <div class="mt-5">
                            <label for="tipo_campo" class="form-label required">{{ __('Tipo de Campo') }}</label>
                            <!--begin:Options-->
                            <div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                                @foreach($tipoCampos as $tipoCampo)
                                <!--begin:Option-->
                                <label class="d-flex flex-stack mb-5 cursor-pointer">
                                    <!--begin:Label-->
                                    <span class="d-flex align-items-center me-2">
                                        <!--begin:Info-->
                                        <span class="d-flex flex-column">
                                            <span class="fw-bold fs-6">{{ $tipoCampo }}</span>

                                            <span class="fs-7 text-muted"></span>
                                        </span>
                                        <!--end:Info-->
                                    </span>
                                    <!--end:Label-->

                                    <!--begin:Input-->
                                    <span class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" name="tipo_campo" value="{{ $tipoCampo }}"
                                            data-gtm-form-interact-field-id="0">
                                    </span>
                                    <!--end:Input-->
                                </label>
                                <!--end:Option-->
                                @endforeach
                            </div>
                            <!--end:Options-->

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    {{-- El botón está protegido por el middleware 'can:admin-denuncia-turnar' en la ruta --}}
                    <button type="submit" class="btn btn-success">{{ __('Solicitar Info') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>