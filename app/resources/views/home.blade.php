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
    @if(\Illuminate\Support\Facades\Session::has("depot_fail"))
        <div class="alert alert-danger">
            {{\Illuminate\Support\Facades\Session::get("depot_fail")}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has("ajout_admin_fail"))
        <div class="alert alert-danger">
            {{\Illuminate\Support\Facades\Session::get("ajout_admin_fail")}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has("ajout_prof_fail"))
        <div class="alert alert-danger">
            {{\Illuminate\Support\Facades\Session::get("ajout_prof_fail")}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has("image_overload"))
        <div class="alert alert-danger">
            {{\Illuminate\Support\Facades\Session::get("image_overload")}}
        </div>
    @endif
    <h1 class="text-center">Bienvenue dans le portail de projets des étudiants au CUI</h1>

@endsection
