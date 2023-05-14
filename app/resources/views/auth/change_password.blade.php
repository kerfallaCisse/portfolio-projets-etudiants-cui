@extends('layouts.navbar')

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Entrer un nouveau mot de passe</h3>
                        <div class="card-body">
                            <form action="{{route('change_password_process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="email_unige_password">Mot de passe</label>
                                    <input type="password"
                                           id="email_unige_password" class="form-control" name="email_unige_password"
                                           required autofocus>
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Changer le mot de passe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
