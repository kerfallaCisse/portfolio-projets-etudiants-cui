<html>
    <body>
        <p>Bienvenue tu t'es authentifié. <a href="{{ route('logout') }}">Déconnecte toi</a></p>
        <div>
            <pre><?php print_r(Auth::user()) ?></pre>
        </div>
    </body>
</html>