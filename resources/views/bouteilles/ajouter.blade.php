@extends('layouts.app')
@section('titre', 'Bouteilles personalisée')
@section('content')
<main class="main-content">
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
    
                    <h2 class="product-name">{{$bouteille->nom}}</h2>
                    <p class="product-description">{{$bouteille->description}}</p>
                    <p class="product-code">Code SAQ : {{$bouteille->code_saq}}</p>
                </div>
                <div class="product-image-container">
                    <img src="{{$bouteille->url_img}}" alt="bouteille">
                </div>
                <div class="product-cart">
                    <a class="product-price" href="#">{{ number_format($bouteille->prix_saq, 2, '.', ' ')}} $</a>
                    <input type="button" class="product-add-cart-btn" onclick="ajouterAuCellier(event)" data-id="{{$bouteille->id}}" value="Ajouter à mon cellier">
                </div>
            </section>
            </div>
        </div>
    </div>
</main>
@endsection
