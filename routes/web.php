<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dashboard', 'App\Http\Controllers\IncidenciesController@crear')->name('/dashboard');
Route::put('profesors/incidencies/store', 'App\Http\Controllers\IncidenciesController@store')->name('profesors/incidencies/store');
 
/* Leer */ 
Route::get('profesors/incidencies/show/{id}', 'App\Http\Controllers\IncidenciesController@show')->name('profesors/incidencies/detalles'); 
 
/* Actualizar */
Route::get('profesors/incidencies/actualitzar/{id}', 'App\Http\Controllers\IncidenciesController@actualizar')->name('profesors/incidencies/actualitzar');
Route::put('profesors/incidencies/update/{id}', 'App\Http\Controllers\IncidenciesController@update')->name('profesors/incidencies/update');
 
/* Eliminar */
Route::put('profesors/incidencies/eliminar/{id}', 'App\Http\Controllers\IncidenciesController@eliminar')->name('profesors/incidencies/eliminar'); 
 
/* Vista Principal */
Route::get('profesors/incidencies', 'App\Http\Controllers\IncidenciesController@index')->name('profesors/incidencies');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
