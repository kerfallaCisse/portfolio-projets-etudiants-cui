@extends('layouts.navbar')

@section('content')
    <script>
        $(function () {
            const cours = <?php echo $cours ?>;
            $('#cours').autocomplete({
                source: cours
            });
        });
    </script>

    <form class="input-group" style="padding-left: 20px; padding-right: 20px"
          action="{{route('search.projects.process')}}" method="post">
        @csrf
        <input class="form-control autocomplete mr-sm-2" type="search" placeholder="Rechercher par cours"
               aria-label="Search"
               id="cours" name="cours">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
    </form>

@endsection
