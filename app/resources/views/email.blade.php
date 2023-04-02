<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<h1>Changer votre email</h1>
<script src="{{asset('js/app.js')}}"></script>

<form action="{{route('email')}}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="example@gmail.com">
    <button type="submit">Changer d'email</button>

</form>

</body>
