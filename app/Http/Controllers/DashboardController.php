<?php

namespace App\Http\Controllers;

use App\Repositories\DenunciasRepository;
use App\Models\Denuncia;
use App\Models\Area;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $denunciasOICRepo;

    public function __construct(DenunciasRepository $denunciasOICRepo)
    {
        $this->denunciasOICRepo = $denunciasOICRepo;
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
                        return $this->indexAdminGlobal();
                        
                    case 2: // Admin Denuncias (Recepción y Turno)
                        // Vista: Dashboard Operativo de Recepción
                        return $this->indexAdminDenuncias();
                        
                    case 3: // Usuario OIC (Órgano Interno de Control)
                        // Vista: Dashboard de Casos Asignados
                        return $this->indexIOC();
                        
                    case 4: // Capturista
                        // Vista: Dashboard de Captura y Listado Básico (Placeholder)
                        return $this->indexCapturista();
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
        // Nota: Este dashboard aún no está construido. Usamos una vista por defecto.
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);
        return view('pages/dashboards.index');
    }

    /**
     * Muestra el dashboard del Usuario del Órgano Interno de Control (OIC - ID 3).
     */
    public function indexIOC()
    {
        $totalDenunciasArea = $this->denunciasOICRepo->totalDenunciaAreaResponsable();
        $totalDenunciasTurnadaResponsable = $this->denunciasOICRepo->totalDenunciasTurnadasResponsable();

        return view('pages/dashboards.indexOIC', compact('totalDenunciasArea', 'totalDenunciasTurnadaResponsable'));
    }
    
    /**
     * Muestra el dashboard del Administrador de Denuncias (ID 2) con métricas operativas.
     */
    public function indexAdminDenuncias()
    {
        // IDs de Estado usados: 1 (Recibida), 2 (Turnada), 4 (Cerrada)
        
        $recibidas_count = Denuncia::where('id_estado', 1)->count();
        $turnadas_count = Denuncia::where('id_estado', 2)->count();
        
        // Denuncias Activas/En Trámite (Estados 2 y 3, excluyendo 4 Cerrada)
        $activas_count = Denuncia::whereIn('id_estado', [2, 3])->count();
        
        // Denuncias Cerradas (Estado 4)
        $cerradas_count = Denuncia::where('id_estado', 4)->count();
        
        // Total de Áreas
        $areas_activas_count = Area::where('is_active', true)->count();
        
        $data = compact(
            'recibidas_count',
            'turnadas_count',
            'activas_count',
            'cerradas_count',
            'areas_activas_count'
        );
        
        return view('pages/dashboards.index_admin_denuncias', $data);
    }
}