{{-- 
    MODAL AGREGAR ETIQUETA A UNA DENUNCIA
--}}
<div class="modal fade" tabindex="-1" id="modal_etiquetas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Etiquetar la Denuncia ') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Formulario que llama a la ruta POST de turno --}}
            <form action="{{ route('oic.etiquetar', $denuncia->id_denuncia) }}" method="POST">
                @csrf

                <div class="modal-body">
                    <p class="mb-4">
                        {{ __('Seleccione los tipos de etiquetas que desea asignarle a la denuncia.') }}
                        <br><br>
                        <span class="fw-bold">{{ __('Folio:') }} {{ $denuncia->folio_seguimiento }}</span>
                    </p>

                    <div class="mb-3">
                        <label for="etiquetas" class="form-label required">{{ __('Etiquetas') }}</label>
                        <!--begin:Options-->
                        <div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                            @foreach ($tipoEtiquetas as $etiqueta)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $etiqueta }}"
                                        id="etiquetas" name="etiquetas[]" />
                                    <label class="form-check-label" for="etiquetas">
                                        {{ $etiqueta }}
                                    </label>
                                </div><br>
                            @endforeach
                        </div>
                        <!--end:Options-->
                        @error('etiqueta')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    {{-- El botón está protegido por el middleware 'can:admin-denuncia-turnar' en la ruta --}}
                    <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
