<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bouteille;
use App\Models\Cellier;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class BouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bouteilles = Bouteille::paginate(30);
         return view('bouteilles.index',['bouteilles' => $bouteilles]);
    }

    // recherche de bouteilles
    public function rechercher(Request $request)
    {
        $searchQuery = strtolower($request->valeur); // Convertir la recherche en minuscules pour rendre la recherche insensible à la casse

        $bouteilles = Bouteille::where(function ($query) use ($searchQuery) {
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
                });
        })->paginate(30);

       $bouteilles->withPath('/recherche')->appends(request()->except('_token'));
          return view('bouteilles.index', [
                    'bouteilles' => $bouteilles,
                    'searchQuery' => $searchQuery
        ]);
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $bouteille = Bouteille::find($id);
        // Vérifier si la bouteille existe
        if (!$bouteille) {
            return redirect()->route('bouteilles.index')->with('error', 'Bouteille non trouvée');
        }

        return view('bouteilles.details', ['bouteille' => $bouteille]);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function indexCellier($cellier_id)
    {
        $bouteilles = Bouteille::paginate(30);
        $cellier = Cellier::find($cellier_id);
        return view('bouteilles.index-cellier',compact('bouteilles','cellier'));
    }

}
