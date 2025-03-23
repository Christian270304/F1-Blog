<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($article)? 'Editar Article': 'Crear Artículo F1'}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --rojo-intenso: #FF1E1E;
            --negro-carbon: #1C1C1C;
            --blanco-hielo: #F7F7F7;
            --gris-metalico: #B0B0B0;
            --amarillo-dorado: #FFC300;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: var(--blanco-hielo);
            color: var(--negro-carbon);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
    display: grid;
    min-height: 100vh;
    grid-template-rows: auto 1fr auto;
    grid-template-areas: 
        'header'
        'content';
}

        .header {
    grid-area: header;
    background-color: var(--negro-carbon);
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.logo {
    width: 50px;
    height: 50px;
    background-color: var(--rojo-intenso);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    
}
.logo a {
    text-decoration: none;
    color: white;
    border-radius: 40%;
}
.logo img {
    width: 50px;
    height: 50px;
    border-radius: 40%;
}
nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: var(--blanco-hielo);
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: var(--rojo-intenso);
}

.user-icon {
    position: relative;
    display: flex;
    align-items: center;
}

.user-icon img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
}

.user-icon input[type="checkbox"] {
    display: none;
}

.section-dropdown {
    position: absolute;
    padding: 5px;
    background-color: #111;
    top: 70px;
    right: 0;
    width: 200px;
    border-radius: 4px;
    display: block;
    box-shadow: 0 14px 35px 0 rgba(9,9,12,0.4);
    z-index: 2;
    opacity: 0;
    pointer-events: none;
    transform: translateY(20px);
    transition: all 200ms linear;
}

.user-icon input[type="checkbox"]:checked ~ .section-dropdown {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0);
}

.section-dropdown:before {
    position: absolute;
    top: -20px;
    left: 0;
    width: 100%;
    height: 20px;
    content: '';
    display: block;
    z-index: 1;
}

.section-dropdown:after {
    position: absolute;
    top: -7px;
    right: 10px; /* Mueve el triángulo a la derecha */
    width: 0; 
    height: 0; 
    border-left: 8px solid transparent;
    border-right: 8px solid transparent; 
    border-bottom: 8px solid #111;
    content: '';
    display: block;
    z-index: 2;
    transition: all 200ms linear;
}

.section-dropdown a {
    position: relative;
    color: #fff;
    transition: all 200ms linear;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    font-size: 15px;
    border-radius: 2px;
    padding: 5px 0;
    padding-left: 20px;
    padding-right: 15px;
    margin: 2px 0;
    text-align: left;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.section-dropdown a:hover {
    color: #102770;
    background-color: #ffeba7;
}

.section-dropdown a .uil {
    font-size: 22px;
}

        /* .logo {
            font-weight: 700;
            color: var(--rojo-intenso);
            text-transform: uppercase;
            font-size: 1.5rem;
        }

        .logo img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            margin-right: 10px;
        } */

        .form-container {
            grid-area: content;
            background: white;
            border-radius: 15px;
            padding: 5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            border-color: var(--gris-metalico);
            border-style: solid;
            margin: 5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 3rem;
        }

        .image-section {
            border: 2px dashed var(--gris-metalico);
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
            position: relative;
            cursor: pointer;
        }

        .image-section.dragover {
            border-color: var(--rojo-intenso);
            background: rgba(255, 30, 30, 0.1);
        }

        .file-input-container {
            position: relative;
            display: inline-block;
            margin: 1rem 0;
        }

        .custom-file-input {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-btn {
            background: var(--rojo-intenso);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .file-btn:hover {
            background: var(--amarillo-dorado);
        }

        .file-info {
            margin-top: 1rem;
            color: var(--gris-metalico);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .file-name {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .image-preview-container {
            position: relative;
            margin-top: 1rem;
            max-height: auto;
            overflow: hidden;
            border-radius: 5px;
        }

        .image-preview {
            width: 100%;
            height: auto;
            display: none;
        }

        .text-section {
            display: flex;
            flex-direction: column;
        }

        .text-section input,
        .text-section .editor {
            margin: 1rem 0;
        }

        .title-input {
            font-size: 2rem;
            border: none;
            border-bottom: 3px solid var(--gris-metalico);
            transition: border-color 0.3s;
            width: 100%;
            max-width: 100%;
        }

        .title-input:focus {
            border-color: var(--rojo-intenso);
            outline: none;
        }

        .char-counter {
            color: var(--gris-metalico);
            font-size: 0.9rem;
            margin-top: -0.5rem;
            display: block;
            transition: color 0.3s;
        }

        .char-counter.warning {
            color: var(--rojo-intenso);
        }

        .toolbar {
            background: var(--negro-carbon);
            border-radius: 5px;
            padding: 0.5rem;
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .toolbar button {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .toolbar button:hover {
            color: var(--amarillo-dorado);
        }

        .editor {
            border: 2px solid var(--gris-metalico);
            border-radius: 5px;
            min-height: 300px;
            padding: 1rem;
            outline: none;
        }

        .submit-btn {
            background: var(--rojo-intenso);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s;
            align-self: flex-end;
        }

        .submit-btn:hover {
            background: var(--amarillo-dorado);
        }

        .error-message {
            color: var(--rojo-intenso);
            font-size: 0.9rem;
            margin: 0.5rem 0;
        }

        .alert {
            padding: 15px 20px;
            border: 1px solid transparent;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-danger i {
            color: #f5c6cb;
            font-size: 20px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-success i {
            color: #c3e6cb;
            font-size: 20px;
        }

        .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .alert-warning i {
            color: #ffeeba;
            font-size: 20px;
        }

        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        .alert-info i {
            color: #bee5eb;
            font-size: 20px;
        }

        .alert .close {
            margin-left: auto;
            color: inherit;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s;
        }

        .alert .close:hover {
            color: #000;
        }

        .info-message {
            font-size: 0.9rem;
            color: var(--gris-metalico);
            margin-top: 5px;
        }
        

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <a href="{{ route('articles') }}">
                    <img src="{{ asset('assets/icons/logo4.png') }}" alt="Logotip de la pàgina">
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
        </header>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="form-container">
            <form action="{{ isset($article) ? route('updateArticle', $article->id) : route('newArticle') }}" method="POST" enctype="multipart/form-data" id="form">
                @csrf
                @if (isset($article))
                    @method('PUT')
                @endif

                <div class="form-grid">
                    <!-- Sección de imagen -->
                    <div class="image-section" id="imageSection">
                        <i class="fas fa-cloud-upload-alt fa-3x" style="color: var(--gris-metalico);"></i>
                        <p>Arrastra y suelta o selecciona una imagen</p>
                        
                        <div class="file-input-container">
                            @if (isset($article))
                                <input type="hidden" name="existing_image" value="{{ $article->image }}">
                            @endif
                            <input type="file" name="image" id="imageInput" class="custom-file-input" accept="image/*">
                            <label for="imageInput" class="file-btn">
                                <i class="fas fa-file-image"></i> Seleccionar imagen
                            </label>
                        </div>

                        <div class="file-info">
                            <span class="file-name" id="fileName">Ningún archivo seleccionado</span>
                            @if (isset($article))
                                <p class="info-message">Deja este campo vacío si no deseas cambiar la imagen.</p>
                            @endif
                        </div>

                        <div class="image-preview-container">
                            <img id="imagePreview" class="image-preview" src="{{ isset($article)? asset('storage/' . $article->image) : '' }}" alt="Vista previa de la imagen">
                        </div>
                        @error('image')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sección de contenido -->
                    <div class="text-section">
                        <input 
                            type="text" 
                            name="title" 
                            class="title-input" 
                            placeholder="Título del artículo" 
                            value="{{ old('title', $article->titol ?? '') }}"
                            maxlength="255"
                            oninput="updateCounter()"
                        >
                        <span id="charCounter" class="char-counter">255 caracteres restantes</span>
                        @error('title')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                        <div class="toolbar">
                            <button type="button" onclick="formatText('bold')"><i class="fas fa-bold"></i></button>
                            <button type="button" onclick="formatText('italic')"><i class="fas fa-italic"></i></button>
                            <button type="button" onclick="formatText('underline')"><i class="fas fa-underline"></i></button>
                            <button type="button" onclick="addLink()"><i class="fas fa-link"></i></button>
                        </div>

                        <div id="content" class="editor" contenteditable="true">{!! old('body', $article->cos ?? '') !!}</div>
                        <input type="hidden" name="body" id="body">
                        @error('body')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="submit-btn">{{ isset($article)? 'Editar Article': 'Publicar Artículo' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const imageSection = document.getElementById('imageSection');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const fileName = document.getElementById('fileName');

        // Drag and Drop
        imageSection.addEventListener('dragenter', (e) => {
            e.preventDefault();
            imageSection.classList.add('dragover');
        });

        imageSection.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        imageSection.addEventListener('dragleave', () => {
            imageSection.classList.remove('dragover');
        });

        imageSection.addEventListener('drop', (e) => {
            e.preventDefault();
            imageSection.classList.remove('dragover');
            
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                handleFile(file);
            }
        });

        // File input handling
        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) handleFile(file);
        });

        function handleFile(file) {
            const reader = new FileReader();
            
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                fileName.textContent = file.name;
                imageSection.style.borderColor = 'var(--rojo-intenso)';
                imageSection.querySelector('p').style.display = 'none';
            };
            
            reader.readAsDataURL(file);
        }

        // Si esta setado la variable article, se muestra la imagen
        @if(isset($article))
        
            imagePreview.style.display = 'block';
            // fileName.textContent = file.name;
            imageSection.style.borderColor = 'var(--rojo-intenso)';
            imageSection.querySelector('p').style.display = 'none';
        
        @endif


        // Contador de caracteres
        function updateCounter() {
            const input = document.querySelector('.title-input');
            const counter = document.getElementById('charCounter');
            const remaining = 255 - input.value.length;
            
            counter.textContent = `${remaining} caracteres restantes`;
            counter.classList.toggle('warning', remaining <= 20);
            
            if (remaining < 0) {
                input.value = input.value.slice(0, 255);
                counter.textContent = '0 caracteres restantes';
            }
        }

        // Editor de texto
        function formatText(command) {
            document.execCommand(command, false, null);
        }

        function addLink() {
            const url = prompt('Ingrese la URL:');
            if (url) {
                document.execCommand('createLink', false, url);
            }
        }

        // Guardar contenido
        document.querySelector('#form').addEventListener('submit', function(e) {
            document.getElementById('body').value = document.getElementById('content').innerHTML;
        });
    </script>
</body>
</html>