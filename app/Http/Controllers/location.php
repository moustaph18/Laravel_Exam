<?php

namespace App\Http\Controllers;

use App\Models\location as ModelsLocation;
use App\Models\voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Type\VoidType;

class location extends Controller
{
    public function DemandeReservation(Request $request){
        $loc = new ModelsLocation();
        $loc->Client_id = $request->session('personne')->get('personne')->id;
        $loc->Voiture_id = $request->idVoiture;
        $loc->Lieu_Depart = $request->lieuDepartRes3;
        $loc->Lieu_Arrivee = $request->lieuArriveeRes3;
        $loc->{('Distance(KM)')} = $request->distanceRes3;
        $loc->Date_Location = $request->date2_hidden;
        $loc->Heure_Debut = $request->heure_depart_add;
        $loc->Heure_Fin = $request->heure_Fin;
        $loc->save();
        if ( $loc->save()) {
            voiture::where('id',$request->idVoiture)
                ->update([
                    'Status' => 0
                ]);
        }
        return redirect('/payement')->with('success', 'Votre demande a ete bien recu. Passer maintenant au paiement ...');
    }

    public function En_attente(){
        $reservations = ModelsLocation::where('Etat', 0)->get();

$detailsReservations = collect(); // Collection pour stocker les détails de chaque réservation

    foreach ($reservations as $reservation) {
        $detailsReservation = DB::table('location')
            ->join('voiture', 'location.Voiture_id', '=', 'voiture.id')
            ->select('location.*', 'voiture.*', 'location.id as location_id') // Ajouter location.id à la sélection
            ->where('location.id', $reservation->id)
            ->first();
        
        $detailsReservations->push($detailsReservation); // Ajouter les détails de la réservation à la collection
    }
        //dd($detailsReservations);
    
         return view('Reservations.En attente', ['detailsReservations' => $detailsReservations]);
    }
    
    public function Valider(Request $request){

        ModelsLocation::where('id',$request->id_Location)
            ->update([
                'Etat' => 1
            ]);

            $location = ModelsLocation::find($request->id_Location);

            if ($location) {
                voiture::where('id',$location->Voiture_id)
                ->update([
                    'Kilometrage' => $request->Kilometrage,
                ]);
                
            }
        
        return redirect('/Valider')->with("Success","Reservation valider avec success!");
    }
    public function Liste(){
        // $images = DB::table('location')
        // ->join('voiture', 'location.Voiture_id', '=', 'voiture.id')
        // ->select('voiture.Image')
        // ->first();

        $reservation = ModelsLocation::where('Etat','=',1)
        ->join('voiture', 'location.Voiture_id', '=', 'voiture.id')
        ->select('location.*', 'voiture.Image as ImageVoiture')
        ->get();

        $personneId = session()->get('personne')->id;

        $reservations = DB::table('personne')
            ->join('location', 'personne.id', '=', 'location.Client_id')
            ->join('voiture', 'location.Voiture_id', '=', 'voiture.id')
            ->select('personne.Pronom', 'personne.Nom', 'location.*', 'voiture.Image as ImageVoiture')
            ->where('location.Etat', 1)
            ->where('location.Paiement', 1)
            ->where('personne.id', $personneId)
            ->get();

        
        //dd($reservation);
        return view('Reservations.valider',compact('reservations','reservation'));
    }
}
