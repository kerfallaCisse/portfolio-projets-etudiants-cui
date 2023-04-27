<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
</head>
<body>
<script src="{{asset("js/app.js")}}"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{route("home")}}"><img src="{{asset("logo_pp.jpeg")}}" alt="logo" width="100"
                                                          height="80" style="border-radius: 50%"></a></a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('registration')}}">Créer un compte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("login")}}">Se connecter</a>
            </li>
        </ul>
        <form class="input-group" style="padding-left: 20px">
            @csrf
            <input class="form-control mr-sm-2" type="search" placeholder="Rechercher par cours" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
        </form>
        <?php if (\Illuminate\Support\Facades\Session::get("connected")): ?>
        <div class="dropdown" style="padding-left: 5px">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    $nom = \Illuminate\Support\Facades\Session::get("nom");
                    $prenom = \Illuminate\Support\Facades\Session::get("prenom");
                    echo "$nom $prenom";

                    ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-dark aria-labelledby=" dropdownMenuButton2
            ">
            <li><a class="dropdown-item active" href="{{route("logout")}}">Déconnexion</a></li>
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
