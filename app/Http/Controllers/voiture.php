<?php

namespace App\Http\Controllers;

use App\Models\contrat;
use App\Models\permis;
use App\Models\voiture as ModelsVoiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class voiture extends Controller
{
    public function allofdriver(){
        $chauffeur = DB::table('contrat')
        ->join('permis', 'contrat.Chauffeur', '=', 'permis.id')
        ->select('contrat.*', 'permis.*')
        ->get();
        
        $touslesvoitures = DB::table('voiture')
        ->where('status', '=', 1)
        ->orderBy('Marque', 'asc')
        ->get();
        
        return view('Voiture.VoitureDispo',compact('chauffeur','touslesvoitures'));
    }

    public function Voiture_Indispo(){
        $chauffeur = DB::table('contrat')
        ->join('permis', 'contrat.Chauffeur', '=', 'permis.id')
        ->select('contrat.*', 'permis.*')
        ->get();

        $touslesvoitures_Res = DB::table('voiture')
        ->where('status', '=', 0)
        ->get();
        return view('Voiture.VoitureInDispo',compact('chauffeur','touslesvoitures_Res'));
    }
    public function Voiture_Hors(){
        $chauffeur = DB::table('contrat')
        ->join('permis', 'contrat.Chauffeur', '=', 'permis.id')
        ->select('contrat.*', 'permis.*')
        ->get();

        $touslesvoitures_Hors = DB::table('voiture')
        ->where('status', '=', -1)
        ->get();
        
        return view('Voiture.VoitureHorsService',compact('chauffeur','touslesvoitures_Hors'));
    }
    public function voiture(Request $request) {
        $request->validate([
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'marque'=>'required',
            'modele'=>'required',
            'nombre_place'=>'required',
            'date_sortie'=>'required',
            'matricule'=>'required',
            'kilometrage'=>'required',
            'numero'=>'required',
            'categorie'=>'required',
        ]);
        $newCar = new ModelsVoiture();
        $newCar->Marque = $request->marque;
        $newCar->Modele = $request->modele;
        $newCar->Date_Sortie = $request->date_sortie;
        $newCar->Kilometrage = $request->kilometrage;
        $newCar->Matricule = $request->matricule;
        $newCar->Chauffeur_id = $request->numero;
        $newCar->nombre_place = $request->nombre_place;
        $filename=time().$request->file('image')->getClientOriginalName();
        if ($request->hasFile('image')) {
          $path = $request->file('image')->storeAs('photos',$filename,'public');
          $newCar->Image= '/storage/'.$path;
        }
        $newCar->Categorie = $request->categorie;
        $newCar->save();
        return back()->with("state","L'ajout du voiture avec chauffeur a ete fait avec success");
    }
    public function DelCar($id){
        $supp_car = ModelsVoiture::find($id);
        $supp_car->delete(); 
        return redirect()->back()->with('success', 'Voiture supprimé avec succès.');
    }
    public function Modification(Request $request){
        
        

    }
    public function DemandeReservation(){
        
    }
}
