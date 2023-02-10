<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AutenticarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'welcome']);

Route::get('vista-registro', [AutenticarController::class, 'vistaRegistrar'])->name('registrar');
Route::get('vista-login', [AutenticarController::class, 'vistaLogin'])->name('login');
