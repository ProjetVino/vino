@extends('layouts.app')
@section('titre', 'MES CELLIERS')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Style for positioning toast */
        .toast{
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
@endpush
@section('content')
        <main class="main-content">
            <section class="container">
                <div class="titre-section">
                    <h1 class="product-name">{{$cellier->nom}}</h1>
                    <!-- <h5><i class="font-weight-bold">{{$cellier->bouteilles->count()}}</i> Bouteilles dans votre cellier</h5> -->

                </div>
                <div class="text-container">
                    <a href="{{route('bouteilles.indexCellier',$cellier->id)}}" class="text-container">
                        <img src="{{asset('assets/add.png')}}" alt="add">
                        Ajouter une bouteille
                    </a>
                </div>
            </section>



            <section class="catalogue">
   <!--              <div class="recherche">
                    <img src="{{asset('assets/lupe.png')}}" alt="lupe">
                    <input id="search" type="text" placeholder="Rechercher un vin">

                </div> -->
                <div class="row text-center carte">
                    @forelse($bouteilles as $bouteille)

                        <div class="col-md-3 card mb-1 mr-1">
                        
                            <div class="card-body text-carte">

                                <h2 class="card-title-detail-cellier">{{ $bouteille->nom }}

                        
                                </h2>
                                <p class="card-subtitle mb-2 text-muted"> <img src="{{ $bouteille->image }}" alt="{{ $bouteille->image }}"></p>

                                <p>{{ $bouteille->description }}</p>
                                <h3>Prix :  {{ number_format($bouteille->prix_saq, 2, '.', ' ')}} $   </h3>
                                <p>
                                    Quantité : <input id="quantite" name="quantite" type="number" min="1" value="{{ $bouteille->pivot->quantite }}" width="auto">

                                </p>

                                <!-- debut -->

                          <input id="idcb" type="hidden" value="{{$bouteille->pivot->id}}">
                               
                               <div class="btn-carte-trash">
                                   <form   action="{{ route('bouteillecellier.destroy', $bouteille->pivot->id )}}" method="POST">
                                       <button type="submit" class="btn btn-link card-link" value="">  <i class="bi bi-trash"></i></button>
                                       @csrf
                                       @method('DELETE')
                                   </form>
                               </div>
                           
                       <!-- fin -->
                            </div>
                        </div>

                    @empty

                        <label class="vide">Pas de Celliers</label>

                    @endforelse
                      
                </div>


            </section>
            <section class="pagination">
                <!-- Pagination -->
                @include('../pagination.pagination', ['paginator' => $bouteilles])
            </section>


            <!---- Message -->
            <div id="myToast1" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Bouteille à été ajouté avec succès...!!!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div id="myToast2" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Bouteille supprimé avec succès...!!!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div id="myToast3" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">

                    <div class="toast-body">
                        Quantité mise a jour avec succés...
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <!---- Fin Message -->


        </main>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            var element1 = document.getElementById("myToast1");
            var myToast1 = new bootstrap.Toast(element1);
            var element2 = document.getElementById("myToast2");
            var myToast2 = new bootstrap.Toast(element2);


            { @if (Session::get('success')=="success") }
                myToast1.show();
            setTimeout(() => {
                myToast1.hide();
            }, 2000);
            {@elseif (Session::get('success')=="delete") }
            myToast2.show();
            setTimeout(() => {
                myToast2.hide();
            }, 3000);
            { @endif }


            let search = document.querySelector('#search');
            //let result = document.querySelector('#result');
            search.addEventListener('keydown', function () {
                alert('ok')
            });


            let quantite = document.querySelector('#quantite');
            //let result = document.querySelector('#result');

            document.querySelectorAll("#quantite").forEach(el => el.addEventListener('click',function (e) {

                updateQuantite(el.value);
            }));




        });

        function updateQuantite(qte) {
            let url = '{{URL::current().'/updateQuantite'}}';
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    idcb: document.getElementById("idcb"),
                    quantite: qte
                })
            })
                .then((data) => {


                    var element3 = document.getElementById("myToast3");
                    var myToast3 = new bootstrap.Toast(element3);
                    myToast3.show();
                    setTimeout(() => {
                        myToast3.hide();
                    }, 2000);
                })
                .catch(function(error) {
                    console.log(error);
                });

        }


    </script>
@endpush
@endsection


