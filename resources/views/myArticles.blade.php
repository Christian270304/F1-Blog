<!-- Christian Torres Barrantes -->
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    @vite(['resources/css/articles.css', 'resources/js/app.js'])
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
                <form action="{{ route('myArticles') }}" method="GET" id="paginationForm">
                    <input type="number" name="perPage" id="articulosPorPagina" min="1" max="{{ $articles->total() != 0? $articles->total() : "" }}" value="{{ request('perPage', 5) }}" onchange="document.getElementById('paginationForm').submit();">
                </form>
            </div>
            <div class="sort-buttons">
                <form action="{{ route('myArticles') }}" method="GET">
                    <input type="hidden" name="order" value="ASC">
                    <input type="hidden" name="perPage" value="{{ request('perPage', 5) }}">
                    <button type="submit" class="{{ request('order') === 'ASC' ? 'active' : '' }}">A-Z</button>
                </form>
                <form action="{{ route('myArticles') }}" method="GET">
                    <input type="hidden" name="order" value="DESC">
                    <input type="hidden" name="perPage" value="{{ request('perPage', 5) }}">
                    <button type="submit" class="{{ request('order') === 'DESC' ? 'active' : '' }}">Z-A</button>
                </form>
            </div>
            <div class="user-icon">
                <label  for ="dropdown">
               
                    <img src="@if (Auth::user()->image == null) 
                                {{ asset('assets/profile-account.svg') }}
                            @else
                                {{ asset('storage/' . Auth::user()->image) }}
                            @endif"  alt="Foto de perfil" id="userIcon">
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

    <div class="content">
        @foreach ($articles as $article)
            <div class="user-article" id="{{ $article->id }}">
                <img class="img-article" src="{{ asset('storage/' . $article->image) }}" alt="Imatge Article">
               
                <h4 class="titulo">{{ $article->titol }}</h4>
                <p class="texto">{!! $article->cos !!}</p>
             
                <div class="card-actions">
                    <button id="read" data-id="{{ $article->id }}" >Leer</button>
                    <button onclick="window.location.href='{{ route('editArticle', $article->id) }}'">Editar</button>
                    <button onclick="deleteArticle({{ $article->id }})">Eliminar</button>
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
    
</div>

{{-- <!-- Modal -->
<div id="articleModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalArticleContent"></div>
        </div>
    </div> --}}

    <!-- Modal de Confirmación -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>¿Estás seguro de que deseas eliminar este artículo?</h2>
            <p>Esta acción no se puede deshacer.</p>
            <div class="modal-actions">
                <button id="confirmDelete" class="btn btn-danger">Eliminar</button>
                <button id="cancelDelete" class="btn btn-secondary">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Modal para Leer Artículo -->
    <div id="readArticleModal" class="readModal">
        <div class="read-modal-content">
            <span class="close">&times;</span>
            <div id="modalArticleContent">
                <!-- Aquí se cargará dinámicamente el contenido del artículo -->
            </div>
        </div>
    </div>
    
    <script>



    let deleteModal = document.getElementById("deleteModal");
    let closeModal = document.getElementsByClassName("close")[0];
    let confirmDeleteButton = document.getElementById("confirmDelete");
    let cancelDeleteButton = document.getElementById("cancelDelete");
    let articleIdToDelete = null;

    // Mostrar el modal al hacer clic en el botón "Eliminar"
    function deleteArticle(articleId) {
        articleIdToDelete = articleId; // Guardar el ID del artículo a eliminar
        deleteModal.style.display = "block";
    }

    // Cerrar el modal al hacer clic en la "X"
    closeModal.onclick = function() {
        deleteModal.style.display = "none";
        articleIdToDelete = null; // Limpiar el ID del artículo
    }

    // Cerrar el modal al hacer clic fuera del contenido
    window.onclick = function(event) {
        if (event.target == deleteModal) {
            deleteModal.style.display = "none";
            articleIdToDelete = null; // Limpiar el ID del artículo
        }
    }

    // Confirmar la eliminación
    confirmDeleteButton.onclick = function() {
        if (articleIdToDelete) {
            // Realizar la solicitud para eliminar el artículo
            fetch(`/delete/${articleIdToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Recargar la página o eliminar el artículo del DOM
                    location.reload();
                } else {
                    alert('Error al eliminar el artículo.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
        deleteModal.style.display = "none";
    }

    // Cancelar la eliminación
    cancelDeleteButton.onclick = function() {
        deleteModal.style.display = "none";
        articleIdToDelete = null; // Limpiar el ID del artículo
    }




    let readModal = document.getElementById("readArticleModal");
    let closeReadModal = document.getElementsByClassName("close")[0];

    // Función para abrir el modal y cargar el contenido del artículo
    function readArticle(articleId) {
        fetch(`/article/${articleId}`) // Cambia esta URL según tu ruta para obtener el artículo
            .then(response => response.json())
            .then(data => {
                // Cargar el contenido del artículo en el modal
                document.getElementById('modalArticleContent').innerHTML = `
                    <img src="/storage/${data.image}" alt="Imagen del artículo">
                    <h4>${data.titol}</h4>
                    <p>${data.cos}</p>
                `;
                readModal.style.display = "block";
            })
            .catch(error => console.error('Error:', error));
    }

    // Cerrar el modal al hacer clic en la "X"
    closeReadModal.onclick = function() {
        readModal.style.display = "none";
    }

    // Cerrar el modal al hacer clic fuera del contenido
    window.onclick = function(event) {
        if (event.target == readModal) {
            readModal.style.display = "none";
        }
    }
    </script>
</body>

</html>