@extends('Layouts/App')
@section('content')
<form class="form-inline my-4 ml-5">
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputSearch" class="sr-only">Recherche</label>
    <input type="text" class="form-control" id="inputSearch" placeholder="Rechercher...">
  </div>
  <button type="submit" class="btn btn-warning mb-2">Recherche</button>
</form>
    
<div class="row col-md-12 ml-4">
@foreach($touslesvoitures_Res as $car)
<div class="card ml-4" style="width: 22rem; height:31rem;">
  <img src="{{asset($car->Image)}}" style="width: 100%;" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{$car->Marque}}</h5>
    <h5 class="card-title">{{$car->Modele}}</h5>
    <h5 class="card-title">{{date("Y",strtotime($car->Date_Sortie))}}</h5>    
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal{{$car->id}}">
  Voir Plus</button>
  </div>
</div> <!-- fermer la balise div de la carte -->
<!-- Modal -->
<div class="modal fade modal-dialog-scrollable" id="exampleModal{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <img src="{{asset($car->Image)}}" class="img-fluid w-50 h-50 custom-image" alt="...">
          <div class="col ml-3">
            <h5 class="mb-3">Marque : {{$car->Marque}}</h5>
            <h5 class="mb-3">Modele : {{$car->Modele}}</h5>
            <h5 class="mb-3">Date de Sortie : {{$car->Date_Sortie}}</h5>
            <h5 class="mb-3">Nombre de Place : {{$car->nombre_place}}</h5>
          </div>
          
        </div>
      
      
      <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, at officia ullam, repellendus officiis sit exercitationem voluptate perferendis quia soluta quas minima quod odio voluptatum iste deleniti corrupti eligendi hic.</h4>
      </div>
      <div class="modal-footer" {{empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil==2 ? 'hidden' : ''}}>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModals{{$car->id}}">Modifier</button>
        <form action="/supprimerCar/id={{$car->id}}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Supprimer</button>
          </form>
      </div>
    </div>
  </div>
</div> <!-- fermer la balise div du modal -->
@endforeach
@endsection
