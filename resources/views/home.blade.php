<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Estilos/estilosInicio.css" rel="stylesheet">
    <title>Inici</title>
</head>
<body>
<div class="container">
    <form action="" method="get">
    <div class="header">
        <div class="logo">
            <a href="">
                <img src="images/favicon.png" alt="Logotip de la pàgina">
            </a>
        </div>
        
                <nav>
                    <ul>
                        <li><a href="index.php?pagina=Inicio" id="showAllArticles" >Inici</a></li>
                        <li><a href="index.php?pagina=Mostrar" id="showMyArticles" >Articles</a></li>
                        <li><a href="index.php?pagina=Insertar" id="newArticle" >Crear Article</a></li>
                        <li><a href="index.php?pagina=LeerQR">Leer QR</a></li>
                    </ul>
                </nav>
             
                <div class="search-bar">
                <input type="text" name="search" id="search" placeholder="Buscar por título o contenido" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            </div>
            <div class="articles-per-page">
            <label for="articulosPorPagina">Artículos por página:</label>
               
                <input type="hidden" name="page" >
                <input type="hidden" name="pagina" >
                <input type="number" name="articulosPorPagina" id="articulosPorPagina"
                    
                    min="1" max="12">
                <button type="submit">Actualizar</button>
            </div>
            <div class="sort-buttons">
                <button type="submit" name="order" value="ASC" >A-Z</button>
                <button type="submit" name="order" value="DESC" >Z-A</button>

            </div>
        <div class="user-icon">
                <label  for ="dropdown">
               
                    <img src="" alt="Foto de perfil" id="userIcon">
                </label>
                <input hidden class="dropdown" type="checkbox" id="dropdown" name="dropdown" />
                <div class="section-dropdown">
                
                        <a href="index.php?pagina=Perfil">Perfil <i class="uil uil-arrow-right"></i></a>
                        
                            <a href="index.php?pagina=Admin">Admin <i class="uil uil-arrow-right"></i></a>
                        
                        <a href="index.php?pagina=MostrarInici&logout=1">Tancar Sessió <i class="uil uil-arrow-right"></i></a>
                    
                        <a href="index.php?pagina=Login">Iniciar Sessió <i class="uil uil-arrow-right"></i></a>
                        <a href="index.php?pagina=SignUp">Crear Compte <i class="uil uil-arrow-right"></i></a>
                    
                </div>
            </div>
    </div>
    </form>
    <div class="content">
    
    </div>
    <!-- Contenedor para mostrar el código QR -->
    <div id="qr-code-overlay">
            <div id="qr-code-container">
                <img id="qr-code-image" src="" alt="Código QR">
            </div>
        </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Selecciona todos los botones con la clase 'qr-generate'
            const qrButtons = document.querySelectorAll('.qr-content');

            // Asigna el evento a cada botón
            qrButtons.forEach(button => {
                button.addEventListener('click', function() {
                    var qrImage = document.getElementById('qr-code-image');
                    var qrOverlay = document.getElementById('qr-code-overlay');
                    const username = document.getElementById('username').textContent;
                    const url = `https://ctorres.cat/index.php?pagina=Login&username=${encodeURIComponent(username)}`;
                    fetch(`/Backend_Pt5/generate_qr.php?text=${encodeURIComponent(url)}`)
                        .then(response => response.json())
                        .then(data => {
                            qrImage.src = data.url;
                            qrOverlay.style.display = 'flex';
                        });
                });
            });
            // Oculta el QR cuando se hace clic fuera de él
            document.addEventListener('click', function(event) {
                var qrOverlay = document.getElementById('qr-code-overlay');
                var qrImage = document.getElementById('qr-code-image');
                if (qrOverlay.style.display === 'flex' && !qrImage.contains(event.target)) {
                    qrOverlay.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>