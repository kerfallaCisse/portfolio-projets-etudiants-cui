<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "Utilisateur";

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function cours()
    {
        return $this->hasMany('App\Models\UtilisateurCours');
    }

    public function projet()
    {
        return $this->hasMany('App\Models\UtilisateurProjet');
    }

    public function recommandation()
    {
        return $this->hasMany('App\Models\Recommandation');
    }
}
