@extends('Layouts/App')
@section('content')

@if(session('Success'))
<div class="alert alert-success col-md-10 mx-auto">
    {{ session('Success') }}
</div>
@endif
<div class="row col-md-12 ml-4">

<style>
  .pending-validation {
    position: absolute;
    top: 0;
    right: 0;
    background-color: green;
    color: black;
    padding: 5px;
    border-radius: 5px;
    z-index: 1; /* Assure que le tampon est au-dessus de l'image */
  }
</style>


@foreach($reservation as $car)
<div class="col-md-6">
  <div class="card ml-4" style="width: 22rem; height:31rem; position: relative;">
    <p class="pending-validation text-light">Reservation Valider</p>
    <img src="{{asset($car->ImageVoiture)}}" style="width: 100%;" class="card-img-top" alt="...">
    <div class="card-body">
      <button type="button" class="btn btn-warning text-light float-end mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal{{$car->id}}">
        Suivi Reservation
      </button>
    </div>
  </div>
</div>

<div class="modal fade modal-dialog-scrollable" id="exampleModal{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="id_Location" hidden name="id_Location" value="{{$car->id}}">
        <div class="row">
          <img src="{{asset($car->ImageVoiture)}}" class="img-fluid w-50 h-50 custom-image" alt="...">
          <div class="col ml-3">
            <h5 class="mb-3 mt-3">Trajet : {{$car->Lieu_Depart}} {{$car->Lieu_Arrivee}}</h5>
            <h5 class="mb-3 mt-3">Distance : {{$car->{'Distance(KM)'} ?? ''}}</h5>
            <h5 class="mb-3 mt-3">Date de Location: {{$car->Date_Location}}</h5>
            <h5 class="mb-3 mt-3">heure_Depart : {{$car->Heure_Debut}}</h5>
            <h5 class="mb-3 mt-3">heure_Arrivee : {{$car->Heure_Fin}}</h5>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
      </div>
    </div>
  </div>
</div>

@endforeach
@endsection
