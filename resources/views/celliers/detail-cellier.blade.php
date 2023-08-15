@extends('layouts.app')
@section('titre', 'MES CELLIERS')
@push('css')    


<link href="{{ asset('css/icons/fontawesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   
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
                                <h3>Prix : {{ number_format($bouteille->prix_saq, 2, '.', ' ')}} $  </h3>
                                    Quantité : <input  @if(isset($searchQuery)) id="{{ $bouteille->id }}" @else id="{{ $bouteille->pivot->id }}" @endif  @if(isset($searchQuery)) name="{{ $bouteille->id }}" @else name="{{ $bouteille->pivot->id }}" @endif  type="number" min="1" @if(isset($searchQuery)) value="{{ $bouteille->quantite }}" @else   value="{{ $bouteille->pivot->quantite }}" @endif />
                                    <input name="idcb" type="hidden"  @if(isset($searchQuery)) value="{{ $bouteille->id }}" @else value="{{ $bouteille->pivot->id }}" @endif >


                                <!-- debut -->
                               
                          
                               <div class="btn-carte-trash">
                              
                                       
                            
            <button id="btUpdateQte" type="button"  class="btn btn-link card-link" onclick="updateQuantite(' {{ isset($searchQuery) ? $bouteille->id : $bouteille->pivot->id }}','{{ isset($searchQuery) ? $bouteille->quantite : $bouteille->pivot->quantite }} ')" >
                                   
            <i class="fa-solid fa-floppy-disk"></i>

                                
                                </button> 



                                       <button type="button" data-id="{{ isset($searchQuery) ? $bouteille->id : $bouteille->pivot->id }}" class="btn btn-link card-link" onclick="afficherPopupCellier(event)" >  <i class="bi bi-trash" ></i></button>
                                   
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
        });
    </script>
    <script src="{{asset('js/bouteille-cellier.js')}}"></script>

    @endpush
@endsection


