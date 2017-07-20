@extends('adminMaster')

@section('contenido')
<form action="{{url('/guardarcategorias')}}" method="POST">
<input id="token" type="hidden" name="_token" value="{{csrf_token() }}">
<form action="">
	<div class="form-group">
		<label for="nombre">Nombre:</label>
		<input type="text" class="form-control" name="nombre" required>
	</div>
	<div class="form-group">
		<label for="descripcion">Descripcion:</label>
		<input type="text" class="form-control" name="correo" required>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Registrar</button>
		<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>
	</div>
</form>
@stop