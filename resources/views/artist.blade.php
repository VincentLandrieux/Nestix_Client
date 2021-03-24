@extends('template')

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
@endsection

@section('mast-header_class')
    {{ "mast-header__color" }}
@endSection



@section('content')
    <div class="main-header">
        <div class="main-header_left">
            <div class="main-header_img" @if ($artist->image != null)
                style=" background-image: url('{{ env('FILE_URL').'/image/'.$artist->image->path_image }}');"
            @endif></div>
            <div class="main-header_left_content">
                <h2 class="main-header_title">{{ $artist->surnom_artiste }}</h2>
            </div>
        </div>
        <div class="main-header_right">
        </div>
    </div>
    <div class="main-section">
        <div class="main-section_left">
            <div class="main-section_metier">
                @foreach ($artist->artistesMetiersMedias as $artisteMetierMedia)
                    <p class="main-section_title">{{ ucfirst($artisteMetierMedia->metier->nom_metier).':' }}</p>
                    <a href="{{ route('media', $artisteMetierMedia->media->id_media) }}">{{ $artisteMetierMedia->media->oeuvre->nom_oeuvre }}</a>
                @endforeach
            </div>
        </div>
        <div>
        @if ($artist->dob_artiste != null)
            <div class="main-section_dob">
                <p class="main-section_title">Date de naissance:</p>
                <p>{{ $artist->dob_artiste }}</p>
            </div>
        @endif
        </div>
    </div>
@endsection
