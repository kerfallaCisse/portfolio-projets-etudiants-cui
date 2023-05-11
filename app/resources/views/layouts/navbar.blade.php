<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <title>portail projets cui</title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <style>
        .required {
            color: red
        }

        .info {
            color: red;
            font-style: italic;
            font-size: small;
        }

    </style>
</head>
<body>
<script src="{{asset("js/app.js")}}"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{route("home")}}" style="margin-left: 10px"><img src="{{asset("logo_pp.jpeg")}}"
                                                                                    alt="logo" width="100"
                                                                                    height="80"
                                                                                    style="border-radius: 50%"></a></a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @if(! \Illuminate\Support\Facades\Session::has("connected"))

                <li class="nav-item active">
                    <a class="nav-link" href="{{route('registration')}}">Créer un compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("login")}}">Se connecter</a>
                </li>
            @endif
        </ul>
        <form class="input-group" style="padding-left: 20px; padding-right: 20px">
            @csrf
            <input class="form-control mr-sm-2" type="search" placeholder="Rechercher par cours" aria-label="Search"
                   id="search_cours" name="search_cours"">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
        </form>
        <?php if (\Illuminate\Support\Facades\Session::get("connected")): ?>
        <div class="dropdown" style="padding-left: 5px; padding-right: 40px">
            <button class="btn btn-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    $nom = \Illuminate\Support\Facades\Session::get("nom");
                    $prenom = \Illuminate\Support\Facades\Session::get("prenom");
                    echo "$nom $prenom";

                    ?>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('logout')}}">Déconnexion</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @if(\Illuminate\Support\Facades\Session::get("est_administrateur") == 1)
                    <li><a class="dropdown-item" href="{{route('add.admin')}}">Ajouter<br>un administrateur</a></li>
                    <li><a class="dropdown-item" href="{{route('professor.cours')}}">Renseigner<br>un enseignant</a></li>
                @endif

            </ul>


        </div>
        <?php endif; ?>

    </div>
</nav>


</body>
<div class="container-fluid" style="padding-bottom: 100px">
    @yield('content')
</div>
<footer class="bg-secondary text-center fixed-bottom">
    <!-- Grid container -->
    <div class="container p-2"></div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="bg-secondary">
        &copy; 2023 Copyright:
        <a href="mailto: Kerfalla.Cisse@etu.unige.ch" style="color: black">Kerfalla.Cisse@etu.unige.ch</a>, <a
            href="mailto: Nikita.Missiri@etu.unige.ch" style="color: black">Nikita.Missiri@etu.unige.ch</a>
    </div>
    <!-- Copyright -->
</footer>
</html>
