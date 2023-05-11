@extends("layouts.navbar")

@section('content')
    <main>
        <center><h1>Bienvenue sur la page de <strong><span class="unige">{{ $utilisateur }}</span></strong></h1></center>

        <div class="row row-cols-4 g-4">
            <?php $slideshow_count = 0 ?>
            @for ($i = 0; $i < count($titre); $i++)
            <div class="col">
                <div class="card">
                    @if(count($vignettes[$i]) > 1)
                        <div class="slideshow-container">
                            @for($j = 0; $j < count($vignettes[$i]); $j++)
                            <div class="slide{{$slideshow_count}}">
                                <img src="{{ $vignettes[$i][$j] }}" style="width:100%">
                            </div>
                            @endfor
                            <a class="prev" onclick="plusSlides(-1, {{$slideshow_count}})">&#10094;</a>
                            <a class="next" onclick="plusSlides(1, {{$slideshow_count}})">&#10095;</a>
                        </div>
                        <?php $slideshow_count++ ?>
                    @else
                        <img src="{{ $vignettes[$i][0] }}" style="width:100%">
                    @endif
                    <div class="card-body">
                        <div style="float: right">
                            @if(count($participants[$i]) > 1 or (count($participants[$i]) == 1 and count($participants_non_inscrits[$i]) > 1))
                                <i style="color:orange" class="fas fa-users mx-1"></i>
                            @endif
                            @if($acces[$i] == 1)
                                <i style="color:green" class="fas fa-lock mx-1"></i>
                            @endif
                        </div>
                        <h3 class="card-title unige" style="font-weight: bold">{{ $titre[$i] }}</h3>
                        <h5 class="unige">Nom du cours</h5>
                        <p class="card-text {{ $faculte[$i] }}">{{ $cours[$i] }}</p>
                        <h5 class="unige">Participants au projet</h5>
                        <ul>
                            @for ($j = 0; $j < count($participants[$i]); $j++)
                                <li>{{ $participants[$i][$j] }}</li>
                            @endfor
                            @for ($j = 0; $j < count($participants_non_inscrits[$i]); $j++)
                                @if($participants_non_inscrits[$i][$j] != "")
                                    <li class="guest">{{ $participants_non_inscrits[$i][$j] }}</li>
                                @endif
                            @endfor
                        </ul>
                        <h5 class="unige">Bref résumé</h5>
                        <p class="card-text">{{ $resume[$i] }}</p>
                        @if($repo_git[$i] != null)
                            <h5 class="unige"><a href="{{ $repo_git[$i] }}">Répertoire GitLab</a></h5>
                            <div style="margin: 15px"></div>
                        @endif
                        <h5 class="unige">Tâches effectués</h5>
                            <ul>
                                @for ($j = 0; $j < count($taches[$i]); $j++)
                                    <li>{{ $taches[$i][$j] }}</li>
                                @endfor
                            </ul>
                        @if(count($outils_nom) > 0 and $outils_nom[0] != "")
                        <h5 class="unige">Outils utilisés</h5>
                        <div class="row row-cols-3 g-3">
                            @for ($j = 0; $j < count($taches[$i]); $j++)
                                <img src="{{ asset($outils_img[$i][$j]) }}" title="{{ $outils_nom[$i][$j] }}" style="width:30%">
                            @endfor
                        </div>
                        @endif
                        <div style="margin: 15px"></div>
                        <h5 class="unige"><a href="{{ route('files', $id[$i]) }}">Accéder aux fichiers du projet</a></h5>
                    </div>
                </div>
            </div>
            @endfor
        </div>

    </main>
    <script>
        let slideIndex = [];
        let slideId = [];
        for (let k = 0; k <= {{$slideshow_count}}; k++){
            slideIndex.push(1);
            slideId.push("slide" + k);
        }
        for (let k = 0; k <= {{$slideshow_count}}; k++){
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
@endsection
