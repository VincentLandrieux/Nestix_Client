@extends('template')

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .main-section{display:flex;justify-content:space-around;align-items:flex-start;}
        form{margin:10px;}
        .main_title{margin:20px;font-size: 2.5em;font-weight: 600;}
        .data_input{width: 300px;}
    </style>
@endsection

@section('mast-header_class')
    {{ "mast-header__color" }}
@endSection



@section('content')
    <div class="main-section">
        <div>
            <h2 class="main_title">Proposition</h2>
            <form method="POST" action="{{ route('proposition') }}" accept-charset="UTF-8">
                @csrf

                <div class="data">
                    @error('save')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                    <label for="title" class="data_label">Titre:</label>
                    <input id="title" type="text" name="title" required autofocus
                        class="data_input" maxlength="60" size="20"
                        value="">
                    @error('title')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <label for="type" class="data_label">Type:</label>
                    <select id="type" name="type"
                        class="data_input">
                        <option value=""></option>
                        <option value="livre">livre</option>
                        <option value="film">film</option>
                        <option value="musique">musique</option>
                    </select>
                    @error('type')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <label for="resume" class="data_label">Résumé:</label>
                    <textarea id="resume" name="resume" placeholder="Optionnel"
                        class="data_input" rows="5" cols="20" maxlength="3000"></textarea>
                    @error('resume')
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
