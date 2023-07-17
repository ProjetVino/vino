@extends('layouts.app')
@section('titre', 'VINO')
@section('content')
        <main>
            <section class="container">
                <div class="titre">
                    <h1>Bonjour <span>{{ Auth::user()->nom }}</span></h1>
                </div>
                <div>
                    <a href="#" class="text-container">
                        <img src="{{asset('assets/add.png')}}" alt="add">
                        Ajouter un cellier
                    </a>
                </div>
                <form method="post" action="{{ route('recherche') }}">
                     @csrf
                    <div class="recherche">
                        <img src="{{asset('assets/lupe.png')}}" alt="lupe">
                        <input id="rechercheInput" name="valeur" type="text" placeholder="Rechercher un vin" value="{{   $searchQuery ?? '' }}" >
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
                                <a href="/details/{{$bouteille->id}}">Détails</a>
                                <input type="button" class="btn-carte-btn" onclick="ajouterAuCellier(event)" data-id="{{$bouteille->id}}" value="Ajouter à mon cellier">
                            </div>
                        </div>
                    </div>
                @endforeach 
            @endif  
                            
            </section>
            <section id="paginationContainer" class="pagination">
                <!-- Pagination -->
                 
                @include('../pagination.pagination', ['paginator' => $bouteilles])



            </section>
        </main>

        <!-- Popup ajouter au cellier -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="cacherPopup()">&times;</span>
                <h2>Ajouter au cellier</h2>
                @if (Auth::user()->celliers->isEmpty())
                    <div>
                        <a href="#" class="text-container">
                            <img src="{{asset('assets/add.png')}}" alt="add">
                            Ajouter un cellier
                        </a>
                    </div>             
                @else
                    <div class="formulaires">
                        
                        <label for="quantite">Quantité :</label>
                        <input type="number" id="quantite" name="quantite" min=1 value="1" required>
                        
                        <label for="cellier">Cellier :</label>
                        <select id="cellier" name="cellier" required>
                            <option value="" selected>Coisir un cellier</option>
                        @foreach(Auth::user()->celliers as $cellier)
                            <option value="{{$cellier->id}}">{{$cellier->nom}}</option>
                        @endforeach
                        <!-- Ajouter les autres options de cellier ici -->
                        </select>
                        
                        <input type="button" id="popup-ajouter" value="Ajouter">
                    </div>
                @endif
            </div>
        </div>
        <script src="{{ asset('js/popUp.js') }}"></script> <!-- Inclure le fichier JavaScript de popup -->
@endsection
