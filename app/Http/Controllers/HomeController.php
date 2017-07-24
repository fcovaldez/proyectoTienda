<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Articulos;
use App\Comentarios;
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
        $comentarios= DB::table('comentarios')
        ->join('articulos','articulos.id','=','comentarios.idarticulo')
        ->join('users','users.id','=','comentarios.idusuario')
        ->where('articulos.id','=',$id)
        ->select('comentarios.*','users.email as correo')
        ->get();
        $totalComentarios=DB::table('comentarios')
        ->where('idarticulo','=',$id)
        ->count('comentario');
        $yaComento= DB::table('comentarios')
        ->join('articulos','articulos.id','=','comentarios.idarticulo')
        ->join('users','users.id','=','comentarios.idusuario')
        ->where('articulos.id','=',$id)
        ->where('users.id','=',Auth()->user()->id)
        ->first();
        return view('articuloIndividual',compact('articulo','categorias','comentarios','totalComentarios','yaComento'));
    }
    public function comentar($id,Request $datos){
        $comentario = new Comentarios();
        $comentario->idusuario=Auth()->user()->id;
        $comentario->idarticulo= $id;
        $comentario->comentario=$datos->input('comentario');
        $comentario->rating=$datos->input('ratingArt');
        $comentario->save();
        $promediorating= DB::table('comentarios')
        ->where('idarticulo','=',$id)
        ->groupBy('idarticulo')
        ->avg('rating');
        $actualizar=DB::table('articulos')
        ->where('id','=',$id)
        ->update(array('promedioRating'=>$promediorating));
        return redirect('/articuloIndividual/'.$id); 
    }
}
