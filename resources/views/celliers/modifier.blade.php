@extends('layouts.app')
@section('titre', 'MES CELLIERS')
@section('content')
    <main class="cellier-container">
            <div class="titre-section">
                <h2>Modifier Cellier</h2>
            </div>

            <form method="post" class="edit-profile" >
                @csrf
                <div>
                    <input type="hidden" name="cellier_id" value="{{ old('cellier_id', $cellier->id) }}">

                    <label>Nom du cellier: </label>
                    <input
                        type="text"
                        name="nom"
                        placeholder="Nom du cellier"
                        required
                        value="{{ old('nom', $cellier->nom) }}"
                    />
                </div>

                @if($errors->has('nom'))
                    <div class="message-error" >
                        * {{ __('validation.nom.min') }}
                    </div>
                @endif

                <div>
                    <label class="auth-form-label">Commentaire:
                        <textarea name="note" class="auth-form-input" >{{ old('note',$cellier->note) }}</textarea>
                    </label>
                </div>
                    
                <div class="align-center">
                    <button type="submit" class="product-add-cart-btn"value="Modifier">Modifier</button>
                   
                </div>


        

            <!-- <form method="post" class="cellier-form-container" >
                @csrf
                <input type="hidden" name="cellier_id" value="{{ old('cellier_id', $cellier->id) }}">
                <label class="auth-form-label">
               Nom du cellier
                    <input
                        type="text"
                        name="nom"
                        class="auth-form-input"
                        class="auth-icon"
                        placeholder="Nom du cellier"
                        required
                        value="{{ old('nom', $cellier->nom) }}"
                    />
                </label>
                @if($errors->has('nom'))
                    <div class="message-error" >
                        * {{ __('validation.nom.min') }}
                    </div>
                @endif
                <label class="auth-form-label">
                    Commentaire
                    <textarea name="note" class="auth-form-input" >{{ old('note',$cellier->note) }}</textarea>
                </label>

                <input
                    type="submit"
                    class="auth-form-input-submit"
                    value="Modifier"
                />

            </form> -->


        </main>

        @endsection

