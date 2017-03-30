<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index() 
   {
    return response()->json(Movie::all());
   }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return response()->json( ['error' => false,
                                  'msg' => 'La película se ha guardado exitosamente' ] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return response()->json( Movie::findOrFail($id) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $year = $request->input('year');
        $director = $request->input('director');
        $poster = $request->input('poster');
        $rented = $request->input('rented');
        $synopsis = $request->input('synopsis');
        $arrayPeliculas = Movie::findOrFail($id);
        $arrayPeliculas->title=$title;
        $arrayPeliculas->year=$year;
        $arrayPeliculas->director=$director;
        $arrayPeliculas->poster=$poster;
        $arrayPeliculas->rented=$rented;
        $arrayPeliculas->synopsis=$synopsis;
        $arrayPeliculas->save();
        return response()->json( ['error' => false,
                                  'msg' => 'La película se ha modificado exitosamente' ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arrayPeliculas = Movie::findOrFail($id);
        $arrayPeliculas->delete();
        Notification::success('Película Eliminada');
        return redirect()->action('CatalogController@getIndex');
    }
    
    public function putRent($id) {
        $m = Movie::findOrFail( $id );
        $m->rented = true;
        $m->save();
        return response()->json( ['error' => false,
                                  'msg' => 'La película se ha marcado como alquilada' ] );
    }
    
    public function putReturn($id) {
        $m = Movie::findOrFail( $id );
        $m->rented = false;
        $m->save();
        return response()->json( ['error' => false,
                                  'msg' => 'La película se ha marcado como disponible' ] );
    }
}