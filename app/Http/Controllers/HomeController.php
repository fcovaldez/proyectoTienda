<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Articulos;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('inicio','articulosporCategoria','articuloIndividual');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/home');
    }
    public function inicio(){
        $categorias= Categorias::all();
        $articulos= DB::table('articulos')
        ->orderBy('nombre')
        ->take(12)
        ->get();
        return view('inicio',compact('articulos','categorias'));
    }
    public function articulosporCategoria($id){
    $articulos = DB::table('articulos')
    ->select('*')
    ->where('idcategoria','=',$id)
    ->orderBy('nombre')
    ->get();
    $categorias=Categorias::all();
    return view('articulosPorCategoria',compact('articulos','categorias'));
    }
    public function articuloIndividual($id){
        $articulo=Articulos::find($id);
        $categorias=Categorias::all();
        return view('articuloIndividual',compact('articulo','categorias'));
    }
}
