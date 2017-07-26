@extends ('adminMaster')
@section ('contenido')
<h1>{{$promocion->descripcion}}</h1>
<form action="{{url('/enviarCorreo')}}/{{$promocion->id}}" method="POST">
<input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
<h5>Selecciona al grupo de personas que desees enviar la promocion</h5>
<input type="radio" name ="rd" value="may1000">Personas con compras mayores a $1000 <br>
<input type="radio" name ="rd" value= "5compras">Personas con mas de 5 Compras<br>
<input type="radio" name ="rd" value="5articulos">Personas que hayan comprado mas de 5 artiuculos<br>
<br>
<div>
    <button type"submit" class="btn btn-success">Enviar</button>
    <a href="{{url('/consultarPromocion')}}" class="btn btn-danger">Cancelar</a>
</div>
</form>
@stop