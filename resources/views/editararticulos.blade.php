@extends('adminMaster')

@section('contenido')
<form action="{{url('/actualizararticulos')}}/{{$articulos->id}}" method="POST">
<input id="token" type="hidden" name="_token" value="{{csrf_token() }}">

	<div class="form-group">
		<label for="nombre">Nombre:</label>
		<input type="text" class="form-control" name="nombre" required value="{{$articulos->nombre}}">
	</div>

	<div class="form-group">
		<label for="descripcion">Descripcion:</label>
		<input type="text" class="form-control" name="descripcion" required value="{{$articulos->descripcion}}">
	</div>

	<div class="form-group">	
		<label for="precio">Precio:</label>
		<input type="text" class="form-control" name="precio" required value="{{$articulos->precio}}">
	</div>

	<div class="form-group">
		<label for="existencia">Existencia:</label>
		<input type="number" class="form-control" name="existencia" required value="{{$articulos->existencia}}">
	</div>
	
	<div class="form-group">
		<label for="categoria">Categoria:</label>
		<select name="categoria" class="form-control">
		<!--<option selected value="{{$articulos->idcategoria}}">{{$articulos->nombreCategoria}}</option>!-->
			@foreach($categorias as $c)
				<option value="{{$c->id}}">{{$c->nombre}}</option>
			@endforeach
		</select>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Actualizar</button>
		<a href="{{url('/consultarArticulo')}}" class="btn btn-danger">Cancelar</a>
	</div>

</form>
@stop