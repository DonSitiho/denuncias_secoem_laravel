<div class="card-toolbar">

    @if ($estatus == 2)
    {{-- 1. Botón cambiar el estatus de la denucia a tramite  (Permiso: admin-denuncia-tramite) --}}
    <button wire:click="cambiarEnTramite()" type="button" class="btn btn-sm btn-light-primary me-2">
        <i class="fas fa-check me-1"></i> Cambiar a Tramite
    </button>

    @elseif ($estatus == 3)
        {{-- 2. Botón cambiar el estatus de la denucia a finalizado --}}
        <button wire:click="finalizar()" type="button" class="btn btn-sm btn-light-success me-2">
            <i class="fas fa-check me-1"></i> Finalizar
        </button>
        {{-- 3. Botón/Modal de Solventar informacion (Permiso: admin-denuncia-turnar) --}}
        
    @endif
</div>