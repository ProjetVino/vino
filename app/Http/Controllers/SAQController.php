<?php

namespace App\Http\Controllers;
use App\Services\SAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SAQController extends Controller
{
    public function index(){
        if(Auth::user()->role_id == 1)
            return view('importation');
        else
            return redirect(route('celliers.index'));
    }
    public function scrapeSAQ(Request $request)
    {
        $nombreProduits = 0;
        $nombreProduit = $request->input('nombre');
        $page = $request->input('pages');
        $saq = new SAQ();
        for($i=1; $i<= $page ;$i++){
            $nombreProduits += $saq->getProduits($nombreProduit,$i);
        }
       // return "Nombre de produits insérés : " . $nombreProduits;
         return redirect()->back()->with("nbbouteilles", $nombreProduits . " bouteille(s) ajoutée(s)");
    }
}