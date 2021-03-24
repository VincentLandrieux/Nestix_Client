<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchGenre($search){
        if(is_null($search)){
            $genres = null;
        }else{
            $genres = \App\Genre::
            selectRaw('nom_genre AS nom, id_genre AS id, "genre" AS type')
            ->where('nom_genre', 'LIKE', '%'.$search.'%')->get();
        }

        return $genres;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $search = $request->all()['search'];

        $mediaController = new \App\Http\Controllers\MediaController();
        $medias = $mediaController->search($search);
        $artistController = new \App\Http\Controllers\ArtisteController();
        $artists = $artistController->search($search);
        $otherController = new \App\Http\Controllers\OtherController();
        $genres = $otherController->searchGenre($search);

        return $medias->concat($artists)->concat($genres)->sortBy('nom')->values()->all();
    }

    /**
     * Get a validator for an incoming update request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateCollection(array $datas){
        return \Illuminate\Support\Facades\Validator::make($datas, [
            'collection_name' => ['required', 'string', 'max:50']
        ]);
    }

    /**
     * Get a validator for an incoming update request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateProposition(array $datas){
        return \Illuminate\Support\Facades\Validator::make($datas, [
            'title' => ['required', 'string', 'max:60'],
            'type' => ['nullable', 'string', 'in:,livre,film,musique'],
            'resume' => ['nullable', 'string', 'max:3000'],
        ]);
    }

    /**
     * Show the editing proposition form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function proposition(){
        $user = auth()->user();

        return view('proposition', compact('user'));
    }

    /**
     * Create proposition
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createProposition(Request $request){
        $datas = $request->all();

        $validator = OtherController::validateProposition($datas);

        if($validator->fails()){
            return redirect(route('proposition'))->withErrors($validator->errors());
        }else{
            $user = auth()->user();
            $datas['user_id'] = $user->id_utilisateur;
            unset($datas['_token']);
            $storage = \Illuminate\Support\Facades\Storage::disk('api');
            $file_name = 'purpose/user_'.$user->id_utilisateur.'.json';

            $local_datas = [];
            if($storage->exists($file_name)){
                $local_datas = json_decode($storage->get($file_name), true);

                $exist = false;
                foreach($local_datas as $key => $data) {
                    if($data['title'] == $datas['title']){
                        if($data['type'] == $datas['type']){
                            $exist = true;
                            $local_datas[$key] = $datas;
                        }
                    }
                }
                if(!$exist){
                    if(count($local_datas) < 5){
                        $local_datas[count($local_datas)+1] = $datas;
                    }else{
                        return redirect(route('proposition'))->withErrors(['save' => 'Erreur nombre de proposition > 5']);
                    }
                }
            }else{
                $local_datas[1] = $datas;
            }

            if($storage->put($file_name, json_encode($local_datas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT))){
                return redirect(route('profil'));
            }else{
                return redirect(route('proposition'))->withErrors(['save' => 'Erreur lors de la sauvegarde de la proposition']);
            }
        }
    }

    /**
     * Create collection
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createCollection(Request $request){
        $datas = $request->all();

        $validator = OtherController::validateCollection($datas);

        if($validator->fails()){
            return redirect(route('profil'))->withErrors($validator->errors());
        }else{
            $user = auth()->user();
            $collection = new \App\Collection();
            $collection->nom_collection = $datas['collection_name'];
            $collection->utilisateur_id = $user->id_utilisateur;
            $collection->date_crea_collection = date("Y-m-d");
            $collection->save();

            return redirect(route('profil'));
        }
    }

    /**
     * Update collection
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateCollection($collection_id, Request $request){
        $datas = $request->all();

        $validator = OtherController::validateCollection($datas);

        if($validator->fails()){
            return redirect(route('profil'))->withErrors($validator->errors());
        }else{
            $user = auth()->user();
            $collection = \App\Collection::findOrFail($collection_id);
            if($collection->utilisateur_id == $user->id_utilisateur){
                $collection->update([
                    'nom_collection' => $datas['collection_name']
                ]);
            }

            return redirect(route('profil'));
        }
    }

    /**
     * Delete collection
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteCollection($collection_id){
        $user = auth()->user();
        $collection = \App\Collection::findOrFail($collection_id);
        if($collection->utilisateur_id == $user->id_utilisateur){
            $collection->delete();
        }

        return redirect(route('profil'));
    }

    /**
     * Create media collection
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createMediaCollection($collection_id, $media_id){
        $user = auth()->user();
        $collection = \App\Collection::findOrFail($collection_id);
        if($collection->utilisateur_id == $user->id_utilisateur){
            $media = \App\Media::findOrFail($media_id);
            $mediaCollection = new \App\MediaCollection();
            $mediaCollection->media_id = $media_id;
            $mediaCollection->collection_id = $collection_id;
            $mediaCollection->save();
        }

        return back();
    }
    /**
     * Delete media collection
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteMediaCollection($collection_id, $media_id){
        $user = auth()->user();
        $collection = \App\Collection::findOrFail($collection_id);
        if($collection->utilisateur_id == $user->id_utilisateur){
            $mediaCollection = \App\MediaCollection::
            where("media_id", "=", $media_id)
            ->where("collection_id", "=", $collection_id)->firstOrFail();

            $mediaCollection->delete();
        }

        return back();
    }
}
