<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Listado de Promociones</title>
</head>
<body>
  <h1>Listado de Promociones</h1>
  <style>
    table, th, td {
        border: 1px solid black;
    }
</style>
    <br><br>
    <table>
        <tr>
            <th>Descripcion</th>
        </tr>
        @foreach ($promociones as $p)
        <tr>
            <td>{{ $p->descripcion}}</td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>