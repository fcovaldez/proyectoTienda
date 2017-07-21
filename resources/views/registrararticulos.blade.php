@extends('adminMaster')

@section('contenido')
<form action="{{url('/guardararticulo')}}" method="POST">
<input id="token" type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="form-group">
		<label for="nombre">Nombre:</label>
		<input type="text" class="form-control" name="nombre" required>
	</div>
	<div class="form-group">
		<label for="descripcion">Descripcion:</label>
		<input type="text" class="form-control" name="descripcion" required>
	</div>
	<div class="form-group">
		<label for="precio">Precio:</label>
		<input type="text" class="form-control" name="precio" required>
	</div>
	<div class="form-group">
		<label for="existencia">Existencia:</label>
		<input type="number" class="form-control" name="existencia" required>
	</div>

	<div class="form-group">
		<label for="categoria">Categoria:</label>
		<select name="categoria" class="form-control">
			@foreach($categorias as $c)
				<option value="{{$c->id}}">{{$c->nombre}}</option>
			@endforeach
		</select>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Registrar</button>
		<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>
	</div>
</form>
<hr>
<h4>Registro mediante archivo CSV</h4>
<form action="{{url('/guardararticuloCSV')}}" method="POST" enctype="multipart/form-data">
<input id="token" type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="form-group">
		<label for="subirArchivo">Seleccionar Archivo</label>
		<input type="file" name="subirArchivo" class="form-control" required>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Registrar</button>
		<a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>
	</div>
		
</form>
@stop