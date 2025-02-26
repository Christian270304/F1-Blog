<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/newArticle.css') }}">
    <title>Nou Article</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="">
                    <img src="images/favicon.png" alt="Logotip de la pàgina">
                </a>
            </div>
            
                <nav>
                    <ul>
                        <li><a href="index.php?pagina=Inicio" id="showAllArticles">Inici</a></li>
                        <li><a href="index.php?pagina=Mostrar" id="showMyArticles">Articles</a></li>
                        <li><a href="index.php?pagina=Insertar" id="newArticle">Crear Article</a></li>
                    </ul>
                </nav>


            <div class="user-icon">
                <label for="dropdown">
                   
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
        <div class="content">
            <div class="form">
                <div class="image-grid">
                    <div class="image-selector">
                        <div class="profile-picture">
                            <img id="profile-image" alt="Foto de perfil" height="100" src="<?php echo $profileImage; ?>" />
                            <div class="edit-button" onclick="document.getElementById('file-input').click()">
                                <button class="fas fa-pencil-alt"></button>Edit 🖋️
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titol-grid-containter">
                 <div class="text-fields">
                    <input placeholder="Titulo" type="text"/>
                </div>   
                </div>
                <div class="cuerpo-grid-containter">
                    <div class="text-fields">
                        <textarea placeholder="Cuerpo"></textarea>
                    </div>   
                </div>
                <form id="upload-form" action="index.php?pagina=SubirImagen" method="post" enctype="multipart/form-data">
                <input type="file" id="file-input" name="article_image" accept="image/*" onchange="previewImage(event)">
                <button type="submit" style="display: none;"></button> 
            </form>
            </div>
        </div>
    </div>


    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const profileImage = document.getElementById('profile-image');
            profileImage.src = file;
            document.getElementById('upload-form').submit();

        }
    </script>
</body>

</html>