<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaGenre extends Model
{
    protected $table = "nestix_media_genre";
    public $timestamps = false;

    public function media(){
        return $this->belongsTo('App\Media', 'media_id', 'id_media');
    }
    public function genre(){
        return $this->belongsTo('App\Genre', 'genre_id', 'id_genre');
    }
}
