<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Utilisateur;
use App\Models\UtilisateurProjet;
use App\Models\Fichier;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


/****
 * @author nikita missiri
 *
 */
class CreateProjectController extends Controller
{

    public function create()
    {
        $cours = Cours::all()->pluck('cours_nom');
        return view("project.create", ['cours' => $cours]);
    }

    public function creation_process(Request $request)
    {
        $data = $request->all();

        $project = new Projet();
        $userproject = new UtilisateurProjet();

        $project->titre = $data['projet_titre'];
        $project->cours = $data[''];
    }

}
