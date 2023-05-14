@extends("layouts.navbar")

@section('content')

    <script>
        var availableProfs = <?php echo $enseignants ?>;
        $(document).ready(function() { // ajout dynamiques de champs pour les nouveaux profs
            let nouveauProf = '<tr>' +
                '<td><input type="text" id="enseignants" class="form-control enseignants autocomplete" placeholder="Dupont Jean jean.dupont@unige.ch" name="enseignants[]"></td>' +
                '<td><span class="prof_btn"><input type="button" name="nouveauProf" class="btn btn-outline-success nouveauProf" value ="+"></span></td></tr>';
            $("#nouveauProf").click(function () {
                $(".prof_btn").html('<input type="button" name="enleverProf" class="btn btn-outline-danger" id="enleverProf" value ="×">');
                $("#profTable").append(nouveauProf);
            });
            $("#profTable").on('click', '.nouveauProf', function () {
                $(".prof_btn").html('<input type="button" name="enleverProf" class="btn btn-outline-danger" id="enleverProf" value ="×">');
                $("#profTable").append(nouveauProf);
            });
            $("#profTable").on('click', '#enleverProf', function () {
                $(this).closest('tr').remove();
            });
            $("#profTable").on("focus.autocomplete", '.enseignants', function () {
                $(this).autocomplete({
                    source: availableProfs
                });
            });
        });
    </script>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Assigner des enseignants à un cours</h3>
                        <div class="card-body">
                            <form action="{{route('professor.cours.process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="cours">Nom et/ou code du cours</label>
                                    <input type="text" id="cours" class="form-control cours autocomplete" name="cours" required autofocus>
                                </div>
                                <script>
                                    var availableCourses = <?php echo $cours?>;
                                    $("#cours").autocomplete({
                                        source: availableCourses
                                    });
                                </script>
                                <div class="form-group mb-3">
                                    <table class="table table-borderless" id="profTable">
                                        <tr>
                                            <td><label for="enseignants">Insérez le nom et/ou le prénom de l'enseignant</label></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="enseignants" class="form-control enseignants autocomplete" placeholder="Dupont Jean jean.dupont@unige.ch" name="enseignants[]"></td>
                                            <td><span class="prof_btn"><input type="button" name="nouveauProf" class="btn btn-outline-success" id="nouveauProf" value ="+"></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Assigner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
