@extends('userMaster')
@section('contenido')
<h3>Tu carrito</h3>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
    @foreach($carrito as $c)
        <tr>
            <td>{{$c->name}}</td>
            <td>${{$c->price}} </td>
            <form action="{{url('/actualizarCarrito')}}/{{$c->rowId}}" method="post">
            <input id="token" type="hidden" name="_token" value="{{csrf_token()}}">
            <td><input type="number" name="cantidad" min="1" max="30" value="{{$c->qty}}">
            <button type="submit" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-refresh"></span></button>
            </td>
            </form>
            <td><a href="{{url('/removerdeCarrito')}}/{{$c->rowId}}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td>Total:${{Cart::subtotal()}}</td>
        <td>Total Articulos:{{Cart::count()}}</td>
    </tr>
    </tbody>
    @include('flash::message')
</table>
<a href="{{url('/')}}" class="btn btn-primary">Seguir comprando</a>
<a href="{{url('/vaciar')}}" class="btn btn-warning">Vaciar Carrito</a>
<a href="{{url('/detalleorden')}}" class="btn btn-success">Realizar Pedido</a>

<script type="text/javascript">
    setTimeout(function() {
      $(".alert").fadeOut(2000);
    },1500);
</script>
@stop