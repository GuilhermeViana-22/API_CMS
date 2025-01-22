<?php

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TipoUsuarioController;
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

Route::apiResource('produtos', ProdutosController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('tipos-usuario', TipoUsuarioController::class);


Route::group(['prefix' => 'cursos'], function (){
    Route::get('/', [CursoController::class, 'index'])->name('cursos.index');
    Route::post('/', [CursoController::class, 'store'])->name('cursos.store');
    Route::get('/{id}', [CursoController::class, 'show'])->name('cursos.show');
    Route::get('/show/{id}', [CursoController::class, 'show'])->name('cursos.show');
    Route::put('/show/{id}', [CursoController::class, 'edit'])->name('cursos.edit');
    Route::delete('/{id}', [CursoController::class, 'destroy'])->name('cursos.destroy');
});
