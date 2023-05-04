<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilisateurCours extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "UtilisateurCours";

    public function utilisateur()
    {
        return $this->belongsTo('App\Models\Utilisateur', 'user_id');
    }

    public function cours()
    {
        return $this->belongsTo('App\Models\Cours');
    }
}
