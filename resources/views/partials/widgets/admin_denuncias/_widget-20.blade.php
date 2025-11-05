<div class="card card-flush h-xl-100">
    <div class="card-header py-5">
        <h3 class="card-title fw-bold text-gray-800">{{ __('Denuncias Mensuales') }}</h3>
        <div class="card-toolbar">
            <div id="kt_chart_widget_20_date_range" class="btn btn-sm btn-light d-flex align-items-center px-4">
                <div class="text-gray-600 fw-bold">{{ $chartData['periodo'] ?? 'Seleccione un rango...' }}</div>
                {!! getIcon('calendar-8', 'fs-1 ms-2 me-0') !!}
            </div>
        </div>
    </div>
    <div class="card-body d-flex justify-content-between flex-column px-5 pt-1 pb-0"> 
        
        <div class="d-flex flex-wrap d-grid gap-5 px-5 mb-5"> 
            
            {{-- Item 1: Total de Denuncias en el Período --}}
            <div class="me-md-2">
                <div class="d-flex mb-2">
                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2" id="total-denuncias-periodo">{{ $chartData['total'] ?? 0 }}</span>
                </div>
                <span class="fs-6 fw-semibold text-gray-500">{{ __('Total en el Período') }}</span>
            </div>
            
            <div class="border-start-dashed border-end-dashed border-start border-end border-gray-300 px-5 ps-md-10 pe-md-7 me-md-5">
                <div class="d-flex mb-2">
                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">N/A</span>
                </div>
                <span class="fs-6 fw-semibold text-gray-500">{{ __('Promedio Diario') }}</span>
            </div>
            
            <div class="m-0">
                <div class="d-flex align-items-center mb-2">
                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">N/A</span>
                </div>
                <span class="fs-6 fw-semibold text-gray-500">{{ __('Cerradas vs. Activas') }}</span>
            </div>
        </div>
        <div id="kt_charts_widget_20" class="min-h-auto px-5" style="height: 300px"></div>
        </div>
    </div>
<script>
    // Almacenamos la instancia del gráfico
    let chartWidget20Instance = null;

    // Función de inicialización del Chart (Usando ApexCharts)
    function initChartWidget20(labels, seriesData) {
        
        if (chartWidget20Instance) {
            chartWidget20Instance.destroy(); 
            chartWidget20Instance = null; // Resetear la instancia
        }
        
        var element = document.getElementById('kt_charts_widget_20');
        if (!element) { return; }

        var height = parseInt(KTUtil.css(element, 'height'));
        var chart = new ApexCharts(element, {
            series: [{
                name: 'Denuncias',
                data: seriesData
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                height: height,
                toolbar: { show: false },
                // Asegurar que el redibujado sea limpio
                animations: { enabled: true, easing: 'linear', speed: 200 } 
            },
            plotOptions: {
                bar: { horizontal: false, columnWidth: ['40%'], borderRadius: 5 }
            },
            legend: { show: false },
            dataLabels: { enabled: false },
            stroke: { show: true, width: 2, colors: ['transparent'] },
            xaxis: {
                categories: labels,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: KTUtil.getCssVariableValue('--kt-gray-500'), fontSize: '12px' } }
            },
            yaxis: {
                min: 0,
                // ⭐ CLAVE: Forzamos tickAmount y usamos Math.ceil() en el formatter
                tickAmount: 5, // Muestra 6 líneas (0 a 5) o más si el máximo es alto
                labels: { 
                    formatter: function (val) {
                        return parseInt(val.toFixed(0)); // Asegura que sean enteros
                    },
                    style: { colors: KTUtil.getCssVariableValue('--kt-gray-500'), fontSize: '12px' } 
                }
            },
            fill: { opacity: 1 },
            tooltip: { y: { formatter: function (val) { return parseInt(val) + " Denuncias" } } }
        });
        chart.render();
        chartWidget20Instance = chart;
        return chart;
    }

    // Función de carga y actualización AJAX
    function loadChartData(start, end) {
        
        $('#kt_chart_widget_20_date_range').find('.text-gray-600').text(moment(start).format('DD MMM YYYY') + ' - ' + moment(end).format('DD MMM YYYY'));

        $.ajax({
            url: '{{ route("admin.dashboard.data") }}',
            method: 'GET',
            data: { start_date: start, end_date: end },
            success: function(data) {
                
                // Actualizar contadores totales
                $('#total-denuncias-periodo').text(data.total);
                
                // ⭐ 1. Inicializamos con los datos nuevos
                initChartWidget20(data.labels, data.series); 

                // 2. Ajuste fino del eje Y para evitar decimales en el máximo:
                const maxCount = Math.max(...data.series, 1); // Asegura que el mínimo sea 1 si no hay data
                chartWidget20Instance.updateOptions({
                     yaxis: { 
                         max: Math.ceil(maxCount * 1.1) || 5 // Escalar al entero superior más cercano (+10%)
                     }
                });
            },
            error: function() {
                 toastr.error('Fallo al cargar los datos del gráfico.');
            }
        });
    }

    // Lógica del Filtro de Fechas (Daterangepicker)
    document.addEventListener('DOMContentLoaded', function () {
        
        // ⭐ Rango por defecto: Últimos 7 días
        const endInitial = moment();
        const startInitial = moment().subtract(6, 'days');
        
        const dateRangeElement = document.getElementById('kt_chart_widget_20_date_range');
        if (dateRangeElement) {
            
            $(dateRangeElement).daterangepicker({
                startDate: startInitial, 
                endDate: endInitial,
                opens: 'left',
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 Días': [moment().subtract(6, 'days'), moment()], 
                    'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                locale: { 
                    applyLabel: "Aplicar",
                    cancelLabel: "Cancelar",
                    customRangeLabel: "Rango Personalizado",
                    daysOfWeek: moment.weekdaysMin(),
                    monthNames: moment.monthsShort(),
                    firstDay: 1,
                    format: 'DD/MM/YYYY'
                }
            }, function(start, end, label) {
                loadChartData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            });
            
            // 2. Carga inicial: Llamamos a la función de carga con el rango por defecto
            loadChartData(startInitial.format('YYYY-MM-DD'), endInitial.format('YYYY-MM-DD'));
        }
    });
</script>