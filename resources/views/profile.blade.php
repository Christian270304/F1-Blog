<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
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
    
        /* HEADER */
        .header {
            grid-area: header;
            background-color: var(--negro-carbon);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
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
            flex-wrap: wrap;
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
    
        /* PERFIL */
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
    
        .section-dropdown {
            position: absolute;
            padding: 5px;
            background-color: #111;
            top: 70px;
            right: 0;
            width: 180px;
            border-radius: 4px;
            box-shadow: 0 14px 35px rgba(9,9,12,0.4);
            z-index: 2;
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
    
        .user-icon input[type="checkbox"]:checked ~ .section-dropdown {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }
    
        .section-dropdown a {
            color: #fff;
            font-size: 14px;
            padding: 8px 15px;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
        }
    
        .section-dropdown a:hover {
            background-color: #ffeba7;
            color: #102770;
        }
    
        /* FORMULARIO */
        .form-container {
            grid-area: content;
            background: white;
            border-radius: 15px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            margin: 4rem auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    
        .profile-header {
            align-items: center;
            text-align: center;
        }
    
        .profile-avatar {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }
    
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--gris-metalico);
        }
    
        .profile-avatar .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--rojo-intenso);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s;
        }
    
        .profile-avatar .edit-icon:hover {
            background: var(--amarillo-dorado);
        }
    
        .form-group {
            margin-bottom: 1.2rem;
        }
    
        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
    
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--gris-metalico);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }
    
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--rojo-intenso);
            outline: none;
        }
    
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
    
        .submit-btn {
            background: var(--rojo-intenso);
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            width: 100%;
            transition: all 0.3s;
        }
    
        .submit-btn:hover {
            background: var(--amarillo-dorado);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            overflow: auto;
        }

        .modal-content {
            background: white;
            margin: 10% auto;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            color: var(--gris-metalico);
            cursor: pointer;
            transition: color 0.3s;
        }

        .close-modal:hover {
            color: var(--rojo-intenso);
        }

        .modal-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .disabled-btn {
            background: var(--gris-metalico);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 2rem;
            transition: all 0.3s;
        }

        .change-password-btn {
            background: var(--rojo-intenso);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 2rem;
            transition: all 0.3s;
        }

        .change-password-btn:hover {
            background: var(--amarillo-dorado);
        }

        .error-message {
        color: var(--rojo-intenso);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        }

        .form-group.error input,
        .form-group.error textarea {
            border-color: var(--rojo-intenso);
        }

        /* Botón de Cerrar Sesión */
.logout-btn {
    background-color: #ff4757;
    color: white;
    position: relative;
    overflow: hidden;
}

.button.logout:hover {
    background-color: #ff6b81;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 71, 87, 0.4);
}

.logout-btn a {
    color: white;
    text-decoration: none;
    display: block;
}

/* Botón Generar QR */
.generate-qr-btn {
    background-color: #2ed573;
    color: white;
}

.generate-qr-btn:hover {
    background-color: #7bed9f;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(46, 213, 115, 0.4);
}

/* Botón Generar Token */
.generate-token-btn {
    background-color: #3742fa;
    color: white;
}

.generate-token-btn:hover {
    background-color: #5352ed;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(55, 66, 250, 0.4);
}

/* Efectos comunes al hacer clic */
button:active {
    transform: translateY(1px);
}

/* Opcional: Contenedor para alinear los botones */
.buttons-container {
    display: flex;
    gap: 15px;
    padding: 20px;
    flex-wrap: wrap;
    justify-content: center;
}

/* Estilos para el overlay del código QR */
#qr-code-overlay {
    display: none; /* Oculto por defecto */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8); /* Fondo semi-transparente */
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Asegurarse de que esté por encima de otros elementos */
  }
  
  /* Estilos para el contenedor del código QR */
  #qr-code-container {
    background-color: #fff; /* Fondo blanco para el código QR */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }
  
  #qr-code-image {
    /* degradado */
    background: linear-gradient(145deg, #f0f0f0, #1510a3);
    width: 300px;
    height: 300px;
  }

  /* Estilos para el overlay del Token */
  #token-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    animation: fadeIn 0.3s ease-in-out;
}

/* Contenedor del token */
#token-container {
    background: #ffffff;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    max-width: 90%;
    width: 500px;
    position: relative;
    text-align: center;
    transform: scale(0.9);
    animation: modalSlideIn 0.3s ease-out forwards;
}



/* Texto del token */
#token {
    color: #2d3436;
    font-size: 1rem;
    margin: 0;
    word-break: break-all;
    font-family: 'Courier New', monospace;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 2px dashed #ced4da;
}

#refreshtoken {
    color: #2d3436;
    font-size: 1rem;
    margin: 0;
    word-break: break-all;
    font-family: 'Courier New', monospace;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 2px dashed #ced4da;
}
    
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: center;
                padding: 15px;
            }
    
            nav ul {
                justify-content: center;
                flex-wrap: wrap;
                padding-top: 10px;
            }
    
            nav ul li {
                margin: 5px 10px;
            }
    
            .profile-header {
                flex-direction: column;
            }
    
            .profile-avatar {
                width: 100px;
                height: 100px;
            }
    
            .form-container {
                width: 95%;
                padding: 1.5rem;
            }
    
            .submit-btn {
                padding: 0.8rem;
            }
        }
    
        @media (max-width: 480px) {
            .logo img {
                width: 40px;
                height: 40px;
            }
    
            .user-icon img {
                width: 40px;
                height: 40px;
            }
    
            .profile-avatar {
                width: 80px;
                height: 80px;
            }
    
            .profile-header h1 {
                font-size: 1.5rem;
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
        </header>

        <div class="form-container">
            <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="profile-header">
                    <div class="profile-avatar">
                        <img id="avatarPreview" src="@if (Auth::user()->image == null) 
                        {{ asset('assets/profile-account.svg') }}
                    @else
                        {{ asset('storage/' . Auth::user()->image) }}
                    @endif" alt="Avatar">
                        <label for="avatarInput" class="edit-icon">
                            <i class="fas fa-pencil-alt"></i>
                        </label>
                        <input hidden type="file" name="avatar" id="avatarInput" accept="image/*" >
                    </div>
                    <div class="profile-info">
                        <h1>{{ auth()->user()->username }}</h1>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            value="{{ old('username', auth()->user()->username) }}"
                            placeholder="Nombre de usuario"
                        >
                        @error('username')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', auth()->user()->email) }}"
                            placeholder="Correo electrónico"
                            @if (Auth::user()->OAuth) disabled @endif
                        >
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    @if (Auth::user()->OAuth)
                        <button type="button" class="disabled-btn" disabled>No puedes cambiar la contraseña</button>
                    @else
                        <button type="button" class="change-password-btn" id="openModalBtn">Cambiar contraseña</button>
                    @endif

                    <div class="form-group">
                        <label for="bio">Biografía</label>
                        <textarea 
                            name="bio" 
                            id="bio" 
                            placeholder="Escribe algo sobre ti...">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn">Guardar cambios</button>
                </div>
            </form>
        </div>
        <div class="buttons-container">
            <!-- Botón para cerrar la sesion -->
            <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <a href="#">Cerrar Sesión</a>
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <!-- Botón para generar el código QR -->
            <button id="generate-qr-btn" class="generate-qr-btn">Generar QR</button>

            <!-- Botón para generar token de la api -->
            <button id="generate-token-btn" class="generate-token-btn">Generar Token</button>
        </div>

        <!-- Modal -->
        <form action="{{ route('updatePassword') }}" method="POST">
            @csrf
            <div id="passwordModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal" id="closeModal">&times;</span>
                    <h2 class="modal-title">Cambiar contraseña</h2>

                    <div class="form-group">
                        <label for="current_password">Contraseña actual</label>
                        <input 
                            type="password" 
                            name="current_password" 
                            id="current_password_modal" 
                            placeholder="Ingresa tu contraseña actual"
                        >
                        @error('current_password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group password-input">
                        <label for="password">Nueva contraseña</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="new_password_modal" 
                            placeholder="Ingresa tu nueva contraseña"
                        >
                        <i class="fas fa-eye-slash" id="toggleNewPasswordModal" onclick="toggleNewPasswordVisibilityModal()"></i>
                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group password-input">
                        <label for="password_confirmation">Confirmar nueva contraseña</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="new_password_confirmation_modal" 
                            placeholder="Confirma tu nueva contraseña"
                        >
                        <i class="fas fa-eye-slash" id="toggleConfirmPasswordModal" onclick="toggleConfirmPasswordVisibilityModal()"></i>
                        @error('password_confirmation')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn" id="savePasswordChanges">Guardar cambios</button>
                </div>
            </div>
        </form>

        <!-- Contenedor para mostrar el código QR -->
        <div id="qr-code-overlay">
            <div id="qr-code-container">
                <img id="qr-code-image" src="" alt="Código QR">
            </div>
        </div>

        <!-- Contenedor para mostrar el token -->
        <div id="token-overlay">
            <div id="token-container">
                <label for="token">Token</label>
                <h3 id="token"></h3><br>
                <label for="refreshtoken">Refresh Token</label>
                <h3 id="refreshtoken"></h3><br><br>
                <small>No compartir los tokens</small>
            </div>
            <div id="refreshtoken-container">
                
            </div>
        </div>
    </div>

    <script>
        // Vista previa de avatar
        const avatarInput = document.getElementById('avatarInput');
        const avatarPreview = document.getElementById('avatarPreview');

        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    avatarPreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Modal functionality
        const modal = document.getElementById('passwordModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModal');

        openModalBtn.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeModalBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Mostrar/ocultar contraseñas en el modal
        function toggleNewPasswordVisibilityModal() {
            const newPasswordInput = document.getElementById('new_password_modal');
            const toggleIcon = document.getElementById('toggleNewPasswordModal');
            if (newPasswordInput.type === 'password') {
                newPasswordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                newPasswordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        function toggleConfirmPasswordVisibilityModal() {
            const confirmPasswordInput = document.getElementById('new_password_confirmation_modal');
            const toggleIcon = document.getElementById('toggleConfirmPasswordModal');
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                confirmPasswordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        // Generar token para la api
        document.getElementById('generate-token-btn').addEventListener('click', function () {
            var token = document.getElementById('token');
            var refreshtoken = document.getElementById('refreshtoken');
            var tokenOverlay = document.getElementById('token-overlay');

            // Hacer la solicitud al backend para generar los tokens
            fetch('/generate-tokens', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Agregar el token CSRF
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        token.innerHTML = data.access_token; // Mostrar el access token
                        refreshtoken.innerHTML = data.refresh_token; // Mostrar el refresh token
                        tokenOverlay.style.display = 'flex';
                
                    } else {
                        console.error('Error al generar los tokens:', data.message);
                        alert('Error al generar los tokens.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al generar los tokens.');
                });
        });

        // Cerrar el overlay cuando se hace clic fuera del Token
        document.getElementById('token-overlay').addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });

        document.getElementById('generate-qr-btn').addEventListener('click', function () {
            // Obtener el contenedor del código QR
            const qrImage = document.getElementById('qr-code-image');
            const qrOverlay = document.getElementById('qr-code-overlay');

            // URL para el QR
            const username = '{{ auth()->user()->username }}';
            const url = `https://ctorres.cat/index.php?pagina=Login&username=${username}`;

            // Hacer la solicitud al backend para generar el QR
            fetch(`/generate-qr?text=${encodeURIComponent(url)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        qrImage.src = data.url; // Establecer la imagen del QR
                        qrOverlay.style.display = 'flex'; // Mostrar el overlay
                    } else {
                        console.error('Error al generar el QR:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Cerrar el overlay cuando se hace clic fuera del código QR
        document.getElementById('qr-code-overlay').addEventListener('click', function (event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });

        @if ($errors->any() && session('modal') === 'passwordModal')
            document.addEventListener('DOMContentLoaded', function() {
                modal.style.display = 'block';
            });
        @endif
    </script>
</body>
</html>