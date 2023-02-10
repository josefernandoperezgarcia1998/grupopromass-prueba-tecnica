<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AutenticarController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registrar',[AutenticarController::class, 'registrar']);
Route::post('login',[AutenticarController::class, 'login']);


Route::get('user-profile', [AutenticarController::class, 'userProfile']);
Route::get('logout', [AutenticarController::class, 'logout']);


Route::resource('posts', PostController::class);
Route::get('listado-posts', [PostController::class, 'listadoPostsUsuario']);
Route::get('listado-posts-general', [PostController::class, 'listadoPostGeneral']);

Route::get('buscador-post', [PostController::class, 'buscadorPost']);
