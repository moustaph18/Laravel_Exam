@extends('Layouts/App')
@section('content')
<div class="row row-cols-2">
@foreach($detailsReservations as $car)
<div class="col">
<style>
  .pending-validation {
    position: absolute;
    top: 45px;
    right: -20px;
    background-color: rgba(255, 255, 0, 0.7); /* Jaune avec 50% d'opacité */
    color: black;
    padding: 7px;
    border-radius: 5px;
    z-index: 1; /* Assure que le tampon est au-dessus de l'image */
    transform: rotate(45deg); /* Rotation de 45 degrés dans le sens anti-horaire */
    transform-origin: top right; /* Point d'origine de la rotation */
  }
</style>
  <div class="card ml-4" style="width: 22rem; height:31rem; position: relative;">
    <span class="pending-validation">En attente</span>
    <img src="{{asset($car->Image)}}" style="width: 100%;" class="card-img-top" alt="...">
    <!-- <div class="card-body">
      <h5 class="card-title">Marque :</h5>
      <h5 class="card-title">Model : </h5>
      <h5 class="card-title">Annee : </h5>   -->
      @if($car->Paiement == 1)
      <div class="col-md-6">
          <p class="card-text text-success">Paiement effectuer</p>
      </div>
      @endif
      @if($car->Paiement == 0)
      <div class="col-md-6">
          <p class="card-text text-warning">Pas de de paiement</p>
      </div>
      @endif
      <button type="button" class="btn btn-warning text-light float-end col-md-6" data-bs-toggle="modal" data-bs-target="#exampleModal{{$car->id}}">
        Suivi Reservation
      </button>
    </div>
  </div>
</div>
@endforeach
</div>
</div>
<!-- Modal -->
<div class="modal fade modal-dialog-scrollable" id="exampleModal{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/location_valid" method="post">
        @csrf
        <div class="modal-body">
          <input type="text" id="id_Location" hidden name="id_Location" value="{{$car->location_id}}">
          <div class="row">
            <img src="{{asset($car->Image)}}" class="img-fluid w-50 h-50 custom-image" alt="...">
            <div class="col ml-3">
              <h5 class="mb-3 mt-3">Trajet : {{$car->Lieu_Depart}} {{$car->Lieu_Arrivee}}</h5>
              <input type="text" id="Kilometrage" hidden name="Kilometrage" value="{{$car->{'Distance(KM)'} ?? '0'}}">
              <h5 class="mb-3 mt-3">Distance : {{$car->{'Distance(KM)'} ?? ''}} KM</h5>
              <h5 class="mb-3 mt-3">Date de Location: {{$car->Date_Location}}</h5>
              <h5 class="mb-3 mt-3">heure_Depart : {{$car->Heure_Debut}}</h5>
              <h5 class="mb-3 mt-3">heure_Arrivee : {{$car->Heure_Fin}}</h5>
            </div>
          </div>
        </div>
        <div class="modal-footer" {{empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil==2 ? 'hidden' : ''}}>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
          <button type="submit" class="btn btn-success">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
