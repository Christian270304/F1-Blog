<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/articles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Articles</title>
</head>

<body>
    <div class="container">

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
    
            
                <div class="search-bar">
                    <input type="text" name="search" id="search" placeholder="Buscar por título o contenido" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                <div class="articles-per-page">
                    <label for="articulosPorPagina">Artículos por página:</label>
                    <form action="{{ route('articles') }}" method="GET" id="paginationForm">
                        <input type="number" name="perPage" id="articulosPorPagina" min="1" max="{{ $articles->total() }}" value="{{ request('perPage', 5) }}" onchange="document.getElementById('paginationForm').submit();">
                    </form>
                </div>
                <div class="sort-buttons">
                    <button type="submit" name="order" value="ASC" >A-Z</button>
                    <button type="submit" name="order" value="DESC"  >Z-A</button>

                </div>
                <div class="user-icon">
                    <label  for ="dropdown">
                
                        <img src="" alt="Foto de perfil" id="userIcon">
                    </label>
                    <input hidden class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
                    <div class="section-dropdown">
                        <a href="{{ route('profile') }}">Perfil <i class="uil uil-arrow-right"></i></a>
                
                        <a href="{{ route('admin') }}">Admin <i class="uil uil-arrow-right"></i></a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar Sesión <i class="uil uil-arrow-right"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
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
                            <button id="qr-generate" class="qr-content"> <img class="qr" src="{{ asset('assets/codigo-qr.png') }}" alt="QR" />  </button>
                        </div>
                    </div>
                @endforeach
        </div>
        <div class="pagination">
            {{$articles->links()}}
        </div>
        
    </div>

    <!-- Modal -->
    <div id="articleModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalArticleContent"></div>
        </div>
    </div>
    
    <script> 
   

    // Modal functionality
    var modal = document.getElementById("articleModal");
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</body>

</html>