<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Articulos;

class carritoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function contenido(){
        $carrito=Cart::content();
        return view('contenidoCarrito',compact('carrito'));
    }

    public function agregar($id){
        $articulo= Articulos::find($id);
        Cart::add($id,$articulo->nombre,1,$articulo->precio);
        return back();
    }
    public function vaciar(){
        Cart::destroy();
        return redirect('/');
    }
    public function remover($id){
        Cart::remove($id);
        return back();
    }
    public function actualizar(Request $datos, $id){
        Cart::update($id,$datos->cantidad);
        return back();
    }
}
