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
}
