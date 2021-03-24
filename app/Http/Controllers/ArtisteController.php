<?php

namespace App\Http\Controllers;


class ArtisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($search){
        if(is_null($search)){
            $artists = null;
        }else{
            $artists = \App\Artiste::valid()
            ->selectRaw('surnom_artiste AS nom, id_artiste AS id, "artiste" AS type')
            ->where('surnom_artiste', 'LIKE', '%'.$search.'%')->get();
        }

        return $artists;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = \App\Artiste::valid()->findOrFail($id);

        return view('artist', compact('artist'));
    }

}
