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
            <h2 class="main_title">Réinitialiser le mot de passe</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

            @if (session('status'))
                <p class="data_message">{{ session('status') }}</p>
            @endif

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
                    <input type="submit" class="data_btn" value="Envoyer">
                </div>
            </form>
        </div>
    </div>
@endsection
