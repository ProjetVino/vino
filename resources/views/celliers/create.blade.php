@extends('layouts.app')
@section('titre', 'MES CELLIERS')

@section('content')
    <main class="cellier-container">
            <div class="titre-section">
                <h2>Ajouter Cellier</h2>
            </div>
            <form method="post" class="cellier-form-container edit-profile" action="{{route('celliers.store')}}">
                @csrf
                <label class="auth-form-label">
               Nom du cellier
                    <input
                        type="text"
                        name="nom"
                        class="auth-form-input"
                        class="auth-icon"
                        required
                        value="{{ old('nom') }}"
                    />
                </label>
                @if($errors->has('nom'))
                    <div class="message-error" >
                        * {{ __('validation.nom.min') }}
                    </div>
                @endif
                <label class="auth-form-label">
                    Commentaire
                    <textarea name="note" class="auth-form-input"></textarea>
                </label>

                <div class="align-center">
                    <button type="submit" class="product-add-cart-btn"value="Enregistrer">Enregistrer</button>
                   
                </div>

            </form>


        </main>

        @endsection

