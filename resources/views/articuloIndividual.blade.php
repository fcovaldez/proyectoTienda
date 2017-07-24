@extends('userMaster')
@section('contenido')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
        <p class="lead">Categorias</p>
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
                        <a href="{{url('/agregarcarrito')}}/{{$articulo->id}}" class="btn btn-primary">Agregar al carrito</a>
                    </div>
                    <div class="ratings">
                        <p class="pull-right">Comentarios: {{$totalComentarios}}</p>
                        <p>Calificacion: 
                            @for($i=0;$i<$articulo->promedioRating;$i++)
                            <span class="glyphicon glyphicon-star"></span>
                            @endfor
                        </p>
                    </div>
                </div>
                <form action="{{url('/comentarioArticulo')}}/{{$articulo->id}}" method="POST">
                <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                <div class="well">
                <p>Calificar:<span id="Estrellas"> </span></p>
                <input type="text" name="ratingArt" id="ratingArt" require value="3" hidden="true">
                <input type="text" name="comentario" class="form-control" required>
                    <div class="text-right">
                    <button class="btn btn-primary" type="submit">Comentar</button>
                    </div>
                    <script>
                    $('#Estrellas').starrr({
                        rating:3,
                        change:function(e,valor){
                           $("#ratingArt").val(valor);
                        }
                    });
                    </script>
                </form>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($comentarios as $c)
                            @for($i=0;$i<$c->rating;$i++)
                            <span class="glyphicon glyphicon-star"></span>
                            @endfor
                            {{$c->correo}}
                            <p>{{$c->comentario}}</p>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
@stop