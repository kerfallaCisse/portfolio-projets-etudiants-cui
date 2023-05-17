@extends('layouts.navbar')

@section('content')
<p>Hello</p>
    <div>
        @foreach($files as $file)
            <div>
                <div class="box">
                    <a href="/{{$file}}" class="button is-primary">
                        <?php
                            echo pathinfo($file)['filename'];
                            ?>
                    </a>
                </div>
            </div>
        @endforeach

    </div>


@endsection
