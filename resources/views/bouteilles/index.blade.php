@extends('layouts.app')
@section('titre', 'VINO')
@section('content')
        <main class="main-content">
            <section class="container">
                <div class="titre">
                    <h1>Bonjour <span>{{ Auth::user()->nom }}</span></h1>
                </div>
               
                @if (isset($sourcePage) && $sourcePage == 'ajoutBouteilleCellier' )
                    <div class="titre-section">
                       <h1>Cellier :  {{ $cellier->nom }}</h1>
                    </div>
                    <div class="text-container">
                        <a href="{{route('bouteilles.indexCellier',$cellier->id)}}" class="text-container">
                            <img src="{{asset('assets/add.png')}}" alt="add">
                            Ajouter une bouteille personalisée
                        </a>
                    </div>                    
                @else
                    <a href="{{ route('celliers.create') }}" class="text-container">
                        <img src="{{asset('assets/add.png')}}" alt="add">
                        Ajouter un cellier
                    </a>
                @endif
                
                <form method="post" action="{{ route('recherche') }}">
                     @csrf
                    <div class="recherche">
                        <input id="rechercheInput" name="valeur" type="text" placeholder="Rechercher un vin dans le catalogue" value="{{   $searchQuery ?? '' }}" >
                        <a href="{{ route('recherche') }}" onclick="event.preventDefault(); document.querySelector('form').submit();">
                            <img src="{{asset('assets/lupe.png')}}" alt="lupe">
                        </a>
                    </div>
                </form>

            </section>

            <section id="bouteillesContainer" class="catalogue">

            @if ($bouteilles->isEmpty())
                <div class="carte centrer-text">
                  <p>Aucune bouteille trouvée!</p>
                </div>
            @else
             @if (isset($nbBouteilles) && !empty($nbBouteilles))
                <div class="details-nbBouteilles">{{$nbBouteilles}}</div>
            @endif
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
                                <input type="button" class="btn-carte-btn" onclick="ajouterAuCellier(event)" data-id="{{$bouteille->id}}" data-cellier_id="{{ ($sourcePage == 'ajoutBouteilleCellier')?$cellier->id:null}}" value="Ajouter à mon cellier">   
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
