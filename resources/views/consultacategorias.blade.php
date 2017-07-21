@extends('adminMaster')

@section('contenido')
<table class="table table-hover">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th><a href="{{url('/categoriasPDF')}}">PDF</th>
    </tr>
  </thead>
  <tbody>
    @foreach($categorias as $p)
    <tr>
      <td>{{$p->nombre}}</td>
      <td>{{$p->descripcion}}</td>
      
      <td>
        <a href="{{url('/editarcategorias')}}/{{$p->id}}" class="btn btn-xs btn-primary">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
        <a href="{{url('/eliminar')}}/{{$p->id}}" class="btn btn-xs btn-danger">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
      </td>       
      </tr>
    @endforeach
  </tbody>
  
</table>
@stop