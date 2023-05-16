<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    //
    public function getAvailableCourses()
    {
        $code_cours = AdministrateurController::get_code_cours();
        $nom_cours = AdministrateurController::get_nom_cours();

        $cours = array_map(function ($code_cours, $nom_cours) {
            return $code_cours ." ".$nom_cours;
        }, $code_cours, $nom_cours);


        return view("search.search", ["cours" => collect($cours)]);
    }

    public function searchProjectsCoursesProcess(Request $request) {
        $data = $request->all();
        $cours = $data["cours"];
        $code_cours = explode(" ",$cours)[0];
        $cours_id_raw = DB::table('Cours')
            ->select('id')
            ->where('code', '=', $code_cours);
        $cours_id = $cours_id_raw->pluck('id')->toArray();
        if (count($cours_id) == 0) {
            $code_cours = AdministrateurController::get_code_cours();
            $nom_cours = AdministrateurController::get_nom_cours();

            $cours = array_map(function ($code_cours, $nom_cours) {
                return $code_cours ." ".$nom_cours;
            }, $code_cours, $nom_cours);
            Session::flash("cours_not_exist", "Désolé, le cours mentionné n'existe pas. Veuillez réessayer.");
            return view("search.search", ["cours" => collect($cours)]);
        }
        return to_route('cours', $cours_id);
    }

    public function showCourseList($id) {
        $utilisateur = DB::table('Utilisateur')
            ->join('Role', 'Role.id', '=', 'Utilisateur.role_id')
            ->select('nom', 'prenom', 'Role.est_enseignant')
            ->where('Utilisateur.id', '=', $id);
        if ($utilisateur->pluck('est_enseignant')->toArray()[0] == 0) {
            return view('introuvable');
        } else {
            $utilisateur_nom = $utilisateur->pluck('nom')->toArray()[0];
            $utilisateur_prenom = $utilisateur->pluck('prenom')->toArray()[0];
            $utilisateur_info = $utilisateur_nom ." ".$utilisateur_prenom;
            $cours = DB::table('Cours')
                ->join('UtilisateurCours', 'UtilisateurCours.cours_id', '=', 'Cours.id')
                ->select('cours_id', 'Cours.code', 'Cours.nom', 'Cours.faculte')
                ->where('UtilisateurCours.user_id', '=', $id);
            $id_cours = $cours->pluck('cours_id');
            $code_cours = $cours->pluck('code')->toArray();
            $nom_cours = $cours->pluck('nom')->toArray();
            $faculte = $cours->pluck('faculte');
            $faculte_class = [];
            foreach($id_cours as $course) {
                array_push($faculte_class, (new ProjectController)->getFacultyClass($course));
            }
            $cours_list = array_map(function ($code_cours, $nom_cours) {
                return $code_cours ." ".$nom_cours;
            }, $code_cours, $nom_cours);
            return view("search.list", [
                "utilisateur" => $utilisateur_info,
                "id" => $id_cours,
                "nom" => collect($cours_list),
                "faculte" => $faculte,
                "faculte_class" => collect($faculte_class)
            ]);
        }
    }


}
