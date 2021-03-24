<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metier extends Model
{
    protected $table = "nestix_metier";
    protected $primaryKey = "id_metier";
    public $timestamps = false;
}
