@extends('layouts.app')
@section('titre', 'DETAILS')
@section('content')
<main>
            <section class="container">
            </section>

            <section class="detail">
                <div class="detail-text">
                    <p>{{$bouteille->type_id}}</p>
                    <h2>{{$bouteille->nom}}</h2>
                    <p>{{$bouteille->description}}</p>
                    <p>Code SAQ : {{$bouteille->code_saq}}</p>
                </div>
                <div class="detail-img">
                    <img src="{{$bouteille->url_img}}" alt="bouteille">
                </div>
                <div class="btn-carte">
                    <a href="#">{{ number_format($bouteille->prix_saq, 2, '.', ' ')}} $</a>
                    <a href="#">Ajouter à mon celier</a>
                </div>
            </section>
        </main>
@endsection
