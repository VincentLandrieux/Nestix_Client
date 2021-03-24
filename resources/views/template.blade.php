<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Nestix</title>

    @yield('css')
</head>
<body>
    <header class="mast-header @yield('mast-header_class')">
        <h3 class="mast-header_title">Nestix</h3>
        <nav class="mast-header_nav">
            <a class="mast-header_nav_link @if(Route::has('accueil')){{ 'active' }}@endif" href="{{ route('accueil') }}">Accueil</a>
            @if (Route::has('login'))
                @auth
                    <a class="mast-header_nav_link" href="{{ route('profil') }}">Profil</a>
                    <a class="mast-header_nav_link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">Déconnexion</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                @else
                    <a class="mast-header_nav_link btn" href="{{ route('login') }}">Connexion</a>

                    @if (Route::has('register'))
                        <a class="mast-header_nav_link" href="{{ route('register') }}">Inscription</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mast-footer">
        <div>
            <h5 class="mast-footer_title">Médias</h5>
            <ul class="mast-footer_nav">
                <li><a class="mast-footer_nav_link" href="{{ route('medias', 'livres') }}">livres</a></li>
                <li><a class="mast-footer_nav_link" href="{{ route('medias', 'films') }}">films</a></li>
                <li><a class="mast-footer_nav_link" href="{{ route('medias', 'musiques') }}">musiques</a></li>
            </ul>
        </div>
        <div>
            <h5 class="mast-footer_title">Profil</h5>
            <ul class="mast-footer_nav">
                <li><a class="mast-footer_nav_link" href="{{ route('profil') }}">profil</a></li>
            @auth
                <li><a class="mast-footer_nav_link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">déconnexion</a></li>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>

            @else
                <li><a class="mast-footer_nav_link" href="{{ route('register') }}">inscription</a></li>
                <li><a class="mast-footer_nav_link" href="{{ route('login') }}">connexion</a></li>
            @endauth
            </ul>
        </div>
        <div></div>
        <div></div>
    </footer>

    @yield('script')
</body>
</html>
