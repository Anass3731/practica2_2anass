<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CocheRelacionController;
use App\Http\Controllers\elmeucontrolador;
use Illuminate\Support\Facades\Route;

// 1. Ruta principal: Si no estás logueado va a Login, si lo estás va a Logado/Inici
Route::get('/', [AuthController::class, 'f_index'])->name('login');


// 2. RUTAS SOLO PARA VISITANTES NO REGISTRADOS (GUEST)
Route::middleware("guest")->group(function () {
    Route::post('/login', [AuthController::class, 'f_login'])->name('login_autenticar');
    Route::get('/registro', [AuthController::class, 'f_registro'])->name('registro');
    Route::post('/registro', [AuthController::class, 'f_registro_guardar'])->name('registro_guardar');
});


// 3. RUTAS PROTEGIDAS: SOLO ACCESIBLES SI ESTÁS LOGUEADO (AUTH)
Route::middleware("auth")->group(function () {
    Route::get('/logout', [AuthController::class, 'f_logout'])->name('logout');
    
    // Ruta explícita para el inicio logueado
    Route::get('/inicio', function () {return view('index');})->name('inicio');

    // Páginas informativas protegidas
    Route::get('/nosotros', function () { return view('nosotros'); });
    Route::get('/dondeestamos', function () { return view('dondeestamos'); });

    // Catálogo y Consultas
    Route::get('/consultar-coches', [CocheRelacionController::class, 'index'])->name('coches_consultar');
    Route::get('/listar', [elmeucontrolador::class, 'f_listar'])->name('dades_consultar');
    Route::get('/listar/{fila}', [elmeucontrolador::class, 'f_consultardetalle'])->name('dades_consultardetalle');
    Route::get('/buscar', [elmeucontrolador::class, 'f_formulari_buscar'])->name('datos_buscar');
    Route::post('/buscar', [elmeucontrolador::class, 'f_buscar'])->name('datos_buscar');

    // Gestión del CRUD (Añadir coche)
    Route::get('/inserir', [elmeucontrolador::class,'f_formulari'])->middleware(['auth', 'can:admin'])->name('datos_insertar');
    Route::post('/inserir', [elmeucontrolador::class, 'f_insert'])->name('datos_insertar');

    // Gestión del CRUD EXCLUSIVA para ADMINISTRADORES
    Route::get('/borrar', [elmeucontrolador::class, 'f_borrar'])->name('datos_borrar');
    Route::delete('/borrar/{fila}', [elmeucontrolador::class, 'f_borrarfila'])->name('datos_borrarfila');
    Route::get('/modificar', [elmeucontrolador::class, 'f_modificar'])->name('datos_modificar');
    Route::get('/modificar/{fila}', [elmeucontrolador::class, 'f_modificarfila'])->name('datos_modificarfila');
    Route::patch('/modificar/{fila}', [elmeucontrolador::class, 'f_actualimodificarfila'])->name('datos_actualimodificarfila');
});