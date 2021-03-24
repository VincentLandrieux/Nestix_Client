@extends('template')

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/liste_media.css') }}" rel="stylesheet">
@endsection

@section('mast-header_class')
    {{ "mast-header__color" }}
@endSection

@extends('component.search')
@section('content')
    <div class="main-header">
        @parent
    </div>

        <h2 class="main-title">{{ $title }}</h2>

    <div class="main-section">
        @forelse($medias AS $media)
            <a class="card" href="{{ route('media', $media->id_media) }}">
                <div class="card_img" @if ($media->image != null)
                    style="background-image: url('{{ env('FILE_URL').'/image/'.$media->image->path_image }}');"
                @endif></div>
                <div class="card_title"><p>{{ $media->oeuvre->nom_oeuvre }}</p></div>
            </a>
        @empty
            <p>Vide</p>
        @endforelse
    </div>
@endsection

@section('script')
    <script>
        var url = "{{ env('APP_URL') }}";
    </script>
    <script type='text/javascript' src='{{ asset('js/search.js') }}'></script>
@endsection
