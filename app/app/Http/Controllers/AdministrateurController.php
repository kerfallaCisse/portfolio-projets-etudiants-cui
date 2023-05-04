<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Utilisateur;
use App\Models\UtilisateurCours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/***
 * @author kerfalla cissé
 *
 */
class AdministrateurController extends Controller
{
    public function assigne_professor_cours()
    {
        $nom_cours = $this->get_nom_cours();
        $code_cours = $this->get_code_cours();
        $cours = array_map(function ($code_cours, $nom_cours) {
            return $code_cours . ' ' . $nom_cours;
        }, $code_cours, $nom_cours);

        $enseignants = $this->get_teacher();

        return view("professor_cours", ["cours" => collect($cours)], ["enseignants" => collect($enseignants)]);
    }

    public function process_prof_cours(Request $request)
    {
        $data = $request->all();
        $cours = explode(" ", $data["cours"]);
        $enseignants = explode(",", $data["enseignant"]);

        $code_cours = $cours[0];
        # On récupère l'id du cours en question
        $corresponding_cours = Cours::query()->where("cours_code", "=", $code_cours)->select("id")->get();
        $cours_id = $corresponding_cours[0]->id;
        $currentDate = date('Y-m-d');
        # Process enseignants
        foreach ($enseignants as $enseignant) {

            $enseig = explode(" ", $enseignant);
            $enseig_clean = array_map(function ($element) {
                return trim($element, " ");
            }, $enseig);
            $last_index = count($enseig_clean);
            if ($last_index != 1) {
                $corresponding_teacher_email = $enseig_clean[$last_index - 1];
                # On récupère l'id de l'utilisateur
                $corresponding_teacher = Utilisateur::query()->where("email_unige", "=", $corresponding_teacher_email)->select("id")->get();
                if (count($corresponding_teacher) != 0) {
                    $teacher_id = $corresponding_teacher[0]->id;
                    UtilisateurCours::query()->insert(array("cours_id" => $cours_id, "user_id" => $teacher_id, "created_at" => $currentDate, "updated_at" => $currentDate));
                }
            }
        }
        Session::flash("ajout_prof", "L'assignement a été fait correctement");
        return view("home");
    }


    private function get_code_cours(): array
    {
        $code_cours = Cours::all()->pluck("cours_code");
        return $code_cours->toArray();
    }

    private function get_nom_cours(): array
    {
        $nom_cours = Cours::all()->pluck("cours_nom");
        return $nom_cours->toArray();
    }

    private function get_teacher(): array
    {
        $enseignants = DB::table("Utilisateur")
            ->join("Role", "Role.id", "=", "Utilisateur.id")
            ->where("Role.est_enseignant", "=", 1)
            ->select("Utilisateur.nom", "Utilisateur.prenom", "Utilisateur.email_unige")
            ->get();

        $all_enseignants = array();

        foreach ($enseignants as $enseignant) {
            $nom = $enseignant->nom;
            $prenom = $enseignant->prenom;
            $email_unige = $enseignant->email_unige;
            $professor = $nom . " " . $prenom . " " . $email_unige;
            $all_enseignants[] = $professor;
        }

        return $all_enseignants;
    }
}
