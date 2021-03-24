@extends('template')

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/accueil.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
@endsection

@section('mast-header_class')
    {{ "mast-header__abs" }}
@endSection


@extends('component.search')
@section('content')
    <div class="main-header">
        <div>
        @auth
        <h1 class="main-header_title">Bienvenue</h1>
        <p class="main-header_line">Retrouvez vos livres, films et musiques favorites</p>
        @else
            <h1 class="main-header_title">Bienvenue</h1>
            <p class="main-header_line">Connectez-vous pour profiter de toutes les fonctionnalitées</p>
            <div class="main-header_action">
              <a class="main-header_btn btn" href="{{ route('login') }}">se connecter</a>

              @if (Route::has('register'))
                  <a class="main-header_btn btn" href="{{ route('register') }}">s'inscrire</a>
              @endif
          </div>
        @endauth
        </div>
    </div>

    <div class="main-section">
        @parent
    </div>

    <div class="main-section">
        <h2 class="main-section_title">Nouveautés</h2>
        <div class="news">
            @forelse($mediasNews AS $media)
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
    </div>

    <div class="main-section">
        <h2 class="main-section_title">Plus populaires</h2>
        <div class="news">
            @forelse($mediasScores AS $media)
                <a class="card"  href="{{ route('media', $media->id_media) }}">
                    <div class="card_img" @if ($media->path_image != null)
                        style="background-image: url('{{ env('FILE_URL').'/image/'.$media->path_image }}');"
                    @endif></div>
                    <div class="card_title"><p>{{ $media->nom_oeuvre.' - '.round($media->note_avg, 1).'/5' }}</p></div>
                </a>
            @empty
                <p>Vide</p>
            @endforelse
        </div>
    </div>

    <div class="main-section">
        <div class="lecteur">
            <a class="lecteur_link" href="https://landrieux.needemand.com/nestix/lecteur">
                Ecoutez la sélection musicale du mois
            </a>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var url = "{{ env('APP_URL') }}";
    </script>
    <script src='{{ asset('js/search.js') }}'></script>
@endsection
