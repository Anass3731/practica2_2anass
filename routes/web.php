<?php

use App\Http\Controllers\elmeucontrolador;
use App\Http\Controllers\CocheRelacionController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
Route::get('/', [AuthController::class, 'f_index'])->name('login');


Route::middleware("guest")->group(function ()
{
    // Rutas de Autenticación
Route::post('/login', [AuthController::class, 'f_login'])->name('login_autenticar');
Route::get('/registro', [AuthController::class, 'f_registro'])->name('registro');
Route::post('/registro', [AuthController::class, 'f_registro_guardar'])->name('registro_guardar');
});


Route::middleware("auth")->group(function ()
{
Route::get('/logout', [AuthController::class, 'f_logout'])->name('logout');

// ELIMINAMOS la línea de view('index') y dejamos la del controlador de autenticación como la ruta principal:
// Route::get('/', [AuthController::class, 'f_index'])->name('login');

// Rutas informativas
Route::get('/nosotros', function () { return view('nosotros'); });
Route::get('/dondeestamos', function () { return view('dondeestamos'); });

// Rutas CRUD
Route::get('/inserir',[elmeucontrolador::class, 'f_formulari'])->name('datos_insertar');
Route::post('/inserir',[elmeucontrolador::class, 'f_insert'])->name('datos_insertar');

Route::get('/listar',[elmeucontrolador::class, 'f_listar'])->name('dades_consultar');
Route::get('/listar/{fila}',[elmeucontrolador::class, 'f_consultardetalle'])->name('dades_consultar');

Route::get('/buscar', [elmeucontrolador::class, 'f_formulari_buscar'])->name('datos_buscar');
Route::post('/buscar', [elmeucontrolador::class, 'f_buscar'])->name('datos_buscar');

Route::get('/borrar', [elmeucontrolador::class, 'f_borrar'])->name('datos_borrar');
Route::delete('/borrar/{fila}',[elmeucontrolador::class, 'f_borrarfila'])->name('datos_borrarfila');

Route::get('/modificar', [elmeucontrolador::class, 'f_modificar'])->name('datos_modificar');
Route::get('/modificar/{fila}',[elmeucontrolador::class, 'f_modificarfila'])->name('datos_modificarfila');
Route::patch('/modificar/{fila}',[elmeucontrolador::class, 'f_actualimodificarfila'])->name('datos_actualimodificarfila');

Route::get('/consultar-coches', [CocheRelacionController::class, 'index'])->name('coches_consultar');

});

