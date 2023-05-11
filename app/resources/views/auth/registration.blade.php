@extends("layouts.navbar")

@section('content')
    <script>
        $("#num_immatriculation").css("display", "none");

        function valueChanged() {
            if ($("#etudiant").prop("checked")) {
                $("#num_immatriculation").css("display", "block");
                $("#email_personel").css("display", "block");
                $("#email_personnel_password").css("display", "block");
            } else {
                $("#num_immatriculation").css("display", "none");
                $("#email_personel").css("display", "none");
                $("#email_personnel_password").css("display", "none");
            }
        }

        $("#etudiant").trigger("change");
    </script>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Créer un compte</h3>
                        <div class="card-body">
                            <form action="{{route('registration.process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <p>Rôles <span class="required">*</span></p>
                                    <input type="checkbox" id="etudiant" name="etudiant"
                                           value="etudiant" onchange="valueChanged()">
                                    <label for="etudiant">Etudiant</label><br>
                                    <input type="checkbox" id="enseignant" name="enseignant" value="enseignant">
                                    <label for="enseignant">Enseignant</label><br>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nom">Nom <span class="required">*</span></label>
                                    <input type="text" id="nom" class="form-control" name="nom" required autofocus>
                                    <span
                                        class="info">Veillez mentionner qu'un seul nom si vous en possédez plusieurs</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="prenom">Prénom <span class="required">*</span></label>
                                    <input type="text" id="prenom" class="form-control" name="prenom" required
                                           autofocus>
                                    <span class="info">Veillez mentionner qu'un seul prénom si vous en possédez plusieurs</span>
                                </div>
                                <div class="form-group mb-3" id="num_immatriculation">
                                    <label for="no_immatriculation">Numéro d'immatriculation <span class="required">*</span></label>
                                    <input type="text" placeholder="11-412-642" id="no_immatriculation"
                                           class="form-control" name="no_immatriculation" autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email_unige">Email de l'université <span
                                            class="required">*</span></label>
                                    <input type="email" placeholder="John.Doe@etu.unige.ch" id="email_unige"
                                           class="form-control" name="email_unige" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email_unige_password">Mot de passe <span
                                            class="required">*</span></label>
                                    <input type="password" id="email_unige_password" class="form-control"
                                           name="email_unige_password" required autofocus>
                                </div>

                                <div class="form-group mb-3" id="email_personel">
                                    <label for="email_perso">Email personnel <span class="required">*</span></label>
                                    <input type="email" placeholder="johndoe@gmail.com" id="email_perso"
                                           class="form-control" name="email_perso" autofocus>
                                    <span class="info">Si vous êtes étudiants, il est nécessaire de remplir ce champ afin d'accéder à votre portail, une fois parti de l'université.</span>
                                </div>
                                <div class="form-group mb-3" id="email_personnel_password">
                                    <label for="email_perso_password">Mot de passe <span class="required">*</span></label>
                                    <input type="password" id="email_perso_password"
                                           class="form-control" name="email_perso_password" autofocus>
                                    <span class="info">Si vous êtes étudiants, il est nécessaire de remplir ce champ afin d'accéder à votre portail, une fois parti de l'université.</span>
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">S'enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
