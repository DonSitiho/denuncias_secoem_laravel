<!--begin::Chart widget 18-->
<div class="card card-flush h-xl-100">
    <!--begin::Header-->
    <div class="card-header pt-7">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">Denunicas</span>
            <span class="text-gray-500 mt-1 fw-semibold fs-6">Total de denuncias turnadas por mes</span>
        </h3>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
        <!--begin::Chart-->
        <div class="card card-bordered">
            <div class="card-body">
                <div id="kt_charts_widget_18" class="min-h-auto px-5" style="height: 350px; width: 650px;"></div>
            </div>
        </div>
        <!--end::Chart-->
    </div>
    <!--end::Body-->
</div>
<!--end::Chart widget 18-->

<script>

    // Almacenamos la instancia del gráfico
    let chartWidget18Instance = null;

    // Función de inicialización del Chart (Usando ApexCharts)
    function initChartWidget18(labels, seriesData) {
        
        if (chartWidget18Instance) {
            chartWidget18Instance.destroy(); 
            chartWidget18Instance = null; // Resetear la instancia
        }
        
        var element = document.getElementById('kt_charts_widget_18');
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
                height: '100%',
                width: '100%',
                toolbar: { show: false },
                // Asegurar que el redibujado sea limpio
                animations: { enabled: true, easing: 'linear', speed: 200 } 
            },
            responsive: [{
                breakpoint: undefined,
                options: {
                chart: {
                    width: '100%',
                    height: '100%'
                }
                }
            }],
            plotOptions: {
                bar: { horizontal: false, columnWidth: ['60%'], borderRadius: 5 }
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
        chartWidget18Instance = chart;
        return chart;
    }

    // Función de carga y actualización AJAX
    function loadChartData() {
        
        $.ajax({
            url: '{{ route("oic.dashboard.data") }}',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                
                
                // ⭐ 1. Inicializamos con los datos nuevos
                initChartWidget18(data.labels, data.series); 

                // 2. Ajuste fino del eje Y para evitar decimales en el máximo:
                const maxCount = Math.max(...data.series, 1); // Asegura que el mínimo sea 1 si no hay data
                chartWidget18Instance.updateOptions({
                    yaxis: { 
                         max: Math.round(maxCount * 1.1) || 5 // Escalar al entero superior más cercano (+10%)
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
                
        // 2. Carga inicial: Llamamos a la función de carga con el rango por defecto
        loadChartData();

    });

</script>