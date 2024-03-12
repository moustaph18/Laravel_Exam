<?php

namespace App\Http\Controllers;

use App\Models\permis;
use Illuminate\Http\Request;

class permis_c extends Controller
{
    public function add(Request $request){
        $request->validate([
            'prenom'=>'required',
            'nom'=>'required',
            'date_naissance'=>'required',
            'Lieu_De_Naissance'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_emission'=>'required',
            'date_expiration'=>'required',
            'delivrer_par'=>'required',
            'categorie'=>'required',
         ]);
         $chauffeur = new permis();
         $chauffeur->Prenom = $request->prenom;
         $chauffeur->Nom = $request->nom;
         $chauffeur->Date_Naissance= $request->date_naissance;
         $chauffeur->Lieu_de_Naissance = $request->Lieu_De_Naissance;
         $chauffeur->Numero = $request->n_permis;
         $chauffeur->Date_Emission = $request->date_emission;
         $chauffeur->Date_Expiration = $request->date_expiration;
         $chauffeur->Delivrer_Par = $request->delivrer_par;
         $chauffeur->Categorie = $request->categorie;
         $filename=time().$request->file('image')->getClientOriginalName();
         if ($request->hasFile('image')) {
          $path = $request->file('image')->storeAs('photos',$filename,'public');
          $chauffeur->Image= '/storage/'.$path;
         }
        //  $candidat->programme_id = $request->programme;
        $chauffeur->save();
        return back()->with("state","L'ajout du chauffeur a ete fait avec success");
    }
    public function liste(){
        $chauffeur = permis::all();
        return view('Admin.Permis',compact('chauffeur'));
    }
    public function InfoChauffeurById($id) {
        $infos = permis::find($id);
        $infos->delete();
        return redirect()->back()->with('success', 'Chauffeur supprimé avec succès.');
    }
}
