<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $table = "nestix_livre";
    protected $primaryKey = "livre_id";
    public $timestamps = false;

    public function editeur(){
        return $this->belongsTo('App\Editeur', 'editeur_id', 'id_editeur');
    }
}
