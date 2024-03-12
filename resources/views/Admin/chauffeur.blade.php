@extends('Layouts/App')
@section('content')


<form class="form-inline my-4 ml-5">
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputSearch" class="sr-only">Recherche</label>
    <input type="text" class="form-control" id="inputSearch" placeholder="Rechercher...">
  </div>
  <button type="submit" class="btn btn-warning mb-2">Recherche</button>
</form>
<?php

use Illuminate\Support\Facades\DB;

 $etat=null ?>
<div class="container mt-4 md-6">
    <div class="row">
@foreach($permis as $detaille)
<?php
    $etat = DB::select("SELECT * from contrat where Chauffeur = ?", [$detaille->id]);
    // dd($etat);
  ?>
  
<div class="col-md-6">
<div class=" card ml-4" style="width: 25rem; height:28rem;">
  <img src="{{asset($detaille->Image)}}" style="width: 100%;" class="card-img-top" alt="...">
  <div class="card-body">
  <h5 class="card-title">Prenom: {{$detaille->Prenom}}</h5>
    <h5 class="card-title">Nom : {{$detaille->Nom}}</h5>
    <h5 class="card-title">Type de permis : {{$detaille->Categorie}}</h5>
    <div class="row mt-5">
    <div class="col">
        <p class="card-text text-success h6"><?php echo $etat ? 'Contrat en cours' : ''; ?></p>
        <p class="card-text text-warning h6"><?php echo !$etat ? 'Pas de Contrat' : ''; ?></p>
    </div>
    <div class="col">
        <a href="/gesChauffeurs/idChauffeur={{$detaille->id}}" class="btn btn-primary float-end">Voir Contrat</a>
    </div>
</div>

  </div>
    
</div>
</div>
@endforeach
    </div>
</div>
@endsection