@extends("layouts.navbar")

@section('content')
    <script>
        var availableAdmins = <?php echo $admins?>;
        $(document).ready(function(){ // ajout dynamiques de champs pour nouveaux admins
            let nouvelUtilisateur = '<tr>' +
                '<td><input type="text" id="admins" class="form-control admins autocomplete" placeholder="Dupont Jean jean.dupont@unige.ch" name="admins[]" required></td>' +
                '<td><span class="admin_btn"><input type="button" name="nouvelUtilisateur" class="btn btn-outline-success nouvelUtilisateur" id="nouvelUtilisateur" value ="+"></span></td></tr>';
            $("#nouvelUtilisateur").click(function () {
                $(".admin_btn").html('<input type="button" name="enleverUtilisateur" class="btn btn-outline-danger" id="enleverUtilisateur" value ="×">');
                $("#adminTable").append(nouvelUtilisateur);
            });
            $("#adminTable").on('click', '.nouvelUtilisateur', function () {
                $(".admin_btn").html('<input type="button" name="enleverUtilisateur" class="btn btn-outline-danger" id="enleverUtilisateur" value ="×">');
                $("#adminTable").append(nouvelUtilisateur);
            });
            $("#adminTable").on('click', '#enleverUtilisateur', function () {
                $(this).closest('tr').remove();
            });
            $("#adminTable").on("focus.autocomplete", '.admins', function () {
                $(this).autocomplete({
                    source: availableAdmins
                });
            });
        });
    </script>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Ajouter des administrateurs</h3>
                        <div class="card-body">
                            <form action="{{route('add.admin.process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <table class="table table-borderless" id="adminTable">
                                        <tr>
                                            <td><label for="admins">Insérez le nom et/ou le prénom de l'utilisateur</label></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="admins" class="form-control admins autocomplete" placeholder="Dupont Jean jean.dupont@unige.ch" name="admins[]" required></td>
                                            <td><span class="admin_btn"><input type="button" name="nouvelUtilisateur" class="btn btn-outline-success" id="nouvelUtilisateur" value ="+"></span></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
