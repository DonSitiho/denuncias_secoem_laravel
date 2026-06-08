<x-default-layout>
    @section('title')
        {{ __('Buzon Naranja Denuncias Historial') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('Bandeja de Historial de Denuncias') }}</span>
                <span class="text-muted mt-1 fw-semibold fs-7">{{ __('Listado y búsqueda de denuncias ciudadanas.') }}</span>
            </h3>
        </div>
        <div class="card-body py-4">
            {{-- 
                INTEGRACIÓN DEL COMPONENTE LIVEWIRE 
                Aquí Livewire se encarga de: 
                1. La caja de búsqueda en tiempo real.
                2. La paginación y la tabla.
            --}}
            @livewire('buzon-naranja-denuncias.denuncias-historial-table')
        </div>
    </div>

</x-default-layout>