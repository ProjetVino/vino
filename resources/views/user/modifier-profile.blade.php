@extends('layouts.app')
@section('titre', 'MON COMPTE')
@section('content')
    <main class="cellier-container">
        <div class="titre-section">
            <h2>Modifier Profile</h2>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="edit-profile">
            @csrf
            @method('PUT')
            <div>
                <label for="nom">Nom:</label>
                <input type="text" name="nom" value="{{ $user->nom }}" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="text" name="email" value="{{ $user->email }}" required>
            </div>

            <div>
                <label for="adresse">Adresse:</label>
                <input type="text" name="adresse" value="{{ $user->adresse }}">
            </div>

            <div>
                <label for="ville">Ville:</label>
                <input type="text" name="ville" value="{{ $user->ville }}">
            </div>

            <div>
                <label for="code-postal">Code Postal:</label>
                <input type="text" name="code-postal" value="{{ $user->cp }}" pattern="[A-Za-z0-9]{6}">
            </div>

            <div>
                <label for="phone">Téléphone:</label>
                <input type="text" name="phone" value="{{ $user->tel }}" pattern="[0-9]{10}">
            </div>

            <div class="align-center">
                <button type="submit" class="product-add-cart-btn">Modifier</button>
            </div>
        </form>
       
    </main>

@endsection

