@extends('template')

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .title{padding:10px;text-align: center;font-size: 2.2em;font-weight: 800;border-bottom: 1px solid #aaa;}
        .main-section{display:flex;justify-content:space-around;align-items:flex-start;padding:20px;border-bottom: 1px solid #aaa;background-color: var(--back-color);}
        .main_title{margin:10px;font-size: 1.8em;font-weight: 600;}
        .collection_form{display: inline-block;}
        .data-line{display: inline-block;margin: 5px;}
    </style>
@endsection

@section('mast-header_class')
    {{ "mast-header__color" }}
@endSection



@section('content')
    <h1 class="title">Données personnelles</h1>
    <div class="main-section">
        <div>
            <h2 class="main_title">Profil</h2>
            <form method="POST" action="{{ route('profil.update') }}" accept-charset="UTF-8">
                <input name="_method" type="hidden" value="PUT">
                @csrf

                <div class="data">
                    <label for="pseudo" class="data_label">Pseudo:</label>
                    <input id="pseudo" type="text" name="pseudo" required autofocus
                        class="data_input" maxlength="80" size="20"
                        value="{{ $user->pseudo_utilisateur }}">
                    @error('pseudo')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <label for="email" class="data_label">Email:</label>
                    <input id="email" type="email" name="email" required
                        class="data_input" maxlength="190"
                        value="{{ $user->email_utilisateur }}">
                    @error('email')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <label for="dob" class="data_label">Date de naissance:</label>
                    <input id="dob" type="date" name="dob"
                        class="data_input"
                        value="{{ $user->dob_utilisateur }}">
                    @error('dob')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <input type="submit" class="data_btn" value="Enregistrer">
                </div>
            </form>
        </div>
        <div>
            <h2 class="main_title">Mot de passe</h2>
            <form method="POST" action="{{ route('password.update') }}" accept-charset="UTF-8">
                <input name="_method" type="hidden" value="PUT">
                @csrf

                <div class="data">
                    <label for="password" class="data_label">Mot de passe:</label>
                    <input id="password" type="password" name="password" required
                        class="data_input" minlength="8" maxlength="40" size="20">
                    @error('password')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <label for="password-confirm" class="data_label">Confirmation:</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required
                        class="data_input" minlength="8" maxlength="40" size="20">
                    @error('password-confirm')
                        <p class="data_message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="data">
                    <input type="submit" class="data_btn" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>
    <h1 class="title">Collections</h1>
    <div class="main-section">
        <div>
            <h2 class="main_title">Mes collections</h2>
            @foreach ($collections AS $collection)
            <div>
                <form class="collection_form" method="POST" action="{{ route('collection.update', $collection->id_collection) }}" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="PUT">
                    @csrf

                    <div class="data-line">
                        <input id="collection_name" type="text" name="collection_name" required
                            class="data_input" maxlength="50" size="20"
                            value="{{ $collection->nom_collection }}">
                        @error('collection_name')
                            <p class="data_message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="data-line">
                        <input type="submit" class="data_btn" value="Modifier">
                    </div>
                </form>
                <form class="collection_form" method="POST" action="{{ route('collection.delete', $collection->id_collection) }}" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="DELETE">
                    @csrf

                    <div class="data-line">
                        <input type="submit" class="data_btn" value="Supprimer">
                    </div>
                </form>
                @foreach ($collection->mediasCollections AS $mediaCollection)
                <form method="POST" action="{{ route('collection.media.delete', [$collection->id_collection, $mediaCollection->media->id_media]) }}" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="DELETE">
                    @csrf
                    <div class="data-line">
                        <p>{{ $mediaCollection->media->oeuvre->nom_oeuvre }}</p>
                    </div>
                    <div class="data-line">
                        <input type="submit" class="data_btn" value="Supprimer">
                    </div>
                </form>
                @endforeach
            </div>
            @endforeach
        </div>
        <div>
            <h2 class="main_title">Ajouter</h2>
            <div>
                <form method="POST" action="{{ route('collection.create') }}" accept-charset="UTF-8">
                    @csrf

                    <div class="data">
                        <input id="collection_name" type="text" name="collection_name" required
                            class="data_input" maxlength="50" size="20" placeholder="Nom">
                        @error('collection_name')
                            <p class="data_message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="data">
                        <input type="submit" class="data_btn" value="Ajouter">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
