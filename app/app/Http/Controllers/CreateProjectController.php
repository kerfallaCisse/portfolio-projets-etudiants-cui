<?php

namespace App\Http\Controllers;

use App\Models\Projet;
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
        $cours_code = Cours::all()->pluck('code')->toArray();
        $cours_nom = Cours::all()->pluck('nom')->toArray();
        $cours = array_map(function ($cours_code, $cours_nom) {
            return $cours_code . ' ' . $cours_nom;
        }, $cours_code, $cours_nom);
        sort($cours);
        $correspondinguser_noimm = Session::get("no_imm");
        $correspondinguser_email = Session::get("email_unige");
        $correspondinguser_nom = Session::get("nom");
        $correspondinguser_prenom = Session::get("prenom");
        $correspondinguser = "";
        $utilisateurs = DB::table('Utilisateur');
        if (Session::get("est_enseignant")) {
            $utilisateurs = DB::table('Utilisateur')
                ->join('Role', 'Utilisateur.Role_id', '=', 'Role.id')
                ->select('Utilisateur.*')
                ->where('Utilisateur.email_unige', '!=', $correspondinguser_email);
            $correspondinguser = $correspondinguser_nom . ' ' . $correspondinguser_prenom . ' ' . $correspondinguser_email;
        } else {
            $utilisateurs = DB::table('Utilisateur')
                ->join('Role', 'Utilisateur.Role_id', '=', 'Role.id')
                ->select('Utilisateur.*', 'est_etudiant')
                ->where('est_etudiant', '=', 1)
                ->where('Utilisateur.no_imm', '!=', $correspondinguser_noimm);
            $correspondinguser = $correspondinguser_noimm . ' ' . $correspondinguser_nom . ' ' . $correspondinguser_prenom;
        }
        $utilisateurs_no_imm = $utilisateurs->pluck('no_imm')->toArray();
        $utilisateurs_prenom = $utilisateurs->pluck('prenom')->toArray();
        $utilisateurs_nom = $utilisateurs->pluck('nom')->toArray();
        $utilisateurs_email = $utilisateurs->pluck('email_unige')->toArray();
        $utilisateurs_list = array_map(
            function($utilisateurs_no_imm, $utilisateurs_prenom, $utilisateurs_nom, $utilisateurs_email) {
                if ($utilisateurs_no_imm == null) {
                    return $utilisateurs_nom . ' ' . $utilisateurs_prenom . ' ' . $utilisateurs_email;
                } else {
                    return $utilisateurs_no_imm . ' ' . $utilisateurs_nom . ' ' . $utilisateurs_prenom;
                }
            }, $utilisateurs_no_imm, $utilisateurs_prenom, $utilisateurs_nom, $utilisateurs_email);
        sort($utilisateurs_list);
        return view("project.create", ['cours' => collect($cours), 'utilisateurs' => collect($utilisateurs_list), 'utilisateur' => $correspondinguser]);
    }

    public function creation_process(Request $request)
    {
        $data = $request->all();

        // Création d'un nouveau tuple dans la table 'Projet'
        $project = new Projet();
        $project->titre = $data['titre'];
        $code_cours = explode(" ", $data['cours'])[0];
        $project->cours_id = DB::table('Cours')->select('id')->where('code', '=', $code_cours)->pluck('id')->toArray()[0];
        $taches = $data['taches'];
        $project->taches = join(", ", $taches);
        $project->repo_git = $data['repo_git'];
        $outils = $data['outils'];
        $outils_img = [];
        $svg = ["Agda", "APlus", "ATS", "Awk", "BQN", "Chapel", "Chicken", "Clojure", "CoffeeScript", "Coq", "CPlusPlus",
            "Crystal", "CSharp", "D", "Dart", "Egel", "Eiffel", "Elm", "Erlang", "Fantom", "Fortran", "FSharp", "FStar",
            "Go", "Granule", "Green", "Hack", "Haskell", "Haxe", "Huginn", "Hy", "Java", "JavaScript", "Julia", "Kawa",
            "Koka", "Kotlin", "Lisp", "Lua", "Mathics", "MatLab", "Nim", "Oberon", "OCaml", "Octave", "Odin", "Perl",
            "Pharo", "PHP", "PicoLisp", "PureScript", "Python", "QB64", "R", "Racket", "Raku", "Reason", "Red", "Ruby",
            "Rust", "SAS", "Scala", "Shakti", "Squeak", "Swift", "Tcl", "TypeScript", "Wax", "WebAssembly", "Wolfram"];
        $png = ["AJAX", "Angular", "Axure", "Bootstrap", "C", "CakePHP", "Ceylon", "Cryptol", "Delphi", "Django", "Elixir",
            "Euphoria", "ExpressJS", "Figma", "Flask", "Groovy", "Idris", "Inkscape", "J", "jQuery", "Laravel", "NodeJS",
            "Odoo", "OpenSCAD", "Oxygene", "PheonixFramework", "Pheonix", "PlantUML", "PlayFramework", "Prolog", "Pyret",
            "React", "Spring", "Sass", "Unity", "Unreal", "yEd", "Zig"];
        $jpg = ["Maple"];
        foreach($outils as $outil) {
            $mimeType = "";
            if (in_array($outil, $svg)) {
                $mimeType = ".svg";
            } elseif (in_array($outil, $png)) {
                $mimeType = ".png";
            } elseif (in_array($outil, $jpg)) {
                $mimeType = ".jpg";
            }
            array_push($outils_img, "storage/images/tools/" . $outil . $mimeType);
        }
        $project->outils_nom = join(", ", $outils);
        $project->outils_img = join(", ", $outils_img);
        $project->resume = $data['resume'];
        $acces = $data['acces'];
        if ($acces == "public") {
            $project->acces = 0;
        } else {
            $project->acces = 1;
            $visiteurs_ext = $data['emails'];
            $project->visiteurs_ext = join(", ", $visiteurs_ext);
        }
        $project->save();

        // Création de tuples dans la table 'UtilisateurProjet'
        $utilisateurs = $data['participants'];
        $currentDate = date('Y-m-d');
        $projet_id = $project->id;
        // on traite l'utilisateur qui dépose le projet en premier
        $correspondinguser_noimm = Session::get("no_imm");
        $correspondinguser_email = Session::get("email_unige");
        if ($correspondinguser_noimm != null) {
            $user_id = DB::table('Utilisateur')->select('id')->where('no_imm', '=', $correspondinguser_noimm)->pluck('id')->toArray()[0];
            UtilisateurProjet::query()->insert(array("projet_id" => $projet_id, "user_id" => $user_id, "created_at" => $currentDate, "updated_at" => $currentDate));
        } else {
            $user_id = DB::table('Utilisateur')->select('id')->where('email_unige', '=', $correspondinguser_email)->pluck('id')->toArray()[0];
            UtilisateurProjet::query()->insert(array("projet_id" => $projet_id, "user_id" => $user_id, "created_at" => $currentDate, "updated_at" => $currentDate));
        }
        $participants_non_inscrits = [];
        foreach ($utilisateurs as $utilisateur) {
            if ($utilisateur != null or $utilisateur != " ") {
                $utilisateur_info = explode(" ", $utilisateur);
                if (count($utilisateur_info) == 3) {
                    $no_imm = $utilisateur_info[0];
                    if (is_numeric(substr($no_imm, 0, 1))) {
                        // si le premier caractère du premier élément est un chiffre, alors on a bien affaire à un numéro d'immatriculation et donc on traite un étudiant
                        $user_id = DB::table('Utilisateur')->select('id')->where('no_imm', '=', $no_imm)->pluck('id')->toArray()[0];
                        UtilisateurProjet::query()->insert(array("projet_id" => $projet_id, "user_id" => $user_id, "created_at" => $currentDate, "updated_at" => $currentDate));
                    } else {
                        // si le premier caractère est un caractère alphanumérique, alors on a affaire à un enseignant
                        $email = $utilisateur_info[count($utilisateur_info) - 1];
                        $user_id = DB::table('Utilisateur')->select('id')->where('email_unige', '=', $email)->pluck('id')->toArray()[0];
                        UtilisateurProjet::query()->insert(array("projet_id" => $projet_id, "user_id" => $user_id, "created_at" => $currentDate, "updated_at" => $currentDate));

                    }
                } else {
                    array_push($participants_non_inscrits, $utilisateur);
                }
            }
        }
        Projet::where('id', $projet_id)->update(['participants_non_inscrits' => join(", ", $participants_non_inscrits)]);

        // Création de tuples dans la table 'Fichier'
        $vignette = $data['vignette'];
        $fichiers = $data['fichier'];
        $path_directory = "projects/" . $projet_id .'/';
        foreach($vignette as $image) {
            $fichier_nom = $image->getClientOriginalName();
            $chemin = $path_directory;
            Storage::disk('public')->put($chemin . $fichier_nom, file_get_contents($image));
            $vignette_val = 0;
            if (in_array($image, $fichiers)) { // si la vignette a été également passé en tant que fichier, alors on assigne la valeur 2
                $vignette_val = 2;
            } else {
                $vignette_val = 1;
            }
            Fichier::query()->insert(array("chemin" => $chemin . $fichier_nom, "vignette" => $vignette_val, "projet_id" => $projet_id, "created_at" => $currentDate, "updated_at" => $currentDate));
        }

        foreach ($fichiers as $fichier) {
            if (!in_array($fichier, $vignette)) { // si le fichier n'est pas passé en tant que vignette, alors on assigne la valeur 0
                $fichier_nom = $fichier->getClientOriginalName();
                $chemin = $path_directory;
                Storage::disk('public')->put($chemin . $fichier_nom, file_get_contents($fichier));
                Fichier::query()->insert(array("chemin" => $chemin . $fichier_nom, "vignette" => 0, "projet_id" => $projet_id, "created_at" => $currentDate, "updated_at" => $currentDate));
            }
        }

        Session::flash("ajout_projet", "Votre projet a été déposé avec succès.");
        return redirect()->route("portail");
    }

}
