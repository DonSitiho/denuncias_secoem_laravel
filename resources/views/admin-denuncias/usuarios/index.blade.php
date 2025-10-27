<x-default-layout>

    @section('title')
        {{ __('Gestión de Usuarios Internos') }}
    @endsection

    <div class="card shadow-sm">
        <div class="card-header border-0 pt-6">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{ __('Usuarios de Área Asignada') }}</span>
                <span class="text-muted mt-1 fw-semibold fs-7">{{ __('Solo se muestran usuarios vinculados a un Área.') }}</span>
            </h3>
            <div class="card-toolbar">
                {{-- Botón para abrir el modal de creación de usuario --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_create_user">
                    <i class="fas fa-user-plus me-2"></i> {{ __('Crear Nuevo Usuario') }}
                </button>
            </div>
        </div>

        <div class="card-body py-4">
            {{-- Integración del componente Livewire --}}
            @livewire('admin-denuncias.user-table')
        </div>
    </div>
    
    {{-- Inclusión del Modal de Creación --}}
    @include('admin-denuncias.usuarios.partials.modal_create_user')

    @push('scripts')
        <script>
            // Script para inicializar Select2 dentro del modal (si es necesario)
            document.addEventListener('livewire:initialized', () => {
                // Evento que escucha la inicialización de Livewire para Select2
                $('#modal_create_user').on('shown.bs.modal', function () {
                    $(this).find('select[data-control="select2"]').select2({
                        dropdownParent: $('#modal_create_user')
                    });
                });
            });
        </script>
    @endpush

</x-default-layout>