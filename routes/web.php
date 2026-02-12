<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaRegisterController;
use App\Http\Controllers\CandidatoRegisterController;
use App\Http\Controllers\EmpresaDashboardController;
use App\Http\Controllers\EmpresaOfertaController;
use App\Http\Controllers\EmpresaPerfilController;
use App\Http\Controllers\CandidatoPerfilController;
use App\Http\Controllers\CandidatoOfertaController;
use App\Http\Controllers\CandidatoDashboardController;

// -----------------------------------------------------
// 0. LANDING
// -----------------------------------------------------

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// -----------------------------------------------------
// 1. ELECCIÓN DE ROL DESPUÉS DEL REGISTRO
// -----------------------------------------------------

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/elige-rol', function () {
        return view('auth.choose-role');
    })->name('choose.role');

    Route::post('/elige-rol', [CandidatoRegisterController::class, 'assignRole'])
        ->name('choose.role.store');
});


// -----------------------------------------------------
// 2. FORMULARIOS EXTRA: EMPRESA Y CANDIDATO
// -----------------------------------------------------

Route::middleware(['auth', 'verified'])->group(function () {

    // EMPRESA: formulario extra
    Route::get('/empresa/register-extra', function () {
        return view('auth.register-empresa-extra');
    })->name('empresa.register.extra');

    Route::post('/empresa/register-extra', [EmpresaRegisterController::class, 'storeExtra'])
        ->name('empresa.register.extra.store');

    // CANDIDATO: completar perfil
    Route::get('/candidato/completar-perfil', function () {
        return view('candidato.completar-perfil');
    })->name('candidato.completar-perfil');

    Route::post('/candidato/completar-perfil', [CandidatoPerfilController::class, 'store'])
        ->name('candidato.completar-perfil.store');
});


// -----------------------------------------------------
// 3. REDIRECCIÓN DINÁMICA SEGÚN ROL
// -----------------------------------------------------

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {

        $user = auth()->user();

        if (!$user->role) {
            return redirect()->route('choose.role');
        }

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'empresa' => redirect()->route('empresa.dashboard'),
            'candidato' => redirect()->route('candidato.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');
});


// -----------------------------------------------------
// 4. RUTAS PROTEGIDAS POR ROL
// -----------------------------------------------------

// ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
});


// EMPRESA
Route::middleware(['auth', 'verified', 'role:empresa'])->group(function () {

    Route::get('/empresa/dashboard', [EmpresaDashboardController::class, 'index'])
        ->name('empresa.dashboard');

    Route::redirect('/empresa', '/empresa/dashboard');

    Route::get('/empresa/ofertas/crear', [EmpresaOfertaController::class, 'create'])
        ->name('empresa.ofertas.create');

    Route::post('/empresa/ofertas', [EmpresaOfertaController::class, 'store'])
        ->name('empresa.ofertas.store');

    Route::put('/empresa/perfil', [EmpresaPerfilController::class, 'update'])
        ->name('empresa.perfil.update');

    Route::get('/empresa/ofertas', [EmpresaOfertaController::class, 'index'])
        ->name('empresa.ofertas.index');

    Route::get('/empresa/ofertas/{oferta}/editar', [EmpresaOfertaController::class, 'edit'])
        ->name('empresa.ofertas.edit');

    Route::put('/empresa/ofertas/{oferta}', [EmpresaOfertaController::class, 'update'])
        ->name('empresa.ofertas.update');

    Route::get(
        '/empresa/ofertas/{oferta}/postulaciones',
        [EmpresaOfertaController::class, 'postulaciones']
    )->name('empresa.ofertas.postulaciones');


});


// CANDIDATO
Route::middleware(['auth', 'verified', 'role:candidato'])->group(function () {

    // Dashboard candidato (CORREGIDO)
    Route::get('/candidato', [CandidatoDashboardController::class, 'index'])
        ->name('candidato.dashboard');

    // Actualizar perfil
    Route::put('/candidato/perfil', [CandidatoPerfilController::class, 'update'])
        ->name('candidato.perfil.update');

    // Ofertas disponibles
    Route::get('/candidato/ofertas', [CandidatoOfertaController::class, 'index'])
        ->name('candidato.ofertas');

    // Inscribirse
    Route::post('/candidato/ofertas/{id}/inscribirse', [CandidatoOfertaController::class, 'inscribirse'])
        ->name('candidato.inscribirse');

    // Retirarse
    Route::delete('/candidato/ofertas/{id}/retirarse', [CandidatoOfertaController::class, 'retirarse'])
        ->name('candidato.retirarse');
});
