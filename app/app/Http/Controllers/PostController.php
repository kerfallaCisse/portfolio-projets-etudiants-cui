<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Psy\Util\Str;

class PostController extends Controller
{
    // Contient la logique du programme. IL fait l'intermédiaire entre le modèle et la vue
    /***

     */

    public function index()
    {
        return view('home', [
                'articles' => Post::all() // Syntaxe propre à laravel qui est éloquant
            ]
        );
    }

    public  function show(Post $post) {
        # Toujours faire des vérifications avant de retourner la vue

        # IL va définir pour nous le find or fail
        return view( 'article',
            [
                'article' => $post # on lui dit de trouver l'article ayant l'id qu'on lui a passé en argument de la fonction
            ]

        );
    }

}
