<?php

namespace App\Http\Controllers;

use App\Models\contrat;
use App\Models\permis;
use Illuminate\Http\Request;

class contrat_c extends Controller
{
    public function contratChauff(){
        $permis = permis::all();
        return view('Admin.chauffeur',compact('permis'));
    }
    public function DetailleChauffeur($id){
        $permis_by_id = permis::find($id);
        $findContrat = contrat::where('Chauffeur',$id)->first();
        // dd($findContrat);
        return view('Admin.contratChauffeur',compact('permis_by_id','findContrat'));
    }
    public function signatureContrat(Request $request){
        $request->validate([
            'date1_hidden'=>'required',
            'date2'=>'required',
            'salaire'=>'required'
        ]);
        $signa = new contrat();
        $signa->Etat = 1;
        $signa->Date_Embauche = $request->date1_hidden;
        $signa->Date_Fin = $request->date2;
        $signa->Salaire = $request->salaire;
        $signa->Chauffeur = $request->idChauff;
        $signa->save();
        return redirect()->back()->with('success', 'contrat signer.');
    }
}
