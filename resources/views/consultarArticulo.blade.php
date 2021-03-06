@extends('adminMaster')
@section('contenido')
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Categoria</th>
            <th><a href="{{url('/articulosPDF')}}">PDF</a></th>
        </tr>
    </thead>
    <tbody>
    @foreach($articulos as $a)
        <tr>
            <td>{{$a->id}}</td>
            <td>{{$a->nombre}}</td>
            <td>{{$a->descripcion}}</td>
            <td>{{$a->precio}}</td>
            <td>{{$a->existencia}}</td>
            <td>{{$a->nombreCategoria}}</td>
            <td>
                <a href="{{url('/editararticulos')}}/{{$a->id}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <a href="{{url('/eliminararticulos')}}/{{$a->id}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@include('flash::message')
<script type="text/javascript">
    setTimeout(function() {
      $(".alert").fadeOut(1500);
    },1500);
</script>
@stop