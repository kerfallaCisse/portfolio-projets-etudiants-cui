@extends("layouts.navbar")

@section('content')
    <script>

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
                                    <label for="nom">Nom <span class="required">*</span></label>
                                    <input type="text" id="nom" class="form-control" name="nom" required autofocus>
                                    <span class="info">Veillez mentionner qu'un seul nom si vous en possédez plusieurs</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="prenom">Prénom <span class="required">*</span></label>
                                    <input type="text" id="prenom" class="form-control" name="prenom" required autofocus>
                                    <span class="info">Veillez mentionner qu'un seul prénom si vous en possédez plusieurs</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_immatriculation">Numéro d'immatriculation</label>
                                    <input type="text" placeholder="11-412-642" id="no_immatriculation" class="form-control" name="no_immatriculation"  autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email_unige">Email de l'université <span class="required">*</span></label>
                                    <input type="email" placeholder="John.Doe@etu.unige.ch" id="email_unige" class="form-control" name="email_unige" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email_unige_password">Mot de passe <span class="required">*</span></label>
                                    <input type="password" id="email_unige_password" class="form-control" name="email_unige_password" required autofocus>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email_perso">Email personnel</label>
                                    <input type="email" placeholder="johndoe@gmail.com" id="email_perso" class="form-control" name="email_perso" autofocus>
                                    <span class="info">Si vous êtes étudiants, il est nécessaire de remplir ce champ afin d'accéder à votre portail, une fois parti de l'université.</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email_perso_password">Mot de passe</label>
                                    <input type="password" placeholder="mot de passe" id="email_perso_password" class="form-control" name="email_perso_password" autofocus>
                                    <span class="info">Si vous êtes étudiants, il est nécessaire de remplir ce champ afin d'accéder à votre portail, une fois parti de l'université.</span>
                                </div>
                                <div class="form-group mb-3">
                                    <p>Rôles</p>
                                    <input type="checkbox" id="etudiant" name="etudiant" value="etudiant">
                                    <label for="etudiant">Etudiant</label><br>
                                    <input type="checkbox" id="enseignant" name="enseignant" value="enseignant">
                                    <label for="enseignant">Enseignant</label><br>
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
