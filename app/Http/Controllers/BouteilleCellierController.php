<?php

namespace App\Http\Controllers;

use App\Models\BouteilleCellier;
use App\Models\Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\DB;

class BouteilleCellierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $test = BouteilleCellier::where('cellier_id','=',$request->cellier_id)->where('bouteille_id','=',$request->bouteille_id);
        if($test->count()==0){
            $celliers = BouteilleCellier::create([
                'cellier_id'=>$request->cellier_id,
                'bouteille_id'=>$request->bouteille_id,
                'quantite'=>$request->quantite,
                'note'=>'',
            ]);
        }
        else{
           $celliers = BouteilleCellier::where('cellier_id', $request->cellier_id)
                ->where('bouteille_id', $request->bouteille_id)
                ->update(['quantite' => $test->first()->quantite + $request->quantite]);
        }
        // pour tester si je viens d'index & retourné message succès echec
        if(isset($request->vue_source) &&  $request->vue_source == "index"){
            if($celliers)
             return response()->json(['message' => 'Ajout avec succès']);
            else
             return response()->json(['message' => 'Echec d\'ajout']);
        } 
           
        else
        return redirect()->route('celliers.show',$request->cellier_id)->with('success','success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy(Request $request)
    {
      

      
        $cellier_id = BouteilleCellier::find($request->idbc)->first()->cellier_id;
        BouteilleCellier::destroy($request->idbc);

        return response()->json(['success' => 'delete']);
       // return redirect()->route('celliers.show',$cellier_id)->with('success','delete');

    }

    public function updateQuantite(Request $request)
    {

        $data = $request->all();

        $quantite=$data["quantite"];
        $id=$data["idcb"];

        BouteilleCellier::where('id','=',$id) //
            ->update(['quantite' => $quantite]);

        $cellier_id = BouteilleCellier::find($id)->first()->cellier_id;


        return response()->json(['success' => 'update', 'cellier_id' => $cellier_id]);
    }

    // recherche de bouteilles
    public function rechercherCellier(Request $request)
    {
        $searchQuery = strtolower($request->searchQuery); // Convertir la recherche en minuscules pour rendre la recherche insensible à la casse
        $cellier_id = $request->cellierid;
        $cellier = Cellier::find($cellier_id);

        $bouteilles = DB::table('bouteilles')
            ->select('bouteilles.nom','bouteilles.image','bouteilles.description','bouteilles.prix_saq','bouteilles_celliers.id','bouteilles_celliers.cellier_id','bouteilles_celliers.bouteille_id','bouteilles_celliers.quantite')
            ->join('bouteilles_celliers','bouteilles_celliers.bouteille_id','=','bouteilles.id')
            ->where('bouteilles_celliers.cellier_id','=',$cellier_id)
        ->where(function ($query) use ($searchQuery) {
            $query->whereRaw('LOWER(nom) LIKE ?', ['%'.$searchQuery.'%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%'.$searchQuery.'%'])
                ->orWhereRaw('LOWER(pays) LIKE ?', ['%'.$searchQuery.'%'])
                ->orWhere('prix_saq', 'LIKE', '%'.$searchQuery.'%')
                ->orWhere('format', 'LIKE', '%'.$searchQuery.'%')
                ->orWhere(function ($query) use ($searchQuery) {
                    // Gérer la recherche par type_id en utilisant les codes 1, 2 ou 3
                    if ($searchQuery === 'vin blanc') {
                        $query->where('type_id', 1);
                    } elseif ($searchQuery === 'vin rouge') {
                        $query->where('type_id', 2);
                    } elseif ($searchQuery === 'vin rosé') {
                        $query->where('type_id', 3);
                    }
                })
            ;
        })->paginate(8);

        $bouteilles->withPath('/rechercherCellier')->appends(request()->except('_token'));


        return view('celliers.detail-cellier',compact('cellier','bouteilles','searchQuery'));


    }



}
