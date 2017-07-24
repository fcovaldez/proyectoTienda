@extends('adminMaster')

@section('contenido')
<table class="table table-hover">
  <thead>
    <tr>
      <th>Comentarios</th>
      <th>Articulo</th>
      <th>Usuario</th>
      <th><a href="{{url('/comentariosPDF')}}">PDF</th>
    </tr>
  </thead>
  <tbody>
    @foreach($comentarios as $p)
    <tr>
      <td>{{$p->comentario}}</td>
      <td>{{$p->nombre}}</td>
      <td>{{$p->email}}</td>
      
      <td>
        <a href="{{url('/eliminarComentario')}}/{{$p->id}}" class="btn btn-xs btn-danger">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
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