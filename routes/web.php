<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriterioController;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UsuarioController;
//logueo
use App\Http\Controllers\LoginController;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


//obtener usuario para guardarlo en la tabla respuestas
Route::get('/obtener-usuario', function () {
    return response()->json(['user_id' => Auth::id()]);
});



//dimension_a
Route::get('dimension-{dimension}', [CriterioController::class, 'dimension_a'])->name('dimension.a')->middleware('auth');
Route::post('/guardar-respuesta', [RespuestaController::class, 'store'])->name('guardar.respuesta')->middleware('auth');


//criterios fortalecimiento
Route::get('criterio-{criterio}', [CriterioController::class, 'criterio_a'])->name('fortalezas.criterio')->middleware('auth');
Route::post('/guardar-criterio-f', [RespuestaController::class, 'store_criterio'])->name('guardar-criterio-f');
Route::delete('/eliminar-respuesta/{id}', [RespuestaController::class, 'destroy']);

//criterios oportunidades
Route::get('oportunidad-{oportunidadCriterio}', [CriterioController::class, 'criterio_oportunidad'])->name('oportunidades.criterio')->middleware('auth');
Route::post('/guardar-criterio-o', [RespuestaController::class, 'store_criterio_o'])->name('guardar-criterio-o');
Route::delete('/eliminar-respuesta-o/{id}', [RespuestaController::class, 'destroy_o']);

//logueo
Route::view('/login', 'login')->name('login');
Route::view('/registro', 'register')->name('registro');
Route::get('/home', [UsuarioController::class, 'home'])->middleware('auth')->name('home');

Route::get('/editar-perfil', [UsuarioController::class, 'editarPerfil'])->middleware('auth')->name('editar-perfil');
Route::put('/actualizar-perfil', [UsuarioController::class, 'actualizarPerfil'])->name('actualizar-perfil');


Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin');
Route::get('/usuario/{id}/editar', [AdminController::class, 'edit'])->name('editar-usuario');
Route::put('/usuario/{id}', [AdminController::class, 'update'])->name('actualizar-usuario');
Route::delete('/usuario/{id}', [AdminController::class, 'destroy'])->name('eliminar-usuario');   


//register ADMIN
Route::post('/validar-admin', [LoginController::class, 'registerAdmin'])->name('validar-admin');
Route::view('/registro-admin', 'Admin-register')->name('registro-admin');
//pdf

Route::get('/informe-a', [RespuestaController::class, 'GenerarPDFA']);

Route::get('informe-d-{dimension}', [PDFController::class, 'GenerarPDFDimension'])->name('dimension.informe');

Route::get('informe-f-{dimension}', [PDFController::class, 'GenerarPDFFA'])->name('informe.f');

Route::get('informe-o-{dimension}', [PDFController::class, 'GenerarPDFOA'])->name('informe.o');

