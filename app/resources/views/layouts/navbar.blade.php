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
    <script defer src="http://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <style>
        .required {
            color: red
        }

        .info {
            color: red;
            font-style: italic;
            font-size: small;
        }
        tr td{
            padding: 0 !important;
            margin: 0 !important;
        }

        .unige {
            color: #CF0063
        }

        .sciences {
            color: #007E64
        }

        .lettres {
            color: #0067C5
        }

        .medecine {
            color: #96004B
        }

        .droit {
            color: #F42941
        }

        .theologie {
            color: #4B0B71
        }

        .psychologie {
            color: #00B1AE
        }

        .traduction {
            color: #FF5C00
        }

        .economie {
            color: #465F7F
        }

        .societe {
            color: #F1AB00
        }

        .guest {
            color: #7A7A7A
        }

        * {box-sizing: border-box}
        .mySlides1, .mySlides2 {display: none}
        img {vertical-align: middle;}

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a grey background color */
        .prev:hover, .next:hover {
            background-color: #f1f1f1;
            color: black;
        }


        /* Parent Container */
        .content_img{
            position: relative;
            width: 200px;
            height: 200px;
            float: left;
            margin-right: 10px;
        }

        /* Child Text Container */
        .content_img div{
            position: absolute;
            bottom: 0;
            right: 0;
            background: black;
            color: white;
            margin-bottom: 5px;
            font-family: sans-serif;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: visibility 0s, opacity 0.5s linear;
            transition: visibility 0s, opacity 0.5s linear;
        }

        /* Hover on Parent Container */
        .content_img:hover{
            cursor: pointer;
        }

        .content_img:hover div{
            width: 150px;
            padding: 8px 15px;
            visibility: visible;
            opacity: 0.7;
        }

        a {
            color:green
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
        <form class="input-group" style="padding-left: 20px">
            @csrf
            <input class="form-control mr-sm-2" type="search" placeholder="Rechercher par cours" aria-label="Search"
                   id="search_cours" name="search_cours">
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
                    <li><a class="dropdown-item" href="#">Ajouter<br>un administrateur</a></li>
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
