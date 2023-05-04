<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "Cours";

    public function projet()
    {
        return $this->hasMany('App\Models\Projet');
    }

    public function utilisateur()
    {
        return $this->hasMany('App\Models\UtilisateurCours');
    }
}
