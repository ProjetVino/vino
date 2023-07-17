@extends('layouts.app')
@section('titre', 'DETAILS')
@section('content')
<main>
    <div class="details-container">
        <span class="details-category">
            <a heref="/">Vins</a>
            &#62;
            <a heref="/">Rouge</a>
        </span>

        <div class="product-card">
            <div class="product-details">
                <h2 class="product-name">EA Cartuxa Reserva</h2>
                <p class="product-description">
                    Vin rouge | 750 ml | Portugal
                </p>
                <p class="product-code">Code produit : 12345678</p>
            </div>

            <div class="product-image-container">
                <img
                    src="./vin-rouge.png"
                    alt="bouteille"
                    class="product-image"
                />
            </div>

            <div class="product-cart">
                <p class="product-price">29.95 $</p>
                <button class="product-add-cart-btn">
                    Ajouter à mon celier
                </button>
            </div>
        </div>
    </div>
</main>
@endsection
