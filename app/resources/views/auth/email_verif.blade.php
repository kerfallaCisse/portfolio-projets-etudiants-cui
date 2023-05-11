@extends('layouts.navbar')

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Entrer l'email de l'université</h3>
                        <div class="card-body">
                            <form action="{{route('email_verif_process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="email_unige">Email</label>
                                    <input type="email" placeholder="John.Doe@etu.unige.ch"
                                           id="email_unige" class="form-control" name="email_unige" required autofocus>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Vérification de l'email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
