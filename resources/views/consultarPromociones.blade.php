@extends('adminMaster')
@section('contenido')
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
<<<<<<< HEAD
            
            <th><a href="{{url('/promocionesPDF')}}">PDF</a></th>
=======
            <th><a href="{{url('/')}}">PDF</a></th>
>>>>>>> 818afb8879e46fc47a2b5e7004fba11a6d246f2c
        </tr>
    </thead>
    <tbody>
    @foreach($promociones as $a)
        <tr>
            <td>{{$a->descripcion}}</td>
            <td>
                <a href="{{url('/enviarPromociones')}}/{{$a->id}}" class="btn btn-success btn-xs">Enviar</a>
                <a href="{{url('/eliminarPromocion')}}/{{$a->id}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
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