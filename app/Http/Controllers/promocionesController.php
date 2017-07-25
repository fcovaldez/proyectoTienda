<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promociones;

class promocionesController extends Controller
{
    public function registrar(){

      return view ('/registrarPromocion');
    }
    public function consultarPromocion(){
      $promociones=Promociones::all();
      return view('/consultarPromociones', compact('promociones'));
    }
}
