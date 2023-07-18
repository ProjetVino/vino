@extends('layouts.app')
@section('titre', 'Authentification')
@section('MasquerHeaderFooter', true)<!--  pour afficher ou masquer le header et le footer -->
@section('content')
<main class="auth-container">
    <form method="post" class="auth-form-container">
        @csrf
        <h1 class="auth-form-logo">
            The <br />
            Vine
        </h1>
        <label class="auth-form-label">
            <img src="{{asset('assets/user.png')}}" alt="user" class="auth-icon" />
            <input
            type="text"
            name="email"
            class="auth-form-input"
            class="auth-icon"
            placeholder="Courriel"
            value="{{ old('email') }}"
            />
        </label>        
        <label class="auth-form-label">
            <img src="{{asset('assets/lock.png')}}" alt="lock" class="auth-icon" />
            <input
            type="password"
            name="password"
            class="auth-form-input"
            placeholder="Mot de passe"
            required
            />
        </label>

        @if($errors->any())
            <div class="alert alert-danger fs-6" >
                {{$errors->first()}}
            </div>
        @endif        

        <div class="auth-form-options-container">
            <div>
           <!--  <input type="checkbox" name="check" /> -->
           <!--  <label for="check" class="auth-form-text">Se souvenir de moi</label> -->
            </div>
           <!--  <a href="/" class="auth-form-text">Mot de passe oublié?</a> -->
        </div>
        <input type="submit" class="auth-form-input-submit" value="Connexion" />
    </form>
    <a href="/create" class="auth-form-redirect"
    >Voulez-vous vous inscrire?</a>
</main>
@endsection