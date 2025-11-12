<?php

namespace App\Services;

use App\Models\Denuncia;
use App\Models\Area;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class DashboardMetricsService
{
    /**
     * Lógica compartida para obtener los conteos de Denuncias para el dashboard.
     * @return array
     */
    public function loadStatsData()
    {
        return [
            'recibidas' => [
                'count' => Denuncia::where('id_estado', 1)->count(),
                'title' => 'Denuncias Recibidas (Pendientes de Turnar)', 'color' => '#F1416C',
                'link' => Route::has('admin.denuncias.index') ? route('admin.denuncias.index', ['estado' => 1]) : '#',
            ],
            'turnadas' => [
                'count' => Denuncia::where('id_estado', 2)->count(),
                'title' => 'Expedientes Turnados', 'color' => '#009EF7',
                'link' => Route::has('admin.denuncias.index') ? route('admin.denuncias.index', ['estado' => 2]) : '#',
            ],
            'activas' => [
                'count' => Denuncia::whereIn('id_estado', [2, 3])->count(),
                'title' => 'Casos Activos', 'color' => '#50CD89',
                'link' => Route::has('admin.denuncias.index') ? route('admin.denuncias.index', ['estado' => 'activos']) : '#',
            ],
            'cerradas' => [
                'count' => Denuncia::where('id_estado', 4)->count(),
                'title' => 'Denuncias Concluidas', 'color' => '#7239EA',
                'link' => Route::has('admin.denuncias.index') ? route('admin.denuncias.index', ['estado' => 4]) : '#',
            ],
            'areas' => [
                'count' => Area::where('is_active', true)->count(),
                'title' => 'Áreas Asignables', 'color' => '#FFC700',
                'link' => Route::has('areas.index') ? route('areas.index') : '#',
            ],
        ];
    }

    public function getAreaPerformanceData()
    {
        // Estados relevantes para el desempeño
        $performanceStates = [2, 3, 4]; // Turnada, En Trámite, Cerrada

        // 1. Unir Denuncia con Área y agrupar por el ID del Área.
        $performance = Denuncia::select('id_area_responsable')
            ->selectRaw('COUNT(id_denuncia) as total')
            ->selectRaw('SUM(CASE WHEN id_estado = 2 THEN 1 ELSE 0 END) as turnadas')
            ->selectRaw('SUM(CASE WHEN id_estado = 3 THEN 1 ELSE 0 END) as tramite')
            ->selectRaw('SUM(CASE WHEN id_estado = 4 THEN 1 ELSE 0 END) as cerradas')
            ->whereIn('id_estado', $performanceStates)
            ->whereNotNull('id_area_responsable')
            ->groupBy('id_area_responsable')
            ->orderBy('total', 'desc')
            ->take(5) // Top 4 Áreas
            ->get();

        // 2. Cargar los nombres y siglas del área
        $areaIds = $performance->pluck('id_area_responsable')->toArray();
        $areas = Area::whereIn('id_area', $areaIds)->get()->keyBy('id_area');
        
        $results = $performance->map(function ($item) use ($areas) {
            $area = $areas[$item->id_area_responsable] ?? null;
            
            return [
                'area_name' => $area->nombre_area ?? 'Área Desconocida',
                'area_siglas' => $area->siglas ?? 'N/D',
                'denuncias_total' => $item->total,
                'turnadas' => $item->turnadas,
                'tramite' => $item->tramite,
                'cerradas' => $item->cerradas,
            ];
        })->toArray();
        
        return $results;
    }
    
    /**
     * Obtiene el conteo de denuncias por estado agrupado por Usuario (Top 4).
     * @return array
     */
    public function getUserPerformanceData()
    {
        $performanceStates = [2, 3, 4]; 
        
        // 1. Unir Denuncia con Usuario y agrupar por el ID del Usuario.
        $performance = Denuncia::select('id_responsable')
            ->selectRaw('COUNT(id_denuncia) as total')
            ->selectRaw('SUM(CASE WHEN id_estado = 2 THEN 1 ELSE 0 END) as turnadas')
            ->selectRaw('SUM(CASE WHEN id_estado = 3 THEN 1 ELSE 0 END) as tramite')
            ->selectRaw('SUM(CASE WHEN id_estado = 4 THEN 1 ELSE 0 END) as cerradas')
            ->whereIn('id_estado', $performanceStates)
            ->whereNotNull('id_responsable')
            ->groupBy('id_responsable')
            ->orderBy('total', 'desc')
            ->take(5) // Top 4 Usuarios
            ->get();

        // 2. Cargar los nombres de usuario
        $userIds = $performance->pluck('id_responsable')->toArray();
        $users = User::whereIn('id', $userIds)->get()->keyBy('id');
        
        $results = $performance->map(function ($item) use ($users) {
            $user = $users[$item->id_responsable] ?? null;
            
            return [
                'user_name' => $user->name ?? 'Usuario Desconocido',
                'user_email' => $user->email ?? 'N/D',
                'denuncias_total' => $item->total,
                'turnadas' => $item->turnadas,
                'tramite' => $item->tramite,
                'cerradas' => $item->cerradas,
            ];
        })->toArray();
        
        return $results;
    }

    /**
     * Obtiene el conteo de denuncias por día dentro de un rango de fechas.
     * @param string $startDate 'YYYY-MM-DD'
     * @param string $endDate 'YYYY-MM-DD'
     * @return array ['days' => [], 'counts' => [], 'total' => 0]
     */
    public function getDailyDenunciasData(string $startDate, string $endDate): array
    {
        // El conteo se basa en la fecha de recepción
        $denuncias = Denuncia::whereDate('fecha_recepcion', '>=', $startDate)
            ->whereDate('fecha_recepcion', '<=', $endDate)
            ->selectRaw('DATE(fecha_recepcion) as date')
            ->selectRaw('COUNT(id_denuncia) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Mapear los resultados y rellenar los días sin denuncias
        $dataMap = $denuncias->pluck('count', 'date')->toArray();
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        
        $dates = [];
        $counts = [];
        $total = 0;
        
        for ($date = $start; $date <= $end; $date->modify('+1 day')) {
            $dayKey = $date->format('Y-m-d');
            $dayLabel = $date->format('d/M'); // Para el eje X
            $count = $dataMap[$dayKey] ?? 0;
            
            $dates[] = $dayLabel;
            $counts[] = $count;
            $total += $count;
        }

        return [
            'labels' => $dates,
            'series' => $counts,
            'total' => $total,
            'periodo' => date('d M', strtotime($startDate)) . ' - ' . date('d M', strtotime($endDate)),
        ];
    }

    public function getMonthDenunciasData(int $year, int $userId): array
    {

        $denuncias = Denuncia::whereYear('fecha_recepcion', $year)
            ->where('id_responsable', $userId)
            ->selectRaw('MONTH(fecha_recepcion) as date')
            ->selectRaw('COUNT(id_denuncia) AS count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        // Mapear los resultados y rellenar los meses sin denuncias
        $dataMap = $denuncias->pluck('count', 'date')->toArray();

        $labels = [];
        $series = [];
        $total = 0;

        // Recorrer los 12 meses del año
        for ($m = 1; $m <= 12; $m++) {
            $monthLabel = ucfirst(Carbon::createFromDate($year, $m, 1)->translatedFormat('M'));
            $count = $dataMap[$m] ?? 0;

            $labels[] = $monthLabel; // Ej: Ene, Feb, Mar...
            $series[] = $count;
            $total += $count;
        }

        return [
            'labels' => $labels,
            'series' => $series,
            'total' => $total,
            'periodo' => $year,
        ];
    }
}