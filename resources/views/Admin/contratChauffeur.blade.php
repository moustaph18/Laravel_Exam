@extends('Layouts/App')
@section('content')
@if(session('success'))
<div class="alert alert-success col-md-10 mx-auto">
    {{ session('success') }}
</div>
@endif
@foreach($errors->all() as $error)
      <div class="alert alert-danger">{{$error}}</div>
    @endforeach
<div class="container mt-4">
  <div class="card">
    @if($findContrat)
    <span class="h6 text-right text-success">Contrat en Cours</span>
    @endif
    @if(!$findContrat)
    <span class="h6 text-right text-warning">Pas de contrat Pour le moment</span>
    @endif
    <div class="card-header">
      <div class="row">
        <h6>Moustapha DIAGNE <span class="text-right ">Ville de Dakar</span> </h6>
        
      </div>
      <h4>KAAY GNOU DEMM</h4>
    </div>
    
    <div class="card-body">
      <form action="{{route('Signature')}}" method="post">
        @csrf
        <div class="row">
          <h1>Objet : Contrat de travail - Chauffeur <br>
          <br></h1>
          <h6>
            <input type="text" hidden name="idChauff" value="{{$permis_by_id->id}}">
            Entre l'employeur <strong>Moustapha </strong>, domicilié à <strong>Keur Massar</strong>, représenté par <strong>KAAY GNOU DEMM</strong>, en sa qualité de <strong>recruteur</strong>, d'une part,
          </h6>
        <h6>
            Et le salarié <strong>{{$permis_by_id->Prenom}} {{$permis_by_id->Nom}}</strong>, né le <strong>{{$permis_by_id->Date_Naissance}}</strong> à <strong>{{$permis_by_id->Lieu_de_Naissance}}</strong>, demeurant à <strong>[Adresse du salarié]</strong>, titulaire du permis de conduire n°<strong>{{$permis_by_id->Numero}}</strong>, d'autre part,
          </h6>
        <h6>
            Il a été convenu et arrêté ce qui suit :
          </h6>
        <h5>Article 1 - Fonction</h5>
        <h6>
            Le salarié est engagé en qualité de chauffeur.
          </h6>
        <h5>Article 2 - Durée</h5>
        <h6>
          @if($findContrat)
             Le présent contrat est conclu pour une durée de <strong id="duree"></strong> à compter du <!--<input type="hidden" name="date1_hidden" id="date1_hidden">--> <strong>{{$findContrat->Date_Embauche}}</strong> et prendra fin le <strong>{{$findContrat->Date_Fin}}</strong>. 
          @endif
          @if(!$findContrat)
            Le présent contrat est conclu pour une durée de <strong id="duree"></strong> à compter du <input type="hidden" name="date1_hidden" id="date1_hidden"> <input type="date" disabled name="date1" id="date1"> et prendra fin le <input type="date" name="date2" id="date2">.
          @endif
          </h6>
        <h5>Article 3 - Rémunération</h5>
        <h6>
          @if($findContrat)
            Le salarié percevra une rémunération mensuelle de <strong>{{$findContrat->Salaire}}</strong>.
          @endif
          @if(!$findContrat)
            Le salarié percevra une rémunération mensuelle de <input type="text" id="salaire" name="salaire">.
          @endif
          </h6>
        <h5>Article 4 - Obligations du salarié</h5>
        <h6>
            Le salarié s'engage à respecter les horaires de travail et les consignes de sécurité, à entretenir le véhicule qui lui est confié, etc.
          </h6>
        <h5>Article 5 - Obligations de l'employeur</h5>
        <h6>
            L'employeur s'engage à fournir au salarié un véhicule en bon état de fonctionnement, à lui verser sa rémunération mensuelle, etc.
          </h6>
        <h5>Article 6 - Résiliation</h5>
        <h6>
            En cas de résiliation du contrat, un préavis de [Durée du préavis] devra être respecté par l'une ou l'autre des parties.
          </h6>
        </div>
        
    </div>
    
    <div class="card-footer">
      @if(!$findContrat)
      <button type="submit" class="btn btn-success float-end ml-3" hidden id="signer">Approuver</button>
      @endif
      <a href="/gesChauffeurs" class="btn btn-warning float-end">Annuler</a>
    </div>
</form>
  </div>
</div>
<script>
      var aujourdhui = new Date();
        var jour = aujourdhui.getDate();
        var mois = aujourdhui.getMonth() + 1; // Les mois sont indexés à partir de 0
        var annee = aujourdhui.getFullYear();

        // Mettre à jour la valeur du champ date1 avec la date d'aujourd'hui
        document.getElementById('date1').value = annee + '-' + (mois < 10 ? '0' : '') + mois + '-' + (jour < 10 ? '0' : '') + jour;
        document.getElementById('date1_hidden').value = annee + '-' + (mois < 10 ? '0' : '') + mois + '-' + (jour < 10 ? '0' : '') + jour;
        document.getElementById('date1').addEventListener('input', updateDuration);
        document.getElementById('date2').addEventListener('input', updateDuration);
       let boutton = document.getElementById('signer');

        function updateDuration() {
            var date1 = new Date(document.getElementById('date1').value);
            var date2 = new Date(document.getElementById('date2').value);

            if (date1.getTime() >= date2.getTime()) {
              boutton.setAttribute('hidden','');
              alert("La date de fin ne doit pas etre antertieur a celle de du debut.");
            }else{
              boutton.removeAttribute('hidden','');
            }

            var diffTime = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            document.getElementById('duree').textContent = diffDays;
        }
</script>

@endsection