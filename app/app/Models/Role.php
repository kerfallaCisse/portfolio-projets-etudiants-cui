<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "Role";

    public function utilisateur()
    {
        return $this->hasMany('App\Models\Utilisateur');
    }
}
