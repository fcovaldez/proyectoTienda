<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articulos;
use App\Categorias;
use DB;
use Excel;
use Storage;

class articuloscontroller extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
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
        $articulos->idcategoria=$datos->input('categoria');
    	$articulos->save();
        flash('¡Articulo guardado con éxito!')->success();

    	return redirect('/consultarArticulo');
	}
    public function subirArchivo(Request $datos){
        $archivo=$datos->file('subirArchivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        $temporal = Storage::disk('archivos')->put($nombreOriginal, \File::get($archivo));
        $ruta = storage_path('archivos')."/".$nombreOriginal;
        if($temporal){
            Excel::selectSheetsByIndex(0)->load($ruta,function($hoja){
                $hoja->each(function($fila){
                $articulos= new Articulos(); 
                $articulos->nombre=$fila->nombre;
    	        $articulos->descripcion=$fila->descripcion;
    	        $articulos->precio=$fila->precio;
    	        $articulos->existencia=$fila->existencia;
                $articulos->idcategoria=$fila->idcategoria;
                $articulos->save();
                });
            });
        }
        
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
        ->select('articulos.*','categorias.nombre as nombreCategoria')
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
