<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AutenticarController;

// Rutas API de autenticación
Route::post('registrar',[AutenticarController::class, 'registrar']);
Route::post('login',[AutenticarController::class, 'login']);
Route::get('user-profile', [AutenticarController::class, 'userProfile']);
Route::get('logout', [AutenticarController::class, 'logout']);

// Rutas API Posts
Route::resource('posts', PostController::class);
Route::get('listado-posts', [PostController::class, 'listadoPostsUsuario']);
Route::get('listado-posts-general', [PostController::class, 'listadoPostGeneral']);

Route::get('buscador-post', [PostController::class, 'buscadorPost']);
