@extends('layouts.navbar')

@section('content')

    <div class="columns is-centered">
        @if(count($id) == 0)
            <div style="margin:50px"></div>
            <center><i><h3>Aucun cours n'est encore associé avec <span class="unige" style="font-weight: bold">{{ $utilisateur }}</span>.</h3></i></center>
        @else
        <h2>Les cours donnés par <span class="unige" style="font-weight: bold">{{ $utilisateur }}</span></h2>
        <ul>
            @for($i = 0; $i < count($id); $i++)
                <li>
                    <div class="column is-3">
                        <div class="box">
                            <h4><a href="{{ route('cours', $id[$i]) }}" class="button is-primary nostyle"><span class="{{ $faculte_class[$i] }}">{{ $nom[$i] }} </span><i>{{ $faculte[$i] }}</i></a></h4>
                        </div>
                    </div>
                </li>
            @endfor
        </ul>
        @endif
    </div>


@endsection
