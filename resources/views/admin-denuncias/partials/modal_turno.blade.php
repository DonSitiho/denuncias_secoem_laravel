{{-- 
    MODAL DE TURNO DE DENUNCIA 
--}}
<div class="modal fade" tabindex="-1" id="modal_turno">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Turnar Denuncia a OIC') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            {{-- Formulario que llama a la ruta POST de turno --}}
            <form action="{{ route('admin.denuncias.turnar', $denuncia->id_denuncia) }}" method="POST">
                @csrf
                
                <div class="modal-body">
                    <p class="mb-4">
                        {{ __('Seleccione al Usuario del Órgano Interno de Control (OIC) al que desea asignar esta denuncia.') }}
                        <br>
                        <span class="fw-bold">{{ __('Folio:') }} {{ $denuncia->folio_seguimiento }}</span>
                    </p>
                    
                    <div class="mb-3">
                        <label for="id_responsable_secoem" class="form-label required">{{ __('Responsable OIC') }}</label>
                        <select 
                            name="id_responsable_secoem" 
                            id="id_responsable_secoem" 
                            class="form-select form-select-solid" 
                            data-control="select2" 
                            data-dropdown-parent="#modal_turno"
                            required
                        >
                            <option value="">{{ __('Seleccionar responsable...') }}</option>
                            
                            {{-- 
                                NOTA: La variable $usuariosOIC debe ser pasada a la vista show.blade.php 
                                y contener solo usuarios con el rol 'usuario-oic'. (Trabajo del D2 en show).
                            --}}
                            @if(isset($usuariosOIC))
                                @foreach($usuariosOIC as $usuario)
                                    <option 
                                        value="{{ $usuario->id }}"
                                        {{ ($denuncia->id_responsable_secoem == $usuario->id) ? 'selected' : '' }}
                                    >
                                        {{ $usuario->name }} ({{ $usuario->email }})
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>{{ __('Cargando usuarios...') }}</option>
                            @endif

                        </select>
                        
                        {{-- Muestra error de validación --}}
                        @error('id_responsable_secoem')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    {{-- El botón está protegido por el middleware 'can:admin-denuncia-turnar' en la ruta --}}
                    <button type="submit" class="btn btn-success">{{ __('Turnar y Notificar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
