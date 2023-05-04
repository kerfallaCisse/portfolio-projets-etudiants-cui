<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Utilisateur;
use App\Models\UtilisateurProjet;
use App\Models\Fichier;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


/****
 * @author nikita missiri
 *
 */
class CreateProjectController extends Controller
{

    public function create()
    {
        $cours_code = Cours::all()->pluck('cours_code')->toArray();
        $cours_nom = Cours::all()->pluck('cours_nom')->toArray();
        $cours = array_map(function($cours_code, $cours_nom) { return $cours_code . ' ' . $cours_nom; }, $cours_code, $cours_nom);
        $etudiants = DB::table('Utilisateur')
            ->join('Role', 'Utilisateur.Role_id', '=', 'Role.id')
            ->select('Utilisateur.*', 'est_etudiant')
            ->where('est_etudiant', '=', 1);
        $etudiants_no_imm = $etudiants->pluck('no_imm')->toArray();
        $etudiants_prenom = $etudiants->pluck('prenom')->toArray();
        $etudiants_nom = $etudiants->pluck('nom')->toArray();
        $etudiants_list = array_map(function($etudiants_no_imm, $etudiants_prenom, $etudiants_nom) { return $etudiants_no_imm . ' ' . $etudiants_nom . ' ' . $etudiants_prenom; }, $etudiants_no_imm, $etudiants_prenom, $etudiants_nom);
        return view("project.create", ['cours' => collect($cours)], ['etudiants' => collect($etudiants_list)]);
    }

    public function creation_process(Request $request)
    {
        $path = $request->file();

        $project = new Projet();
        $userproject = new UtilisateurProjet();

        $project->titre = $data['projet_titre'];
        $project->cours = $data[''];
    }

}
