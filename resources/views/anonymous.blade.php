<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" {{ asset('css/anonymous.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Inici</title>
</head>

<body>
    <div class="container">

        <div class="header">
            <div class="logo">
                <a href="{{ route('anonymous') }}">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logotip de la pàgina">
                </a>
            </div>
        
            <div class="search-bar">
                <input placeholder="Search..." type="text" />
            </div>
            <div class="articles-per-page">
                <label for="articulosPorPagina">Artículos por página:</label>
                <form action="{{ route('anonymous') }}" method="GET" id="paginationForm">
                    <input type="number" name="perPage" id="articulosPorPagina" min="1" max="{{ $articles->total() }}" value="{{ request('perPage', 5) }}" onchange="document.getElementById('paginationForm').submit();">
                </form>
            </div>
            <div class="sort-buttons">

            </div>
            <div class="user-icon">
                <label  for ="dropdown">
                    <img src="{{ asset('assets/profile-account.svg') }}" alt="User Icon" id="userIcon">
                </label>
                <input hidden class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
                <div class="section-dropdown">
                        <a href="{{ route('login') }}">Iniciar Sessió <i class="uil uil-arrow-right"></i></a>
                        <a href="{{ route('signup') }}">Crear Compte <i class="uil uil-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="content">
            @foreach ($articles as $article)
                <div class="card" id="{{ $article->id }}">
                    <img class="img-article" src="{{ asset('storage/' . $article->image) }}" alt="Imatge Article">
                    <div class="article-content">
                        <h4 class="titulo">{{ $article->titol }}</h4>
                        <p class="texto">{!! $article->cos !!}</p>
                        <span id="username" class="username"><i class="fa fa-user"></i> {{ $article->user->username }}</span>
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="pagination">
            {{$articles->links()}} 
            {{-- @if ($page > 1)
                <a href="{{ route('articles', ['page' => $page - 1]) }}">Anterior</a>
            @endif
            @if ($page < $totalPages)
                <a href="{{ route('articles', ['page' => $page + 1]) }}">Següent</a>
            @endif --}}
        </div>
 
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const accountIconBtn = document.getElementById('account-icon-btn');
            const accountIcon = document.querySelector('.account-icon');

            // Detectar si el dispositivo es móvil
            const isMobile = window.matchMedia("(max-width: 768px)").matches;

            // Configuración para dispositivos móviles
            if (isMobile) {
                accountIconBtn.addEventListener('click', function (event) {
                    event.preventDefault(); // Evita redirección en caso de usar `a` o `button`
                    event.stopPropagation();
                    accountIcon.classList.toggle('active'); // Alterna la clase active
                });

                // Cierra el menú desplegable si se hace clic fuera del icono
                document.addEventListener('click', function (event) {
                    if (!accountIcon.contains(event.target)) {
                        accountIcon.classList.remove('active');
                    }
                });
            }
        });
    </script>
</body>

</html>