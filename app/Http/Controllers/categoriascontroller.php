<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Categorias;

class categoriascontroller extends Controller
{
    public function registrar(){
    	$categorias=Categorias::all();
    	return view('registrarCategorias', compact('categorias'));
    }

    public function guardar(Request $datos){
    	$categorias= new Categorias(); //objeto del modelo encargado para registrar encargados
    	$categorias->nombre=$datos->input('nombre');
    	$categorias->descripcion=$datos->input('descripcion');
    	$categorias->save();
        flash('¡Categoria guardada con éxito!')->success();

    	return redirect('/');
}
