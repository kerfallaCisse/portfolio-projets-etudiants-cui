<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


/****
 * @author kerfalla cissé
 *
 */
class CustomAuthController extends Controller
{

    public function login()
    {
        return view("auth.login");
    }

    public function registration()
    {
        return view("auth.registration");
    }

    public function logout()
    {
        Session::flush();
        return redirect("/");
    }

    public function registration_process(Request $request)
    {

        $data = $request->all();
        # On vérifie si le numéro d'immatriculation existe dans la base de données. Chaque étudiant possède un seul et unique numéro d'immatriculation
        $corresponding_user = Utilisateur::query()->where("no_imm", "=", $data['no_immatriculation'])->get();
        if (count($corresponding_user) == 0) {
            # L'utilisateur n'existe pas dans la base de données alors on crée son compte
            $user = new Utilisateur();
            $user->nom = $data['nom'];
            $user->prenom = $data['prenom'];
            $user->no_imm = $data['no_immatriculation'];
            $user->email_unige = $data['email_unige'];
            # On vérifie la robustesse du mot de passe
            $mdp_unige = $data['email_unige_password'];
            $mdp_perso = $data['email_perso_password'];
            if ($this->verifyPasswordStrength($mdp_perso) && $this->verifyPasswordStrength($mdp_unige)) {
                $user->mdp_unige = password_hash($mdp_unige, PASSWORD_BCRYPT);
                $user->email_perso = $data['email_perso'];
                $user->mdp_perso = password_hash($mdp_perso, PASSWORD_BCRYPT);
                $user->save();

                $role = new Role();
                $role->user_id = $user->id;
                $role->est_etudiant = 0;
                $role->est_enseignant = 0;
                $role->est_administrateur = 0;
                if (array_key_exists("etudiant", $data)) {
                    $role->est_etudiant = 1;
                }
                if (array_key_exists("enseignant", $data)) {
                    $role->est_enseignant = 1;
                }
                $role->save();

                $session_info = array("nom" => $user->nom, "prenom" => $user->prenom, "email_unige" => $user->email_unige, "connected" => true);
                Session::put($session_info);
                return redirect()->route("projects");

            } else {
                return view("auth.mdp_validation");
            }

        }

        return redirect()->route("auth.account");

    }

    public function login_process(Request $request)
    {
        $data = $request->all();
        $email_unige = $data["email_unige"];
        $mdp_unige_hash = password_hash($data["email_unige_password"], PASSWORD_BCRYPT);
        $mdp_unige = $data["email_unige_password"];

        if (password_verify($mdp_unige, $mdp_unige_hash)) {
            # on récupère les informations de l'utilisateur
            $corresponding_user = Utilisateur::query()
                ->where("email_unige", "=", $email_unige)
                ->get();
            if (count($corresponding_user) == 0) {
                return redirect()->route("registration");
            } else {
                $nom = $corresponding_user[0]["nom"];
                $prenom = $corresponding_user[0]["prenom"];
                $emailUnige = $corresponding_user[0]["email_unige"];
                $session_info = array("nom" => $nom, "prenom" => $prenom, "email_unige" => $emailUnige, "connected" => true);
                Session::put($session_info);
                return redirect()->route("projects");
            }
        } else {
            return redirect("/");
        }

    }

    /***
     * @param string $password le mot de passe
     * @return bool true si le mot de passe satisafait les conditions false dans le cas contraire
     */
    private function verifyPasswordStrength(string $password): bool
    {
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@\W@', $password);
        if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            return false;
        }
        return true;

    }


}
