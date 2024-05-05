<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\GraficaController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\RolesController;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* This PHP code snippet defines various API routes for different functionalities in a Laravel
application. Here's a breakdown of what each section is doing: */
//Libros
Route::post('CrearLibros',[LibrosController::class,'create']);
Route::get('listarLibros',[LibrosController::class,'index']);
Route::post('editarLibros',[LibrosController::class,'update']);
Route::post('eliminarLibros',[LibrosController::class,'destroy']);

//User y autenticacion
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('ListarUsuarios',[AuthController::class,'index']);
Route::post('editarUsuarios',[AuthController::class,'update']);
Route::post('eliminarUsuarios',[AuthController::class,'destroy']);

//categorias
Route::get('ListarCategorias',[CategoriasController::class,'index']);
Route::post('CrearCategorias',[CategoriasController::class,'create']);
Route::post('editarCategorias',[CategoriasController::class,'update']);
Route::post('eliminarCategorias',[CategoriasController::class,'destroy']);

//Prestamos
Route::get('ListarPrestamos',[PrestamosController::class,'index']);
Route::post('CrearPrestamos',[PrestamosController::class,'create']);
Route::post('editarPrestamos',[PrestamosController::class,'update']);
Route::post('eliminarPrestamos',[PrestamosController::class,'destroy']);

//Estado
Route::get('ListarEstado',[EstadosController::class,'index']);
Route::post('CrearEstado',[EstadosController::class,'create']);

//roles
Route::get('ListarRol',[RolesController::class,'index']);
Route::post('CrearRol',[RolesController::class,'create']);

//Graficas
Route::get('GraficaUsuario',[GraficaController::class,'GraficaUsuario']);
Route::get('GraficaLibros',[GraficaController::class,'GraficaLibros']);
