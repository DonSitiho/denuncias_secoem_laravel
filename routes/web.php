<?php

use App\Http\Controllers\CatMunicipioController;
use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\AdminDenuncias\AdminDenunciasController;
use App\Http\Controllers\AdminDenuncias\ExportController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OICDenunciasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatEstadosController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\AdminDenuncias\AreaController;
use App\Http\Controllers\CatAreaGobController;
use App\Http\Controllers\AdminDenuncias\AdminUserController;
use App\Http\Controllers\AdminDenuncias\AdminDashboardController;
use App\Http\Controllers\AdminDenuncias\InterquejasController;
use App\Http\Controllers\BuzonNarajaDenuncias\BuzonNaranjaDenunciasController;
use App\Http\Controllers\STDenuncias\STDenunciasController;
use App\Http\Controllers\UAOICDenuncias\UAOICDenunciasController;
use FontLib\Table\Type\name;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('profile')->name('profile.')->group(function () {
        // Vista del formulario
        Route::get('/change-password', [UserManagementController::class, 'showChangePasswordForm'])->name('change_password');
        // Acción POST
        Route::post('/update-password', [UserManagementController::class, 'updatePassword'])->name('update_password');
    });

    Route::middleware(['auth', 'can:admin-usuarios-crud'])->prefix('admin/usuarios')->name('admin.usuarios.')->group(function () {


        // RUTA RESTABLECIMIENTO FORZADO (Para el modal de usuario específico)
        Route::put('usuarios/{user}/password', [UserManagementController::class, 'updatePasswordAdmin'])
            ->name('password.update'); // Nombre de ruta: admin.usuarios.password.update

        // RUTA DE CAMBIO DE ROL (Para el modal de usuario específico)
        Route::put('usuarios/{user}/role', [UserManagementController::class, 'updateRole']) // ⬅️ AÑADIR ESTA RUTA
            ->name('role.update');
    });

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/catalogos', function () {
        return view('catalogos.index');
    })->name('catalogos.index');
    Route::patch('cat_municipios/{id}/activate', [CatMunicipioController::class, 'activate'])->name('cat_municipios.activate');
    Route::resource('cat_municipios', CatMunicipioController::class);

    Route::patch('cat_areas_gob/{id}/activate', [CatAreaGobController::class, 'activate'])->name('cat_municipios.activate');
    Route::resource('cat_municipios', CatMunicipioController::class);

    Route::prefix('cat_areas_gob')->name('cat_areas_gob.')->group(function () {
        // Listado de áreas
        Route::get('/', [CatAreaGobController::class, 'index'])->name('index')->middleware('can:admin-areas-crud');

        // Crear área
        Route::get('/create', [CatAreaGobController::class, 'create'])->name('create')->middleware('can:admin-areas-crud');
        Route::post('/', [CatAreaGobController::class, 'store'])->name('store')->middleware('can:admin-areas-crud');

        // Editar área
        Route::get('/{id}/edit', [CatAreaGobController::class, 'edit'])->name('edit')->middleware('can:admin-areas-crud');
        Route::put('/{id}', [CatAreaGobController::class, 'update'])->name('update')->middleware('can:admin-areas-crud');

        // Activar / Desactivar
        Route::delete('/{id}', [CatAreaGobController::class, 'destroy'])->name('destroy')->middleware('can:admin-areas-crud');
        Route::patch('/{id}/activate', [CatAreaGobController::class, 'activate'])->name('activate')->middleware('can:admin-areas-crud');
    });
    Route::resource('cat_estados', CatEstadosController::class);
    Route::patch('cat_estados/{id}/activate', [CatEstadosController::class, 'activate'])->name('cat_estados.activate')->middleware('can:admin-catalogos-crud');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class)->middleware('can:admin-usuarios-crud');
        Route::resource('/user-management/roles', RoleManagementController::class)->middleware('can:system-roles-crud');
        Route::resource('/user-management/permissions', PermissionManagementController::class)->middleware('can:system-permissions-crud');
    });

    /*
    Route::name('oic.')->group(function () {

        Route::get('/oic/mis-denuncias/', [OICDenunciasController::class, 'getMisDenuncias'])->name('mis-denuncias');
        Route::get('/oic/denuncia/{id}', [OICDenunciasController::class, 'verDetallesDenuncia'])->name('ver-denuncia');

    });
    */
});

// Grupo de rutas para el Usuario OIC
Route::middleware(['auth'])->prefix('uaoic')->name('uaoic.')->group(function () {

    //Ruta del Dashboard UAOIC de Denuncias
    Route::middleware(['can:uaoic-denuncia-ver'])->name('dashboard.')->group(function () {

        // 1. Ruta principal: uaoic.dashboard.index
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::get('/data', [DashboardController::class, 'getDashboardUaoicData'])
            ->name('data');
    });

    // Listado de mis denuncias para un UAOIC
    Route::get('/mis-denuncias', [UAOICDenunciasController::class, 'getMisDenuncias'])
        ->name('mis-denuncias')
        ->middleware('can:uaoic-denuncia-ver');

    Route::get('/mis-denuncias-buzon-naranja', [UAOICDenunciasController::class, 'getMisDenunciasBN'])
        ->name('mis-denuncias-buzon')
        ->middleware('can:uaoic-denuncia-ver');
    
    Route::get('/denuncia/{id_denuncia}', [UAOICDenunciasController::class, 'show'])
        ->name('show')
        ->middleware('can:uaoic-denuncia-detalles');
    
    Route::post('/{id_denuncia}/turnar', [UAOICDenunciasController::class, 'turnarDenunciaOIC'])
        ->name('turnar')
        ->middleware('can:uaoic-denuncia-turnar');

    Route::get('/evidencia/{id_archivo}', [UAOICDenunciasController::class, 'descargarDenuncia'])
        ->name('descargar.evidencia')
        ->middleware('can:uaoic-denuncia-descargar');

    Route::post('/{id_denuncia}/solicitar-informacion', [UAOICDenunciasController::class, 'solvetarInformacionDenuncia'])
        ->name('solicitar-informacion')
        ->middleware('can:uaoic-denuncia-solventar-info');

    Route::get('/{id_denuncia}/exportar', [ExportController::class, 'exportarExpediente'])
        ->name('exportar.expediente')
        ->middleware('can:uaoic-denuncia-descargar');

});


Route::middleware(['auth'])->prefix('secretaria-tecnica')->name('st.')->group(function () {

    Route::get('/capturar', [STDenunciasController::class, 'create'])
        ->name('capturar')
        ->middleware('can:st-denuncia-capturar');

    Route::post('/denunciar', [STDenunciasController::class, 'store'])
        ->name('denunciar')
        ->middleware('can:st-denuncia-capturar');

    Route::patch('/{id_denuncia}/agregar-folio', [STDenunciasController::class, 'agregarFolioCED'])
        ->name('agregar-folio')
        ->middleware('can:St-denuncia-folio');
        
});



// Grupo de rutas para el Usuario OIC
Route::middleware(['auth'])->prefix('oic')->name('oic.')->group(function () {

    //Ruta del Dashboard OIC de Denuncias

    Route::middleware(['can:oic-denuncia-ver'])->name('dashboard.')->group(function () {

        // 1. Ruta principal: oic.dashboard.index
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::get('/data', [DashboardController::class, 'getDashboardOicData'])
            ->name('data');
    });

    // Listado de mis denuncias para un OIC
    Route::get('/mis-denuncias', [OICDenunciasController::class, 'getMisDenuncias'])
        ->name('mis-denuncias')
        ->middleware('can:oic-denuncia-ver');
    
    Route::get('/mis-denuncias-buzon-naranja', [OICDenunciasController::class, 'getMisDenunciasBN'])
        ->name('mis-denuncias-bn')
        ->middleware('can:oic-denuncia-ver');

    Route::get('/denuncia/{id_denuncia}', [OICDenunciasController::class, 'verDetallesDenuncia'])
        ->name('ver-denuncia')
        ->middleware('can:oic-denuncia-detalles');

    Route::post('/{id_denuncia}/turnar', [OICDenunciasController::class, 'turnarDenunciaOIC'])->name('turnar');

    Route::get('/descargar/{id_archivo}', [OICDenunciasController::class, 'descargarEvidenciaDenuncia'])
        ->name('descargar')
        ->middleware('can:oic-denuncia-descargar');

    Route::post('/{id_denuncia}/solicitar-informacion', [OICDenunciasController::class, 'solvetarInformacionDenuncia'])
        ->name('solicitar-informacion')
        ->middleware('can:oic-denuncia-solventar-info');

    Route::get('/{id_denuncia}/exportar', [ExportController::class, 'exportarExpediente'])
        ->name('exportar.expediente')
        ->middleware('can:oic-denuncia-descargar');

    /*
    Route::get('/tramite/{id_denuncia}', [OICDenunciasController::class, 'denunciaEnTramite'])
        ->name('tramite')
        ->middleware('can:oic-denuncia-tramite');
    */
});


// Grupo de rutas para el Administrador de Denuncias
Route::middleware(['auth'])->prefix('admin/denuncias')->name('admin.denuncias.')->group(function () {

    Route::get('/interquejas', [InterquejasController::class, 'index'])
        ->name('interquejas')
        ->middleware('can:admin-denuncia-ver');

    // 1. Dashboard de Recepción (Listado)
    Route::get('/', [AdminDenunciasController::class, 'index'])
        ->name('index')
        ->middleware('can:admin-denuncia-ver'); // Permiso para ver la lista

    // 2. Vista Detalle de Denuncia
    Route::get('/{id_denuncia}', [AdminDenunciasController::class, 'show'])
        ->name('show')
        ->middleware('can:admin-denuncia-ver'); // Permiso para ver el detalle

    // 3. Acción de Turno (POST)
    Route::post('/{id_denuncia}/turnar', [AdminDenunciasController::class, 'turnar'])
        ->name('turnar')
        ->middleware('can:admin-denuncia-turnar'); // Permiso para asignar un OIC

    // 4. Descarga Segura de Evidencia (GET)
    Route::get('/evidencia/{id_archivo}', [AdminDenunciasController::class, 'descargarArchivoEncriptado'])
        ->name('descargar.evidencia')
        ->middleware('can:admin-denuncia-descargar'); // Permiso para la descarga

    // 5. Exportación del Expediente (GET/PDF/Excel)
    Route::get('/{id_denuncia}/exportar', [ExportController::class, 'exportarExpediente'])
        ->name('exportar.expediente')
        ->middleware('can:admin-denuncia-descargar'); // Permiso para exportar

    // 1. Dashboard de Recepción (Listado)

    Route::get('/interqueja/{id_denuncia}', [InterquejasController::class, 'show'])
        ->name('interqueja')
        ->middleware('can:admin-denuncia-ver');

});


//Route::get('/interquejas', [InterquejasController::class, 'getAllInterquejas'])->name('interquejas'); 

// Grupo de rutas para el Usuario Buzon Naranja
Route::middleware(['auth'])->prefix('buzon-naranja/denuncias')->name('buzon-naranja.denuncias.')->group(function () {

    //Route::get('/interquejas', [InterquejasController::class, 'getAllInterquejas'])->name('interquejas'); 

    Route::get('/', [BuzonNaranjaDenunciasController::class, 'getDenunciasNuevas'])
        ->name('index')
        ->middleware('can:bn-denuncia-ver');


    Route::get('/historial', [BuzonNaranjaDenunciasController::class, 'getDenunciasHistorial'])
        ->name('historial')
        ->middleware('can:bn-denuncia-ver');
    
        Route::get('/denuncia-historial/{id_denuncia}', [BuzonNaranjaDenunciasController::class, 'verDetallesDenunciaHistorial'])->name('ver-denuncia-historial')->middleware('can:bn-denuncia-detalles');

    Route::get('/{id_denuncia}', [BuzonNaranjaDenunciasController::class, 'verDetallesDenuncias'])->name('show')->middleware('can:bn-denuncia-detalles');
    Route::post('/{id_denuncia}/turnar', [BuzonNaranjaDenunciasController::class, 'turnarDenuncia'])->name('turnar')->middleware('can:bn-denuncia-turnar');
});

Route::middleware(['auth', 'can:admin-usuarios-crud'])->prefix('admin/usuarios')->name('admin.usuarios.')->group(function () {

    // Listado de Usuarios
    Route::get('/', [AdminUserController::class, 'index'])->name('index');
    // Vista de Creación
    Route::get('/create', [AdminUserController::class, 'create'])->name('create');
    // Acción de Guardado
    Route::post('/', [AdminUserController::class, 'store'])->name('store');
    Route::get('usuarios/{user}/editar', [AdminUserController::class, 'edit'])->name('edit');
    Route::put('usuarios/{user}', [AdminUserController::class, 'update'])->name('update');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Rutas del Dashboard de Denuncias
    // El prefijo es 'dashboard' y el nombre es 'dashboard.'
    Route::middleware(['can:admin-denuncia-ver'])->prefix('dashboard')->name('dashboard.')->group(function () {

        // 1. Ruta principal: admin.dashboard.index
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // 2. Ruta AJAX de Persistencia: admin.dashboard.saveOrder
        Route::post('/save-order', [DashboardController::class, 'saveOrder'])
            ->name('saveOrder');

        Route::get('/data', [DashboardController::class, 'getDashboardData'])
            ->name('data');
    });

    // Route::get('/data', [DashboardController::class, 'getDashboardData'])
    // ->name('data');
});

Route::get('admin/areas/{id_area}/users', [AdminDenunciasController::class, 'getUsersForArea'])
    ->name('admin.areas.getUsersForArea')->middleware('auth', 'can:admin-usuarios-crud');

Route::get('areas/{id_area}/usuarios', [AdminDenunciasController::class, 'getUsersForArea'])->name('areas.usuarios')->middleware('auth', 'can:system-areas-usuarios');



// RUTAS PARA LA GESTIÓN DE ÁREAS (Trabajo del D4)
Route::middleware(['auth', 'can:admin-areas-crud'])->prefix('areas')->name('areas.')->group(function () {
    // Vista principal del gestor de áreas
    Route::get('/', [AreaController::class, 'index'])->name('index');

    // API Endpoint para obtener la estructura del árbol
    Route::get('/tree', [AreaController::class, 'getTreeData'])->name('tree_data');

    // API Endpoint para operaciones CRUD de jsTree
    Route::post('/crud', [AreaController::class, 'crud'])->name('crud');
});


Route::get('/error', function () {
    abort(500);
});
//********************** DENUNCIAS ********************************* */
// Página pública de inicio con dos opciones
Route::get('/inicio', [DenunciaController::class, 'inicio'])->name('inicio');
//denuncias
Route::post('/denunciar', [DenunciaController::class, 'create'])->name('denunciar'); // <-- create, no crear
Route::get('/buscar-denuncia', [DenunciaController::class, 'buscar'])->name('buscar.denuncia');

Route::post('/api/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');
//qr
// Route::get('/denuncias/seguimiento/{folio}', [DenunciaController::class, 'seguimiento'])
//     ->name('denuncias.seguimiento');
//PDF
Route::get('/denuncias/{folio}/pdf', [App\Http\Controllers\DenunciaController::class, 'generarPDF'])->name('denuncias.pdf');
//********************** FIN DENUNCIAS ********************************* */

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
