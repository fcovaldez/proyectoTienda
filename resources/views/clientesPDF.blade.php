<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Listado de Clientes</title>
</head>
<body>
  <h1>Listado de Clientes</h1>
  <style>
    table, th, td {
        border: 1px solid black;
    }
</style>
    <br><br>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Total que ha comprado</th>
            <th>Total de articulos</th>
        </tr>
        @foreach ($clientes as $c)
        <tr>
            <td>{{ $c->nombre}}</td>
            <td>{{ $c->total}}</td>
            <td>{{$c->totalarticulos}}</td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>