@extends("layouts.navbar")

@section('content')
    @if(\Illuminate\Support\Facades\Session::has("fail"))
        <div class="alert alert-danger">
            {{\Illuminate\Support\Facades\Session::get("fail")}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has("ajout_prof"))
        <div class="alert alert-success">
            {{\Illuminate\Support\Facades\Session::get("ajout_prof")}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has("ajout_admin"))
        <div class="alert alert-success">
            {{\Illuminate\Support\Facades\Session::get("ajout_admin")}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has("email_verif_failed"))
        <div class="alert alert-danger">
            {{\Illuminate\Support\Facades\Session::get("email_verif_failed")}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has("mdp_changed"))
        <div class="alert alert-success">
            {{\Illuminate\Support\Facades\Session::get("mdp_changed")}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has("mdp_validation"))
        <div class="alert alert-danger">
            {{\Illuminate\Support\Facades\Session::get("mdp_validation")}}
        </div>
    @endif
    <h1 class="text-center">Bienvenu dans le portail de projets des étudiants au CUI</h1>

@endsection
