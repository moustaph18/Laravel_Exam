@extends('Layouts/App')
@section('content')
<div class="page-wrapper">

    <div class="page-body">
        <div class="row">

            <!-- order-card start -->
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Voiture</h6>
                        <h2 class="text-right"><i class="ti-car f-left"></i><span>{{$voiture}}</span></h2>
                        <p class="m-b-0">Voiture Hors Service<span class="f-right">{{$voitureHors}}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Total Des chauffeurs</h6>
                        <h2 class="text-right"><i class="ti-user f-left"></i><span>{{$chauffeurs}}</span></h2>
                        <p class="m-b-0">Chauffeurs un contrat<span class="f-right">{{$chauffeurs_contrat}}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Total des Utilisateurs</h6>
                        <h2 class="text-right"><i class="ti-user f-left"></i><span>{{$user}}</span></h2>
                        <p class="m-b-0">Administrateur<span class="f-right">{{$users_admin}}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-pink order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Total Des Revenus</h6>
                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>${{$totalMontant}}</span></h2>
                        <p class="m-b-0">This Month<span class="f-right">${{$totalMontant}}</span></p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div id="styleSelector">

    </div>
</div>
@endsection