@extends('layouts.app')
@section('titre', 'MES CELLIERS')

@section('content')
    <main class="cellier-container">
            <form method="POST" class="cellier-form-container p-2" action="{{route('celliers.update', ["cellier"=>$cellier->id])}}">
                @method('PUT')
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
                        value="{{ $cellier -> nom }}"
                    />
                </label>
                @if($errors->has('nom'))
                    <div class="message-error" >
                        * {{ __('validation.nom.min') }}
                    </div>
                @endif
                <label class="auth-form-label">
                    Commentaire
                    <textarea name="note" class="auth-form-input">{{ $cellier -> nom }}</textarea>
                </label>

                <input
                    type="submit"
                    class="btn"
                    value="Enregistrer"
                />

            </form>
        </main>

        @endsection

