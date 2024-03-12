@extends('Layouts/App')
@section('content')
<button class="btn btn-success offset-11" data-bs-toggle="modal" data-bs-target="#exampleModal1" {{empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil==2 ? 'hidden' : ''}}>Ajouter</button>
@if(session('state'))
<div class="alert alert-success col-md-10 mx-auto">
    {{ session('state') }}
</div>
@endif

@if(session('success3'))
<div class="alert alert-success col-md-10 mx-auto">
    {{ session('success3') }}
</div>
@endif

<form class="form-inline my-4 ml-5">
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputSearch" class="sr-only">Recherche</label>
    <input type="text" class="form-control" id="inputSearch" placeholder="Rechercher...">
  </div>
  <button type="submit" class="btn btn-warning mb-2">Recherche</button>
</form>
    
<div class="row col-md-12 ml-4">
    @foreach($touslesvoitures as $car)
    <div class="card ml-4" style="width: 22rem; height: 31rem;">
        <img src="{{ asset($car->Image) }}" style="width: 100%;" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $car->Marque }}</h5>
            <h5 class="card-title">{{ $car->Modele }}</h5>
            <h5 class="card-title">{{ date("Y", strtotime($car->Date_Sortie)) }}</h5>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal{{$car->id}}">
                Voir Plus
            </button>

            <!-- Modal Affichage des détails de la voiture -->
            <div class="modal fade modal-dialog-scrollable" id="exampleModal{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <img src="{{ asset($car->Image) }}" class="img-fluid w-50 h-50 custom-image" alt="...">
                                <div class="col ml-3">
                                    <h5 class="mb-3">Marque : {{ $car->Marque }}</h5>
                                    <h5 class="mb-3">Modele : {{ $car->Modele }}</h5>
                                    <h5 class="mb-3">Date de Sortie : {{ $car->Date_Sortie }}</h5>
                                    <h5 class="mb-3">Nombre de Place : {{ $car->nombre_place }}</h5>
                                </div>
                            </div>
                            <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, at officia ullam, repellendus officiis sit exercitationem voluptate perferendis quia soluta quas minima quod odio voluptatum iste deleniti corrupti eligendi hic.</h4>
                        </div>
                        <div class="modal-footer" {{ empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil == 2 ? 'hidden' : '' }}>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModals{{$car->id}}">Modifier</button>
                            <form action="/supprimerCar/id={{$car->id}}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                        <div {{ empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil == 1 ? 'hidden' : '' }} class="modal-footer">
                            <form action="" method="POST" style="display: inline;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModals{{$car->id}}">Reserver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

  <!-- Reservation -->

  <div class="modal fade modal-dialog-scrollable" id="exampleModals{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Reservation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
             
        <div id="map{{$car->id}}" style="height: 600px;"></div>
        <div id="result{{$car->id}}">
          Distance en KM:
          <span id="lengthid"></span>
          <br>
          Durée du trajet:
        <span id="duration"></span>
        </div>
        <form id="form{{$car->id}}">
          <label for="start{{$car->id}}">Lieu de départ:</label>
          <input type="text" id="start{{$car->id}}" name="start{{$car->id}}" required><br><br>
          <label for="destination{{$car->id}}">Destination:</label>
          <input type="text" id="destination{{$car->id}}" name="destination{{$car->id}}" required><br><br>
          <button type="submit">Calculer l'itinéraire</button>
        </form>
      </div>
      <div class="modal-footer" {{empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil==2 ? 'hidden' : ''}}>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModals{{$car->id}}">Modifier</button>
        <form action="/supprimerCar/id={{$car->id}}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
      </div>
      <div class="modal-footer" {{empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil==1 ? 'hidden' : ''}}>
        
        <!-- <button type="submit" class="btn btn-primary" onclick="transfererLieux()" data-bs-toggle="modal" data-bs-target="#exampleModals2{{$car->id}}" >Suivant</button> -->
          <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModals2{{$car->id}}" >Suivant</button>
          <button type="submit" class="btn btn-warning" data-bs-dismiss="modal">Annuler</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal Du map  -->
<script>
  var mymap{{$car->id}} = L.map('map{{$car->id}}').setView([14.7167, -17.4677], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(mymap{{$car->id}});

  var control{{$car->id}} = L.Routing.control({
    waypoints: [],
    routeWhileDragging: true
  }).addTo(mymap{{$car->id}});

  document.getElementById('form{{$car->id}}').addEventListener('submit', (e) => {
    e.preventDefault();
    var start = document.getElementById('start{{$car->id}}').value;
    var destination = document.getElementById('destination{{$car->id}}').value;

    let lieuDepart2 = document.getElementById('lieuDepartRes');
    let lieuArrivee2 = document.getElementById('lieuArriveeRes-1');

    // let lieuDepart = start;
    // let lieuArrivee = destination;

    lieuDepart2.innerText = start;
    lieuArrivee2.innerText = destination;

    document.getElementById('lieuDepartResInput').value = start;
    document.getElementById('lieuArriveeResInput').value = destination;

    document.getElementById('lieuDepartRes3').value = start;
    document.getElementById('lieuArriveeRes3').value = destination;

    document.getElementById('lieuDepartRes2').textContent = start;
    document.getElementById('lieuArriveeRes2').textContent = destination;

    console.log(lieuArrivee2, lieuDepart2);
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${start}`)
      .then(response => response.json())
      .then(data => {
        var startCoord = L.latLng(data[0].lat, data[0].lon);

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${destination}`)
          .then(response => response.json())
          .then(data => {
            var destCoord = L.latLng(data[0].lat, data[0].lon);

            control{{$car->id}}.setWaypoints([startCoord, destCoord]);

            control{{$car->id}}.on('routesfound', function(e) {
              var routes = e.routes;
              var summary = routes[0].summary;
              var totalDistance = (summary.totalDistance / 1000).toFixed(2); // Arrondir à 2 décimales
              var totalSeconds = summary.totalTime;
              var hours = Math.floor(totalSeconds / 3600);
              var minutes = Math.floor((totalSeconds % 3600) / 60);
              document.getElementById('lengthid').innerHTML = (summary.totalDistance / 1000).toFixed(1) + ' km';
              document.getElementById('duration').innerHTML = (summary.totalTime / 60).toFixed(0) + ' minutes';

              document.getElementById('distanceRes').value = (summary.totalDistance / 1000).toFixed(1) + ' km';
              
              //pour l'affichage de la distance dans le modal (finalisation de la reservation)
              document.getElementById('distanceRes').innerText = (summary.totalDistance / 1000).toFixed(1) + ' km';
              document.getElementById('distanceRes2').innerText = (summary.totalDistance / 1000).toFixed(1) + ' km';
              document.getElementById('distanceRes3').value = (summary.totalDistance / 1000).toFixed(1);
              document.getElementById('distanceRes0').value = (summary.totalDistance / 1000).toFixed(1);
            });
          });
      });
  });
</script>

 <!-- Finalisation de la Reservation -->

 <div class="modal fade modal-dialog-scrollable" id="exampleModals2{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Reservation</h1>
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
          <h1>Reservations</h1>
          <div class="col ml-3">
              <input type="text" name="idVoiture" id="idVoiture" value=" {{$car->id}}" hidden>
            
              <h5 class="mb-3">Trajet :  <span id="lieuDepartRes"></span> - <span id="lieuArriveeRes-1"></span>
                <input type="text" hidden id="lieuDepartResInput" name="lieuDepartRes" >
                  </input>  <input type="text" hidden id="lieuArriveeResInput" name="lieuArriveeRes" ></input>
              </h5>

              <h5 class="mb-3" >Distance : <span id="distanceRes"></span></h5>
                <input type="text" hidden name="distanceRes" id="distanceRes0" ></input></h5>

                <h5 class="mb-3">Date de Reservation : <input type="hidden" name="date1_hidden" id="date1_hidden"> <input type="date" disabled name="date1" id="date1"></h5>
            <h5 class="mb-3">Heure de depart : <input type="time" id="heure_depart" name="heure_depart" oninput="verifierHeure()"> <small id="erreur_heure" class="text-danger"></small></h5>
            <h5 class="mb-3">Heure d'arrivee : <input type="time" hidden id="Heure_Fin" name="heure_Fin"> <span id="heure_Finis"></span> </h5>
          </div>
        </div>
      </div>
      <div class="modal-footer" {{empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil==1 ? 'hidden' : ''}}>
        <button type="submit" hidden id="valider" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModals3{{$car->id}}">Valider</button>
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Annuler</button>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade modal-dialog-scrollable" id="exampleModals3{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-ls">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Reservation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">      
        <div class="row">
          <h1>Reservations</h1>
          <div class="col ml-3">
            <form action="{{ route('Reservation') }}" method="post">
            @csrf
              <input hidden type="text" name="idVoiture" id="idVoiture" value=" {{$car->id}}">
            
              <h5 class="mb-3">Trajet :  <span id="lieuDepartRes2"></span> - <span id="lieuArriveeRes2"></span>
                <input type="text" id="lieuDepartRes3" hidden name="lieuDepartRes3" >
                  </input>  <input type="text" hidden id="lieuArriveeRes3" name="lieuArriveeRes3" ></input>
              </h5>

              <h5 class="mb-3" >Distance : <span id="distanceRes2"></span></h5>
                <input type="text" name="distanceRes3" hidden id="distanceRes3"></input></h5>

                <h5 class="mb-3">Date de Reservation : <input type="hidden" name="date2_hidden" id="date2_hidden"> <input type="date" disabled name="date4" id="date4"></h5>
                <h5 hidden class="mb-3">Heure de depart : <input type="time" id="heure_depart_add" name="heure_depart_add" hidden ></h5>
                <h5 hidden class="mb-3">Heure d'arrivee : <input type="time" hidden id="Heure_Fin_add" name="heure_Fin"> </h5>
            <h5 class="mb-3">Heure de depart : <span id="depart"></span></h5>
            <h5 class="mb-3">Heure d'arrivee : <span id="arriver"></span> </h5>
          </div>
        </div>
      </div>
      <div class="modal-footer" {{empty(session('personne')) || !empty(session('personne')) && session('personne')->Profil==1 ? 'hidden' : ''}}>
        <button type="submit" class="btn btn-success">Confirmer</button>
         <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Annuler</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Modification -->
<div class="modal fade modal-dialog-scrollable" id="exampleModals{{$car->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/Modification" method="post" enctype="multipart/form-data"   class="text-left">
          @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
          @endforeach
          @csrf
        <div class="row">
          <input type="text" hidden value="{{$car->id}}">
            <img src="{{asset($car->Image)}}" class="img-fluid w-50 h-50 custom-image" alt="...">
          <div class="col ml-3">
          <div class="mb-3">
            <label for="marque" class="form-label">Marque</label>
            <input type="text" class="form-control" id="marque" name="marque" value="{{$car->Marque}}">
          </div>
          <div class="mb-3">
            <label for="modele" class="form-label">Modele</label>
            <input type="text" value="{{$car->Modele}}" class="form-control" id="modele" name="modele">
          </div>
          <div class="mb-3" hidden>
              <label for="Date_Sortie" class="form-label">Date Sortie</label>
              <input type="text"  value="{{$car->Date_Sortie}}" class="form-control" id="Date_Sortie" name="Date_Sortie">
          </div>
          <div class="mb-3">
              <label for="Nombre_Place" class="form-label">Nombre Place</label>
              <input type="text" value="{{$car->nombre_place}}" class="form-control" id="nbr_place" name="nbr_place">
          </div>
          <div class="mb-3">
              <label for="Nombre_Place" class="form-label">Nombre Place</label>
              <input type="text" value="{{$car->nombre_place}}" class="form-control" id="nbr_place" name="nbr_place">
          </div>
            </div>
          
        </div>
      
      
      <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, at officia ullam, repellendus officiis sit exercitationem voluptate perferendis quia soluta quas minima quod odio voluptatum iste deleniti corrupti eligendi hic.</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
        <button type="submit" class="btn btn-success">Modifier</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  </div>
</div>
@endforeach
</div>

<!-- Ajout de voiture -->
<div class="modal fade modal-dialog-scrollable" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Ajout de voiture</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('voiture')}}" method="post" enctype="multipart/form-data" class="text-left">
          @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
          @endforeach
          @csrf
            <label>Image</label>
          <input type="file" id="image" name="image" class="form-control">
          <label>Marque</label>
          <input type="text" id="marque" name="marque" class="form-control">

          <label>Modele</label>
          <input type="text" id="modele" name="modele" class="form-control">

          <label>Nombre de place</label>
          <input type="text" name="nombre_place" id="nombre_place" class="form-control">
          
          <label> Date de sortie <span class="font-weight-bold ml-2"><input type="date" class="form-control" name="date_sortie" id="date_sortie"></span></label>

          <label> Matricule <span class="font-weight-bold ml-2"><input type="text" class="form-control" name="matricule" id="matricule"></span></label>

          <label> Kilometrage <span class="font-weight-bold ml-2"><input type="text" class="form-control" name="kilometrage" id="kilometrage"></span></label>
          <br>
          <label> Categorie 
            <span class="font-weight-bold ml-2">
              <select name="categorie" id="categorie" class="form-control">
                <option value=""></option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
              </select>
            </span>
          </label>
        <br>

        <label> N Permis 
            <span class="font-weight-bold ml-2">
                <select name="numero" id="numero" class="form-control">
                    <option value="">Selectionner...</option>
                    @foreach($chauffeur as $chauf)
                    
                    <option value="{{$chauf->id}}" categorie="{{$chauf->Categorie}}">{{$chauf->Prenom}} {{$chauf->Nom}}</option>
                    @endforeach
                </select>
            </span>
        </label>

          
          
          </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
        <button type="submit" class="btn btn-success">Ajouter</button>
        
      </div>
    </form>
    </div>
  </div>
</div>
<!-- pour le filtrage des permis lotsqu'on assigne une voiture a un chauffeur -->
<script>
  document.getElementById('categorie').addEventListener('change', function() {
    var selectedCategorie = this.value;
    var numeros = document.querySelectorAll('#numero option');
    numeros.forEach(function(numero) {
        if (selectedCategorie === '' || selectedCategorie === numero.getAttribute('categorie')) {
          numero.style.display = 'block';
        } else {
            numero.style.display = 'none';
        }
    });
});
</script>

<!-- Recuperation des lieux du tajets dans un autre modal -->
<!-- <script>
  function transfererLieux() {
    
    // Récupérer les valeurs des lieux de départ et d'arrivée
    let lieuDepart = document.getElementById('start{{$car->id}}').value;
    let lieuArrivee = document.getElementById('destination{{$car->id}}').value;

    let lieuDepart2 = document.getElementById('start{{$car->id}}').value;
    let lieuArrivee2 = document.getElementById('destination{{$car->id}}').value;

    // Afficher les lieux dans le deuxième modal
    document.getElementById('lieuDepartRes').value = lieuDepart;
    document.getElementById('lieuArriveeRes').textContent = lieuArrivee;
    console.log(lieuDepart, lieuDepart2, lieuArrivee, lieuArrivee2);

    document.getElementById('lieuDepartRes2').textContent = lieuDepart2;
    document.getElementById('lieuArriveeRes2').textContent = lieuArrivee2;

    document.getElementById('lieuDepartRes3').value = lieuDepart2;
    document.getElementById('lieuArriveeRes3').value = lieuArrivee2;

    // Fermer le premier modal
    $('#exampleModals{{$car->id}}').modal('hide');
  }
</script> -->

<!-- Controle des dates  -->
<script>
  let depart = document.getElementById('depart');
  let arrivee = document.getElementById("arriver");
  var aujourdhui = new Date();
    var jour = aujourdhui.getDate();
    var mois = aujourdhui.getMonth() + 1; // Les mois sont indexés à partir de 0
    var annee = aujourdhui.getFullYear();
    // Mettre à jour la valeur du champ date1 avec la date d'aujourd'hui
    document.getElementById('date1').value = annee + '-' + (mois < 10 ? '0' : '') + mois + '-' + (jour < 10 ? '0' : '') + jour;

    document.getElementById('date4').value = annee + '-' + (mois < 10 ? '0' : '') + mois + '-' + (jour < 10 ? '0' : '') + jour;

    document.getElementById('date2_hidden').value = annee + '-' + (mois < 10 ? '0' : '') + mois + '-' + (jour < 10 ? '0' : '') + jour;

    document.getElementById('date1_hidden').value = annee + '-' + (mois < 10 ? '0' : '') + mois + '-' + (jour < 10 ? '0' : '') + jour;

    // document.getElementById('date1').addEventListener('input', updateDuration);
    // document.getElementById('date2').addEventListener('input', updateDuration);
    let boutton = document.getElementById('valider');

    // function updateDuration() {
      //     var date1 = new Date(document.getElementById('date1').value);
      //     var date2 = new Date(document.getElementById('date2').value);

      //     if (date1.getTime() >= date2.getTime()) {
      //       boutton.setAttribute('hidden','');
      //       alert("La date de fin ne doit pas etre antertieur a celle de du debut.");
      //     }else{
      //       boutton.removeAttribute('hidden','');
      //     }

      //     var diffTime = Math.abs(date2.getTime() - date1.getTime());
      //     var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
          
      //     document.getElementById('duree').textContent = diffDays;
    // }
    //Control des dates de 
    function verifierHeure() {
      let boutton = document.getElementById('valider');
      let heureDepart = document.getElementById('heure_depart').value;
      let heureFin = document.getElementById('Heure_Fin');
      var maintenant = new Date();
      var heuresActuelles = maintenant.getHours();
      var minutesActuelles = maintenant.getMinutes();

      var heuresSaisies = parseInt(heureDepart.split(':')[0]);
      var minutesSaisies = parseInt(heureDepart.split(':')[1]);

      var erreurHeure = document.getElementById('erreur_heure');
      if (heuresSaisies < heuresActuelles || (heuresSaisies === heuresActuelles && minutesSaisies <= minutesActuelles)) {
          erreurHeure.textContent = "L'heure de départ doit être supérieure à l'heure actuelle.";
          boutton.setAttribute('hidden','');
          document.getElementById('heure_depart').setCustomValidity("L'heure de départ doit être supérieure à l'heure actuelle.");
      } else {
        boutton.removeAttribute('hidden','');
        erreurHeure.textContent = "";
        document.getElementById('heure_depart').removeAttribute("");
        
        //Appelle du fonction de converssion en secondes
        var heureFinEnSecondes = convertirEnSecondes(heureDepart);
        //Recuperation de la duree du trajet
        var [durer,unite ]= document.getElementById('duration').textContent.split(" ").map(Number);
        var seconde = heureFinEnSecondes+durer*60;
        // console.log(convertisserSecondeEnHeure(seconde));

        // passage de valeur de la l'input de la date de fin
        document.getElementById('Heure_Fin').textContent=convertisserSecondeEnHeure(seconde);
        console.log(heureFin.value=convertisserSecondeEnHeure(seconde));
        document.getElementById('heure_Finis').innerHTML = convertisserSecondeEnHeure(seconde);
        
        
      }
    depart.innerText = heureDepart;
    arrivee.innerText = document.getElementById('heure_Finis').innerHTML;
    document.getElementById('heure_depart_add').value = heureDepart;
    document.getElementById('Heure_Fin_add').value = heureFin.value;
    
    }
    
  function convertirEnSecondes(heure) {
    // cette ligne permet de diviser l'heure donner en parametre sous le format d'un tableau [20,30] et convertie chaque partie en une nombre avec map(Number)
    var [heures, minutes] = heure.split(':').map(Number);
    return heures * 3600 + minutes * 60;
  }
  function convertisserSecondeEnHeure(seconde){
    var h = Math.floor(seconde / 3600);
    var M = Math.floor((seconde % 3600) / 60);
    return `${h.toString().padStart(2, '0')}:${M.toString().padStart(2, '0')}`;
  }

    
</script>
@endsection