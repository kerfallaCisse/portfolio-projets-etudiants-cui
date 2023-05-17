@extends('layouts.navbar')

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Se connecter</h3>
                        <div class="card-body">
                            <form action="{{route('login.process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="email_unige">Email de l'université</label>
                                    <input type="email" placeholder="John.Doe@etu.unige.ch"
                                           id="email_unige" class="form-control" name="email_unige" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email_unige_password">Mot de passe</label>
                                    <input type="password"
                                           id="email_unige_password" class="form-control" name="email_unige_password"
                                           required autofocus>
                                </div>
                                <div class="mb-3">
                                    <a href="{{route('registration')}}">Créer un compte</a><br>
                                    <a href="">Mot de passe oublié ?</a>
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Se connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
