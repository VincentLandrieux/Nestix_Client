@extends('template')

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .main-section{display:flex;justify-content:space-around;align-items:flex-start;}
        form{margin:10px;}
        .main_title{margin:20px;font-size: 2.5em;font-weight: 600;}
        .data-line{display: block;margin: 10px;}
        .data-line > *{display: inline-block;}
        .data_input{width: 300px;}
    </style>
@endsection

@section('mast-header_class')
    {{ "mast-header__color" }}
@endSection



@section('content')
    <div class="main-section">
        <div>
            <h2 class="main_title">Connexion</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="data">
                    <label for="email_utilisateur" class="data_label">Email:</label>
                    <input id="email_utilisateur" type="email" name="email_utilisateur" required autocomplete="email" autofocus
                        class="data_input" maxlength="190" size="20"
                        value="">
                    @error('email_utilisateur')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <label for="password" class="data_label">Mot de passe:</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="data_input" maxlength="60" size="20"
                        value="">
                    @error('password')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="data">
                    <input type="submit" class="data_btn" value="Se connecter">
                </div>
                @if (Route::has('password.request'))
                <div class="data">
                    <a href="{{ route('password.request') }}">
                        mot de passe oublié ?
                    </a>
                </div>
                @endif
            </form>
        </div>
    </div>
@endsection
