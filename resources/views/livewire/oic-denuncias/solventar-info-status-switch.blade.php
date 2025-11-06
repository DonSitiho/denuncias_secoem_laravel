<div class="form-check form-switch form-check-custom form-check-solid">
    <input 
        class="form-check-input" 
        type="checkbox" 
        id="status_{{ $infoId }}" 
        wire:click="toggle"
        @checked($activa)
    >
    <label class="form-check-label" for="status_{{ $infoId }}">
        <span class="badge badge-light-{{ $activa ? 'success' : 'danger' }}">
            {{ $activa ? 'Activo' : 'Inactivo' }}
        </span>
    </label>
</div>