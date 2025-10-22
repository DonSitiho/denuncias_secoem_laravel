<?php
 use App\Http\Controllers\CatMunicipioController;
use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\AdminDenuncias\AdminDenunciasController;
use App\Http\Controllers\AdminDenuncias\ExportController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatEstadosController;
use App\Http\Controllers\DenunciaController;



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

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    
    Route::get('/catalogos', function () {return view('catalogos.index');})->name('catalogos.index');
    Route::patch('cat_municipios/{id}/activate', [CatMunicipioController::class, 'activate'])->name('cat_municipios.activate');
    Route::resource('cat_municipios', CatMunicipioController::class);
    

    Route::resource('cat_estados', CatEstadosController::class);
    Route::patch('cat_estados/{id}/activate', [CatEstadosController::class, 'activate'])->name('cat_estados.activate');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

});

// Grupo de rutas para el Administrador de Denuncias
Route::middleware(['auth'])->prefix('admin/denuncias')->name('admin.denuncias.')->group(function () {

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
    Route::get('/evidencia/{id_archivo}', [AdminDenunciasController::class, 'descargarEvidencia'])
        ->name('descargar.evidencia')
        ->middleware('can:admin-denuncia-descarga'); // Permiso para la descarga

    // 5. Exportación del Expediente (GET/PDF/Excel)
    Route::get('/{id_denuncia}/exportar', [ExportController::class, 'exportarExpediente'])
        ->name('exportar.expediente')
        ->middleware('can:admin-denuncia-descarga'); // Permiso para exportar
});

Route::get('/error', function () {
    abort(500);
});
//********************** DENUNCIAS ********************************* */
// Página pública de inicio con dos opciones
Route::get('/inicio', [DenunciaController::class, 'inicio'])->name('inicio');
//denuncias
Route::get('/denunciar', [DenunciaController::class, 'create'])->name('denunciar'); // <-- create, no crear
Route::get('/buscar-denuncia', [DenunciaController::class, 'buscar'])->name('buscar.denuncia');
Route::post('/api/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');
//qr
Route::get('/denuncias/seguimiento/{folio}', [DenunciaController::class, 'seguimiento'])
    ->name('denuncias.seguimiento');
//PDF
Route::get('/denuncias/{folio}/pdf', [App\Http\Controllers\DenunciaController::class, 'generarPDF'])->name('denuncias.pdf');
//********************** FIN DENUNCIAS ********************************* */

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
