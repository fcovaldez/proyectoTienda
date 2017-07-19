<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Articulos;

class articuloscontroller extends Controller
{
    public function registrar(){
    	$articulos=Articulos::all();
    	return view('registrarArticulos', compact('articulos'));
    }

    public function guardar(Request $datos){
    	$articulos= new Articulos(); //objeto del modelo encargado para registrar encargados
    	$articulos->nombre=$datos->input('nombre');
    	$articulos->descripcion=$datos->input('descripcion');
    	$articulos->save();
        flash('¡Articulo guardado con éxito!')->success();

    	return redirect('/');
	}
}
