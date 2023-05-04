@extends("layouts.navbar")

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Dépôt d'un nouveau projet</h3>
                        <div class="card-body">
                            <form action="{{route('newproject.process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="titre">Nom du projet</label>
                                    <input type="text" id="titre" class="form-control" name="titre" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cours">Nom du cours</label>
                                    <input type="text" id="cours" class="form-control autocomplete" name="cours" required autofocus>
                                    <script>
                                        $( function() {
                                            var availableCourses = <?php echo $cours?>;
                                            $( "#cours" ).autocomplete({
                                                source: availableCourses
                                            });
                                        } );
                                    </script>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="participants">Participants au projet</label>
                                    <input type="text" id="participants" class="form-control autocomplete" name="participants" required autofocus>
                                    <script>
                                        $( function() {
                                            var availableStudents = <?php echo $etudiants?>;
                                            $( "#participants" ).autocomplete({
                                                source: availableStudents
                                            });
                                        } );
                                    </script>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Soumettre</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
