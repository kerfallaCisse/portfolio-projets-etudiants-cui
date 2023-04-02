<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /*
    Différents modèles peuvent avoir différentes connexions à la base de données.
    Ainsi, vos modèles utilisent la connexion par défaut normale - mais notre model  peut utiliser une autre connexion
     *
     * */
    #protected $connection =  'second_db_connection';
    protected $connection = "mysql";
    protected $table = 'articles'; # ceci est nécessaire pour l'ORM qui utilise une classe pour chaque table

}
