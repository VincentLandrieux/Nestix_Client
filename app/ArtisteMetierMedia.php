<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtisteMetierMedia extends Model
{
    protected $table = "nestix_artiste_metier_media";
    public $timestamps = false;

    public function artiste(){
        return $this->belongsTo('App\Artiste', 'artiste_id', 'id_artiste');
    }
    public function metier(){
        return $this->belongsTo('App\Metier', 'metier_id', 'id_metier');
    }
    public function media(){
        return $this->belongsTo('App\Media', 'media_id', 'id_media');
    }
}
