@section('content')
    <ul class="main-header_nav">
        <li><a class="main-header_nav_link" href="{{ route('medias', 'livres') }}">LIVRES</a></li>
        <li><a class="main-header_nav_link" href="{{ route('medias', 'films') }}">FILMS</a></li>
        <li><a class="main-header_nav_link" href="{{ route('medias', 'musiques') }}">MUSIQUES</a></li>
    </ul>
    <form class="search-form" enctype="application/x-www-form-urlencoded" accept-charset="UTF-8"
    method="POST" action="{{ route('search') }}">
        @csrf
        <div class="search-contener">
            <label for="search-bar" style="display:none">Recherche</label>
            <input id="search-bar" type="text" name="search"
                class="search-bar" maxlength="40" size="20"
                placeholder="Recherche">
            <div class="search-result"></div>
        </div>
    </form>
@endsection
