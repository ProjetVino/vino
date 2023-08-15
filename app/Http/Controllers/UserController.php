<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.create');
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

    // Validation des données pour le modèle  user
        $validatedData = $request->validate([
            'nom' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required|same:password',
        ]);
        if(!$validatedData)
            return redirect()->back()->withErrors($validatedData)->withInput();
                
        $user = User::create([
                'nom' => $validatedData['nom'],
                'email' =>  $validatedData['email'],
                'password' => Hash::make( $validatedData['password']),
        ]);
        return redirect(route('bouteilles.index'));
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

    public function showProfile()
    {
        $user = auth()->user(); // Obtém o usuário logado
        return view('user.index-profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('user.modifier-profile', compact('user'));
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

    public function updateProfile(Request $request)
    {
    $user = auth()->user();

    $validatedData = $request->validate([
        'nom' => 'required|min:2|max:50',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'adresse' => 'nullable|string',
        'ville' => 'nullable|string',
        'code-postal' => 'nullable|string',
        'phone' => 'nullable|string',
    ]);

    $user->update([
        'nom' => $validatedData['nom'],
        'email' => $validatedData['email'],
        'adresse' => $validatedData['adresse'],
        'ville' => $validatedData['ville'],
        'cp' => $validatedData['code-postal'],
        'tel' => $validatedData['phone'],
    ]);

    return redirect(route('profile'))->with('success', 'Profile updated successfully!');
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
}
