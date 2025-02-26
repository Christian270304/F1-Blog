<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/articles.css') }}">
    <title>Articles</title>
</head>

<body>
<div class="container">
<form method="get" action="">
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
                <label for="articlesPerPage">Artículos por página:</label>
                
                <input type="hidden" name="page" value="">
                <input type="hidden" name="pagina" value="">
                <input type="number" name="articulosPorPagina" id="articulosPorPagina" min="1" max="<?php echo $totalArticulos ; ?> ">

                    <button type="submit">Actualizar</button>
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
    
</div>

    <!-- Modal -->
    <div id="articleModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalArticleContent"></div>
        </div>
    </div>
    
    <script>
    function readArticle(articleId) {
    fetch(`/Backend_Pt5/ajax/read_article.php?id=${articleId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalArticleContent').innerHTML = `
                <img src="${data.image}" alt="Imatge Article">
                <h4>${data.title}</h4>
                <p>${data.content}</p>
            `;
            var modal = document.getElementById("articleModal");
            modal.style.display = "block";
        })
        .catch(error => console.error('Error:', error));
    }   
   

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