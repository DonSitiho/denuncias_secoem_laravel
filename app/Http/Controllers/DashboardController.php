<?php

namespace App\Http\Controllers;

use App\Repositories\DenunciasRepository;
use App\Services\DashboardMetricsService;
use App\Models\Denuncia;
use App\Models\Area;
use App\Models\UserDashboardConfig;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $denunciasRepo;
    protected $metricsService;

    const DEFAULT_WIDGETS = [
        'recibidas', 'turnadas', 'activas', 'cerradas', 'areas'
    ];

    public function __construct(DenunciasRepository $denunciasRepo, DashboardMetricsService $metricsService)
    {
        $this->denunciasRepo = $denunciasRepo;
        $this->metricsService = $metricsService;
    }

    /**
     * Determina el dashboard a mostrar basado en el rol del usuario autenticado.
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->roles->first();
            
            if ($role) {
                switch ($role->id) {
                    case 1: // Administrador (Super Admin)
                        // Vista: Dashboard de Administración Global (Placeholder)
                        return $this->indexAdminDenuncias();
                        
                    case 2: // Admin Denuncias (Recepción y Turno)
                        // Vista: Dashboard Operativo de Recepción
                        return $this->indexAdminDenuncias();
                        
                    case 3: // Usuario UAOIC (Unidad de Apoyo del Órgano Interno de Control)
                        // Vista: Dashboard de Casos Asignados
                        return $this->indexUAOIC();

                    case 4:// Usuario OIC (Órgano Interno de Control)
                        // Vista: Dashboard de Casos Asignados
                        return $this->indexIOC();

                    case 6: // Capturista
                        // Vista: Dashboard de Captura y Listado Básico (Placeholder)
                        return $this->indexCapturista();
                    
                    case 5: //Usuario UAOIC (unidad de apoyo de organos internos de control)
                        // Vista: Dashboard de Captura y Listado Básico (Placeholder)
                        return $this->indexUAOIC();
                }
            }
        }
        
        // Dashboard por defecto (si no está logueado o no tiene rol asignado)
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);
        return view('pages/dashboards.index');
    }

    // ------------------------------------------------------------------------
    // MÉTODOS DE DASHBOARD POR ROL
    // ------------------------------------------------------------------------

    /**
     * Muestra el dashboard del Administrador Global (ID 1).
     */
    public function indexAdminGlobal()
    {
        // Nota: Este dashboard aún no está construido. Usamos una vista por defecto.
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);
        return view('pages/dashboards.index');
    }

    /**
     * Muestra el dashboard del Capturista (ID 4).
     */
    public function indexCapturista()
    {
         // Obtener el total de denuncias por area del responsable OIC.
        $totalDenunciasArea = $this->denunciasRepo->totalDenunciasArea();
        $denunciasArea = $this->denunciasRepo->getDenunciasArea();
        
        // Obtener el total de denunicas turnardas al responsable OIC.
        $totalDenunciasTurnadaResponsable = $this->denunciasRepo->totalDenunciasTurnadasResponsable();
        // Obtener las denunicas turnardas al responsable OIC.
        $denunciasTurnadas = $this->denunciasRepo->getDenunciasTurnadas();

        // Obtener el total de denuncias terminadas por el responsble OIC.
        $totalDTR = $this->denunciasRepo->totalDenunciasTerminadasResponsable();
        // Obtener las denunicas terminadas por el responsable OIC.
        $denunciasTerminadas = $this->denunciasRepo->getDenunciasTerminadas();

        //Obtener el total de denuncias anonimas.
        $totalDenunciasAnonimas = $this->denunciasRepo->totalDenunciasAnonimas();
        $denunciasAnonimas = $this->denunciasRepo->getDenunciasAnonimas();

        //Obtener el total de denuncias no anonimas.
        $totalDenunciasNoAnonimas = $this->denunciasRepo->totalDenunciasNoAnonimas(); 
        $denunciasNoAnonimas = $this->denunciasRepo->getDenunciasNoAnonimas();

        $totalDenunciasEnTramite = $this->denunciasRepo->totalDenunciasEnTramite();
        $denunciasTramite = $this->denunciasRepo->getDenunciasEnTramite();

        //return json_encode($totalDenuncias);

        return view('pages/dashboards.indexOIC', compact('totalDenunciasArea', 'denunciasArea', 'totalDenunciasTurnadaResponsable', 'denunciasTurnadas', 'totalDTR', 'denunciasTerminadas', 'totalDenunciasAnonimas', 'denunciasAnonimas', 'totalDenunciasNoAnonimas', 'denunciasNoAnonimas', 'totalDenunciasEnTramite', 'denunciasTramite'));
    }

    /**
     * Muestra el dashboard del Usuario de la Unidad de Apoyo a los  Órganos Internos de Control (UAOIC - ID 5).
     */
    public function indexUAOIC () {
        
        $totalDenunciasArea = $this->denunciasRepo->totalDenunciasArea();
        $denunciasArea = $this->denunciasRepo->getDenunciasArea();

        $totalDenunciasTurnadaResponsable = $this->denunciasRepo->totalDenunciasTurnadasResponsable();
        $denunciasTurnadas = $this->denunciasRepo->getDenunciasTurnadas();
        
        $totalDTR = $this->denunciasRepo->totalDenunciasTerminadasResponsable();
        $denunciasTerminadas = $this->denunciasRepo->getDenunciasTerminadas();

        $totalDenunciasAnonimas = $this->denunciasRepo->totalDenunciasAnonimas();
        $denunciasAnonimas = $this->denunciasRepo->getDenunciasAnonimas();

        $totalDenunciasNoAnonimas = $this->denunciasRepo->totalDenunciasNoAnonimas(); 
        $denunciasNoAnonimas = $this->denunciasRepo->getDenunciasNoAnonimas();

        $totalDenunciasEnTramite = $this->denunciasRepo->totalDenunciasEnTramite();
        $denunciasTramite = $this->denunciasRepo->getDenunciasEnTramite();
        
        //return json_encode($denunciasArea);

        return view('pages/dashboards.index_uaoic_denuncias', compact('totalDenunciasArea', 'denunciasArea', 'totalDenunciasTurnadaResponsable', 'denunciasTurnadas', 'totalDTR', 'denunciasTerminadas', 'totalDenunciasAnonimas', 'denunciasAnonimas', 'totalDenunciasNoAnonimas', 'denunciasNoAnonimas', 'totalDenunciasEnTramite', 'denunciasTramite'));
    }

    /**
     * Muestra el dashboard del Usuario del Órgano Interno de Control (OIC - ID 3).
     */
    public function indexIOC()
    {
        // Obtener el total de denuncias por area del responsable OIC.
        $totalDenunciasArea = $this->denunciasRepo->totalDenunciasArea();
        $denunciasArea = $this->denunciasRepo->getDenunciasArea();
        
        // Obtener el total de denunicas turnardas al responsable OIC.
        $totalDenunciasTurnadaResponsable = $this->denunciasRepo->totalDenunciasTurnadasResponsable();
        // Obtener las denunicas turnardas al responsable OIC.
        $denunciasTurnadas = $this->denunciasRepo->getDenunciasTurnadas();

        // Obtener el total de denuncias terminadas por el responsble OIC.
        $totalDTR = $this->denunciasRepo->totalDenunciasTerminadasResponsable();
        // Obtener las denunicas terminadas por el responsable OIC.
        $denunciasTerminadas = $this->denunciasRepo->getDenunciasTerminadas();

        //Obtener el total de denuncias anonimas.
        $totalDenunciasAnonimas = $this->denunciasRepo->totalDenunciasAnonimas();
        $denunciasAnonimas = $this->denunciasRepo->getDenunciasAnonimas();

        //Obtener el total de denuncias no anonimas.
        $totalDenunciasNoAnonimas = $this->denunciasRepo->totalDenunciasNoAnonimas(); 
        $denunciasNoAnonimas = $this->denunciasRepo->getDenunciasNoAnonimas();

        $totalDenunciasEnTramite = $this->denunciasRepo->totalDenunciasEnTramite();
        $denunciasTramite = $this->denunciasRepo->getDenunciasEnTramite();

        //return json_encode($totalDenuncias);

        return view('pages/dashboards.indexOIC', compact('totalDenunciasArea', 'denunciasArea', 'totalDenunciasTurnadaResponsable', 'denunciasTurnadas', 'totalDTR', 'denunciasTerminadas', 'totalDenunciasAnonimas', 'denunciasAnonimas', 'totalDenunciasNoAnonimas', 'denunciasNoAnonimas', 'totalDenunciasEnTramite', 'denunciasTramite'));
    }


    public function indexBuzonNaranja()
    {
        
    }
    
    /**
     * Muestra el dashboard del Administrador de Denuncias (ID 2) con métricas operativas.
     */
    public function indexAdminDenuncias()
    {
        // 1. Cargar la configuración de orden (Persistencia)
        $config = UserDashboardConfig::firstOrCreate(
            ['user_id' => Auth::id()],
            ['widget_order' => self::DEFAULT_WIDGETS]
        );

        $widgetOrderKeys = $config->widget_order;

        // 2. Cargar las métricas de datos utilizando el servicio
        $stats = $this->metricsService->loadStatsData();

        //dd($stats);

        // 3. Crear el arreglo final de widgets en el orden guardado
        $orderedWidgets = [];
        
        foreach ($widgetOrderKeys as $key) {
            if (isset($stats[$key])) {
                $orderedWidgets[$key] = $stats[$key];
            }
        }
        
        // Añadir widgets nuevos al final
        $existingKeys = array_keys($orderedWidgets);
        foreach (self::DEFAULT_WIDGETS as $key) {
            if (!in_array($key, $existingKeys) && isset($stats[$key])) {
                $orderedWidgets[$key] = $stats[$key];
            }
        }

        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t'); // Último día del mes actual

        $chartData = $this->metricsService->getDailyDenunciasData($startDate, $endDate);

        $areaData = $this->metricsService->getAreaPerformanceData();
        $userData = $this->metricsService->getUserPerformanceData();

        //dd($orderedWidgets);

        return view('pages/dashboards.index_admin_denuncias', compact('orderedWidgets', 'stats', 'areaData', 'userData', 'chartData'));
    }
    
    /**
     * Lógica compartida para obtener los conteos de Denuncias.
     */
    public function saveOrder()
    {
        $order = request('order');
        

        UserDashboardConfig::updateOrCreate(
            ['user_id' => Auth::id()],
            ['widget_order' => $order]
        );

        return response()->json(['message' => 'Orden actualizado correctamente.']);
    }

    public function getDashboardData(Request $request)
    {
        // 1. Obtener y validar el rango de fechas (usar el mes actual si no se proporciona)
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));
        
        // 2. Llamar al servicio de métricas para obtener los datos agrupados
        $data = $this->metricsService->getDailyDenunciasData($startDate, $endDate);
        
        // 3. Devolver los datos en formato JSON para el frontend
        // Esto será consumido por el script del widget para actualizar el gráfico ApexCharts
        return response()->json($data);
    }

    public function getDashboardOicData(){

        // 1. Obtener el año actual y el usuario logueado
        $year = Carbon::now()->year;
        $user = Auth::user();

        // 2. Llamar al servicio de métricas para obtener los datos agrupados
        $data = $this->metricsService->getMonthDenunciasData($year, $user->id, $user->id_area);

        // 3. Devolver los datos en formato JSON para el frontend
        // Esto será consumido por el script del widget para actualizar el gráfico ApexCharts
        return response()->json($data);

    }

    public function getDashboardUaoicData () {
        // 1. Obtener el año actual y el usuario logueado
        $year = Carbon::now()->year;
        $user = Auth::user();

        // 2. Llamar al servicio de métricas para obtener los datos agrupados
        $data = $this->metricsService->getMonthDenunciasData($year, $user->id, $user->id_area);

        // 3. Devolver los datos en formato JSON para el frontend
        // Esto será consumido por el script del widget para actualizar el gráfico ApexCharts
        return response()->json($data);
    }
}