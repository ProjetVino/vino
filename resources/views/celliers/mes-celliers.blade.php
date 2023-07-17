@extends('layouts.app')
@section('titre', 'MES CELLIERS')
@section('content')
        <main>
            <section class="container">
                <div class="titre-section">
                    <h1>Mes Celliers  <span> > </span></h1>
                </div>
                <!-- <div class="recherche">
                    <img src="assets/lupe.png" alt="lupe">
                    <input type="text" placeholder="Rechercher un vin">
                </div> -->
            </section>

            <section>
                <a href="#" class="align-right">
                    <img src="assets/add.png" alt="add">
                    Ajouter un cellier
                </a>
            </section>

            <!-- <section>
                <div>
                    <div>
                        <a href="mon-cellier.html">Chalet</a>
                        <a href="#">Modifier</a> 
                        <a href="#">
                            <img src="assets/add.png" alt="add">
                        </a>
                    </div>
                    <div>
                        <a href="mon-cellier.html">Maison</a>
                        <a href="#">Modifier</a> 
                        <a href="#">
                            <img src="assets/add.png" alt="add">
                        </a>
                    </div>
                    <div>
                        <a href="mon-cellier.html">Voyage</a>
                        <a href="#">Modifier</a> 
                        <a href="#">
                            <img src="assets/add.png" alt="add">
                        </a>
                    </div>
                </div>
            </section> -->

            <section class="catalogue">
                <div class="carte">
                    <div class="text-carte">
                        <h2>Cellier Maison</h2>
                        <p>Mon commentaire</p>
                        <h3>Stock</h3>
                        <p>Vin rouge : 3 | Vin blanc : 4 | Vin rosé : 12</p>
                        <div class="btn-carte">
                            <a href="/detail-cellier/1">Détails</a>
                            <a href="#">Modifier</a>
                            <a href="#">Supprimer</a>
                        </div>
                    </div>
                </div>
                <div class="carte">
                    <div class="text-carte">
                        <h2>Cellier Chalet</h2>
                        <h3>Stock</h3>
                        <p>Vin rouge : 3 | Vin blanc : 4 | Vin rosé : 12</p>
                        <div class="btn-carte">
                            <a href="/detail-cellier/2">Détails</a>
                            <a href="#">Modifier</a>
                            <a href="#">Supprimer</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
@endsection
