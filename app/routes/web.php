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
    Route::get("email_verif", [\App\Http\Controllers\CustomAuthController::class,"email_verif"])->name("email_verif");
    Route::post("email_verif_process",[\App\Http\Controllers\CustomAuthController::class,'email_verif_process'])->name("email_verif_process");
    Route::get("change_password",[\App\Http\Controllers\CustomAuthController::class,"change_password"])->name("change_password");
    Route::post("change_password_process",[\App\Http\Controllers\CustomAuthController::class,"change_password_process"])->name("change_password_process");

});

Route::group([], function () {
    Route::get("professeur_cours", [\App\Http\Controllers\AdministrateurController::class, 'assigne_professor_cours'])->name("professor.cours");
    Route::post("professeur_cours_process", [\App\Http\Controllers\AdministrateurController::class, "process_prof_cours"])->name("professor.cours.process");
    Route::get("add_admin", [\App\Http\Controllers\AdministrateurController::class, "add_admin"])->name("add.admin");
    Route::post("add_admin_process", [\App\Http\Controllers\AdministrateurController::class, "process_add_admin"])->name("add.admin.process");
});

Route::group([], function () {
    Route::get("search_project_cours", [\App\Http\Controllers\SearchController::class, "getAvailableCours"])->name("search.projects.cours");
    Route::post("search_project_cours_process", [\App\Http\Controllers\SearchController::class, "searchProjectsCoursProcess"])->name("search.projects.process");
    Route::get("files_project",[\App\Http\Controllers\SearchController::class,"getAllFilesProject"])->name("files");
});

Route::group([], function () {
    Route::get("new_project", [\App\Http\Controllers\CreateProjectController::class, 'create'])->name("new.project");
    Route::post("new_project_process", [\App\Http\Controllers\CreateProjectController::class, 'creation_process'])->name("new.project.process");

});

Route::group([], function () {
    Route::get("portail", [\App\Http\Controllers\ProjectController::class, 'showProjects'])->name("portail");
});


Route::get("projects", function () {
    return view("projects");
}) ->name("projects");


