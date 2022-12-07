<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiciosController;

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
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::delete('/home/eliminar-cita/{cita_id}', [HomeController::class, 'eliminarCita'])->name('home.eliminar-cita');
Route::get('/home/servicios', [ServiciosController::class, 'servicios'])->name('servicios');
Route::get('/home/servicios-create', [ServiciosController::class, 'formularioCrearServicio'])->name('servicios.create');
Route::post('/home/servicios-createServicio', [ServiciosController::class, 'crearServicio'])->name('servicio.createServicio');
Route::get('/home/servicios-edit/{servicio_id}', [ServiciosController::class, 'formularioEditarServicio'])->name('servicios.edit');
Route::put('/home/servicios-edit/editServicio/{servicio_id}', [ServiciosController::class, 'editarservicios'])->name('servicio.editServicio');
Route::delete('/home/eliminar-servicio/{servicio_id}', [ServiciosController::class, 'eliminarServicio'])->name('servicios.delete');
