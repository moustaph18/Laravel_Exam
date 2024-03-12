<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 How To Integrate Stripe Payment Gateway</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class='row'>
            <h1>Paiement</h1>
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        
                        <h3>{{$reservationDetails[0]->Pronom}} {{$reservationDetails[0]->Nom}}</h3>
                        

                        <br>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <img src="{{asset($reservationDetails[0]->Image)}}" class="img-fluid w-50 h-50 custom-image" alt="...">
                            <div class="col ml-4 mt-4">
                               
                                <h3 class="mt-3">Trajet : <span>{{$reservationDetails[0]->Lieu_Depart}} - {{$reservationDetails[0]->Lieu_Arrivee}}</span></h3>

                                <h3 class="mt-3">Distance en KM: <span>{{$reservationDetails[0]->{'Distance(KM)'} ?? ''}}</span></h3>
                                 
                                <h3 class="mt-3">Date de Reservation : <span>{{$reservationDetails[0]->Date_Location}}</span></h3>

                                <h3 class="mt-3">Heure depart : <span>{{$reservationDetails[0]->Heure_Debut}}</span></h3>

                                <h3 class="mt-3">Heure Depart : <span>{{$reservationDetails[0]->Heure_Fin}}</span></h3>


                            </div>
                            
                        </div>
                    </div>    
                    <div class="card-footer">
                        <tr>
                            <td colspan="5" style="text-align:right;">Total($) :<h3 id="tots"><strong></strong></h3></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align:right;">
                                <form action="/session" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type='hidden' id="id_res" name="id_ress" value="{{$reservationDetails[0]->location_id}}">
                                <input type='hidden' id="total" name="total">
                                
                                <input type='hidden' name="productname" value="{{$reservationDetails[0]->Date_Location}}">
                                <button class="btn btn-success float-end" type="submit" id="checkout-live-button"><i class="fa fa-money"></i> Payer</button>
                                </form>
                            </td>
                        </tr>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- la recuperation de la distance  -->
<script>
    // Récupérez l'élément total
    let total = document.getElementById("total");
    // Récupérez la valeur de Distance(KM) pour le premier élément de la liste
    let distance = {{$reservationDetails[0]->{'Distance(KM)'} ?? '0'}};
    // Calculez le total en multipliant la distance par 0.5
    let calculTotal = distance * 0.5;
    // Mettez à jour la valeur de l'élément total
    total.value = calculTotal.toFixed(0); // Formatage à deux décimales
    
    document.getElementById("tots").innerText = total.value;
</script>

</html>