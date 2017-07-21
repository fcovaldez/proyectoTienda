@extends('adminMaster')

@section('contenido')
<form action="{{url('/actualizarcategorias')}}/{{$categorias->id}}" method="POST">
<input id="token" type="hidden" name="_token" value="{{csrf_token() }}">
	<div class="form-group">
		<label for="nombre">Nombre:</label>
		<input type="text" class="form-control" name="nombre" required value="{{$categorias->nombre}}">
	</div>
	<div class="form-group">
		<label for="descripcion">Descripcion:</label>
		<input type="text" class="form-control" name="descripcion" required value="{{$categorias->descripcion}}">
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Actualizar</button>
		<a href="{{url('/consultacategorias')}}" class="btn btn-danger">Cancelar</a>
	</div>
</form>
@stop