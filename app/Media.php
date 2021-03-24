<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Media extends Model
{
    protected $table = "nestix_media";
    protected $primaryKey = "id_media";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];


    public function oeuvre(){
        return $this->belongsTo('App\Oeuvre', 'oeuvre_id', 'id_oeuvre');
    }

    public function image(){
        return $this->belongsTo('App\Image', 'image_id', 'id_image');
    }

    public function notes(){
        return $this->hasMany('App\Note', 'media_id', 'id_media');
    }

    public function artistesMetiersMedias(){
        return $this->hasMany('App\ArtisteMetierMedia', 'media_id', 'id_media');
    }

    public function MediasGenres(){
        return $this->hasMany('App\MediaGenre', 'media_id', 'id_media');
    }

    public function livre(){
        return $this->belongsTo('App\Livre', 'id_media', 'livre_id');
    }
    public function film(){
        return $this->belongsTo('App\Film', 'id_media', 'film_id');
    }
    public function musique(){
        return $this->belongsTo('App\Musique', 'id_media', 'musique_id');
    }





    public function scopeAsc($query){
        return $query->orderBy('nom_oeuvre', 'asc');
    }
    public function scopeNews($query){
        return $query->orderBy('annee_sortie_media', 'desc')->orderBy('date_crea_media', 'desc');
    }
    public function scopeJoinOeuvre($query){
        return $query->leftJoin('nestix_oeuvre', 'id_oeuvre',"=","oeuvre_id");
    }
    public function scopeJoinGenre($query){
        return $query->leftJoin('nestix_media_genre', 'media_id',"=","id_media")
        ->leftJoin('nestix_genre', 'id_genre',"=","genre_id");
    }
    public function scopeJoinImage($query){
        return $query->leftJoin('nestix_image', 'id_image',"=","image_id");
    }
    public function scopeValid($query){
        return $query->where('etat_id', '=', '1');
    }
}
