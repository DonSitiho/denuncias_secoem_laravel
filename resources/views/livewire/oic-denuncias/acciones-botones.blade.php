<div class="card-toolbar">

    @if ($denuncia->id_estado == 2)
    {{-- 1. Botón cambiar el estatus de la denucia a tramite  (Permiso: admin-denuncia-tramite) --}}
    <button wire:click="cambiarEnTramite({{ $denuncia->id_denuncia }})" type="button" class="btn btn-sm btn-light-primary">
        <i class="fas fa-check me-1"></i> Cambiar a Tramite
    </button>

    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_turno">
        <i class="fas fa-arrow-right-rotate me-1"></i>Turnar
    </button>

    @elseif ($denuncia->id_estado == 3)
        {{-- 2. Botón cambiar el estatus de la denucia a finalizado --}}
        <button wire:click="finalizar({{ $denuncia->id_denuncia }})" type="button" class="btn btn-sm btn-light-success">
            <i class="fas fa-check me-1"></i> Finalizar
        </button>

        {{-- 3. Botón/Modal de Solventar informacion (Permiso: admin-denuncia-turnar) --}}
        @can('oic-denuncia-solventar-info')
        {{-- El modal debe estar incluido como partial --}}
        <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
            data-bs-target="#modal_solicitar_info">
            <i class="fas fa-plus me-1"></i> Solventar Info
        </button>
        @endcan
    @endif
</div>