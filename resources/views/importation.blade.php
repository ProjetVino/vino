@extends('layouts.app')
@section('content')
<div>
    <h1>Importer les bouteilles</h1>

    <form method="POST" action="{{ route('importer-bouteilles') }}">
        @csrf
        <label for="nombre">Nombre de bouteilles par page :</label>
        <select name="nombre" id="nombre">
            <option value="24">24</option>
            <option value="48">48</option>
            <option value="96">96</option>
        </select>
        <br><br>
        <label for="pages">Nombre de pages à parcourir :</label>
        <select name="pages" id="pages">
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        <br><br>
        <input type="submit" value="Importer les bouteilles" name="submit">
        <a href="/logout">Déconnexion</a>
    </form>

</div>

@endsection
