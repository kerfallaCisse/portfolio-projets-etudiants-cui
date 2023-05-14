@extends("layouts.navbar")

@section('content')
    <main>
        @if(\Illuminate\Support\Facades\Session::has("ajout_projet"))
            <div class="alert alert-success">
                {{\Illuminate\Support\Facades\Session::get("ajout_projet")}}
            </div>
        @endif
        <center><h1>Bienvenue sur la page de <strong><span class="{{ $faculte_class }}">{{ $element }}</span></strong></h1>
            @if($corresponding_faculte != "")
                <h2><strong>Faculté:</strong> {{ $corresponding_faculte }}</h2>
            @if(count($teachers_id) > 0)
                <h2><strong>Enseignants:</strong>
                    @for($h = 0; $h < count($teachers_id); $h++)
                        <span class="unige"><a class="nostyle" href="http://localhost:8003/liste_cours/{{ $teachers_id[$h] }}">{{ $teachers[$h] }}</a></span>@if($h != count($teachers_id)-1), @endif

                        @endfor
                </h2>
                @endif
            @endif
        </center>
            @if(count($titre) == 0)
                <div style="margin:50px"></div>
                <center><i><h3>Il n'y a pas de projets sur cette page.</h3></i></center>
            @else
        <div class="row row-cols-4 g-4">
            <?php $slideshow_count = 0 ?>
            @for ($i = 0; $i < count($titre); $i++)
            <div class="col">
                <div class="card">
                    @if(count($vignettes[$i]) > 1)
                        <div class="slideshow-container">
                            @for($j = 0; $j < count($vignettes[$i]); $j++)
                            <div class="slide{{$slideshow_count}}">
                                <img src="{{ asset($vignettes[$i][$j]) }}" style="width:100%">
                            </div>
                            @endfor
                            <a class="prev" onclick="plusSlides(-1, {{$slideshow_count}})">&#10094;</a>
                            <a class="next" onclick="plusSlides(1, {{$slideshow_count}})">&#10095;</a>
                        </div>
                        <?php $slideshow_count++ ?>
                    @else
                        <img src="{{ asset($vignettes[$i][0]) }}" style="width:100%">
                    @endif
                    <div class="card-body">
                        <div style="float: right">
                            @if(count($participants[$i]) + count($participants_non_inscrits[$i]) > 1)
                                <i style="color:orange" class="fas fa-users mx-1" title="Projet en groupe"></i>
                            @endif
                            @if($acces[$i] == 1)
                                <i style="color:green" class="fas fa-lock mx-1" title="Projet privé"></i>
                            @endif
                        </div>
                        <h3 class="card-title unige" style="font-weight: bold">{{ $titre[$i] }}</h3>
                        <h5 class="unige">Nom du cours</h5>
                        <p class="card-text {{ $faculte[$i] }}"><a class="nostyle" href="http://localhost:8003/cours/{{ $cours_id[$i] }}">{{ $cours[$i] }}</a></p>
                        <h5 class="unige">Participants au projet</h5>
                        <ul>
                            @for ($j = 0; $j < count($participants[$i]); $j++)
                                <li class="unige"><a class="nostyle" href="http://localhost:8003/portail/{{ $participants_id[$i][$j] }}">{{ $participants[$i][$j] }}</a></li>
                            @endfor
                            @for ($j = 0; $j < count($participants_non_inscrits[$i]); $j++)
                                @if($participants_non_inscrits[$i][$j] != "")
                                    <li class="guest">{{ $participants_non_inscrits[$i][$j] }}</li>
                                @endif
                            @endfor
                        </ul>
                        <div class="details">
                        <h5 class="unige">Bref résumé</h5>
                        <p>{{ $resume[$i] }}</p>
                        @if($repo_git[$i] != null)
                            <img src="http://localhost:8003/storage/images/tools/GitLab.png" style="width:8%; vertical-align:-10px"><a href="{{ $repo_git[$i] }}" style="font-size: 20px">Répertoire GitLab</a>
                            <div style="margin: 15px"></div>
                        @endif
                        <h5 class="unige">Tâches effectués</h5>
                            <ul>
                                @for ($j = 0; $j < count($taches[$i]); $j++)
                                    <li>{{ $taches[$i][$j] }}</li>
                                @endfor
                            </ul>
                        @if(count($outils_nom) > 0)
                        <h5 class="unige">Outils utilisés</h5>
                        <div class="row row-cols-3 g-3">
                            @for ($j = 0; $j < count($outils_img[$i]); $j++)
                                <img src="{{ asset($outils_img[$i][$j]) }}" title="{{ $outils_nom[$i][$j] }}" style="width:30%">
                            @endfor
                        </div>
                        @endif
                        <div style="margin: 15px"></div>
                        <h5 class="unige"><a href="{{ route('files', $project_id[$i]) }}">Accéder aux fichiers du projet</a></h5>
                        @if(count($recommandation_contenu[$i]) > 0)
                            <hr>
                            <h5 class="unige">Recommandations</h5>
                            @for($j = 0; $j < count($recommandation_contenu[$i]); $j++)
                                <div style="margin:10px">
                                    <strong>{{ $recommandation_auteur[$i][$j] }}</strong>
                                    <i>{{ $recommandation_date[$i][$j] }}</i>
                                    <br>
                                    <p>{{ $recommandation_contenu[$i][$j] }}</p>
                                </div>
                            @endfor
                        @endif
                        @if(\Illuminate\Support\Facades\Session::get("connected") and
                            str_contains($teachers, \Illuminate\Support\Facades\Session::get('nom') . ' ' . \Illuminate\Support\Facades\Session::get('prenom')) and
                            !in_array(\Illuminate\Support\Facades\Session::get('nom') . ' ' . \Illuminate\Support\Facades\Session::get('prenom'), $recommandation_auteur[$i]))
                            <hr>
                            <form action="{{route('recommandation.process', $project_id[$i])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="recommandation">Insérez une recommandation pour ce projet.</label>
                                    <textarea id="recommandation" name="recommandation" class="form-control" placeholder="C'est un très bon travail !" rows="4" cols="50" required autofocus></textarea>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button id="soumettre" type="submit" class="btn btn-dark btn-block">Soumettre</button>
                                </div>
                            </form>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
            @endif
            <script>
                let slideIndex = [];
                let slideId = [];
                for (let k = 0; k <= {{count($vignettes)}}; k++){
                    slideIndex.push(1);
                    slideId.push("slide" + k);
                }
                for (let k = 0; k <= {{count($vignettes)}}; k++){
                    showSlides(1, k)
                }

                function plusSlides(n, no) {
                    showSlides(slideIndex[no] += n, no);
                }

                function showSlides(n, no) {
                    let i;
                    let x = document.getElementsByClassName(slideId[no]);
                    if (n > x.length) {slideIndex[no] = 1}
                    if (n < 1) {slideIndex[no] = x.length}
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    x[slideIndex[no]-1].style.display = "block";

                }
            </script>
    </main>

@endsection
