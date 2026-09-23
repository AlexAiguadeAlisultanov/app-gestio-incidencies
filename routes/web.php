<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Idioma;
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
/* Cambio de idioma: guarda la elección en la sesión y devuelve a la página de origen */
Route::get('idioma/{idioma}', function (string $idioma) {
    if (Idioma::admitido($idioma)) {
        session()->put(Idioma::CLAVE, $idioma);
    }

    // Se vuelve a donde estaba la persona. Solo se acepta una dirección de esta misma
    // aplicación y que no sea el propio cambio de idioma, para no dar vueltas ni acabar
    // en otro sitio; si no cuadra, se vuelve a la portada.
    $origen = (string) url()->previous();
    $ruta = (string) parse_url($origen, PHP_URL_PATH);
    $mismoSitio = str_starts_with($origen, url('/'));

    if (! $mismoSitio || str_starts_with($ruta, '/idioma/')) {
        $origen = url('/');
    }

    return redirect()->to($origen);
})->name('idioma');

Route::get('/dashboard', 'App\Http\Controllers\IncidenciesController@crear')->name('/dashboard');
Route::put('profesors/incidencies/store', 'App\Http\Controllers\IncidenciesController@store')->name('profesors/incidencies/store');
 
/* Leer */ 
Route::get('profesors/incidencies/show/{id}', 'App\Http\Controllers\IncidenciesController@show')->name('profesors/incidencies/detalles'); 
 
/* Actualizar */
Route::get('profesors/incidencies/actualitzar/{id}', 'App\Http\Controllers\IncidenciesController@actualitzar')->name('profesors/incidencies/actualitzar');
Route::put('profesors/incidencies/update/{id}', 'App\Http\Controllers\IncidenciesController@update')->name('profesors/incidencies/update');
 
/* Eliminar */
Route::put('profesors/incidencies/eliminar/{id}', 'App\Http\Controllers\IncidenciesController@eliminar')->name('profesors/incidencies/eliminar'); 
 
/* Vista Principal */
Route::get('profesors/incidencies', 'App\Http\Controllers\IncidenciesController@index')->name('profesors/incidencies');

Route::get('profesors/reparadors/crear', 'App\Http\Controllers\ReparadorsController@crear')->name('/profesor/reparadors/crear');

Route::put('profesors/reparadors/store', 'App\Http\Controllers\ReparadorsController@store')->name('profesors/reparadors/store');
 
/* Leer */ 
Route::get('profesors/reparadors/show/{id}', 'App\Http\Controllers\ReparadorsController@show')->name('profesors/reparadors/detalles'); 
 
/* Actualizar */
Route::get('profesors/reparadors/actualitzar/{id}', 'App\Http\Controllers\ReparadorsController@actualizar')->name('profesors/reparadors/actualitzar');
Route::put('profesors/reparadors/update/{id}', 'App\Http\Controllers\ReparadorsController@update')->name('profesors/reparadors/update');
 
/* Eliminar */
Route::put('profesors/reparadors/eliminar/{id}', 'App\Http\Controllers\ReparadorsController@eliminar')->name('profesors/reparadors/eliminar'); 
 
/* Vista Principal */
Route::get('profesors/reparadors', 'App\Http\Controllers\ReparadorsController@index')->name('profesors/reparadors');


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