<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminHome');
    }
    public function consultaClientes(){
        $clientes = DB::table('orden')
        ->select(DB::raw('users.name as nombre, SUM(orden.subtotal) as total,COUNT(detalleorden.cantidad) as totalarticulos'))
        ->join('users','users.id','=','orden.idusuario')
        ->join('detalleorden','detalleorden.idorden','=','orden.id')
        ->groupBy('users.name')
        ->get();
        return view('consultaClientes',compact('clientes'));
    }
    public function clientePDF(){
        $clientes = DB::table('orden')
        ->select(DB::raw('users.name as nombre, SUM(orden.subtotal) as total,COUNT(detalleorden.cantidad) as totalarticulos'))
        ->join('users','users.id','=','orden.idusuario')
        ->join('detalleorden','detalleorden.idorden','=','orden.id')
        ->groupBy('users.name')
        ->get();
        $vista=view('clientesPDF', compact('clientes'));
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);
        $pdf->setPaper('letter');
        return $pdf->stream('ListaClientes.pdf');
    }
}
