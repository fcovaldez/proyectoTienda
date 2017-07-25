<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promociones;

class promocionesController extends Controller
{
    public function registrar(){
      $promociones=Promociones::all();

      return view ('/registrarPromocion', compact('promociones'));
    }
}
