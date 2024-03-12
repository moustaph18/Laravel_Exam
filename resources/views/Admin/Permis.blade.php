@extends('layouts.app')

@section('content')
@if(session('state'))
<div class="alert alert-success col-md-10 mx-auto">
    {{ session('state') }}
</div>
@endif

<button class="btn btn-success offset-11" data-bs-toggle="modal" data-bs-target="#exampleModal2">Ajouter</button>


<div class="container mt-4 md-6">
  <div class="row">
    @foreach($chauffeur as $Info_chauffeur)
      <div class="col-md-6">
        <button type="button" class="card mb-3 ml-5" data-bs-toggle="modal" data-bs-target="#exampleModal{{$Info_chauffeur->id}}">
          <div class="row no-gutters">
              <div class="col-md-6 ml-3 mt-1">
                <h1>S N</h1>
                <img style="width: 170px; height: 190px;" src="{{asset($Info_chauffeur->Image)}}" alt="...">
                <h6 class="mt-3 text-center">Signature</h6>
              </div>
                        <div class="col-md-8 ml-5">
                            <div class="card-body ml-2">
                                <h6 class="card-title text-secondary text-center ">REPUBLIQUE DU SENEGAL</h6>
                                <h6 class="card-title text-secondary text-center">PERMIS DE CONDUIRE</h6>
                                <ol class="text-left">
                                    <li>Nom</li>
                                    <h6>{{$Info_chauffeur->Nom}}</h6>
                                    <li>Prenom</li>
                                    <h6>{{$Info_chauffeur->Prenom}}</h6>
                                    <li>Date et Lieu de naissance</li>
                                    <h6>{{$Info_chauffeur->Date_Naissance}} a {{$Info_chauffeur->Lieu_de_Naissance}}</h6>
                                    <li> Date d'emission <span class="font-weight-bold ml-2"> {{$Info_chauffeur->Date_Emission}}</span></li>
                                    <li> Date d'expiration <span class="font-weight-bold ml-2">{{$Info_chauffeur->Date_Expiration}}</span></li>
                                    <li> Delivration par <span class="font-weight-bold ml-2">{{$Info_chauffeur->Delivrer_Par}}</span></li>
                                    <li> N Permis <span class="font-weight-bold ml-2">{{$Info_chauffeur->Numero}}</span></li>
                                    <li> Categorie <span class="font-weight-bold ml-2">{{$Info_chauffeur->Categorie}}</span></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </button>
            </div>
<div class="modal fade modal-dialog-scrollable" id="exampleModal{{$Info_chauffeur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Information Chauffer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row no-gutters">
    
    <div class="col-md-2 ml-3 mt-1">
      <h1>S N</h1>
      <img style="width: 170px; height: 190px;" src="{{asset($Info_chauffeur->Image)}}" alt="...">
      <h6 class="mt-3 text-center">Signature</h6>
    </div>
    <div class="col-md-8 ml-5">
      <div class="card-body ml-2">
        <h6 class="card-title text-secondary text-center ">REPUBLIQUE DU SENEGAL</h6>
        <h6 class="card-title text-secondary text-center">PERMIS DE CONDUIRE</h6>
        <ol class="text-left">
          <li>Nom</li>
          <h6>{{$Info_chauffeur->Nom}}</h6>

          <li>Prenom</li>
          <h6>{{$Info_chauffeur->Prenom}}</h6>

          <li>Date et Lieu de naissance</li>
          <h6>{{$Info_chauffeur->Date_Naissance}} a {{$Info_chauffeur->Lieu_de_Naissance}}</h6>
          
          <li> Date d'emission <span class="font-weight-bold ml-2"> {{$Info_chauffeur->Date_Emission}}</span></li>
          <li> Date d'expiration <span class="font-weight-bold ml-2">{{$Info_chauffeur->Date_Expiration}}</span></li>
          <li> Delivration par <span class="font-weight-bold ml-2">{{$Info_chauffeur->Delivrer_Par}}</span></li>
          <li> N Permis <span class="font-weight-bold ml-2">{{$Info_chauffeur->Numero}}</span></li>
          <li> Categorie <span class="font-weight-bold ml-2">{{$Info_chauffeur->Categorie}}</span></li>
        </ol>
      </div>
    </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
         <form action="/supprimer/id={{$Info_chauffeur->id}}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Supprimer</button>
          </form> 
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajout Chauffeur</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ajouter-permis') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    
                        <div class="col-md-6">
                          <!-- <h1>S N</h1> -->
                        <div class="col-md-2 ml-3">
                        <label for="nom" class="form-label">Image</label>
                          <div class="upload">
                          <img src="{{asset('assets/images/noprofil.jpg')}}" width = 100 height = 100 alt="">
                          <div class="round">
                            <input type="file" name="image">
                            <i class = "fa fa-camera" style = "color: #fff;"></i>
                          </div>
                        </div>
                          
                        </div>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom">
                            </div>
                            <div class="mb-3">
                                <label for="date_naissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance">
                            </div>
                            <div class="mb-3">
                                <label for="Lieu_De_Naissance" class="form-label">Lieu De Naissance</label>
                                <input type="text" class="form-control" id="Lieu_De_Naissance" name="Lieu_De_Naissance">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_emission" class="form-label">Date d'émission</label>
                                <input type="date" class="form-control" id="date_emission" name="date_emission">
                            </div>
                            <div class="mb-3">
                                <label for="date_expiration" class="form-label">Date d'expiration</label>
                                <input type="date" class="form-control" id="date_expiration" name="date_expiration">
                            </div>
                            <div class="mb-3">
                                <label for="delivrer_par" class="form-label">Délivré par</label>
                                <input type="text" class="form-control" id="delivrer_par" name="delivrer_par">
                            </div>
                            <div class="mb-3">
                                <?php $nbr = rand(); ?>
                                <label for="n_permis" class="form-label">N° Permis</label>
                                <input type="text" hidden value="{{$nbr}}" class="form-control" id="n_permis" name="n_permis">
                                <input type="text" disabled value="{{$nbr}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="categorie" class="form-label">Catégorie</label>
                                <select class="form-select" id="categorie" name="categorie">
                                  <option value=""></option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                    @foreach($errors->all() as $error)
                      <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
