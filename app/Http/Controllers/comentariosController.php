<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comentarios;
use DB;


class comentariosController extends Controller
{
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

      return redirect('/consultaComentarios');
    }
}
