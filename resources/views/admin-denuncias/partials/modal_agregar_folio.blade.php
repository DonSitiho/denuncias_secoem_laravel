{{-- 
    MODAL PARA AGREGAR FOLIO CED A UNA DENUNCIA
--}}
<div class="modal fade" tabindex="-1" id="modal_folio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Asignar Folio Interno a la Denuncia') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            {{-- Formulario que llama a la ruta POST de turno --}}
            <form action="{{ route('st.agregar-folio', $denuncia->id_denuncia) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="modal-body">
                    <p class="mb-4">
                        {{ __('Ingresa el folio CED de la denuncia. Este folio será utilizado para su identificación y seguimiento interno.') }}                        
                        <br>
                        <span class="fw-bold">{{ __('Folio:') }} {{ $denuncia->folio_seguimiento }}</span>
                    </p>
                    
                    <div class="mb-3">
                        <label for="folio_ced" class="form-label required">{{ __('Folio CED') }}</label>
                        <input
                            type="text"
                            name="folio_ced" 
                            id="folio_ced" 
                            class="form-control form-control-solid"
                            placeholder="Ingrese el folio interno CED-01"
                            required
                        />
                        @error('folio_ced')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    {{-- El botón está protegido por el middleware 'can:admin-denuncia-turnar' en la ruta --}}
                    <button type="submit" class="btn btn-success">{{ __('Guardar Folio') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
