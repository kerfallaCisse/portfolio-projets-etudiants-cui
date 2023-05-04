<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommandation extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "Recommandation";

    public function utilisateur()
    {
        return $this->belongsTo('App\Models\Utilisateur', 'user_id');
    }

    public function projet()
    {
        return $this->belongsTo('App\Models\Projet');
    }
}

