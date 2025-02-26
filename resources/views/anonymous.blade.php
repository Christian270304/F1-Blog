<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" {{ asset('css/anonymous.css') }}">
    <title>Inici</title>
</head>

<body>
    <div class="container">
    <form method="get" action="">
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
                
                <input type="hidden" name="page" >
                <input type="hidden" name="pagina" >
                <input type="number" name="articulosPorPagina" id="articulosPorPagina" min="1" max="12">
                <button type="submit">Actualizar</button>
            </div>
            <div class="sort-buttons">

            </div>
            <div class="user-icon">
                <label  for ="dropdown">
                    <img src="{{ asset('assets/profile-account.svg') }}" alt="User Icon" id="userIcon">
                </label>
                <input hidden class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
                <div class="section-dropdown">
                        <a href="{{ route('admin') }}">Admin <i class="uil uil-arrow-right"></i></a>
                        <a href="{{ route('login') }}">Iniciar Sessió <i class="uil uil-arrow-right"></i></a>
                        <a href="{{ route('signup') }}">Crear Compte <i class="uil uil-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="content" id="articlesContainer">
        
                
            

            {{-- <?php
            // Obtener la página actual de la URL, por defecto es 1
            // $paginaActual = validarEntero('page', 1, 1, ceil($totalArticulos / 1));
            // $articulosPorPagina = validarEntero('articulosPorPagina', 5, 1, $totalArticulos); // Número de artículos por página

            // echo mostrarTodosArticulos('MostrarInici', $paginaActual, $articulosPorPagina);  // Usar el valor de artículos por página
            ?> --}}
        </div>
        </form>
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