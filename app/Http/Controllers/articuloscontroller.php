<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class articuloscontroller extends Controller
{
    public function registrar(){
    	$articulos=Articulos::all();
    	return view('registrarArticulos', compact('articulos'));
    }
}
