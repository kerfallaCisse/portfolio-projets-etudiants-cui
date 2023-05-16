<?php

namespace App\Http\Controllers;

use App\Models\Recommandation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

/****
 * @author nikita missiri
 *
 */
class ProjectController extends Controller
{
    public function showUserProjects($id)
    {
        $correspondinguser = $this->getUserById($id);
        $projects = DB::table('Projet')
            ->join('Cours', 'Cours.id', '=', 'Projet.cours_id')
            ->join('UtilisateurProjet', 'Projet.id', '=', 'UtilisateurProjet.projet_id')
            ->select('Projet.id as projet_id', 'Projet.titre', 'Projet.resume', 'Projet.repo_git', 'Projet.acces', 'Projet.taches',
                'Projet.outils_nom', 'Projet.outils_img', 'Projet.visiteurs_ext', 'Projet.participants_non_inscrits',
                'Cours.id as cours_id', 'Cours.code', 'Cours.nom', 'Cours.faculte')
            ->where('UtilisateurProjet.user_id', '=', $id)
            // ->where('Projet.acces', '=', 0) // nous pouvons filtrer pour obtenir que les projets publics et quelques projets privés, mais cela devient complexe
            ->orderBy('Projet.created_at', 'desc');
        $projects_informations = $this->getProjectInfo($projects, $correspondinguser, "unige", "", ["", ""]);
        return view("project.view", $projects_informations);
    }

    public function showCourseProjects($id) {
        $correspondingcourse = $this->getCourseById($id);
        $projects = DB::table('Projet')
            ->join('Cours', 'Cours.id', '=', 'Projet.cours_id')
            ->select('Projet.id as projet_id', 'Projet.titre', 'Projet.resume', 'Projet.repo_git', 'Projet.acces', 'Projet.taches',
                'Projet.outils_nom', 'Projet.outils_img', 'Projet.visiteurs_ext', 'Projet.participants_non_inscrits',
                'Cours.id as cours_id', 'Cours.code', 'Cours.nom', 'Cours.faculte')
            ->where('cours_id', '=', $id)
            ->orderBy('Projet.created_at', 'desc');
        $projects_informations = $this->getProjectInfo($projects, $correspondingcourse, $this->getFacultyClass($id), $this->getFaculty($id), $this->getTeachers($id));
        return view("project.view", $projects_informations);
    }

    public function getProjectInfo($projects, $correspondingelement, $correspondingfaculty_class, $correspondingfaculty, $teachers)  {
        $projet_id = $projects->pluck('projet_id');
        $projet_participants = [];
        $projet_participants_id = [];
        $projet_vignettes = [];
        $projet_recommandations_user = [];
        $projet_recommandations_date = [];
        $projet_recommandations_content = [];
        foreach ($projet_id as $projet) {
            $utilisateurs = DB::table('Utilisateur')
                ->join('UtilisateurProjet', 'Utilisateur.id', '=', 'UtilisateurProjet.user_id')
                ->select('Utilisateur.id as user_id', 'Utilisateur.nom', 'Utilisateur.prenom')
                ->where('UtilisateurProjet.projet_id', '=', $projet)
                ->orderBy('UtilisateurProjet.created_at', 'desc');
            $utilisateurs_id = $utilisateurs->pluck('user_id')->toArray();
            $utilisateurs_nom = $utilisateurs->pluck('Utilisateur.nom')->toArray();
            $utilisateurs_prenom = $utilisateurs->pluck('Utilisateur.prenom')->toArray();
            $utilisateurs_list = array_map(function ($utilisateur_nom, $utilisateur_prenom) {
                return $utilisateur_nom . ' ' . $utilisateur_prenom;
            }, $utilisateurs_nom, $utilisateurs_prenom);
            array_push($projet_participants, $utilisateurs_list);
            array_push($projet_participants_id, $utilisateurs_id);

            $vignette = DB::table('Fichier')
                ->select('chemin', 'vignette')
                ->where('vignette', '>', 0)
                ->where('Fichier.projet_id', '=', $projet)
                ->orderBy('created_at', 'desc');
            $image = $vignette->pluck('chemin')->toArray();
            array_push($projet_vignettes, $image);

            $recommandation = DB::table('Recommandation')
                ->join('Utilisateur', 'Utilisateur.id', '=', 'Recommandation.user_id')
                ->select('Recommandation.date', 'Recommandation.contenu', 'Recommandation.projet_id',
                'Utilisateur.nom', 'Utilisateur.prenom')
                ->where('Recommandation.projet_id', '=', $projet);
            $comment_user_nom = $recommandation->pluck('Utilisateur.nom')->toArray();
            $comment_user_prenom = $recommandation->pluck('Utilisateur.prenom')->toArray();
            $comment_user = array_map(function ($comment_user_nom, $comment_user_prenom) {
                return $comment_user_nom . ' ' . $comment_user_prenom;
            }, $comment_user_nom, $comment_user_prenom);
            $comment_data = $recommandation->pluck('date')->toArray();
            $comment_content = $recommandation->pluck('contenu')->toArray();
            array_push($projet_recommandations_user, $comment_user);
            array_push($projet_recommandations_date, $comment_data);
            array_push($projet_recommandations_content, $comment_content);
        }
        $nom_projet = $projects->pluck('titre');
        $cours_id = $projects->pluck('cours_id');
        $facultes_class = [];
        foreach($cours_id as $course) {
            array_push($facultes_class, $this->getFacultyClass($course));
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
            if($nom != "") {
                array_push($outils_nom_list, explode(", ", $nom));
            } else  {
                array_push($outils_nom_list, []);
            }
        }
        $outils_img = $projects->pluck('outils_img');
        $outils_img_list = [];
        foreach($outils_img as $img) {
            if($img != "storage/images/tools/") {
                array_push($outils_img_list, explode(", ", $img));
            } else {
                array_push($outils_img_list, []);
            }
        }
        $participants_non_inscrits = $projects->pluck('participants_non_inscrits');
        $participants_non_inscrits_list = [];
        foreach($participants_non_inscrits as $participant) {
            if($participant != "") {
                array_push($participants_non_inscrits_list, explode(", ", $participant));
            } else {
                array_push($participants_non_inscrits_list, []);
            }
        }

        return ["element" => $correspondingelement,
            "project_id" => $projet_id,
            "titre" => $nom_projet,
            "resume" => $resume,
            "repo_git" => $repo_git,
            "taches" => collect($taches_list),
            "outils_nom" => collect($outils_nom_list),
            "outils_img" => collect($outils_img_list),
            "acces" => $acces,
            "visiteurs_ext" => collect($emails_list),
            "participants" => collect($projet_participants),
            "participants_id" => collect($projet_participants_id),
            "participants_non_inscrits" => collect($participants_non_inscrits_list),
            "vignettes" => collect($projet_vignettes),
            "cours" => collect($cours),
            "cours_id" => $cours_id,
            "faculte_class" => $correspondingfaculty_class,
            "corresponding_faculte" => $correspondingfaculty,
            "teachers_id" => $teachers[0],
            "teachers" => $teachers[1],
            "faculte" => collect($facultes_class),
            "recommandation_auteur" => collect($projet_recommandations_user),
            "recommandation_date" => collect($projet_recommandations_date),
            "recommandation_contenu" => collect($projet_recommandations_content)
        ];
    }

    public function recommandation_process(Request $request, $id) {
        $data = $request->all();
        $recommandation = new Recommandation();
        $recommandation->contenu = $data['recommandation'];
        $recommandation->projet_id = $id;
        $recommandation->user_id = Session::get('id');
        $recommandation->date = date('Y-m-d');
        $recommandation->save();
        $cours = DB::table('Projet')
            ->select('Projet.cours_id')
            ->where('id', '=', $id);
        $cours_id = $cours->pluck('cours_id')->toArray()[0];
        return redirect()->route('cours', $cours_id);
    }

    public function getAllFilesProject($id) {
        $disk = Storage::disk("public");
        $directory = "storage/projects/" . $id;
        $files = $disk->allFiles($directory);
        $titre = DB::table('Projet')
            ->select('titre')
            ->where('id', '=', $id)->pluck('titre')->toArray()[0];
        $datas = array(
            "id" => $id,
            "titre" => $titre,
            "files" => $files
        );
        return view("project.files")->with($datas);
    }

    public function getUserById($id) {
        $utilisateurs = DB::table('Utilisateur')
            ->select('nom', 'prenom')
            ->where('id', '=', $id);
        $correspondinguser_nom = $utilisateurs->pluck('nom')->toArray()[0];
        $correspondinguser_prenom = $utilisateurs->pluck('prenom')->toArray()[0];
        return $correspondinguser_nom . ' ' . $correspondinguser_prenom;
    }

    public function getCourseById($id) {
        $utilisateurs = DB::table('Cours')
            ->select('code', 'nom')
            ->where('id', '=', $id);
        $correspondingccourse_code = $utilisateurs->pluck('code')->toArray()[0];
        $correspondingcourse_nom = $utilisateurs->pluck('nom')->toArray()[0];
        return $correspondingccourse_code . ' ' . $correspondingcourse_nom;
    }

    public function getFacultyClass($id) {
        $utilisateurs = DB::table('Cours')
            ->select('faculte')
            ->where('id', '=', $id);
        $faculte = $utilisateurs->pluck('faculte')->toArray()[0];
        $nom_faculte = ["psychologie", "societe", "sciences", "lettres", "medecine", "droit", "theologie", "traduction", "economie"];
        foreach($nom_faculte as $nom) {
            if (str_contains(strtolower(iconv('utf-8', 'ascii//TRANSLIT', $faculte)), $nom)) {
                return $nom;
            }
        }
        return "unige";
    }

    public function getFaculty($id) {
        $utilisateurs = DB::table('Cours')
            ->select('faculte')
            ->where('id', '=', $id);
        return $utilisateurs->pluck('faculte')->toArray()[0];
    }

    public function getTeachers($id) {
        $utilisateurs = DB::table('Utilisateur')
            ->join('UtilisateurCours', 'Utilisateur.id', '=', 'UtilisateurCours.user_id')
            ->select('Utilisateur.id', 'Utilisateur.nom', 'Utilisateur.prenom')
            ->where('UtilisateurCours.cours_id', '=', $id);
        $utilisateurs_id = $utilisateurs->pluck('Utilisateur.id')->toArray();
        $utilisateurs_nom = $utilisateurs->pluck('Utilisateur.nom')->toArray();
        $utilisateurs_prenom = $utilisateurs->pluck('Utilisateur.prenom')->toArray();
        $utilisateurs_list = array_map(function ($utilisateur_nom, $utilisateur_prenom) {
            return $utilisateur_nom . ' ' . $utilisateur_prenom;
        }, $utilisateurs_nom, $utilisateurs_prenom);
        return [$utilisateurs_id, collect($utilisateurs_list)];
    }

}
