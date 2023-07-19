@extends('layouts.app')
@section('titre', 'Création de compte')
@section('MasquerHeaderFooter', true) <!--  pour afficher ou masquer le header et le footer -->
@section('content')
<main class="auth-container">
      <form method="post" class="auth-form-container">
        @csrf
        <h1 class="auth-form-logo">
          The
          <br />
          Vine
        </h1>
        <label class="auth-form-label">
          <img src="{{asset('assets/user.png')}}" alt="user" class="auth-icon" />
          <input
            type="text"
            name="nom"
            class="auth-form-input"
            class="auth-icon"
            placeholder="Nom"
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
          <img src="{{asset('assets/mail.png')}}" alt="mail" class="auth-icon" />
          <input type="email" name="email" class="auth-form-input" placeholder="Courriel" required   value="{{ old('email') }}"/>
        </label>
        @if($errors->has('email'))
            <div class="message-error" >
            * {{ __('validation.email.unique') }}
            </div>
        @endif         
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
        @if($errors->has('password'))
            <div class="message-error" >
              * {{ __('validation.password.regex') }}
            </div>
        @endif        
              
        <label class="auth-form-label">
          <img src="{{asset('assets/lock.png')}}" alt="lock" class="auth-icon" />
          <input
            type="password"
            name="password_confirmation"
            class="auth-form-input"
            placeholder="Confirmation mot de passe"
            required
          />
        </label>
        @if($errors->has('password_confirmation'))
            <div class="message-error" >
              * {{ __('validation.password_confirmation.same') }}
            </div>
        @endif          
        <input
          type="submit"
          class="auth-form-input-submit"
          value="Enregistrer"
        />
        
        <div class="auth-form-text">* le Mot de passe doit avoir au moins 6 caractèrs, une majiscule, un caractère spéciale </div> 
      </form>
      <a href="/login" class="auth-form-text">Connexion</a>
      <a href="{{route('login')}}" class="create-form-redirect">Se connecter</a>
       
    </main>

@endsection