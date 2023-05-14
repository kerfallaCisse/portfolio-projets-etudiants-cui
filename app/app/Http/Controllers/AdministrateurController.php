<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Role;
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

        return view("admin.professor_cours", ["cours" => collect($cours)], ["enseignants" => collect($enseignants)]);
    }

    public function process_prof_cours(Request $request)
    {
        $data = $request->all();
        $cours = explode(" ", $data["cours"]);
        $enseignants = $data["enseignants"];

        $code_cours = $cours[0];
        # On récupère l'id du cours en question
        $corresponding_cours = Cours::query()->where("code", "=", $code_cours)->select("id")->get();
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
        Session::flash("ajout_prof", "L'assignement a été fait correctement.");
        return view("home");
    }


    public static function get_code_cours(): array
    {
        $code_cours = Cours::all()->pluck("code");
        return $code_cours->toArray();
    }

    public static function get_nom_cours(): array
    {
        $nom_cours = Cours::all()->pluck("nom");
        return $nom_cours->toArray();
    }

    private function get_teacher(): array
    {
        $enseignants = DB::table("Utilisateur")
            ->join("Role", "Role.id", "=", "Utilisateur.role_id")
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

    public function add_admin()
    {
        $admins = $this->get_admin();
        return view("admin.add_admin", ["admins" => collect($admins)]);
    }

    public function process_add_admin(Request $request)
    {
        $data = $request->all();
        $admins = $data["admins"];
        $currentDate = date('Y-m-d');
        foreach ($admins as $admin) {
            $adm = explode(" ", $admin);
            $adm_clean = array_map(function ($element) {
                return trim($element, " ");
            }, $adm);
            $last_index = count($adm_clean);
            if ($last_index != 1) {
                $corresponding_user_email = $adm_clean[$last_index - 1];
                # On récupère l'id de l'utilisateur
                $corresponding_user = Utilisateur::query()->where("email_unige", "=", $corresponding_user_email)->select("id")->get();
                if (count($corresponding_user) != 0) {
                    $user_id = $corresponding_user[0]->id;
                    # On récupère l'id du role de l'utilisateur en question
                    $role_id = Utilisateur::query()->where("id", "=", $user_id)->select("role_id")->get()[0]->role_id;
                    Role::query()->where("id", "=", $role_id)->update(array("est_administrateur" => 1, "updated_at" => $currentDate));
                }
            }
        }
        Session::flash("ajout_admin", "L'ajout des administrateurs a été fait avec succès.");
        return view("home");
    }

    private function get_admin(): array
    {
        $admins = DB::table("Utilisateur")
            ->join("Role", "Role.id", "=", "Utilisateur.role_id")
            ->where("Role.est_administrateur", "=", 0)
            ->select("Utilisateur.nom", "Utilisateur.prenom", "Utilisateur.email_unige")
            ->get();

        $all_admins = array();

        foreach ($admins as $enseignant) {
            $nom = $enseignant->nom;
            $prenom = $enseignant->prenom;
            $email_unige = $enseignant->email_unige;
            $professor = $nom . " " . $prenom . " " . $email_unige;
            $all_admins[] = $professor;
        }

        return $all_admins;
    }
}
