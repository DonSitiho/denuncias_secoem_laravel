<x-default-layout>

    @section('title')
        {{ __('Recepción de Denuncias') }}
    @endsection

    @section('breadcrumbs')
        {{-- {{ Breadcrumbs::render('admin-denuncias.index') }} --}}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('Bandeja de Denuncias Recibidas') }}</span>
                <span class="text-muted mt-1 fw-semibold fs-7">{{ __('Listado y búsqueda de denuncias ciudadanas.') }}</span>
            </h3>
        </div>
        <div class="card-body py-4">
            @livewire('admin-denuncias.denuncia-table')
        </div>
        </div>

    @push('scripts')
        
        <script>
            // Script para inicializar cualquier funcionalidad
        </script>
    @endpush

</x-default-layout>