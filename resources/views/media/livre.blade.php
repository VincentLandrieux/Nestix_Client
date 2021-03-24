@extends('media/media')

@section('main-section')
    <div class="main-section_left">
        <div class="main-section_resume">
            @if (isset($media->livre->resume_livre))
            <p class="main-section_title">Résumé:</p>
            <p>{{ $media->livre->resume_livre }}</p>
            @endif
        </div>
        <div class="main-section_metier">
            @foreach ($media->artistesMetiersMedias as $artisteMetierMedia)
                <p class="main-section_title">{{ ucfirst($artisteMetierMedia->metier->nom_metier).':' }}</p>
                <a href="{{ route('artiste', $artisteMetierMedia->artiste->id_artiste) }}">{{ $artisteMetierMedia->artiste->surnom_artiste }}</a>
            @endforeach
        </div>
    </div>
    <div>
        <div class="main-section_editeur">
            <p class="main-section_title">Editeur:</p>
            <p>{{ $media->livre->editeur->nom_editeur }}</p>
        </div>
    @if ($media->livre->tome_livre != null)
        <div class="main-section_tome">
            <p class="main-section_title">Tome:</p>
            <p>{{ $media->livre->tome_livre }}</p>
        </div>
    @endif
    @if (count($media->mediasGenres) > 0)
        <div class="main-section_genre">
            <p class="main-section_title">Genre:</p>
            @foreach ($media->mediasGenres as $mediaGenre)
            <a href="{{ route('medias.genre', $mediaGenre->genre->id_genre) }}">{{ $mediaGenre->genre->nom_genre }}</a>
            @endforeach
        </div>
    @endif
        <div class="main-section_collection">
    @auth
        @if (count($collections) > 0)
            <p class="main-section_title">Collection:</p>
            @foreach ($collections AS $collection)
            <p>{{ $collection->nom_collection }}</p>
            @if (count($collection->mediasCollections->where('media_id', '=', $media->id_media)) > 0)
            <form method="POST" action="{{ route('collection.media.delete', [$collection->id_collection, $media->id_media]) }}" accept-charset="UTF-8">
                <input name="_method" type="hidden" value="DELETE">
                @csrf

                <div class="data-line">
                    <input type="submit" class="data_btn" value="Supprimer">
                </div>
            </form>
            @else
            <form method="POST" action="{{ route('collection.media.create', [$collection->id_collection, $media->id_media]) }}" accept-charset="UTF-8">
                @csrf

                <div class="data-line">
                    <input type="submit" class="data_btn" value="Ajouter">
                </div>
            </form>
            @endif

            @endforeach
        @endif
    @endauth
        </div>
        <div class="main-section_isbn">
            <p class="main-section_title">ISBN:</p>
            <p>{{ $media->livre->isbn }}</p>
        </div>
    </div>
@endsection
