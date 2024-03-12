<?php

namespace App\Http\Controllers;

use App\Models\facturation as ModelsFacturation;
use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class facturation extends Controller
{
    public function payement(){
        $reservationDetails = DB::table('location AS l1')
        ->join('personne', 'personne.id', '=', 'l1.Client_id')
        ->join('voiture', 'voiture.id', '=', 'l1.Voiture_id')
        ->select('personne.Pronom', 'personne.Nom', 'l1.*', 'voiture.*', 'l1.id AS location_id')
        ->orderBy('l1.id', 'desc')
        ->limit(1)
        ->get();
    
    

         return view('Facturation/payement',compact('reservationDetails'));
        //dd($reservationDetails);
    }
    public function checkout()
    {
        return view('Facturation/payement');
    }
 
    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('strip.sk'));
 
        $productname = $request->get('productname');
        $totalprice = $request->get('total');
        $two0 = "00";
        $total = "$totalprice$two0";
        $id_reservation = $request->id_ress;
 
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);
        $fact = new ModelsFacturation();
        $fact->Montant = $request->total;
        $fact->Date_Paiement = $request->productname;
        $fact->Location_id = $request->id_ress;
        $fact->save();
        if ($fact->save()) {
            location::where('id',$id_reservation)
            ->update([
                'Paiement' => 1
            ]);
        }
 
        return redirect()->away($session->url);
    }
 
    public function success()
    {
        return redirect('/VoitureDispo')->with('success3','Votre paiement a bien ete effectuer !');
    }
}