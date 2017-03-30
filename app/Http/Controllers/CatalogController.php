<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Catalog;
use App\Movie;
use Notification;

class CatalogController extends Controller
{
    public function getIndex(){
        $arrayPeliculas = Movie::all();
        return view('catalog.index')->with('arrayPeliculas',$arrayPeliculas);
    }
    public function getShow($id){
   $arrayPeliculas = Movie::find($id);
        return view('catalog.show')->with('arrayPeliculas',$arrayPeliculas);
    }
    public function getCreate(){
        return view('catalog.create');
    }
    public function getEdit($id){
        $arrayPeliculas = Movie::find($id);
        return view('catalog.edit')->with('arrayPeliculas',$arrayPeliculas);
    }
    
    public function postCreate (Request $request){
        $id = $request->input('id');
        $title = $request->input('title');
        $year = $request->input('year');
        $director = $request->input('director');
        $poster = $request->input('poster');
        $synopsis = $request->input('synopsis');
        $arrayPeliculas = new Movie;
        $arrayPeliculas->id=$id;
        $arrayPeliculas->title=$title;
        $arrayPeliculas->year=$year;
        $arrayPeliculas->director=$director;
        $arrayPeliculas->poster=$poster;
        $arrayPeliculas->rented='0';
        $arrayPeliculas->synopsis=$synopsis;
        $arrayPeliculas->save();
        Notification::success('Película Guardada Exitosamente');
        return redirect()->action('CatalogController@getIndex');
    }
    
    public function putEdit(Request $request, $id){
        $title = $request->input('title');
        $year = $request->input('year');
        $director = $request->input('director');
        $poster = $request->input('poster');
        $rented = $request->input('rented');
        $synopsis = $request->input('synopsis');
        $arrayPeliculas = Movie::find($id);
        $arrayPeliculas->title=$title;
        $arrayPeliculas->year=$year;
        $arrayPeliculas->director=$director;
        $arrayPeliculas->poster=$poster;
        $arrayPeliculas->rented=$rented;
        $arrayPeliculas->synopsis=$synopsis;
        $arrayPeliculas->save();
        Notification::success('Película Modificada con éxito');
        return redirect()->action('CatalogController@getShow',[$id]);
        
    }
    
    public function putRent(Request $request, $id){
        $arrayPeliculas = Movie::find($id);
        $arrayPeliculas->rented= !$arrayPeliculas->rented;
        $arrayPeliculas->save();
        Notification::success('Película Modificada con éxito');
        return redirect()->action('CatalogController@getShow',[$id]);
    }
    
     public function putReturn(Request $request, $id){
        $arrayPeliculas = Movie::find($id);
        $arrayPeliculas->rented= !$arrayPeliculas->rented;
        $arrayPeliculas->save();
        Notification::success('Película Modificada con éxito');
        return redirect()->action('CatalogController@getShow',[$id]);
    }
    
    public function deleteMovie(Request $request, $id){
        $arrayPeliculas = Movie::find($id);
        $arrayPeliculas->delete();
        Notification::success('Película Eliminada');
        return redirect()->action('CatalogController@getIndex');
    }


}