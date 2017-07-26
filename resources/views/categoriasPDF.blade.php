<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Listado de Categorias</title>
</head>
<body>
  <h1>Listado de Categorias</h1>
  <style>
    table, th, td {
        border: 1px solid black;
    }
</style>
    <br><br>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
        </tr>
        @foreach ($categorias as $c)
        <tr>
            <td>{{ $c->nombre}}</td>
            <td>{{ $c->descripcion}}</td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>