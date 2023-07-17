@extends('layouts.app')
@section('titre', 'MES CELLIERS')
@section('content')
        <main>  
            <section class="container">
                <div class="titre-section">
                    <h1>Cellier Maison</h1>
                </div>
                <div>
                    <a href="index.html" class="text-container">
                        <img src="{{asset('assets/add.png')}}" alt="add">
                        Ajouter une bouteille
                    </a>
                </div>
                <!-- <div class="recherche">
                    <img src="assets/lupe.png" alt="lupe">
                    <input type="text" placeholder="Rechercher un vin">
                </div> -->
            </section>

            <section class="catalogue">
                <h2>Stock actuel</h2>
                <div class="recherche">
                    <img src="{{asset('assets/lupe.png')}}" alt="lupe">
                    <input type="text" placeholder="Rechercher un vin">
                </div>
                <div class="carte">
                    <div>
                        <img src="{{asset('assets/vin-rouge.png')}}" alt="bouteille">
                    </div>
                    <div class="text-carte">
                        <h2>EA Cartuxa Reserva</h2>
                        <p>Vin rouge | 750 ml | Portugal</p>
                        <div>
                            <h3>Quantité :</h3>
                            <input type="number" min="0">
                        </div>
                        <div class="btn-carte">
                            <a href="#">Modifier</a>
                            <a href="#">Supprimer</a>
                        </div>
                    </div>
                </div>
                <div class="carte">
                    <div>
                        <img src="{{asset('assets/vin-rouge.png')}}" alt="bouteille">
                    </div>
                    <div class="text-carte">
                        <h2>Aveleda</h2>
                        <p>Vin blanc | 750 ml | Portugal</p>
                        <div>
                            <h3>Quantité :</h3>
                            <input type="number" min="0">
                        </div>
                        <div class="btn-carte">
                            <a href="#">Modifier</a>
                            <a href="#">Supprimer</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pagination">
                <p>1 | 2 | 3</p>
            </section>
        </main>
@endsection
