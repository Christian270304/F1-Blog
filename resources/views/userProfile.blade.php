<!DOCTYPE html>
<html lang="cat">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/userProfile.css') }}">
    <title>User Profile</title>
</head>

<body>
    <div class="header">
            <div class="logo">
                <a href="">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logotip de la pàgina">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('articles') }}" id="showAllArticles" >Inici</a></li>
                    <li><a href="{{ route('myArticles') }}" id="showMyArticles" >Articles</a></li>
                    <li><a href="{{ route('newArticle') }}" id="newArticle" >Crear Article</a></li>
                    <li><a href="{{ route('readQR') }}">Leer QR</a></li>
                </ul>
            </nav>


            <div class="user-icon">
                <label  for ="dropdown">
            
                    <img src="@if ($user->image == null) 
                            {{ asset('assets/profile-account.svg') }}
                        @else
                            {{ asset('storage/' . $user->image) }}
                        @endif" alt="Foto de perfil" id="userIcon">
                </label>
                <input hidden class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
                <div class="section-dropdown">
                    <a href="{{ route('profile') }}">Perfil <i class="uil uil-arrow-right"></i></a>
            
                    @if (Auth::user() && Auth::user()->role === 'admin')
                        <a href="{{ route('admin') }}">Admin <i class="uil uil-arrow-right"></i></a>
                    @endif
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión <i class="uil uil-arrow-right"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            @if (!isset($error))
                <!-- Perfil del Usuario -->
                <div class="user-profile">
                    <div class="header-profile">
                        <img alt="Foto de perfil" height="80" src="
                        @if ($user->image == null) 
                            {{ asset('assets/profile-account.svg') }}
                        @else
                            {{ asset('storage/' . $user->image) }}
                        @endif
                        " width="80" />
                        <div class="info">
                            <h1 class="username">{{ $user->username }}</h1>
                            <p>{{ $user->email }}</p>
                            <p class="bio">{{ $user->bio }}</p><br>
                            <div class="stats">
                                <div>
                                    <p>{{ $articles->count() }}</p>
                                    <p>publicaciones</p>
                                </div>
                                <div>
                                    <p>15,6 mil</p>
                                    <p>seguidores</p>
                                </div>
                                <div>
                                    <p>81</p>
                                    <p>seguidos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="tabs">
                    <div>PUBLICACIONS</div>
                </div>
        
                <div class="content">
                    <div class="gallery">
                        @foreach ($articles as $article)
                            <div class="card" id="{{ $article->id }}">
                                <img class="img-article" src="{{ asset('storage/' . $article->image) }}" alt="Imagen de {{ $article->titol }}">
                                <div class="article-content">
                                    <h4 class="titulo">{{ $article->titol }}</h4>
                                    <p class="texto">{!! $article->cos !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h1>{{ $error }}</h1>
            @endif
        </div>
</body>

</html>