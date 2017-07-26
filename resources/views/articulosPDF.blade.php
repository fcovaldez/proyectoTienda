<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Listado de Articulos</title>
</head>
<body>
  <h1>Listado de Articulos</h1>
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
            <th>Precio</th>
            <th>Existencia</th>
        </tr>
        @foreach ($articulos as $a)
        <tr>
            <td>{{ $a->nombre}}</td>
            <td>{{ $a->descripcion}}</td>
            <td> ${{ $a->precio}}</td>
            <td>{{ $a->existencia}}</td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>

