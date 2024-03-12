<?php

use App\Http\Controllers\contrat;
use App\Http\Controllers\contrat_c;
use App\Http\Controllers\facturation;
use App\Http\Controllers\location;
use App\Http\Controllers\permis;
use App\Http\Controllers\permis_c;
use App\Http\Controllers\personne;
use App\Http\Controllers\voiture;
use App\Models\location as ModelsLocation;
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
    return view('Map');
});



Route::get('/VoitureHorsService', function () {
    return view('Voiture/VoitureHorsService');
});
Route::get('/Login', function () {
    return view('Securiter/login');
});
Route::get('/Register', function () {
    return view('Securiter/register');
});
Route::get('/Detaille', function () {
    return view('Voiture/DetailVoiture');
});
Route::get('/En Attente', function () {
    return view('Reservations/En attente');
});
Route::get('/Valider', function () {
    return view('Reservations/valider');
});

Route::get('/App',[personne::class,"all"]);

Route::post('LoginAuth',[personne::class,"Authentification"])->name("LoginAuth");
Route::post('Inscription',[personne::class,"Inscription"])->name("Inscription");
Route::get('/Deconnexion',[personne::class,"deconnexion"])->name("Deconnexion");
// Route::get('/Login',[personne::class,"Page_Connexion"]);
// Route::get('/Inscription',[personne::class,"Page_Inscription"]);


Route::get('/gesChauffeurs',[contrat_c::class,"contratChauff"]);
Route::get('/gesChauffeurs/idChauffeur={id}',[contrat_c::class,"DetailleChauffeur"]);
Route::post('/ajouter-permis',[permis_c::class,"add"])->name('ajouter-permis');
Route::get('/Permis',[permis_c::class,"liste"])->name('listeChauffeur');
Route::post('/supprimer/id={id}',[permis_c::class,"InfoChauffeurById"]);
Route::post('/Signature',[contrat_c::class,"signatureContrat"])->name('Signature');

Route::get('/VoitureDispo',[voiture::class,"allofdriver"]);
Route::post('/voiture',[voiture::class,"voiture"])->name('voiture');
Route::post('/supprimerCar/id={id}',[voiture::class,"DelCar"]);
Route::post('/Modification',[voiture::class,"Modification"]);

Route::get('/VoitureInDispo',[voiture::class,"Voiture_Indispo"]);
Route::get('/VoitureHorsService',[voiture::class,"Voiture_Hors"]);

Route::post('/Reservation',[location::class,"DemandeReservation"])->name('Reservation');
Route::get('/payement',[facturation::class,"payement"])->name('payement');

Route::get('/checkout', 'App\Http\Controllers\facturation@checkout')->name('checkout');
Route::post('/session', 'App\Http\Controllers\facturation@session')->name('session');
Route::get('/success', 'App\Http\Controllers\facturation@success')->name('success');

Route::get('/En Attente',[location::class,"En_attente"]);
Route::post('/location_valid',[location::class,"Valider"]);
Route::get('/Valider',[location::class,"Liste"]);