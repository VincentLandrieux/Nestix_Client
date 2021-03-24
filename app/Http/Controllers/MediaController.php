<?php

namespace App\Http\Controllers;


class MediaController extends Controller
{
    /**
     * Get a validator for an incoming update request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateNote($note){
        return \Illuminate\Support\Facades\Validator::make($note, [
            'note' => ['required', 'integer', 'min:1', 'max:5'],
            'media_id' => ['required', 'integer', 'exists:nestix_media,id_media']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($media_type){
        $medias = \App\Media::valid()->with('oeuvre')->with('image')
        ->joinOeuvre()->asc()
        ->where('type_media', '=', substr($media_type, 0, -1))->get();
        $title = $media_type;

        return view('media.listeMedias', compact('medias', 'title'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByGenre($genre_id){
        $medias = \App\Media::valid()->with('oeuvre')->with('image')
        ->joinOeuvre()->joinGenre()->asc()
        ->where('genre_id', '=', $genre_id)->get();
        $title = \App\Genre::findOrFail($genre_id)['nom_genre'];

        return view('media.listeMedias', compact('medias', 'title'));
    }

    public function indexNews($nb){
        $medias = \App\Media::valid()->with('oeuvre')->with('image')
        ->news()->limit($nb)->get();

        return $medias;
    }
    public function indexScores($nb){
        $medias = \App\Media::valid()->leftJoin('nestix_utilisateur_media', 'media_id',"=","id_media")
        ->joinOeuvre()
        ->joinImage()
        ->select('nestix_media.id_media', 'nestix_oeuvre.nom_oeuvre', 'nestix_media.type_media', 'nestix_image.path_image',
            \DB::raw('AVG(nestix_utilisateur_media.note) AS note_avg'))
        ->groupBy(['nestix_media.id_media', 'nestix_oeuvre.nom_oeuvre', 'nestix_media.type_media', 'nestix_image.path_image'])
        ->orderBy('note_avg', 'DESC')
        ->limit($nb)->get();

        return $medias;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($search){
        if(is_null($search)){
            $medias = null;
        }else{
            $medias = \App\Media::valid()
            ->joinOeuvre()
            ->selectRaw('nom_oeuvre AS nom, id_media AS id, type_media AS type')
            ->where('nom_oeuvre', 'LIKE', '%'.$search.'%')->get();
        }

        return $medias;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = \App\Media::valid()->findOrFail($id);
        $user = auth()->user();
        $note = null;
        $collections = null;
        if(!is_null($user)){
            $note = $user->notes->where('media_id', '=', $media->id_media);
            if(count($note) > 0){
                $note = $note->first()->note;
            }else{
                $note = null;
            }

            $collections = $user->collections;
        }

        return view('media/'.$media->type_media, compact('media', 'user', 'note', 'collections'));
    }

    /**
     * Update the user
     *
     * @return Response
     */
    public function updateNote($media_id, $noteValue){
        $validator = MediaController::validateNote([
            'media_id' => $media_id,
            'note' => $noteValue
        ]);

        // dd($validator->messages());
        if($validator->fails()){
            return redirect(route('media', $media_id))->withErrors($validator->errors());
        }else{
            $user = auth()->user();
            $note = \App\Note::where('utilisateur_id', '=', $user->id_utilisateur)
            ->where('media_id', '=', $media_id)
            ->limit(1)->get();

            if(count($note) == 0){
                $note = new \App\Note();
                $note->media_id = $media_id;
                $note->utilisateur_id = $user->id_utilisateur;
                $note->note = $noteValue;
                $note->date_avis = date("Y-m-d");
                $note->save();
            }

            $note->first()->update([
                'note' => $noteValue,
                'date_avis' => date("Y-m-d")
            ]);

            return redirect(route('media', $media_id));
        }
    }

}
