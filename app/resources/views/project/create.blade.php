@extends("layouts.navbar")

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Dépôt d'un nouveau projet</h3>
                        <div class="card-body">
                            <form action="{{route('new.project.process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="titre">Nom du projet <span class="required">*</span></label>
                                    <input type="text" id="titre" class="form-control" name="titre" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cours">Nom et/ou code du cours <span class="required">*</span></label>
                                    <input type="text" id="cours" class="form-control cours autocomplete" name="cours" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="resume">Bref résumé <span class="required">*</span></label>
                                    <textarea name="resume" id="resume" class="form-control autocomplete" rows="5" cols="10" placeholder="Dans ce projet, nous avons créé une application web, qui ..." required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="vignette">Importer des fichiers pour la vignette</label>
                                    <input type="file" name="vignette[]" id="vignette" class="form-control" multiple>
                                </div>
                                <div class="form-group mb-3">
                                    <table class="table table-borderless" id="participantsTable">
                                        <tr>
                                            <td><label for="participants">Participants au projet</label></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="participant_session" class="form-control" name="participant_session" value="{{ $utilisateur }}" required autofocus readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="participant" class="form-control participants autocomplete" placeholder="Dupont Jean" name="participants[]"></td>
                                            <td><span class="participant_btn"><input type="button" name="nouveauParticipant" class="btn btn-outline-success" id="nouveauParticipant" value ="+"></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="taches">Lien vers le repo git</label>
                                    <input type="text" id="repo_git" class="form-control" placeholder="https://gitlab.unige.ch/prenom.nom/nom-du-projet" name="repo_git">
                                </div>
                                <div class="form-group mb-3">
                                    <table class="table table-borderless" id="tachesTable">
                                        <tr>
                                            <td><label for="taches">Tâches effectués <span class="required">*</span></label></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="taches" class="form-control" placeholder="Créer des interfaces responsives" name="taches[]"></td>
                                            <td><span class="tache_btn"><input type="button" name="nouvelleTache" class="btn btn-outline-success" id="nouvelleTache" value ="+"></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group mb-3">
                                    <table class="table table-borderless" id="outilsTable">
                                        <tr>
                                            <td><label for="outils">Outils utilisés</label></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="outils" class="form-control" placeholder="JavaScript" name="outils[]"></td>
                                            <td><span class="outil_btn"><input type="button" name="nouvelOutil" class="btn btn-outline-success" id="nouvelOutil" value ="+"></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="fichier">Importer des fichiers et documents du projet</label>
                                    <input type="file" name="fichier[]" id="fichier" class="form-control" multiple>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="acces">Définir l'accès au projet <span class="required">*</span></label>
                                    <select name="acces" id="acces" class="form-control">
                                        <option value="public" selected>Public</option>
                                        <option value="prive">Privé</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3" id="prive">
                                    <table class="table table-borderless" id="emailsTable">
                                        <tr>
                                            <td><label for="emails">Donner accès à</label></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="emails" class="form-control" placeholder="jean-dupont@gmail.com" name="emails[]"></td>
                                            <td><span class="email_btn"><input type="button" name="nouveauEmail" class="btn btn-outline-success" id="nouveauEmail" value ="+"></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <script>
                                    var availableCourses = <?php echo $cours?>;
                                    $(".cours").autocomplete({
                                        source: availableCourses
                                    });

                                    $("#acces").change(function() {
                                        if ($(this).val() == "prive") {
                                            $('#prive').show();
                                        } else {
                                            $('#prive').hide();
                                        }
                                    });
                                    $("#acces").trigger("change");

                                    var availableUsers = <?php echo $utilisateurs?>;
                                    $(document).ready(function(){ // ajout dynamiques de champs
                                        // pour les participants
                                        let nouveauParticipant = '<tr>' +
                                            '<td><input type="text" id="participant" class="form-control participants autocomplete" placeholder="Dupont Jean" name="participants[]"></td>' +
                                            '<td><span class="participant_btn"><input type="button" name="nouveauParticipant" class="btn btn-outline-success nouveauParticipant" value ="+"></span></td></tr>';
                                        $("#nouveauParticipant").click(function () {
                                            $(".participant_btn").html('<input type="button" name="enleverParticipant" class="btn btn-outline-danger" id="enleverParticipant" value ="×">');
                                            $("#participantsTable").append(nouveauParticipant);
                                        });
                                        $("#participantsTable").on('click', '.nouveauParticipant', function () {
                                            $(".participant_btn").html('<input type="button" name="enleverParticipant" class="btn btn-outline-danger" id="enleverParticipant" value ="×">');
                                            $("#participantsTable").append(nouveauParticipant);
                                        });
                                        $("#participantsTable").on('click', '#enleverParticipant', function () {
                                            $(this).closest('tr').remove();
                                        });
                                        $("#participantsTable").on("focus.autocomplete", '.participants', function () {
                                            $(this).autocomplete({
                                                source: availableUsers
                                            });
                                        });

                                        // pour les tâches
                                        let nouvelleTache = '<tr>' +
                                            '<td><input type="text" id="taches" class="form-control" placeholder="Créer des interfaces responsives" name="taches[]"></td>' +
                                            '<td><span class="tache_btn"><input type="button" name="nouvelleTache" class="btn btn-outline-success nouvelleTache" value ="+"></span></td></tr>';
                                        $("#nouvelleTache").click(function () {
                                            $(".tache_btn").html('<input type="button" name="enleverTache" class="btn btn-outline-danger" id="enleverTache" value ="×">');
                                            $("#tachesTable").append(nouvelleTache);
                                        });
                                        $("#tachesTable").on('click', '.nouvelleTache', function () {
                                            $(".tache_btn").html('<input type="button" name="enleverTache" class="btn btn-outline-danger" id="enleverTache" value ="×">');
                                            $("#tachesTable").append(nouvelleTache);
                                        });
                                        $("#tachesTable").on('click', '#enleverTache', function () {
                                            $(this).closest('tr').remove();
                                        });

                                        // pour les outils
                                        let nouvelOutil = '<tr>' +
                                            '<td><input type="text" id="outils" class="form-control" placeholder="JavaScript" name="outils[]"></td>' +
                                            '<td><span class="outil_btn"><input type="button" name="nouvelOutil" class="btn btn-outline-success nouvelOutil" value ="+"></span></td>';
                                        $("#nouvelOutil").click(function () {
                                            $(".outil_btn").html('<input type="button" name="enleverOutil" class="btn btn-outline-danger" id="enleverOutil" value ="×">');
                                            $("#outilsTable").append(nouvelOutil);
                                        });
                                        $("#outilsTable").on('click', '.nouvelOutil', function () {
                                            $(".outil_btn").html('<input type="button" name="enleverOutil" class="btn btn-outline-danger" id="enleverOutil" value ="×">');
                                            $("#outilsTable").append(nouvelOutil);
                                        });
                                        $("#outilsTable").on('click', '#enleverOutil', function () {
                                            $(this).closest('tr').remove();
                                        });

                                        // pour les emails
                                        let nouveauEmail = '<tr>' +
                                            '<td><input type="text" id="emails" class="form-control" placeholder="jean-dupont@gmail.com" name="emails[]"></td>' +
                                            '<td><span class="email_btn"><input type="button" name="nouveauEmail" class="btn btn-outline-success nouveauEmail" value ="+"></span></td>';
                                        $("#nouveauEmail").click(function () {
                                            $(".email_btn").html('<input type="button" name="enleverEmail" class="btn btn-outline-danger" id="enleverEmail" value ="×">');
                                            $("#emailsTable").append(nouveauEmail);
                                        });
                                        $("#emailsTable").on('click', '.nouveauEmail', function () {
                                            $(".email_btn").html('<input type="button" name="enleverEmail" class="btn btn-outline-danger" id="enleverEmail" value ="×">');
                                            $("#emailsTable").append(nouveauEmail);
                                        });
                                        $("#emailsTable").on('click', '#enleverEmail', function () {
                                            $(this).closest('tr').remove();
                                        });

                                    });
                                </script>
                                <div class="d-grid mx-auto">
                                    <button id="soumettre" type="submit" class="btn btn-dark btn-block">Soumettre</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
