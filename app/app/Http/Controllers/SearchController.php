<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    //
    public function getAvailableCours()
    {
        $code_cours = AdministrateurController::get_code_cours();
        $nom_cours = AdministrateurController::get_nom_cours();

        $cours = array_map(function ($code_cours, $nom_cours) {
            return $code_cours ." ".$nom_cours;
        }, $code_cours, $nom_cours);


        return view("search", ["cours" => collect($cours)]);
    }

    public function searchProjectsCoursProcess(Request $request) {
        $data = $request->all();
        $cours = $data["cours"];
        $cours_id = explode(" ",$cours)[0];
        return view("home");

        ## On récupère tous les projets qui ont été fait dans le cadre du cours en question
        #DB::table("Projet")
         #   ->join("")


    }

    public function getAllFilesProject() {
        $disk = Storage::disk("public");
        $directory = "Projects/49";
        $files = $disk->allFiles($directory);

        $datas = array(
            "files" => $files
        );
        return view("files")->with($datas);
    }



}
