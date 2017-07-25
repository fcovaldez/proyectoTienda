<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Articulos;
use DB;

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
        Cart::add($articulo->id,$articulo->nombre,1,$articulo->precio)->associate($articulo);
        foreach(Cart::content() as $c){
            if($c->qty > $articulo->existencia){
                $c->qty = $articulo->existencia;
            }
        }
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
    public function detalleOrden(){
        if(Cart::count()==0){
            flash('No se puede realizar un pedido por que no tienes productos agregados al carrito')->error();
            return back();
        }
        return view('detalleOrden');
    }
}
