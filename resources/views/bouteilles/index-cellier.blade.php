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
                      
                       Cellier en cours :  {{ $cellier->nom }}
                    </a>
                </div>
                <div class="recherche">
                    <img src="{{asset('assets/lupe.png')}}" alt="lupe">
                    <input type="text" placeholder="Rechercher un vin">
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
                               
                                <button type="button" class="btn btn-link"  style="font-size: 16px; color: #690102;background-color: rgb(216, 214, 212);padding: 4px 10px;">Détails</button> 
                                @if(isset($cellier->id))
                                <form method="post" id="form_cellier" action="{{route('bouteillecellier.store')}}">
                                    @csrf
                                        <input type="hidden" name="cellier_id" value="{{$cellier->id}}" />
                                        <input id="{{ $bouteille->id }}" type="hidden" name="bouteille_id" value="{{ $bouteille->id }}" />
                                        <input type="hidden" name="quantite" value="1">
                                        <button type="submit" class="btn btn-link" style="font-size: 16px; color: #690102;background-color: rgb(216, 214, 212);padding: 4px 10px;">Ajouter</button>                   
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
