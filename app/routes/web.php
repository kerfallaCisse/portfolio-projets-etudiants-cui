<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name("home");
Route::group([], function () {
    Route::get("login",[\App\Http\Controllers\CustomAuthController::class, "login"])->name("login");
    Route::post("login_process",[\App\Http\Controllers\CustomAuthController::class, "login_process"])->name("login.process");
    Route::get("registration",[\App\Http\Controllers\CustomAuthController::class, "registration"])->name("registration");
    Route::post("registration_process", [\App\Http\Controllers\CustomAuthController::class, 'registration_process'])->name("registration.process");
    Route::get("logout", [\App\Http\Controllers\CustomAuthController::class, "logout"])->name("logout");
});

Route::group([], function () {
    Route::get("professeur_cours", [\App\Http\Controllers\AdministrateurController::class, 'assigne_professor_cours'])->name("professor.cours");
    Route::post("professeur_cours_process", [\App\Http\Controllers\AdministrateurController::class, "process_prof_cours"])->name("professor.cours.process");
});


Route::get("projects", function () {
    return view("projects");
}) ->name("projects");


