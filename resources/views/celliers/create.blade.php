@extends('layouts.app')
@section('titre', 'MES CELLIERS')

@section('content')
    <main class="cellier-container">
            <form method="post" class="cellier-form-container" action="{{route('celliers.store')}}">
                @csrf
                <label class="auth-form-label">
               Nom du cellier
                    <input
                        type="text"
                        name="nom"
                        class="auth-form-input"
                        class="auth-icon"
                        placeholder="Nom du cellier"
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

                <input
                    type="submit"
                    class="auth-form-input-submit"
                    value="Enregistrer"
                />

            </form>


        </main>

        @endsection

