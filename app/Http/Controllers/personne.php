<?php

namespace App\Http\Controllers;

use App\Models\contrat;
use App\Models\facturation;
use App\Models\permis;
use App\Models\personne as ModelsPersonne;
use App\Models\voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class personne extends Controller
{
    public function Inscription(Request $req){
        $req->validate([
            'nom'=> 'required',
            'prenom' => 'required',
            'CNI' => 'required',
            'login'=>'required',
            'mdp'=>'required',
            // 'IdProfil'=>'required',
        ]);
        $ins = new ModelsPersonne();
        $ins->Pronom = $req->prenom;
        $ins->Nom = $req->nom;
        $ins->CNI = $req->CNI;
        $ins->Adresse = $req->adresse;
        $ins->Login = $req->login;
        $ins->Mot_de_passe = bcrypt($req->mdp);
        $ins->save();
        return redirect('/Login')->with('StateI',"Votre compte a ete cree avec success");
  
    }

   public function Authentification(Request $request){

    $request->validate([
        'login'=>'required',
        'mdp'=>'required',
    ]);
    // $log_Elec = Electeur::where('login',$request->login)->fisrt();
    $log_Client = ModelsPersonne::where('Login', $request->login)->first();

    
    if ($log_Client) {
        if (Hash::check($request->mdp,$log_Client->Mot_de_passe)) {
            $request->session()->put('personne',$log_Client);
            if($request->session('personne')->get('personne')->Profil==1){
                return  redirect('/App');
              }else{

                 return redirect('/VoitureDispo');
              }
        }else {
            return back()->with('StatuM',"Mot de passe incorrect!");
        }
    }else {
        return back()->with('StatuL',"Identifiant incorrect!");
    }

   }
     public function deconnexion(Request $request){        
    $request->session()->forget('personne');
    return redirect('/Login');
    }

    public function Page_Connexion(Request $request){
        if(!empty(session('personne')) && $request->session('personne')->get('personne')->Profil==2){
          return  redirect('/VoitureDispo');
        }else if(!empty(session('personne')) && $request->session('personne')->get('personne')->Profil==1){
          return  redirect('/App');
        }
          return view('Securiter/Login');
        
    }
    public function Page_Inscription(Request $request){
        if(!empty(session('personne')) && $request->session('personne')->get('personne')->Profil==2){
            return  redirect('/VoitureDispo');
          }else{
              //return view('/Connexion');
              return view('Inscription');
          }
        
    }

    public function all(){

        $voiture = count(voiture::all());
        $voi = DB::table('voiture')
        ->where('status', '=', -1)
        ->get();
        $voitureHors=count($voi);

        $chauffeurs = count(permis::all());
        $chauffeurs_contrat = count(contrat::all());
        $totalMontant = facturation::sum('Montant');
        $user = count(ModelsPersonne::all());
        $users = $voi = DB::table('personne')
        ->where('Profil', '=', 1)
        ->get();
        $users_admin = count($users);
         return view('Admin/Admin',compact('voiture','voitureHors','chauffeurs','chauffeurs_contrat','totalMontant','user','users_admin'));
    }
}
