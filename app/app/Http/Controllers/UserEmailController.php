<?php

namespace App\Http\Controllers;

use App\Models\UserEmail;
use Illuminate\Http\Request;

class UserEmailController extends Controller
{
    public function index() {
        return view('email');
    }

    public function process_email(Request $request) {
        # Important il faut toujours avoir une colonne created_at et une colonne update_at les deux de types DATE
        #echo $request->get('email');
        $user_email = new UserEmail;
        $user_email->email = $request->get('email');
        $user_email->save(); # enregistre le tuple dans la base de données

        # Pour retourner des vues qui se trouvent dans un sous répertoire return view('admin.profile', $data); on va dans le folder andmin et on appel la vue profile

    }
}
