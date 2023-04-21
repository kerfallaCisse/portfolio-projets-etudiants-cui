@extends('layouts.navbar')

@section('content')

    <h1 class="text-center">This is the projects page
        for <?php echo \Illuminate\Support\Facades\Session::get("nom") . " " . \Illuminate\Support\Facades\Session::get("prenom") ?></h1>

@endsection
