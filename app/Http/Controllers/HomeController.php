<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Articulos;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('inicio');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function inicio(){
        $articulos = Articulos::all();
        $categorias= Categorias::all();
        return view('inicio',compact('articulos','categorias'));
    }
}
