<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_artiste
 * @property int $image_id
 * @property int $etat_id
 * @property string $nom_artiste
 * @property string $prenom_artiste
 * @property string $surnom_artiste
 * @property string $dob_artiste
 * @property Image $nestixImage
 * @property NestixEtat $nestixEtat
 * @property ArtisteMetierMedia[] $nestixArtisteMetierMedia
 */
class Artiste extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nestix_artiste';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_artiste';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Image', 'image_id', 'id_image');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Etat()
    {
        return $this->belongsTo('App\NestixEtat', 'etat_id', 'id_etat');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ArtistesMetiersMedias()
    {
        return $this->hasMany('App\ArtisteMetierMedia', 'artiste_id', 'id_artiste');
    }



    public function scopeAsc($query){
        return $query->orderBy('surnom_artiste', 'asc');
    }
    public function scopeValid($query){
        return $query->where('etat_id', '=', '1');
    }
}
