{{-- 
    MODAL DE TURNO DE DENUNCIA BUZON NARANJA
--}}
<div class="modal fade" tabindex="-1" id="modal_turno">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Turnar Denuncia a Área Responsable') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            {{-- Formulario que llama a la ruta POST de turno --}}
            <form action="{{ route('buzon-naranja.denuncias.turnar', $denuncia->id_denuncia) }}" method="POST">
                @csrf
                
                <div class="modal-body">
                    <p class="mb-4">
                        {{ __('Seleccione el área/usuario responsable al que desea asignar esta denuncia.') }}                        
                        <br>
                        <span class="fw-bold">{{ __('Folio:') }} {{ $denuncia->folio_seguimiento }}</span>
                    </p>
                    
                    <div class="mb-3">
                        <label for="id_area_responsable" class="form-label required">{{ __('Área Responsable') }}</label>
                        <select 
                            name="id_area_responsable" 
                            id="id_area_responsable" 
                            class="form-select form-select-solid" 
                            data-control="select2" 
                            data-dropdown-parent="#modal_turno"
                            required
                        >
                        <option value="">{{ __('Seleccionar Área responsable...') }}</option>                            
                            
                            {{-- Iteramos sobre $areaResponsable cargadas en el controlador show --}}
                            @if(isset($areaResponsable))
                                @foreach($areaResponsable as $area)
                                    <option 
                                        value="{{ $area->id_area }}"
                                        {{ ($denuncia->id_area_responsable == $area->id_area) ? 'selected' : '' }}
                                    >
                                        [{{ $area->siglas }}] {{ $area->nombre_area }}
                                    </option>
                                @endforeach
                            @endif

                        </select>
                        
                        @error('id_area_responsable')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror

                        {{-- 2. CAMPO OPCIONAL: USUARIO ESPECÍFICO --}}
                        <div class="mt-5">
                            <label for="id_responsable" class="form-label">{{ __('Usuario Específico (Opcional)') }}</label>
                            {{-- ⬅️ CAMBIO DE NOMBRE DE CAMPO: Ahora apunta a id_responsable --}}
                            <select 
                                name="id_responsable" 
                                id="id_responsable" 
                                class="form-select form-select-solid"
                                data-control="select2" 
                                data-dropdown-parent="#modal_turno"
                            >
                                <option value="">{{ __('No asignar a usuario específico (Solo al Área)...') }}</option>
                                {{-- 
                                    NOTA: Esta lista debe cargarse/filtrarse por JavaScript al seleccionar un área.
                                    Mientras tanto, se puede cargar la lista completa de usuarios OIC aquí si está disponible en $usuariosOIC:
                                --}}
                                @if(isset($usuariosUAOIC))
                                    @foreach($usuariosUAOIC as $usuario)
                                        <option 
                                            value="{{ $usuario->id }}"
                                            {{ ($denuncia->id_responsable == $usuario->id) ? 'selected' : '' }}
                                        >
                                            {{ $usuario->name }} ({{ $usuario->email }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    {{-- El botón está protegido por el middleware 'can:admin-denuncia-turnar' en la ruta --}}
                    <button type="submit" class="btn btn-success">{{ __('Turnar Denuncia') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>