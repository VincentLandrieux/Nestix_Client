<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oeuvre extends Model
{
    protected $table = "nestix_oeuvre";
    protected $primaryKey = "id_oeuvre";
    public $timestamps = false;
}
