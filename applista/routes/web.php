<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibreriaController;
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

Route::get('/', function () {
    return view('home');
});
Route::fallback([LibreriaController::class, 'error404'])->name('404');

Route::resource('libros', LibreriaController::class);
Route::get('enlaces', [LibreriaController::class, 'enlaces']);
/*Route::get('libros/enlaces', [LibreriaController::class, 'enlaces']);
Route::get('libros/index', [LibreriaController::class, 'index']);
Route::get('libros/create', [LibreriaController::class, 'create']);
Route::get('libros/store', [LibreriaController::class, 'store']);
Route::get('libros/show/{id}', [LibreriaController::class, 'show']);
Route::get('libros/edit/{id}', [LibreriaController::class, 'edit']);
Route::get('libros/update/{id}', [LibreriaController::class, 'update']);
Route::get('libros/destroy/{id}', [LibreriaController::class, 'destroy']);*/