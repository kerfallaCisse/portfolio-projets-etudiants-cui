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

        .nav-link {
            color: white;
            font-weight: bold;
        }

        .footer-dark {
            padding: 50px 0;
            color: #f0f9ff;
            background-color: #282d32;
        }

        .footer-dark h3 {
            margin-top: 0;
            margin-bottom: 12px;
            font-weight: bold;
            font-size: 16px;
        }

        .footer-dark ul {
            padding: 0;
            list-style: none;
            line-height: 1.6;
            font-size: 14px;
            margin-bottom: 0;
        }

        .footer-dark ul a {
            color: inherit;
            text-decoration: none;
            opacity: 0.6;
        }

        .footer-dark ul a:hover {
            opacity: 0.8;
        }

        @media (max-width: 767px) {
            .footer-dark .item:not(.social) {
                text-align: center;
                padding-bottom: 20px;
            }
        }

        .footer-dark .item.text {
            margin-bottom: 36px;
        }

        @media (max-width: 767px) {
            .footer-dark .item.text {
                margin-bottom: 0;
            }
        }

        .footer-dark .item.text p {
            opacity: 0.6;
            margin-bottom: 0;
        }

        .footer-dark .item.social {
            text-align: center;
        }

        @media (max-width: 991px) {
            .footer-dark .item.social {
                text-align: center;
                margin-top: 20px;
            }
        }

        .footer-dark .item.social > a {
            font-size: 20px;
            width: 36px;
            height: 36px;
            line-height: 36px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.4);
            margin: 0 8px;
            color: #fff;
            opacity: 0.75;
        }

        .footer-dark .item.social > a:hover {
            opacity: 0.9;
        }

        .footer-dark .copyright {
            text-align: center;
            padding-top: 24px;
            opacity: 0.3;
            font-size: 13px;
            margin-bottom: 0;
        }

        /* Style pour les tableaux dans les formulaires */
        tr td{
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Pour les cas où on ne veut pas de styles par défaut pour les liens */

        a.nostyle:link {
            text-decoration: inherit;
            color: inherit;
            cursor: auto;
        }

        a.nostyle:visited {
            text-decoration: inherit;
            color: inherit;
            cursor: auto;
        }

        a.nostyle{
        }
        a.nostyle:hover{
            filter: brightness(60%);
        }

        /* Styles pour les facultés */

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

        /* Style pour le slideshow */

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

        .card .details {
            display: none;
        }

        .card:hover .details {
            display: block;
        }
    </style>
</head>
<body>
<script src="{{asset("js/app.js")}}"></script>

<nav class="navbar navbar-expand-lg sticky-top" style="margin-bottom: 50px; background-color: #D80669">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{route("home")}}" style="margin-left: 10px"><img src="{{asset("logo_pp.jpeg")}}"
                                                                                    alt="logo" width="100"
                                                                                    height="80"
                                                                                    style="border-radius: 50%"></a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @if(! \Illuminate\Support\Facades\Session::has("connected"))
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('registration')}}">CRÉER UN COMPTE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("login")}}">SE CONNECTER</a>
                </li>
            @endif
        </ul>
        @if(\Illuminate\Support\Facades\Session::get("connected"))
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            <li class="nav-item active">
                <div>
                    <a class="nav-link" href="{{ route('portail', \Illuminate\Support\Facades\Session::get("id")) }}">VOIR MES PROJETS</a>
                </div>
            </li>
            @if(\Illuminate\Support\Facades\Session::get("est_enseignant"))
            <li class="nav-item active">
                <div>
                    <a class="nav-link" href="{{ route('liste_cours', \Illuminate\Support\Facades\Session::get("id")) }}">VOIR MES COURS</a>
                </div>
            </li>
            @endif

            <li class="nav-item active">
                <div>
                    <a class="nav-link" href="{{ route('new.project') }}">DÉPOSER UN NOUVEAU PROJET</a>
                </div>
            </li>

            <li class="nav-item active">
                <div>
                    <a class="nav-link" href="{{route('search.projects.cours')}}">RECHERCHER LES PROJETS PAR COURS</a>
                </div>

            </li>
        </ul>

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
                    <li><a class="dropdown-item" href="{{route('professor.cours')}}">Renseigner<br>un enseignant</a>
                    </li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</nav>


</body>
<div class="container-fluid" style="padding-bottom: 400px">
    @yield('content')
</div>
<div class="footer-dark">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h3>Outils</h3>
                    <ul>
                        <li><a href="https://getbootstrap.com/">Bootstrap 5</a></li>
                        <li><a href="https://jquery.com/">Jquery</a></li>
                        <li><a href="https://laravel.com/">Laravel 10</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>A propos</h3>
                    <ul>
                        <li><a href="https://cui.unige.ch/fr/">Centre universitaire d'informatique (CUI)</a></li>
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h3>Portail de projets des étudiants au CUI</h3>
                    <p style="text-align: justify">Projet réalisé dans le cadre du cours <em>Projet en nouvelles
                            technologies de l'information et de
                            la communication (NTIC).</em><br>
                        Les principaux objectifs du portail de projets sont les suivants:
                    <ol>
                        <li>Faire la promotion des projets des étudiants du CUI, pour les formations du CUI.</li>
                        <li>Garder une trace utile, organisée et réutilisable des anciens projets pour les enseignants.</li>
                        <li>Permettre aux étudiants de faire la promotion de leurs travaux au CUI, même une fois partis du
                            CUI.</li>
                    </ol>
                    </p>
                </div>

            </div>
            <p class="copyright">Kerfalla CISSE && Nikita MISSIRI © 2023<br>
                <a href="mailto: Kerfalla.Cisse@etu.unige.ch" style="color: whitesmoke">Kerfalla.Cisse@etu.unige.ch</a>, <a
                    href="mailto: Nikita.Missiri@etu.unige.ch" style="color: whitesmoke">Nikita.Missiri@etu.unige.ch</a>
            </p>
        </div>
    </footer>
</div>
</html>
