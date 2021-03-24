<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musique extends Model
{
    protected $table = "nestix_musique";
    protected $primaryKey = "musique_id";
    public $timestamps = false;
}
