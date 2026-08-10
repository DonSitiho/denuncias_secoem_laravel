<div class="card-toolbar">

    @if ($estatus == 2)
        {{-- 1. Botón cambiar el estatus de la denucia a tramite  (Permiso: uaoic-denuncia-tramite) --}}
        <button wire:click="cambiarEnTramite()" type="button"
            class="btn btn-sm btn-light-primary">
            <i class="fas fa-check me-1"></i> Cambiar a Tramite
        </button>
        
    @elseif ($estatus == 3)
        {{-- 2. Botón cambiar el estatus de la denucia a finalizado --}}
        <button wire:click="finalizar()" type="button" class="btn btn-sm btn-light-success">
            <i class="fas fa-check me-1"></i> Finalizar
        </button>
    @endif

</div>
