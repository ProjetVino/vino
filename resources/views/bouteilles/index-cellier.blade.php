@extends('layouts.app')
@section('titre', 'VINO')
@section('content')
        <main class="main-content">
            <section class="container">
                <div class="titre">
                    <h1>Bonjour <span>{{ Auth::user()->nom }}</span></h1>
                </div>
                <div>
                    <div class="text-container">
                       Cellier en cours :  {{ $cellier->nom }}
                    </div>
                </div>
                <div class="text-container">
                    <a href="{{route('bouteilles.indexCellier',$cellier->id)}}" class="text-container">
                        <img src="{{asset('assets/add.png')}}" alt="add">
                        Ajouter une bouteille personalisée
                    </a>
                </div>
                <div class="recherche">
                    <img src="{{asset('assets/lupe.png')}}" alt="lupe">
                    <input type="text" placeholder="Rechercher un vin dans le catalogue">
                </div>
            </section>

            <section class="catalogue">
                @foreach ($bouteilles as $bouteille)
                    <div class="carte">
                        <div>
                            <img src="{{$bouteille->image}}" alt="bouteille">
                        </div>
                        <div class="text-carte">
                            <h2>{{$bouteille->nom}}</h2>
                            <p>{{$bouteille->description}}</p>
                            <h3>{{$bouteille->prix_saq}} $</h3>
                            <div class="btn-carte">
                               
                            <a href="/details/{{$bouteille->id}}">Détails</a>
                                @if(isset($cellier->id))
                                <form method="post" id="form_cellier" action="{{route('bouteillecellier.store')}}">
                                    @csrf
                                        <input type="hidden" name="cellier_id" value="{{$cellier->id}}" />
                                        <input id="{{ $bouteille->id }}" type="hidden" name="bouteille_id" value="{{ $bouteille->id }}" />
                                        <input type="hidden" name="quantite" value="1">
                                        <button type="submit" class="btn-carte-btn" >Ajouter à mon cellier</button>                   
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach






            </section>
            <section class="pagination">
                <!-- Pagination -->
                @include('../pagination.pagination', ['paginator' => $bouteilles])
            </section>
        </main>
    @push('js')
<script>
    function formAjouter(){
        
        document.forms["form_cellier"].submit();

    }
</script>
    @endpush
@endsection
