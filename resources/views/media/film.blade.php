@extends('media/media')

@section('main-section')
    <div class="main-section_left">
        <div class="main-section_resume">
            @if (isset($media->film->resume_film))
            <p class="main-section_title">Résumé:</p>
            <p>{{ $media->film->resume_film }}</p>
            @endif
        </div>
        <div class="main-section_metier">
            @foreach ($media->artistesMetiersMedias as $artisteMetierMedia)
                @if($artisteMetierMedia->artiste->etat_id == 1)
                <p class="main-section_title">{{ ucfirst($artisteMetierMedia->metier->nom_metier).':' }}</p>
                <a href="{{ route('artiste', $artisteMetierMedia->artiste->id_artiste) }}">{{ $artisteMetierMedia->artiste->surnom_artiste }}</a>
                @endif
            @endforeach
        </div>
    </div>
    <div>
    @if ($media->film->duree_film != null)
        <div class="main-section_duree">
            <p class="main-section_title">Durée:</p>
            <p><?php
                $duree = $media->film->duree_film;
                echo (int)($duree/60).'h';
                echo $duree%60;
            ?></p>
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
    </div>
@endsection
