<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "Fichier";

    public function projet()
    {
        return $this->belongsTo('App\Models\Projet');
    }
}
