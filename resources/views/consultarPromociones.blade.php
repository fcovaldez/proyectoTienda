@extends('adminMaster')
@section('contenido')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Descripción</th>
            
            <th><a href="{{url('/')}}">PDF</a></th>
        </tr>
    </thead>
    <tbody>
    @foreach($promociones as $a)
        <tr>
            <td>{{$a->id}}</td>
            <td>{{$a->descripcion}}</td>
            <td>
                <a href="{{url('/')}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <a href="{{url('/')}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
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