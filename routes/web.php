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
    return view('inicio');
});

Auth::routes();
Route::get('/admin/login','Auth\AdminLoginController@mostrarLogin')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin','AdminController@index');
Route::get('/admin/logout','AdminLoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/','HomeController@inicio')->name('/');
Route::get('/articulosporCategoria/{id}','HomeController@articulosporCategoria');
Route::get('/articuloIndividual/{id}','HomeController@articuloIndividual');
Route::post('/comentarioArticulo/{id}','HomeController@comentar');


//Categorias
Route::get('/registrarcategorias', 'categoriascontroller@registrar');
Route::post('/guardarcategorias','categoriascontroller@guardar');
Route::get('/eliminarcategorias/{id}', 'categoriascontroller@eliminar');
Route::get('/editarcategorias/{id}', 'categoriascontroller@editar');
Route::post('/actualizarcategorias/{id}','categoriascontroller@actualizar');
Route::get('/consultacategorias', 'categoriascontroller@consultarCategorias');
Route::get('/categoriasPDF', 'categoriascontroller@pdf');
Route::get('/filtrarcategoria', 'HomeController@filtroarticulocategoria');



//Articulos
Route::get('/registrararticulo', 'articuloscontroller@registrar');
Route::post('/guardararticulo','articuloscontroller@guardar');
Route::get('/eliminararticulos/{id}', 'articuloscontroller@eliminar');
Route::get('/editararticulos/{id}', 'articuloscontroller@editar');
Route::post('/actualizararticulos/{id}','articuloscontroller@actualizar');
Route::get('/articulosPDF', 'articuloscontroller@pdf');
Route::get('/consultarArticulo', 'articuloscontroller@consultararticulos');
Route::post('/guardararticuloCSV','articuloscontroller@subirArchivo');

//Carrito
Route::get('/carrito','carritoController@contenido');
Route::get('/agregarcarrito/{id}','carritoController@agregar');
Route::get('/vaciar','carritoController@vaciar');
Route::post('/actualizarCarrito/{id}','carritoController@actualizar');
Route::get('/removerdeCarrito/{id}','carritoController@remover');
Route::get('/detalleorden','carritoController@detalleOrden');

//Comentarios
Route::get('/consultaComentarios','comentariosController@consultaComentarios');
Route::get('/eliminarComentario/{id}','comentariosController@eliminar');


//paypal
Route::get('payment', array(
	'as' => 'payment',
	'uses' => 'PaypalController@postPayment',
));
// Después de realizar el pago Paypal redirecciona a esta ruta
Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'PaypalController@getPaymentStatus',
));