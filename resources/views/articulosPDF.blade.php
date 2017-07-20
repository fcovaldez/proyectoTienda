<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Listado de Articulos</title>
</head>
<body>
  <h1>Listado de Articulos</h1>
  <hr>
  @foreach($articulos as $p)
      {{$p->nombre}}
      {{$p->descripcion}}
      {{$p->precio}}
      {{$p->existencia}}<br>

  @endforeach
</body>
</html>