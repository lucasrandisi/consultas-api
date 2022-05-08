<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\HorariosConsultaController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\ParametrosController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [AuthController::class, 'login']);

Route::get('users', [UsersController::class, 'index']);
Route::get('materias', [MateriasController::class, 'index']);
Route::get('consultas', array(ConsultasController::class, 'index'));
Route::get('horarios-consulta', [HorariosConsultaController::class, 'index']);


Route::middleware('auth:sanctum')->group(function() {
	Route::get('me', [AuthController::class, 'me']);

	Route::prefix('users')->group(function() {
		Route::get('', [UsersController::class, 'index']);
		Route::post('', [UsersController::class, 'create']);
	});

	Route::prefix('materias')->group(function() {
		Route::post('', [MateriasController::class, 'create']);
	});

	Route::prefix('consultas')->group(function() {
		Route::post('', [ConsultasController::class, 'create']);
	});

	Route::prefix('horarios-consulta')->group(function() {
		Route::post('', [HorariosConsultaController::class, 'create']);
		Route::delete('', [HorariosConsultaController::class, 'delete']);
	});

	Route::prefix('parametros')->group(function() {
		Route::get('', [ParametrosController::class, 'index']);
		Route::post('', [ParametrosController::class, 'create']);
	});
});