<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function showProjects() {
        $correspondinguser_noimm = Session::get("no_imm");
        $correspondinguser_email = Session::get("email_unige");
        $correspondinguser_nom = Session::get("nom");
        $correspondinguser_prenom = Session::get("prenom");
        $correspondinguser = $correspondinguser_nom . ' ' . $correspondinguser_prenom;
        $user_id = "";
        if ($correspondinguser_noimm != null) {
            $user_id = DB::table('Utilisateur')->select('id')->where('no_imm', '=', $correspondinguser_noimm)->pluck('id')->toArray()[0];
        } else {
            $user_id = DB::table('Utilisateur')->select('id')->where('email_unige', '=', $correspondinguser_email)->pluck('id')->toArray()[0];
        }
        $projects = DB::table('Projet')
            ->join('Cours', 'Cours.id', '=', 'Projet.cours_id')
            ->join('UtilisateurProjet', 'Projet.id', '=', 'UtilisateurProjet.projet_id')
            ->select('Projet.id', 'Projet.titre', 'Projet.resume', 'Projet.repo_git', 'Projet.acces', 'Projet.taches',
                'Projet.outils_nom','Projet.outils_img', 'Projet.visiteurs_ext', 'Projet.participants_non_inscrits',
                'Cours.code', 'Cours.nom', 'Cours.faculte')
            ->where('UtilisateurProjet.user_id', '=', $user_id)
            ->orderBy('Projet.created_at', 'desc');
        $projet_id = $projects->pluck('id');
        $projet_participants = [];
        $projet_vignettes = [];

        foreach ($projet_id as $projet) {
            $utilisateurs = DB::table('Utilisateur')
                ->join('UtilisateurProjet', 'Utilisateur.id', '=', 'UtilisateurProjet.user_id')
                ->select('Utilisateur.nom', 'Utilisateur.prenom')
                ->where('UtilisateurProjet.projet_id', '=', $projet)
                ->orderBy('UtilisateurProjet.created_at', 'desc');
            $utilisateurs_info = [];
            $utilisateurs_nom = $utilisateurs->pluck('Utilisateur.nom')->toArray();
            $utilisateurs_prenom = $utilisateurs->pluck('Utilisateur.prenom')->toArray();
            $utilisateurs_list = array_map(function ($utilisateur_nom, $utilisateur_prenom) {
                return $utilisateur_nom . ' ' . $utilisateur_prenom;
            }, $utilisateurs_nom, $utilisateurs_prenom);
            array_push($projet_participants, $utilisateurs_list);

            $vignette = DB::table('Fichier')
                ->select('chemin', 'vignette')
                ->where('vignette', '>', 0)
                ->where('Fichier.projet_id', '=', $projet)
                ->orderBy('created_at', 'desc');
            $image = $vignette->pluck('chemin')->toArray();
            array_push($projet_vignettes, $image);
        }
        $nom_projet = $projects->pluck('titre');
        $cours_faculte = $projects->pluck('faculte')->toArray();
        $facultes = [];
        foreach($cours_faculte as $faculte) {
            if (explode(" ", $faculte)[0] != "Faculté") {
                array_push($facultes, "unige");
            } else {
                $nom_faculte = ["sciences", "lettres", "medecine", "droit", "theologie", "psychologie", "traduction", "economie", "societe"];
                foreach($nom_faculte as $nom) {
                    if (str_contains(strtolower(iconv('utf-8', 'ascii//TRANSLIT', $faculte)), $nom)) {
                        array_push($facultes, $nom);
                    }
                }
            }
        }
        $cours_code = $projects->pluck('Cours.code')->toArray();
        $cours_nom = $projects->pluck('Cours.nom')->toArray();
        $cours = array_map(function ($cours_code, $cours_nom) {
            return $cours_code . ' ' . $cours_nom;
        }, $cours_code, $cours_nom);
        $resume = $projects->pluck('resume');
        $repo_git = $projects->pluck('repo_git');
        $acces = $projects->pluck('acces');
        $emails = $projects->pluck('visiteurs_ext');
        $emails_list = [];
        foreach($emails as $email) {
            array_push($emails_list, explode(", ", $email));
        }
        $taches = $projects->pluck('taches');
        $taches_list = [];
        foreach($taches as $tache) {
            array_push($taches_list, explode(", ", $tache));
        }
        $outils_nom = $projects->pluck('outils_nom');
        $outils_nom_list = [];
        foreach($outils_nom as $nom) {
            array_push($outils_nom_list, explode(", ", $nom));
        }
        $outils_img = $projects->pluck('outils_img');
        $outils_img_list = [];
        foreach($outils_img as $img) {
            array_push($outils_img_list, explode(", ", $img));
        }
        $participants_non_inscrits = $projects->pluck('participants_non_inscrits');
        $participants_non_inscrits_list = [];
        foreach($participants_non_inscrits as $participant) {
            array_push($participants_non_inscrits_list, explode(", ", $participant));
        }

        return view("project.view", [ "utilisateur" => $correspondinguser,
            "id" => $projet_id,
            "titre" => $nom_projet,
            "resume" => $resume,
            "repo_git" => $repo_git,
            "taches" => collect($taches_list),
            "outils_nom" => collect($outils_nom_list),
            "outils_img" => collect($outils_img_list),
            "acces" => $acces,
            "visiteurs_ext" => collect($emails_list),
            "participants" => collect($projet_participants),
            "participants_non_inscrits" => collect($participants_non_inscrits_list),
            "vignettes" => collect($projet_vignettes),
            "cours" => collect($cours),
            "faculte" => collect($facultes),
            'links' => [public_path('storage') => storage_path('app/public')]
        ]);
    }
}


