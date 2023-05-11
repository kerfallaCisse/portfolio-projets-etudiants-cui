<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    public function getAllFilesProject($project_id) {
        $disk = Storage::disk("public");
        $directory = "projects/".$project_id;
        $files = $disk->allFiles($directory);

        $datas = array(
            "files" => $files
        );
        return view("project.files")->with($datas);
    }
}
