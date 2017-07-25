@extends('adminMaster')

@section('contenido')
<form action="{{url('/guardarPromocion')}}" method="POST">
<input id="token" type="hidden" name="_token" value="{{csrf_token() }}">
<form action="">
  <div class="form-group">
    <label for="descripcion">Descripcion:</label>
    <input type="text" class="form-control" name="descripcion" required>
  </div>
  <div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{url('/')}}" class="btn btn-danger">Cancelar</a>
  </div>
</form>
@stop