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
            <div class="main-header_img" @if ($media->image != null)
                style="background-image: url('{{ env('FILE_URL').'/image/'.$media->image->path_image }}');"
            @endif></div>
            <div class="main-header_left_content">
                <h2 class="main-header_title">{{ $media->oeuvre->nom_oeuvre }}</h2>
                <p class="main-header_avg">{{ 'note: '.round($media->notes->avg('note'), 1).'/5' }}</p>
            </div>
        </div>
        <div class="main-header_right">
            <div>
                @auth
                    <p class="main-header_note_title">Note:</p>
                    <a class="main-header_note @if($note == 1) main-header_note_set @endif"
                        href="{{ route('media.note', [$media->id_media, '1']) }}">1</a>
                    <a class="main-header_note @if($note == 2) main-header_note_set @endif"
                        href="{{ route('media.note', [$media->id_media, '2']) }}">2</a>
                    <a class="main-header_note @if($note == 3) main-header_note_set @endif"
                        href="{{ route('media.note', [$media->id_media, '3']) }}">3</a>
                    <a class="main-header_note @if($note == 4) main-header_note_set @endif"
                        href="{{ route('media.note', [$media->id_media, '4']) }}">4</a>
                    <a class="main-header_note @if($note == 5) main-header_note_set @endif"
                        href="{{ route('media.note', [$media->id_media, '5']) }}">5</a>
                @endauth
            </div>
            <div>
                <p class="main-header_type">{{ $media->type_media }}</p>
                <p class="main-header_date">{{ $media->annee_sortie_media }}</p>
            </div>
        </div>
    </div>
    <div class="main-section">
        @yield('main-section')
    </div>
@endsection
