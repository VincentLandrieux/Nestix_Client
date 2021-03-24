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
            <h2 class="main_title">Inscription</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="data">
                    <label for="pseudo_utilisateur" class="data_label">Pseudo:</label>
                    <input id="pseudo_utilisateur" type="text" name="pseudo_utilisateur"
                        value="{{ old('pseudo_utilisateur') }}" required autocomplete="pseudo_utilisateur" autofocus
                        class="data_input" maxlength="80" size="20">
                    @error('pseudo_utilisateur')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <label for="email_utilisateur" class="data_label">Email:</label>
                    <input id="email_utilisateur" type="email" name="email_utilisateur" required autocomplete="email"
                        class="data_input" maxlength="190" size="20"
                        value="{{ old('email_utilisateur') }}">
                    @error('email_utilisateur')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <label for="password" class="data_label">Mot de passe:</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="data_input" minlength="8" maxlength="60" size="20">
                    @error('password')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="data">
                    <label for="password-confirm" class="data_label">Confirmation:</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="data_input" minlength="8" maxlength="60" size="20">
                </div>

                <div class="data">
                    <input type="submit" class="data_btn" value="S'inscrire">
                </div>
            </form>
        </div>
    </div>
@endsection
