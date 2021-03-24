<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editeur extends Model
{
    protected $table = "nestix_editeur";
    protected $primaryKey = "id_editeur";
    public $timestamps = false;
}
