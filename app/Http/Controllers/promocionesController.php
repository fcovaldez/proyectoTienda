<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\promociones;
use Auth;
use DB;
use Mail;
class promocionesController extends Controller
{
    public function __construct(){
      $this->middleware('auth:admin');
    }
    public function registrar(){

      return view ('/registrarPromocion');
    }
    public function consultar(){
      $promociones=Promociones::all();
      return view('/consultarPromociones', compact('promociones'));
    }
    public function guardar(Request $datos){
      $promociones= new Promociones(); 
      $promociones->descripcion=$datos->input('descripcion');
      $promociones->save();
      flash('Promocion guardada con éxito!')->success();
      return redirect('/consultarPromocion');
    }

    public function pdf(){
        $promociones=Promociones::all();
        $vista=view('promocionesPDF', compact('promociones'));
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);
        $pdf->setPaper('letter');
        return $pdf->stream('ListaArticulos.pdf');
    }

    public function eliminar($id){
        $promocion = promociones::find($id);
        $promocion->delete();
        flash('Promocion eliminada correctamente')->success();
        return redirect('/consultarPromocion');
    }
    public function enviar($id){
        $promocion= promociones::find($id);
        return view('enviarPromociones',compact('promocion'));
    }
    public function enviarCorreo($id,Request $datos){
        $promocion= promociones::find($id);
        $radiovalor = $datos->input('rd');
        if($radiovalor == "may1000"){
          $clientes = DB::table('orden')
                     ->select(DB::raw('users.name as nombre, users.email as correo'))
                     ->join('users','users.id','=','orden.idusuario')
                     ->groupBy('orden.idusuario','users.name','users.email')
                      ->havingRaw('SUM(orden.subtotal)>1000')
                     ->get();
          foreach($clientes as $c){
            Mail::send('contenidoEmail',['promocion'=>$promocion], function($message) use($promocion,$c){
            $message->from('quinielatulipanes@gmail.com','Tienda Proyecto');
            $message->to($c->correo)->subject($promocion->descripcion);
            });
          }
        }
        else if($radiovalor == "5compras"){
          $clientes = DB::table('orden')
                     ->select(DB::raw('users.name as nombre, users.email as correo'))
                     ->join('users','users.id','=','orden.idusuario')
                     ->groupBy('orden.idusuario','users.name','users.email')
                      ->havingRaw('COUNT(orden.idusuario)>5')
                     ->get();
          foreach($clientes as $c){
            Mail::send('contenidoEmail',['promocion'=>$promocion], function($message) use($promocion,$c){
            $message->from('quinielatulipanes@gmail.com','Tienda Proyecto');
            $message->to($c->correo)->subject($promocion->descripcion);
            });
          }
        }
         else if($radiovalor == "5articulos"){
          $clientes = DB::table('orden')
                     ->select(DB::raw('users.name as nombre, users.email as correo'))
                     ->join('users','users.id','=','orden.idusuario')
                     ->join('detalleorden','detalleorden.idorden','=','orden.id')
                     ->groupBy('orden.idusuario','users.name','users.email')
                      ->havingRaw('SUM(detalleorden.cantidad)>5')
                     ->get();
          foreach($clientes as $c){
            Mail::send('contenidoEmail',['promocion'=>$promocion], function($message) use($promocion,$c){
            $message->from('quinielatulipanes@gmail.com','Tienda Proyecto');
            $message->to($c->correo)->subject($promocion->descripcion);
            });
          }
        }
        flash('La promocion ha sido enviada correctamente')->success();
        return redirect('/consultarPromocion');
    }

}
