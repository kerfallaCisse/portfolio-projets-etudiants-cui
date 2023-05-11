@extends('layouts.navbar')

@section('content')

    <div>
        @foreach($files as $file)
            <div class="column is-3">
                <div class="box">
                    <a href="/{{$file}}" class="button is-primary">{{$file}}</a>
                </div>
            </div>
        @endforeach

    </div>


@endsection

