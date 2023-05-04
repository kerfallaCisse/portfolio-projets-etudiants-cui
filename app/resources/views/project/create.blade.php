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
                                    <label for="titre">Nom du projet <span class="required">*</span></label>
                                    <input type="text" id="titre" class="form-control" name="titre" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cours">Nom du cours <span class="required">*</span></label>
                                    <input type="text" id="cours" class="form-control autocomplete" name="cours" required autofocus>
                                </div>
                                <script>
                                    $( function() {
                                        var availableCourses = <?php echo $cours?>;
                                        $("#cours").autocomplete({
                                            source: availableCourses
                                        });
                                    } );
                                </script>
                                <div class="form-group mb-3">
                                    <label for="participants">Participants au projet</label>
                                    <textarea name="participants" id="participants" class="form-control autocomplete" rows="3" cols="10" placeholder="Avec qui avez-vous fait votre travail ?"></textarea>
                                </div>
                                <script>
                                    $( function() {
                                        var availableStudents = <?php echo $etudiants?>;
                                        function split(val) {
                                            return val.split(/,\s*/);
                                        }
                                        function extractLast(term) {
                                            return split(term).pop();
                                        }

                                        $( "#participants" )
                                            // don't navigate away from the field on tab when selecting an item
                                            .on("keydown", function(event) {
                                                if (event.keyCode === $.ui.keyCode.TAB &&
                                                    $(this).autocomplete("instance").menu.active) {
                                                    event.preventDefault();
                                                }
                                            })
                                            .autocomplete({
                                                minLength: 0,
                                                source: function( request, response ) {
                                                    // delegate back to autocomplete, but extract the last term
                                                    response( $.ui.autocomplete.filter(
                                                        availableStudents, extractLast(request.term)));
                                                },
                                                focus: function() {
                                                    // prevent value inserted on focus
                                                    return false;
                                                },
                                                select: function( event, ui ) {
                                                    var terms = split(this.value);
                                                    // remove the current input
                                                    terms.pop();
                                                    // add the selected item
                                                    terms.push( ui.item.value );
                                                    // add placeholder to get the comma-and-space at the end
                                                    terms.push( "" );
                                                    this.value = terms.join(", ");
                                                    return false;
                                                }
                                            });
                                    } );
                                </script>
                                <div class="form-group mb-3">
                                    <label for="taches">Tâches effectués <span class="required">*</span></label>
                                    <textarea name="taches" id="taches" class="form-control autocomplete" rows="3" cols="10" placeholder="Décrivez les tâches que vous avez effectués durant ce projet. Séparez vos tâches par des virgules." required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="outils">Outils utilisés</label>
                                    <textarea name="outils" id="outils" class="form-control autocomplete" rows="3" cols="10" placeholder="Quels outils informatiques avez-vous utiliser pour votre projet ? Séparez-les par des virgules."></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="resume">Bref résumé <span class="required">*</span></label>
                                    <textarea name="resume" id="resume" class="form-control autocomplete" rows="5" cols="10" placeholder="En quoi consiste votre projet ?" required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="import-vignette">Importer des fichiers pour la vignette</label>
                                    <input type="file" id="fileInput" placeholder="blabla" multiple>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="import-vignette">Importer les fichiers et documents du projet</label>
                                    <input type="file" id="fileInput" multiple>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="acces">Définir l'accès au projet <span class="required">*</span></label>
                                    <select name="acces" id="acces" class="form-control">
                                        <option value="public" selected>Public</option>
                                        <option value="prive">Privé</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3" id="prive">
                                    <label for="emails">Donner accès à</label>
                                    <textarea name="emails" id="emails" class="form-control autocomplete" rows="3" cols="10" placeholder="Insérez les emails à qui vous voulez donner accès au projet, autre que votre e-mail personnel."></textarea>
                                </div>
                                <script>
                                    $("#acces").change(function() {
                                        if ($(this).val() == "prive") {
                                            $('#prive').show();
                                            $('#emails').attr('required', '');
                                            $('#emails').attr('data-error', 'This field is required.');
                                        } else {
                                            $('#prive').hide();
                                            $('#emails').removeAttr('required');
                                            $('#emails').removeAttr('data-error');
                                        }
                                    });
                                    $("#acces").trigger("change");
                                </script>
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
