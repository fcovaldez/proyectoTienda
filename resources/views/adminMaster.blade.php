<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administrador Home</title>
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
    <script src="{{asset("js/jquery-3.2.1.js")}}"></script>
</head>
<body>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      @if (Auth::guard('web')->check() || Auth::guest())
      <a class="navbar-brand" href="#">Tienda</a>
      </div>
    @elseif(Auth::guard('admin')->check())
    <a class="navbar-brand" href="#">Tienda</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clientes<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{url('/consultaClientes')}}">Consultar Clientes</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categorias<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{url('/registrarcategorias')}}">Registrar Categoria</a></li>
            <li><a href="{{url('/consultacategorias')}}">Consultar Categorias</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Articulos<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{url('/consultarArticulo')}}">Consultar Articulos</a></li>
            <li><a href="{{url('/registrararticulo')}}">Registrar Articulo</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Comentarios<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{url('/consultaComentarios')}}">Consultar Comentarios</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Promociones<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{url('/consultarPromocion')}}">Consultar promociones</a></li>
            <li><a href="{{url('/registrarPromocion')}}">Registrar promoción</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
               {{ Auth::user()->name }} <span class="caret"></span>
               </a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                     <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      Cerrar sesion
                      </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
             </ul>
          </li>
        </ul>
        @endif
    </div>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      @yield('contenido')
    </div>
  </div>
</div>
<footer class="text-center"> <hr>Negocios Electronicos II &copy; 2017 </footer>
<script src="{{asset("js/bootstrap.js")}}"></script>
</body>
</html>