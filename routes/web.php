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
    return view('welcome');
});

Auth::routes();
Route::get('/admin','AdminController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registrarcategorias', 'categoriascontroller@registrar');

Route::post('/guardarcategorias','categoriasontroller@guardar');

Route::get('/eliminarcategorias/{id}', 'categoriascontroller@eliminar');

Route::get('/editarcategorias/{id}', 'categoriascontroller@editar');

Route::post('/actualizarcategorias/{id}','categoriascontroller@actualizar');



