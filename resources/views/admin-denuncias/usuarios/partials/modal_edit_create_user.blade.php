{{-- Este archivo YA DEBE ESTAR PEGADO DENTRO de user-table.blade.php --}}
<div class="modal fade" tabindex="-1" id="modal_edit_create_user" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if ($isEditing)
                        {{ __('Editar Usuario: ') }} {{ $editingUser['name'] ?? '' }}
                    @else
                        {{ __('Crear Nuevo Usuario') }}
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form wire:submit.prevent="saveUser">
                <div class="modal-body">
                    
                    {{-- Mostrar errores de validación de Livewire --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ __('Por favor, corrija los errores del formulario.') }}
                        </div>
                    @endif

                    <input type="hidden" wire:model="editingUser.id">

                    <div class="row">
                        {{-- Nombre Completo --}}
                        <div class="col-md-6 mb-4">
                            <label class="form-label required">{{ __('Nombre Completo') }}</label>
                            <input type="text" wire:model.defer="editingUser.name" class="form-control @error('editingUser.name') is-invalid @enderror" required />
                            @error('editingUser.name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Correo / Usuario --}}
                        <div class="col-md-6 mb-4">
                            <label class="form-label required">{{ __('Usuario (Correo)') }}</label>
                            <div class="input-group">
                                <input type="email" wire:model.defer="editingUser.email" class="form-control @error('editingUser.email') is-invalid @enderror" required />
                                <span class="input-group-text">@denuncias.secoem.gob.mx</span>
                            </div>
                            @error('editingUser.email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        {{-- Contraseña --}}
                        <div class="col-md-6 mb-4">
                            <label class="form-label {{ $isEditing ? '' : 'required' }}">
                                {{ $isEditing ? __('Nueva Contraseña (Dejar vacío para mantener)') : __('Contraseña') }}
                            </label>
                            <input type="password" wire:model.defer="editingUser.password" class="form-control @error('editingUser.password') is-invalid @enderror" />
                            @error('editingUser.password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Área de Adscripción --}}
                        <div class="col-md-6 mb-4" wire:ignore> 
                            <label class="form-label required">{{ __('Área de Adscripción') }}</label>
                            <select 
                                wire:model.defer="editingUser.id_area" 
                                class="form-select @error('editingUser.id_area') is-invalid @enderror" 
                                data-control="select2" 
                                required
                            >
                                <option value="">{{ __('Seleccione el área...') }}</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id_area }}">[{{ $area->siglas }}] {{ $area->nombre_area }}</option>
                                @endforeach
                            </select>
                            @error('editingUser.id_area') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        {{-- Estado Activo (Solo en edición) --}}
                        @if ($isEditing)
                        <div class="col-md-6 mb-4">
                            <label class="form-label">{{ __('Estado del Usuario') }}</label>
                            <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                <input class="form-check-input" type="checkbox" wire:model.defer="editingUser.is_active" id="active_status_edit" />
                                <label class="form-check-label" for="active_status_edit">
                                    {{ $editingUser['is_active'] ? 'Activo' : 'Inactivo' }}
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    <button type="submit" class="btn btn-primary">
                        {{ $isEditing ? __('Guardar Cambios') : __('Crear Usuario') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>