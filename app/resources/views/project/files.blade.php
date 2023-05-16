@extends('layouts.navbar')

@section('content')

    <div class="columns is-centered">
        <h2>Les fichiers pour le projet <span class="unige" style="font-weight: bold">{{ $titre }}</span></h2>
        <ul>
        @foreach($files as $file)
            <li>
                <div class="column is-3">
                    <div class="box">
                        <h4><a href="/{{$file}}" target="_blank" id="file" class="button is-primary"><?php echo pathinfo($file)['basename']; ?></a></h4>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>

    </div>


@endsection
