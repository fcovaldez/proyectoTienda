<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articulos;
use App\Categorias;
use DB;

class articuloscontroller extends Controller
{
    public function registrar(){
    	$categorias=Categorias::all();
    	return view('registrararticulos', compact('categorias'));
    }

    public function guardar(Request $datos){
    	$articulos= new Articulos(); 
    	$articulos->nombre=$datos->input('nombre');
    	$articulos->descripcion=$datos->input('descripcion');
    	$articulos->precio=$datos->input('precio');
    	$articulos->existencia=$datos->input('existencia');
        $articulos->idencargado=$datos->input('encargado');
    	$articulos->save();
        flash('¡Articulo guardado con éxito!')->success();

    	return redirect('/consultarArticulo');
	}

	public function eliminar($id){
    	$articulos=Articulos::find($id);
    	$articulos->delete();
        flash('¡Articulo Eliminado!')->success();

    	return redirect('/');
    }

    public function editar($id){
        $articulos=Articulos::find($id);
               
        return view('', compact('articulos'));
    }

    public function actualizar(Request $datos, $id){
        $articulos=Articulos::find($id);
        $articulos->nombre=$datos->input('nombre');
        $articulos->descripcion=$datos->input('descripcion');
        $articulos->precio=$datos->input('precio');
    	$articulos->existencia=$datos->input('existencia');
        $articulos->save();//Guarda objeto
        flash('¡Se ha actualizado el articulo correctamente!')->success();

        return redirect('/');
    }
    public function consultararticulos(){
        $articulos=DB::table('articulos')
        ->join ('categorias','categorias.id', '=','articulos.idcategoria')
        ->select('articulos.*','categorias.nombre')
        ->get();
        return view('consultarArticulo', compact('articulos'));
}
public function pdf(){
        $articulos=Articulos::all();
        $vista=view('articulosPDF', compact('articulos'));
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);
        $pdf->setPaper('letter');
        return $pdf->stream('ListaArticulos.pdf');
    }
}
