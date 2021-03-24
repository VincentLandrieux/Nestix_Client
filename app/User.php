<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "nestix_utilisateur";
    protected $primaryKey = "id_utilisateur";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo_utilisateur', 'email_utilisateur', 'mdp_utilisateur', 'dob_utilisateur'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'mdp_utilisateur', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword(){
        return $this->attributes['mdp_utilisateur'];
    }

    /**
     * Retrun the medias
     */
    public function medias(){
        return $this->hasMany(Media::class);
    }

    public function notes(){
        return $this->hasMany('App\Note', 'utilisateur_id', 'id_utilisateur');
    }

    public function collections(){
        return $this->hasMany('App\Collection', 'utilisateur_id', 'id_utilisateur');
    }
}
