<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Listado de Categorias</title>
</head>
<body>
  <h1>Listado de Categorias</h1>
  <hr>
  @foreach($categorias as $p)
      {{$p->nombre}}
      {{$p->descripcion}}<br>

  @endforeach
</body>
</html>