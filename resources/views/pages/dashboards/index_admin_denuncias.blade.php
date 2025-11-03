<x-default-layout>

    @section('title')
        {{ __('Dashboard de Gestión de Denuncias') }}
    @endsection

    @section('breadcrumbs')
        {{-- Aquí irían las migas de pan --}}
    @endsection

    {{-- Área para los Contadores Clave --}}
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        
        {{-- Widget 1: Denuncias Recibidas (Estado 1) --}}
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials.widgets.admin_denuncias._widget-stat-card', [
                'count' => $recibidas_count,
                'title' => __('Denuncias Recibidas'),
                'color' => '#F1416C', // Rojo/Naranja para alerta inicial
                'link' => route('admin.denuncias.index', ['estado' => 1]), 
                'subtitle' => __('Pendientes de asignación inicial.')
            ])
        </div>
        
        {{-- Widget 2: Denuncias Turnadas (Estado 2) --}}
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials.widgets.admin_denuncias._widget-stat-card', [
                'count' => $turnadas_count,
                'title' => __('Expedientes Turnados'),
                'color' => '#009EF7', // Azul para el flujo iniciado
                'link' => route('admin.denuncias.index', ['estado' => 2]), 
                'subtitle' => __('En espera de inicio de trámite por el OIC.')
            ])
        </div>

        {{-- Widget 3: Denuncias Activas/En Trámite (Estados 2 y 3) --}}
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials.widgets.admin_denuncias._widget-stat-card', [
                'count' => $activas_count,
                'title' => __('Total de Casos Activos'),
                'color' => '#50CD89', // Verde para activos
                'link' => route('admin.denuncias.index', ['estado' => 'activos']), // Filtrar por estados 2 y 3
                'subtitle' => __('Denuncias en investigación o trámite.')
            ])
        </div>
        
        {{-- Widget 4: Denuncias Cerradas (Estado 4) --}}
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials.widgets.admin_denuncias._widget-stat-card', [
                'count' => $cerradas_count,
                'title' => __('Denuncias Concluidas'),
                'color' => '#7239EA', // Púrpura para conclusión
                'link' => route('admin.denuncias.index', ['estado' => 4]), 
                'subtitle' => __('Expedientes cerrados y archivados.')
            ])
        </div>

        {{-- Widget 5: Áreas de Responsabilidad (Catálogo de apoyo) --}}
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials.widgets.admin_denuncias._widget-stat-card', [
                'count' => $areas_activas_count,
                'title' => __('Áreas de Adscripción'),
                'color' => '#FFC700', // Amarillo para administración
                'link' => route('areas.index'), 
                'subtitle' => __('Catálogo total de OIC/Áreas activas.')
            ])
        </div>
        
    </div>
    
    {{-- ---------------------------------------------------------------------------------- --}}
    {{-- Sección de Visualización y Gráficas (Ejemplos Relevantes) --}}
    {{-- ---------------------------------------------------------------------------------- --}}

    <div class="row gx-5 gx-xl-10">
        {{-- Widget de Tabla: Denuncias Abiertas por Área (Importante para el Admin Denuncias) --}}
        <div class="col-xxl-6 mb-5 mb-xl-10">
             {{-- Este widget debería ser una tabla con las 5 áreas con más casos activos --}}
             @include('partials/widgets/tables/_widget-16') 
        </div>
        
        {{-- Gráfica de Línea/Barra: Tendencia de Denuncias por Mes --}}
        <div class="col-xl-6 mb-5 mb-xl-10">
            @include('partials/widgets/charts/_widget-8')
        </div>
    </div>
    
    {{-- Omitimos el resto de includes genéricos para mantener el foco en la data relevante --}}
    
</x-default-layout>