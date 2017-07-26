@extends('adminMaster')
@section('contenido')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Total que ha comprado</th>
            <th>Total de cantidad</th>
            <th><a href="{{url('/clientesPDF')}}">PDF</a></th>
        </tr>
    </thead>
    <tbody>
    @foreach($clientes as $a)
        <tr>
            <td>{{$a->nombre}}</td>
            <td>{{$a->total}}</td>
            <td>{{$a->totalarticulos}}</td>
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