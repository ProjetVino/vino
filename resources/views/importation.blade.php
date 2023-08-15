@extends('layouts.app')
@section('titre', 'Importation')
@section('content')
<main class="main-content admin">
<div class="details-container">
    @if(session()->has('nbbouteilles'))
    <div class="alert alert-success">{{session('nbbouteilles')}} </div>
    @endif    
    <h1>Importer bouteilles</h1>
    <form method="POST" action="{{ route('importer-bouteilles') }}">
        @csrf
        <label for="nombre">Nombre de bouteilles par page :</label>
        <select name="nombre" id="nombre">
            <option value="24">24</option>
            <option value="48">48</option>
            <option value="96">96</option>
        </select>
        <label for="pages">Nombre de pages à parcourir :</label>
        <select name="pages" id="pages">
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        <div class="boutons">
            <input type="submit" value="Importer les bouteilles" name="submit">
            <a href="/logout">Déconnexion</a>
        </div>
    </form>
</div>
</main>
@endsection
