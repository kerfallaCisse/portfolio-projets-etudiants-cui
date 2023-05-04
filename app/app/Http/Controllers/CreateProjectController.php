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

    public function create(Request $request)
    {
        $cours_code = Cours::all()->pluck('cours_code')->toArray();
        $cours_nom = Cours::all()->pluck('cours_nom')->toArray();
        $cours = array_map(function($cours_code, $cours_nom) { return $cours_code . ' ' . $cours_nom; }, $cours_code, $cours_nom);
        $etudiants_no_imm = Utilisateur::all()->pluck('no_imm')->toArray();
        $etudiants_prenom = Utilisateur::all()->pluck('prenom')->toArray();
        $etudiants_nom = Utilisateur::all()->pluck('nom')->toArray();
        $etudiants = array_map(function($etudiants_no_imm, $etudiants_prenom, $etudiants_nom) { return $etudiants_no_imm . ' ' . $etudiants_nom . ' ' . $etudiants_prenom; }, $etudiants_no_imm, $etudiants_prenom, $etudiants_nom);
        return view("project.create", ['cours' => collect($cours)], ['etudiants' => collect($etudiants)]);
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
