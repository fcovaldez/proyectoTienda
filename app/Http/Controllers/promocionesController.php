<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promociones;
use Auth;

class promocionesController extends Controller
{
    public function __construct(){
      $this->middleware('auth:admin');
    }
    public function registrar(){

      return view ('/registrarPromocion');
    }
    public function consultar(){
      $promociones=Promociones::all();
      return view('/consultarPromociones', compact('promociones'));
    }
    public function guardar(Request $datos){
      $promociones= new Promociones(); 
      $promociones->descripcion=$datos->input('descripcion');
      $promociones->save();
      flash('Promocion guardada con éxito!')->success();
      return redirect('/consultarPromocion');
    }

}
