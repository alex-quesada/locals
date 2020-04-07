<?php

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
    return view('index');
});
Route::resource('pais', 'PaisesAjaxController');
Route::resource('ciudad', 'CiudadesAjaxController');
Route::resource('restaurante', 'RestaurantesAjaxController');
Route::resource('tipoempleado', 'TipoEmpleadoAjaxController');
Route::resource('empleado', 'EmpleadoAjaxController');
Route::resource('telefono', 'TelefonosAjaxController');
Route::resource('horastrabajadas', 'HorasTrabajadasAjaxController');
Route::resource('pagoplanilla', 'PagoPlanillaAjaxController');
Route::resource('telefonorestaurante', 'TelefonosRestAjaxController');


