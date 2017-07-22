@extends('userMaster')
@section('contenido')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
        <p class="lead">Proyecto Tec</p>
            <div class="col-md-3">
                <div class="list-group">
                    @foreach($categorias as $c)
                    <a href="{{url('/articulosporCategoria')}}/{{$c->id}}" class="list-group-item">{{$c->nombre}}</a>
                    @endforeach
                </div>
            </div>

            <div class="col-md-9">
                <div class="thumbnail">
                    <img class="img-responsive" src="http://placehold.it/800x300" alt="">
                    <div class="caption-full">
                        <h4 class="pull-right">${{$articulo->precio}}</h4>
                        <h4><a href="#">{{$articulo->nombre}}</a></h4>
                        <p>{{$articulo->descripcion}}</p>
                    </div>
                    <div class="ratings">
                        <p class="pull-right">3 reviews</p>
                        <p>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            4.0 stars
                        </p>
                    </div>
                </div>

                <div class="well">
                    <div class="text-right">
                        <a class="btn btn-success">Comentar</a>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Anonymous
                            <span class="pull-right">10 days ago</span>
                            <p>This product was great in terms of quality. I would definitely buy another!</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
@stop