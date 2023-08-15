@extends('layouts.app')
@section('titre', 'MES CELLIERS')
@section('content')
        <main class="main-content">
            <section class="container">
                <div class="titre">
                    <h1>Bonjour <span>{{ Auth::user()->nom }}</span></h1>
                </div>
                <div class="titre-section">
                    <h1>Mes Celliers </h1>
                </div>
            </section>

            <section>
                <a href=" {{ route('celliers.create') }} " class="align-right">
                    <img src="assets/add.png" alt="add">
                    Ajouter un cellier
                </a>
            </section>

            <section class="catalogue">
                <div class="row text-center carte" id="carte-cellier">
                        @forelse($celliers as $cellier)

                            <div class="col-md-3 card mb-1 mr-1">
                                <div class="card-body text-carte">
                                    <div class="titre-icons">
                                        <div>
                                             <h2 class="card-title">{{ $cellier->nom  }}</h2>
                                        </div>
                                        <div class="icons">
                                            <a href="{{ route('modifier-cellier', ['id' => $cellier->id]) }}"> <img src="{{asset('assets/crayon.png')}}" alt="Ícone" title="Modifier Cellier" class="icon"> </a>
                                            <a href="{{ route('supprimer-cellier', ['id' => $cellier->id]) }}"> <img src="{{asset('assets/poubelle.png')}}" alt="Ícone" title="Supprimer Cellier" class="icon"> </a>
                                        </div>
                                    </div>

                                    </h2>
                                    <p class="card-subtitle mb-2 text-muted">{{ $cellier->note }}</p>

                                    <p>Nombre de boutelles : {{$cellier->bouteilles_count ?? 0}}</p>
                                    <div class="btn-carte centrer-bouton">
                                        <a href="{{route('celliers.show',$cellier->id)}}">Détails</a>
                                    </div>
                                </div>
                            </div>

                        @empty

                            <label>Pas de Celliers</label>

                    @endforelse
                           
                              </div>
            </section>

            <section class="pagination">
                <!-- Pagination -->
                @include('../pagination.pagination', ['paginator' => $celliers])
            </section>



        </main>
@endsection
