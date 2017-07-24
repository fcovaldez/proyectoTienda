@extends('userMaster')
@section('contenido')
<div class="container text-center"> 
    <div class="page-header">
        <br>
        <h1>Detalle del pedido</h1>
    </div>
    <div class="page">
        <div class="table-responsive">
            <h3>Datos del cliente</h3>
            <table class="table table-striped table-bordered table-hover">
                <tr><td>Nombre</td><td>Correo</td></tr>
                <tr><td>{{Auth::user()->name}}</td><td>{{Auth::user()->email}}</td></tr>
            </table>
        </div>
        <div class="table-responsive">
            <h3>Datos del pedido</h3>
            <table class=" table table-striped table-bordered table-hover">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
                @foreach(Cart::content() as $carrito)
                <tr>
                    <td>{{$carrito->name}}</td>
                    <td>${{$carrito->price}}</td>
                    <td>{{$carrito->qty}}</td>
                </tr>
                @endforeach
                <tr>
                <td></td>
                </tr>
            </table><hr>
            <h3>Total:${{Cart::subtotal()}}</h3>
            <p>
                <a href="{{url('/carrito')}}" class="btn btn-primary">Regresar</a>
                <a href="{{url('/carrito')}}" class="btn btn-success">Pagar mediante PayPal</a>
            </p>
        </div>
    </div>
</div>
@stop