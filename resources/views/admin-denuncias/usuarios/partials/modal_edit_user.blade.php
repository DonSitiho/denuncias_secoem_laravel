{{-- admin-denuncias/usuarios/partials/modal_edit_user.blade.php --}}
<div class="modal fade" tabindex="-1" id="modal_edit_user" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Editar Usuario:') }} {{ $editingUser->name ?? '' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            {{-- Formulario para Livewire (usando wire:submit para manejar el guardado) --}}
            <form wire:submit.prevent="saveEdit">
                <div class="modal-body">
                    {{-- 
                        NOTA: Este formulario debe cargarse con los datos de $this->editingUser 
                        usando wire:model="editingUser.name", wire:model="editingUser.email", etc.
                    --}}
                    @if ($editingUser)
                        <input type="hidden" wire:model="editingUser.id" value="{{ $editingUser->id }}">

                        <div class="row">
                            {{-- Nombre Completo --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label required">{{ __('Nombre Completo') }}</label>
                                <input type="text" wire:model="editingUser.name" class="form-control" required />
                            </div>
                            
                            {{-- Correo / Usuario --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label required">{{ __('Usuario (Correo)') }}</label>
                                <div class="input-group">
                                    <input type="text" wire:model="editingUser.email" class="form-control" required />
                                    <span class="input-group-text">@denuncias.secoem.gob.mx</span>
                                </div>
                                {{-- NOTA: La validación de unicidad debe hacerse en el método Livewire::saveEdit --}}
                            </div>

                            {{-- Área de Adscripción --}}
                            <div class="col-md-6 mb-4" wire:ignore>
                                <label class="form-label required">{{ __('Área de Adscripción') }}</label>
                                <select wire:model="editingUser.id_area" class="form-select" data-control="select2" required>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id_area }}">[{{ $area->siglas }}] {{ $area->nombre_area }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            {{-- Estado Activo --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">{{ __('Estado del Usuario') }}</label>
                                <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        wire:model="editingUser.is_active" 
                                        id="active_status_edit"
                                    />
                                    <label class="form-check-label" for="active_status_edit">
                                        {{ $editingUser->is_active ? 'Activo' : 'Inactivo' }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">Cargando datos...</div>
                    @endif
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                    <button type="submit" class="btn btn-warning">{{ __('Guardar Cambios') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Script JS para abrir el modal al escuchar el evento Livewire
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('open-edit-modal', (event) => {
            // Asegurar que Select2 se inicialice correctamente con los datos cargados
            $('#modal_edit_user').modal('show');
            
            // Re-inicializar Select2 en el modal para el campo Área
            $('#modal_edit_user').find('select[data-control="select2"]').select2({
                 dropdownParent: $('#modal_edit_user')
            }).val(event.user.id_area).trigger('change');
        });
    });
</script>