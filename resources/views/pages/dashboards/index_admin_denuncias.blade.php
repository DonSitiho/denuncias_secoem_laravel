<x-default-layout>

    @section('title')
        {{ __('Dashboard de Gestión de Denuncias') }}
    @endsection

    <h3 class="fw-bold fs-4 mb-5">{{ __('Métricas Operativas y de Seguimiento') }}</h3>

    {{-- 🛑 1. ESTRUCTURA HTML ARRASTRABLE 🛑 --}}
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10 draggable-zone" id="dashboard_widgets_container">
        
        @foreach ($orderedWidgets as $key => $widgetData)
            
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 draggable" data-widget-id="{{ $key }}">
                
                <div class="draggable-handle">
                    @include('partials.widgets.admin_denuncias._widget-stat-card', [
                        'count' => $widgetData['count'],
                        'title' => $widgetData['title'],
                        'color' => $widgetData['color'],
                        'link' => $widgetData['link'],
                        'subtitle' => 'Prioridad: ' . ($loop->index + 1)
                    ])
                </div>
            </div>
            
        @endforeach
        
    </div>
    
    {{-- Contenedor de las gráficas estáticas --}}
    <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-6 mb-5 mb-xl-10">
             @include('partials/widgets/admin_denuncias/_widget-16') 
        </div>
        <div class="col-xl-6 mb-5 mb-xl-10">
            @include('partials/widgets/admin_denuncias/_widget-20')
        </div>
    </div>

    {{-- <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-6 mb-5 mb-xl-10">
             @include('partials/widgets/charts/_widget-20') 
        </div>
        <div class="col-xl-6 mb-5 mb-xl-10">
            @include('partials/widgets/charts/_widget-24')
        </div>
    </div>

    <div class="row gx-5 gx-xl-10">
        <div class="col-xxl-6 mb-5 mb-xl-10">
             @include('partials/widgets/charts/_widget-27') 
        </div>
        <div class="col-xl-6 mb-5 mb-xl-10">
            @include('partials/widgets/charts/_widget-28')
        </div>
    </div> --}}

    @push('scripts')
        <script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>

        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Objeto de inicialización de Metronic (Sortable/Draggable)
                var containers = document.querySelectorAll(".draggable-zone");
                
                if (containers.length === 0) {
                    return false;
                }
                
                // ⭐ 1. Inicialización de Draggable.Sortable
                // La librería expone el objeto Sortable dentro del namespace Draggable (Metronic)
                if (typeof Draggable === 'undefined' || !Draggable.Sortable) {
                     console.error("Error: Draggable.Sortable no está disponible. El arrastre no funcionará.");
                     return;
                }
                
                var swappable = new Draggable.Sortable(containers, {
                    draggable: ".draggable",
                    handle: ".draggable-handle",
                    mirror: {
                        appendTo: "body",
                        constrainDimensions: true
                    }
                });
                
                // 2. Event Listener para PERSISTENCIA al soltar el elemento
                swappable.on('sortable:stop', function (e) {

                // Metronic: obtener contenedor desde e.data
                const container = e.data ? e.data.newContainer || e.data.oldContainer : null;

                if (!container) {
                    console.warn("No container found on sortable:stop event");
                    return;
                }

                // Leer nuevo orden
                const newOrder = [...container.querySelectorAll('.draggable')]
                    .map(item => item.getAttribute('data-widget-id'));

                // Guardar con AJAX
                $.post("{{ route('admin.dashboard.saveOrder') }}", {
                    _token: '{{ csrf_token() }}',
                    order: newOrder
                })
                .done(() => toastr.success("Orden guardado"))
                .fail(() => toastr.error("Error al guardar"));
            });
            });
        </script>
    @endpush
    
</x-default-layout>