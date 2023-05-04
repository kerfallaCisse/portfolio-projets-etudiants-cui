<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


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
        $corresponding_std = Utilisateur::query()->where("no_imm", "=", $data['no_immatriculation'])->get();
        $corresponding_teacher = Utilisateur::query()->where("email_unige", "=", $data["email_unige"])->get();

        if (count($corresponding_std) == 0 || count($corresponding_teacher) == 0) {
            # L'utilisateur n'existe pas dans la base de données alors on crée son compte
            $user = new Utilisateur();
            $user->nom = strtolower($data['nom']);
            $user->prenom = strtolower($data['prenom']);
            $user->no_imm = $data['no_immatriculation'];
            $user->email_unige = strtolower($data['email_unige']);
            $user->email_perso = strtolower($data['email_perso']);
            # On vérifie la robustesse du mot de passe
            $mdp_unige = $data['email_unige_password'];
            $mdp_perso = $data['email_perso_password'];
            $user->mdp_unige = "";
            $user->mdp_perso = "";

            $role = new Role();
            $role->est_etudiant = 0;
            $role->est_enseignant = 0;
            $role->est_administrateur = 0;

            if ($user->email_perso == NULL) {
                # On vérifie la robustesse du mot de passe qu'il a entré pour son email de l'unige
                if ($this->verifyPasswordStrength($mdp_unige) && $this->verifFisrtAndLastName($user->prenom, $user->nom)) {
                    $user->mdp_unige = password_hash($mdp_unige, PASSWORD_BCRYPT);
                } else {
                    return view("auth.mdp_validation");
                }
            } else {
                # On vérife la robustesse des deux mots de passe
                if ($this->verifyPasswordStrength($mdp_perso) && $this->verifyPasswordStrength($mdp_unige) && $this->verifFisrtAndLastName($user->prenom, $user->nom)) {
                    $user->mdp_unige = password_hash($mdp_unige, PASSWORD_BCRYPT);
                    $user->mdp_perso = password_hash($mdp_perso, PASSWORD_BCRYPT);
                } else {
                    return view("auth.mdp_validation");
                }
            }
            # On procède à l'enregistrement des tuples
            if (array_key_exists("etudiant", $data)) {
                $role->est_etudiant = 1;
            }
            if (array_key_exists("enseignant", $data)) {
                $role->est_enseignant = 1;
            }
            # La valeur de l'administrateur est à 0, pour éviter que tout le monde devienne administrateur
            # c'est à l'administrateur de renseigner d'autres administrateurs
            $role->save();
            $user->role_id = $role->id;

            # On crée le tuple utilisateur dans la base de données
            $user->save();
            $session_info = array("nom" => $user->nom,
                "prenom" => $user->prenom,
                "email_unige" => $user->email_unige,
                "est_etudiant" => $role->est_etudiant,
                "est_enseignant" => $role->est_enseignant,
                "est_administrateur" => $role->est_administrateur,
                "connected" => true);
            Session::put($session_info);
            return redirect()->route("projects");
        }

        return view("auth.account");

    }

    public
    function login_process(Request $request)
    {
        $data = $request->all();
        $email_unige = strtolower($data["email_unige"]);
        $mdp_unige = $data["email_unige_password"];
        # On récupère le mot de passe hasher depuis la base de données
        $password_hash_from_db = Utilisateur::query()->where("email_unige", "=", $email_unige)->select("mdp_unige")->get();
        if (count($password_hash_from_db) == 0) {
            Session::put(["fail" => "Les identifiants ne sont pas correctes"]);
            return \redirect()->route("home");
        } else {
            $mdp_unige_hash = $password_hash_from_db[0]["mdp_unige"];
            if (password_verify($mdp_unige, $mdp_unige_hash)) {
                # on récupère les informations de l'utilisateur
                $user = DB::table("Utilisateur")
                    ->join("Role", "Role.id", "=", "Utilisateur.role_id")
                    ->where("Utilisateur.email_unige", "=", $email_unige)
                    ->select("Utilisateur.nom", "Utilisateur.prenom", "Utilisateur.email_unige", "Utilisateur.no_imm","Role.est_etudiant",
                        "Role.est_enseignant", "Role.est_administrateur")
                    ->get();
                # Normalement à ce stade l'utilisateur existe dans la base de données
                if (count($user) == 0) {
                    return to_route("registration");
                }

                # On construit la séssion de l'utilisateur
                $corresponding_user = $user[0];
                $nom = $corresponding_user->nom;
                $prenom = $corresponding_user->prenom;
                $no_imm = $corresponding_user->no_imm;
                $est_etudiant = $corresponding_user->est_etudiant;
                $est_enseignant = $corresponding_user->est_enseignant;
                $est_administrateur = $corresponding_user->est_administrateur;
                $session_info = array(
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "no_imm" => $no_imm,
                    "email_unige" => $email_unige,
                    "est_etudiant" => $est_etudiant,
                    "est_enseignant" => $est_enseignant,
                    "est_administrateur" => $est_administrateur,
                    "connected" => true
                );
                Session::put($session_info);
                return redirect()->route("projects");
            } else {
                Session::put(["fail" => "Les identifiants ne sont pas correctes"]);
                return \redirect()->route("home");
            }
        }

    }


    /***
     * @param string $password le mot de passe
     * @return bool true si le mot de passe satisafait les conditions false dans le cas contraire
     */
    private
    function verifyPasswordStrength(string $password): bool
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
    /***
     * @param string $prenom le prénom de l'utilisateurcd
     * @param string $nom le nom de l'utilisateur
     * @return bool true si le nom et le prénom ne contienne pas des caractères spéciaux et false dans le cas contraire
     *
     */
    private function verifFisrtAndLastName(string $prenom, string $nom): bool
    {

        $_prenom = preg_match("@\W@", $prenom);
        $_nom = preg_match("@\W@", $nom);

        if ($_nom || $_prenom) return false;
        return true;

    }


}
