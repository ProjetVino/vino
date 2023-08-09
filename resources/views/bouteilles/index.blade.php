@extends('layouts.app')
@section('titre', 'VINO')
@section('content')
        <main class="main-content">
            <section class="container">
                <div class="titre">
                    <h1>Bonjour <span>{{ Auth::user()->nom }}</span></h1>
                </div>
                <div>
                    <a href="{{ route('celliers.create') }}" class="text-container">
                        <img src="{{asset('assets/add.png')}}" alt="add">
                        Ajouter un cellier
                    </a>
                </div>
                <form method="post" action="{{ route('recherche') }}">
                     @csrf
                    <div class="recherche">
                        <img src="{{asset('assets/lupe.png')}}" alt="lupe">
                        <input id="rechercheInput" name="valeur" type="text" placeholder="Rechercher un vin dans le catalogue" value="{{   $searchQuery ?? '' }}" >
                    </div>
                </form>

            </section>

            <section id="bouteillesContainer" class="catalogue">

            @if ($bouteilles->isEmpty())
                <div class="carte">
                  <p>Aucune bouteille trouvée!</p>
                </div>
            @else
                @foreach ($bouteilles as $bouteille)
                    <div class="carte">
                        <div>
                            <img src="{{$bouteille->image}}" alt="bouteille">
                        </div>
                        <div class="text-carte">
                            <h2>{{$bouteille->nom}}</h2>
                            <p>{{$bouteille->description}}</p>
                            <h3>{{ number_format($bouteille->prix_saq, 2, '.', ' ')}} $</h3>
                            <div class="btn-carte">
                                <a href="{{ route('bouteilles.details', ['id' => $bouteille->id]) }}">Détails</a>
                                <input type="button" class="btn-carte-btn" onclick="ajouterAuCellier(event)" data-id="{{$bouteille->id}}" value="Ajouter à mon cellier">
                            </div>
                        </div>
                    </div>
                @endforeach 
            @endif  
            <div id="paginationContainer" class="pagination">
                <!-- Pagination -->  
                @include('../pagination.pagination', ['paginator' => $bouteilles])
            </div>            
            </section>
        </main>

        <!-- Popup ajouter au cellier -->
        @include('bouteilles.popup')

@endsection
