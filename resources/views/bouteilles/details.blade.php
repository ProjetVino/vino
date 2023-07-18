@extends('layouts.app')
@section('titre', 'DETAILS')
@section('content')
<main>
    <div class="details-container">
        <span class="details-category">
                <p>
                    @if ($bouteille->type_id === 1)
                        Vin Blanc
                    @elseif ($bouteille->type_id === 2)
                        Vin Rouge
                    @elseif ($bouteille->type_id === 3)
                        Vin Rosé
                    @endif
                </p>
        </span>
            <section class="detail">
                <div class="detail-text">
    
                    <h2>{{$bouteille->nom}}</h2>
                    <p>{{$bouteille->description}}</p>
                    <p>Code SAQ : {{$bouteille->code_saq}}</p>
                </div>
                <div class="detail-img">
                    <img src="{{$bouteille->url_img}}" alt="bouteille">
                </div>
                <div class="btn-carte">
                    <a href="#">{{ number_format($bouteille->prix_saq, 2, '.', ' ')}} $</a>
                    <input type="button" class="btn-carte-btn" onclick="ajouterAuCellier(event)" data-id="{{$bouteille->id}}" value="Ajouter à mon cellier">
                </div>
            </section>
            </div>
        </div>
    </div>
</main>
        <!-- Popup ajouter au cellier -->
        @include('bouteilles.popup')
@endsection
