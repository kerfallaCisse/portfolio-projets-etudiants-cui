<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "Projet";

    public function utilisateur()
    {
        return $this->hasMany('App\Models\UtilisateurProjet');
    }

    public function cours()
    {
        return $this->belongsTo('App\Models\Cours');
    }

    public function recommandation()
    {
        return $this->hasMany('App\Models\Recommandation');
    }

    public function fichier()
    {
        return $this->hasMany('App\Models\Fichier');
    }

}
