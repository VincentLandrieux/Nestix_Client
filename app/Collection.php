<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = "nestix_collection";
    protected $primaryKey = "id_collection";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_collection'
    ];

    public function mediasCollections(){
        return $this->hasMany('App\MediaCollection', 'collection_id', 'id_collection');
    }
}
