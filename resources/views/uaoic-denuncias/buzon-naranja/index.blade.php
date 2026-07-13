<x-default-layout>
    @section('title')
        {{ __('Mis de Denuncias Buzón Naranja') }}
    @endsection

    <div class="card">
        <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('Bandeja de Mis Denuncias de Buzón Naranja Recibidas') }}</span>
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
            @livewire('uaoic-denuncias.mis-denuncias-bn-table')
        </div>
    </div>

</x-default-layout>