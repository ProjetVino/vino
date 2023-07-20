@extends('layouts.app')
@section('titre', 'MES CELLIERS')
@push('css')    

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Style for positioning toast */
        .toast{
            position: absolute;
            bottom: 100px;
            right: 10px;
        }
    </style>
@endpush
@section('content')
        <main>
            <section class="container">
                <div class="titre-section">
                    
                    <h1 data-toggle="tooltip" data-placement="top" title="{{ $cellier->note }}">
                    {{ $cellier->nom }}
                    </h1>
                   
                    <h5><i class="font-weight-bold">{{$cellier->bouteilles->count()}}</i> Bouteilles dans votre cellier</h5>

                </div>
                <div class="text-container">
                    <a href="{{route('bouteilles.indexCellier',$cellier->id)}}" class="text-container">
                        <img src="{{asset('assets/add.png')}}" alt="add">
                        Ajouter une bouteille
                    </a>
                </div>
            </section>



            <section class="catalogue">

                    <form method="post" action="{{ route('rechercherCellier') }}">
                        @csrf
                        <div class="recherche">
                            <img src="{{asset('assets/lupe.png')}}" alt="lupe">
                            <input id="rechercheInput" name="searchQuery" type="text" placeholder="Rechercher un vin" value="{{   $searchQuery ?? '' }}" >
                            <input name="cellierid" type="hidden" value="{{$cellier->id}}">
                        </div>
                    </form>


                <div class="row text-center carte">
                    @forelse($bouteilles as $bouteille)

                        <div class="col-md-3 card mb-1 mr-1" style="width: 18rem;">

                            <div class="card-body text-carte">

                                <h2 class="card-title">{{ $bouteille->nom }}


                                </h2>
                                <p class="card-subtitle mb-2 text-muted"> <img src="{{ $bouteille->image }}" alt="{{ $bouteille->image }}"></p>

                                <p>{{ $bouteille->description }}</p>
                                <h3>Prix :  {{ $bouteille->prix_saq }}   </h3>
                                <p>
                                    Quantité : <input  id="quantite"  @if(isset($searchQuery)) name="{{ $bouteille->id }}" @else name="{{ $bouteille->pivot->id }}" @endif  type="number" min="1" @if(isset($searchQuery)) value="{{ $bouteille->quantite }}" @else   value="{{ $bouteille->pivot->quantite }}" @endif width="auto">
                                    <input name="idcb" type="hidden"  @if(isset($searchQuery)) value="{{ $bouteille->id }}" @else value="{{ $bouteille->pivot->id }}" @endif >

                                </p>

                                <!-- debut -->
                               
                          
                               <div class="btn-carte-trash">
                              
                                       
                                   <form method="POST">
                                   <button type="button"  class="btn btn-link card-link" >  <i class="bi bi-arrow-clockwise" ></i></button>
                                       <button type="button" data-id="{{ isset($searchQuery) ? $bouteille->id : $bouteille->pivot->id }}" class="btn btn-link card-link" onclick="afficherPopupCellier(event)" >  <i class="bi bi-trash" ></i></button>
                                       @csrf
                                       @method('DELETE')
                                   </form>
                               </div>

                       <!-- fin -->
                            </div>
                        </div>

                    @empty

                        <label>Pas de bouteilles</label>

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

            <!--- Model suppression -->
            @include('celliers.popup')
            <!--- Fin Model suppression -->


        </main>
@push('js')

    <script>
        document.addEventListener("DOMContentLoaded", function(){
            var element1 = document.getElementById("myToast1");
            var myToast1 = new bootstrap.Toast(element1);
            
            { @if (Session::get('success')=="success") }
                myToast1.show();
            setTimeout(() => {
                myToast1.hide();
            }, 2000);
          
            { @endif }


        
            let quantite = document.querySelector('#quantite');
            document.querySelectorAll("#quantite").forEach(el => el.addEventListener('click',function (e) {
                updateQuantite(el.name,el.value);
            }));


        });

// Fonction mise a jour quantitée bouteilles Js

        function updateQuantite(id,qte) {
            let url = "{{ URL::current().'/updateQuantite'}}";
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
                    idcb: id,
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


        


function afficherPopupCellier(event) {

const popup = document.getElementById("popup");
popup.style.display = "block";


let idBouteilleC = event.currentTarget.getAttribute("data-id");
let idsuppbc = document.getElementById("idsuppbc");

idsuppbc.onclick = function () {
    SupprimerBouteilleCellier(idBouteilleC);
};

}
function cacherPopupCellier() {
    
    const popup = document.getElementById("popup");
    popup.style.display = "none";



}

       
   
// Fonction supp bouteilles JS :
function SupprimerBouteilleCellier(idbc) {
  
    console.log(idbc)
           
            let url = "{{ URL::current().'/bouteillecellier-destroy'}}";
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          
            fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'POST',
                credentials: "same-origin",
                body: JSON.stringify({
                    idbc: idbc,               
                })
            })
                .then((data) => {
                    cacherPopupCellier();
                    var element2 = document.getElementById("myToast2");
                    var myToast2 = new bootstrap.Toast(element2);
                    myToast2.show();
                    setTimeout(() => {
                        myToast2.hide();
                    }, 2000);
                    setTimeout(() => {
                        location.href =  "{{ URL::current() }}";
                    }, 1000);

                   
                })
                .catch(function(error) {
                    console.log(error);
                });




        }
        //ajouter 
        function AjouterBouteilleCellier(id,qte) {
            let url = "{{ URL::current().'/updateQuantite'}}";
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
                    idcb: id,
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


