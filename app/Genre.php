<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = "nestix_genre";
    protected $primaryKey = "id_genre";
    public $timestamps = false;
}
