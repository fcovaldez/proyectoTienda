@extends('userMaster')
@section('contenido')
<div class="container">
    <div class="row">
    <hr><hr>
     <div class="col-md-3">
                <p class="lead">Categorias</p>
                <div class="list-group">
                    @foreach($categorias as $c)
                    <a href="{{url('/articulosporCategoria')}}/{{$c->id}}" class="list-group-item">{{$c->nombre}}</a>
                    @endforeach
                </div>
                <div class="form-group">
        <label for="filtro">Filtros:</label>
        <form action="{{url('/filtrar')}}" method="get">
        <select name="filtro" class="form-control">
                <option value="default">Selecciona un filtro</option>
                <option value="popular">Mas Popular</option>
                <option value="mayores500">Mayor a 500</option>
                <option value="menores500">Menor a 500</option>
                <option value="mayoramenor">Precio de mayor a menor</option>
                <option value="menoramayor">Precio de menor a mayor</option>
        </select>
        <button type="submit" class="btn btn-primary btn-btn-xs">Filtrar</button>
        </form>
    </div>
            </div>
            <div class="col-md-9">
                <div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($articulos as $a)
                <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="{{$a->imagenURL}}" class="img-thumbnail" alt="">
                    <div class="caption">
                    <h4 class="pull-right">${{$a->precio}}</h4>
                    <h4><a href="{{url('articuloIndividual')}}/{{$a->id}}">{{$a->nombre}}</a></h4>
                    @if($a->existencia>0)
                    <a href="{{url('/agregarcarrito')}}/{{$a->id}}" class="btn btn-primary btn-xs">Agregar al carrito</a>
                    @else
                    <label class="label label-danger">No disponible</label>
                    @endif
                </div>
                <div class="ratings">
                        <p>Calificacion: 
                            @for($i=0;$i<$a->promedioRating;$i++)
                            <span class="glyphicon glyphicon-star"></span>
                            @endfor
                        </p>
                </div>
                </div>
            
            </div>
            @endforeach
    </div>
</div>
@stop