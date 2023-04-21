@extends("layouts.navbar")

@section('content')
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
                                    <input type="text" placeholder="nom" id="nom" class="form-control" name="nom" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="prénom" id="prenom" class="form-control" name="prenom" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="numéro d'immatriculation" id="no_immatriculation" class="form-control" name="no_immatriculation" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" placeholder="email de l'université: John.Doe@etu.unige.ch" id="email_unige" class="form-control" name="email_unige" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="mot de passe du compte de l'université" id="email_unige_password" class="form-control" name="email_unige_password" required autofocus>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" placeholder="email personnel: johndoe@gmail.com" id="email_perso" class="form-control" name="email_perso" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="mot de passe de l'email personnel" id="email_perso_password" class="form-control" name="email_perso_password" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <p>Rôles</p>
                                    <input type="checkbox" id="etudiant" name="etudiant" value="etudiant">
                                    <label for="etudiant">Etudiant</label><br>
                                    <input type="checkbox" id="enseignant" name="enseignant" value="enseignant">
                                    <label for="enseignant">Enseignant</label>
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
