@extends('layouts.master') @section('content')
<div class="row">

    <div class="col-sm-4">
        <img src="{{$arrayPeliculas->poster}}" style="height:300px" />
    </div>
    <div class="col-sm-8">
        <h2 style="min-height:45px;margin:5px 0 10px 0">{{$arrayPeliculas->title}}
        <h3 style="margin:5px 0 10px 0">Año: {{$arrayPeliculas->year}}
        <h3 style="margin:5px 0 10px 0">Director: {{$arrayPeliculas->director}}
        <br>
        <br>
        <h4 style="margin:5px 0 10px 0"><b>Resumen: </b> {{$arrayPeliculas->synopsis}}
        <br>
        <br>
        <h4 style="margin:5px 0 10px 0"><b>Estado: </b>
        
        @if ($arrayPeliculas->rented == false)
            Película disponible
            <br>
            <br>
           <form action="{{action('CatalogController@putReturn', $arrayPeliculas->id)}}"
                method="POST" style="display:inline">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary btn-lg" style="display:inline">
                Alquilar Pelicula
                </button>
            </form>
        
        @else
            Película actualmente alquilada
            <br>
            <br>
            <form action="{{action('CatalogController@putReturn', $arrayPeliculas->id)}}"
                method="POST" style="display:inline">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-lg" style="display:inline">
                Devolver película
                </button>
            </form>
        
        @endif
        
        <form action="{{action('CatalogController@getEdit', $arrayPeliculas->id)}}" method="get" style="display:inline">
                {{ method_field('GET') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-warning btn-lg">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar película
        </button>
        
        </form>
        
        <form action="{{action('CatalogController@deleteMovie', $arrayPeliculas->id)}}"
                method="POST" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary btn-lg" style="display:inline">
                Eliminar película
                </button>
            </form>
              
        </form>
        
        <form action="{{action('CatalogController@getIndex')}}" method="get" style="display:inline">
                {{ method_field('GET') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default btn-lg">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver al listado
        </button> 
        
        </form>
        
          
          
    </div>
</div>
@stop