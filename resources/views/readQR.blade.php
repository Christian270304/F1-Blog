<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/readQR.css') }}">
    <title>Leer QR</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="">
                    <img src="{{ asset('assets/icons/logo2.png') }}" alt="Logotip de la pàgina">
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

                    <img src="{{ asset('assets/profile-account.svg') }}" alt="Foto de perfil" id="userIcon">
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
            <h1>Leer QR</h1>
            
            <form action="index.php?pagina=LeerQR" method="post" enctype="multipart/form-data">
                
                <label for="qrImage">Sube una imagen de un código QR:</label>
                <input type="file" name="qrImage" id="qrImage" accept="image/png" required>
                <input type="submit" value="Leer QR">
                <?= isset($error)? "<label style='color: red; font-weight: bold;'>".$error."</label>": ''; ?>
            </form>
        </div>
    </div>
</body>
</html>