@extends('layouts.app')
@section('titre', 'VINO')
@section('content')
        <main>
            <section class="container">
                <div class="titre">
                    <h1>Bonjour <span>{{ Auth::user()->nom }}</span></h1>
                </div>
                <div>
                    <a href="{{route('celliers.create')}}" class="text-container">
                        <img src="{{asset('assets/add.png')}}" alt="add">
                        Ajouter un cellier
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
                                <a href="/details/{{$bouteille->id}}">Détails</a>
                                <form id="form_cellier" action="{{route('bouteille-cellier.store')}}" method="POST">
                                    @csrf
                                    @if(isset($cellier->id))
                                    <input type="hidden" name="cellier_id" value="{{$cellier->id}}">
                                    @endif
                                    <input type="hidden" name="bouteille_id" value="{{ $bouteille->id }}">
                                    <input type="hidden" name="quantite" value="1">
                                </form>
                                <a href="javascript:void(0)" @if(isset($cellier->id)) onclick="$('#form_cellier').submit()" @else onclick="alert('Veuillez dabord ajouter un cellier')" @endif   >Ajouter à mon cellier</a>

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
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @endpush
@endsection
