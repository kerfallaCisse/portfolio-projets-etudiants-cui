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
    <h1 class="text-center">Bienvenu dans le portail de projets des étudiants au CUI</h1>

@endsection
