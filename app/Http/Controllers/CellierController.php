<?php

namespace App\Http\Controllers;

use App\Models\BouteilleCellier;
use Illuminate\Http\Request;
use App\Models\Cellier;
use App\Models\Bouteille;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class CellierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $celliers = Cellier::where('user_id','=',Auth::user()->id)->paginate(8);
        return view('celliers.mes-celliers',['celliers' => $celliers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('celliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation de la nom du cellier
        $validatedData = $request->validate([
            'nom' => 'required|min:3|max:100',
            'note' => 'nullable',
        ]);
        if(!$validatedData)
            return redirect()->back()->withErrors($validatedData)->withInput();

        $user = Cellier::create([
            'nom' => $validatedData['nom'],
            'note'=> $validatedData['note'],
            'user_id' =>  Auth::user()->id,

        ]);
        return redirect(route('celliers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cellier = Cellier::find($id);
        $bouteilles=Cellier::find($id)->bouteilles()->paginate(8);

        return view('celliers.detail-cellier',compact('cellier','bouteilles'));
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
       // $cellier = Cellier::destroy($id);

      //  return redirect(route('celliers.index'));

    }

   









}
