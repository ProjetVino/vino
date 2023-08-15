@extends('layouts.app')
@section('titre', 'MON COMPTE')
@section('content')

<main class="main-content">
            
            <section class="catalogue">
                <div class="titre">
                    <h1>Bonjour <span>{{ Auth::user()->nom }}</span></h1>
                </div>
                <div class="row text-center carte" id="carte-cellier">
                    <div class="col-md-3 card mb-1 mr-1">
                        <div class="card-body text-carte">
                            <div class="titre-icons">
                                <div>
                                        <h2 class="card-title">Profile</h2>
                                </div>
                                <div class="icons">
                                    <a href="{{ route('modifier-profile') }}"> <img src="{{asset('assets/crayon.png')}}" alt="Ícone" title="Modifier Profile" class="icon"> </a>
                                </div>
                            </div>

                            <div class="form-profile">
                                <p>Nom: <span>{{ $user->nom }}</span></p>
                                <p>Email: <span>{{ $user->email }}</span></p>
                                <p>Adresse: <span>{{ $user->adresse }}</span></p>
                                <p>Ville: <span>{{ $user->ville }}</span></p>
                                <p>Code Postal: <span>{{ $user->cp }}</span></p>
                                <p>Téléphone: <span>{{ $user->tel }}</span></p>
                            </div>
                        </div>
                    </div>       
                </div>
            </section>
</main>

@endsection
