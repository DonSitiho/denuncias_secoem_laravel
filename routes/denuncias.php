<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DenunciaController;

//denuncias
Route::get('/denunciar', [DenunciaController::class, 'create'])->name('denunciar'); // <-- create, no crear
Route::get('/buscar-denuncia', [DenunciaController::class, 'buscar'])->name('buscar.denuncia');
Route::post('/api/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');
//qr
Route::get('/denuncias/seguimiento/{folio}', [DenunciaController::class, 'seguimiento'])
    ->name('denuncias.seguimiento');
//PDF
Route::get('/denuncias/{folio}/pdf', [App\Http\Controllers\DenunciaController::class, 'generarPDF'])->name('denuncias.pdf');

Route::post('/denuncias/buscar', [DenunciaController::class, 'buscarDenunciaFolio'])
     ->name('denuncias.buscarDenunciaFolio');

// Route::get('/denuncias/buscar', [DenunciaController::class, 'buscarForm'])->name('denuncias.buscar.form');
// Route::post('/denuncias/buscar', [DenunciaController::class, 'buscar'])->name('denuncias.buscar');
Route::get('/denuncias/{denuncia}', [DenunciaController::class, 'show'])->name('denuncias.show');

Route::post('/denuncias/{denuncia}/verificar-palabra-clave', [DenunciaController::class, 'verificarPalabraClave'])->name('denuncias.verificar-palabra-clave');
Route::get('/denuncias/{denuncia}/detalles-completos', [DenunciaController::class, 'detallesCompletos'])->name('denuncias.detalles-completos');

Route::post('/denuncias/solventar/guardar', [DenunciaController::class, 'guardarSolventarInfo'])->name('denuncias.solventar.guardar');


//********************** FIN DENUNCIAS ********************************* */
