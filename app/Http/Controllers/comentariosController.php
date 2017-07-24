<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comentarios;
use DB;


class comentariosController extends Controller
{
    public function __construct(){
       $this->middleware('auth:admin');
    }

    public function consultaComentarios(){
        $comentarios=DB::table('comentarios')
        ->join('articulos','articulos.id','=','comentarios.idarticulo')
        ->join('users','users.id','=','comentarios.idusuario')
        ->select('comentarios.*','articulos.nombre','users.email')
        ->get();
        return view ('consultaComentarios',compact('comentarios'));
    }
    public function eliminar($id){
      $comentarios=Comentarios::find($id);
      $comentarios->delete();
        flash('Comentario Eliminado!')->success();
        $promediorating= DB::table('comentarios')
        ->where('idarticulo','=',$comentarios->idarticulo)
        ->groupBy('idarticulo')
        ->avg('rating');
        if($promediorating==null){
          $promediorating=0;
        }
        $actualizar=DB::table('articulos')
        ->where('id','=',$comentarios->idarticulo)
        ->update(array('promedioRating'=>$promediorating));
      return redirect('/consultaComentarios');
    }
}
