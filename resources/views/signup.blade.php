<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <title>Crear Compte</title>
</head>

<body>
    <div>
        <a href="{{ route('anonymous') }}"><button class="salir"></button></a>
    </div>
    <div class="card">
        <h4 class="title">Crear Compte</h4>
        <form method="POST" action="index.php?pagina=SignUp">
            <div class="field">
                <svg class="input-icon" width="800px" height="800px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <style>
                            .cls-1 {
                                stroke-miterlimit: 10;
                                stroke-width: 1.91px;
                            }
                        </style>
                    </defs>
                    <circle class="cls-1" cx="12" cy="7.25" r="5.73" />
                    <path class="cls-1" d="M1.5,23.48l.37-2.05A10.3,10.3,0,0,1,12,13h0a10.3,10.3,0,0,1,10.13,8.45l.37,2.05" />
                </svg>
                <input autocomplete="off" id="logusername" placeholder="Nom d'usuari" class="input-field" name="username" type="text" value="">
            </div>
            <div class="field">
                <svg class="input-icon" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                    <path d="M207.8 20.73c-93.45 18.32-168.7 93.66-187 187.1c-27.64 140.9 68.65 266.2 199.1 285.1c19.01 2.888 36.17-12.26 36.17-31.49l.0001-.6631c0-15.74-11.44-28.88-26.84-31.24c-84.35-12.98-149.2-86.13-149.2-174.2c0-102.9 88.61-185.5 193.4-175.4c91.54 8.869 158.6 91.25 158.6 183.2l0 16.16c0 22.09-17.94 40.05-40 40.05s-40.01-17.96-40.01-40.05v-120.1c0-8.847-7.161-16.02-16.01-16.02l-31.98 .0036c-7.299 0-13.2 4.992-15.12 11.68c-24.85-12.15-54.24-16.38-86.06-5.106c-38.75 13.73-68.12 48.91-73.72 89.64c-9.483 69.01 43.81 128 110.9 128c26.44 0 50.43-9.544 69.59-24.88c24 31.3 65.23 48.69 109.4 37.49C465.2 369.3 496 324.1 495.1 277.2V256.3C495.1 107.1 361.2-9.332 207.8 20.73zM239.1 304.3c-26.47 0-48-21.56-48-48.05s21.53-48.05 48-48.05s48 21.56 48 48.05S266.5 304.3 239.1 304.3z"></path>
                </svg>
                <input autocomplete="off" id="logemail" placeholder="Correu electrònic" class="input-field" name="correo" type="email" value="">
            </div>
            <div class="field">
                <svg class="input-icon" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                    <path d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z"></path>
                </svg>
                <input autocomplete="off" placeholder="Contrasenya" class="input-field" name="contra1" type="password" value="">
            </div>
            <div class="field">
                <svg class="input-icon" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                    <path d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z"></path>
                </svg>
                <input autocomplete="off" placeholder="Repita la contraseña" class="input-field" name="contra2" type="password" value="">
            </div>
            

            <button class="btn" type="submit">Crear</button>

            <a class="g_id_signin" href="">
                <img src="{{ asset('assets/google.png') }}" alt="Google Logo" class="google-logo" width="20" height="20"> <!-- Logo opcional -->
                Iniciar sesión con Google</a>


            <a class="btn-github" href="index.php?pagina=hybridauth">
                <img src="{{ asset('assets/github.png') }}" alt="GitHub Logo" class="github-logo">
                Iniciar sesión con GitHub</a>


            <a href="" class="btn-link">Tengo una cuenta</a>
        </form>
    </div>
    <script>
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId()); // No envíes esto a tu servidor
            console.log('Nombre: ' + profile.getName());
            console.log('Imagen: ' + profile.getImageUrl());
            console.log('Correo: ' + profile.getEmail());

            // Aquí puedes enviar el token a tu servidor
            var id_token = googleUser.getAuthResponse().id_token;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'OAuth_google.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log('Signed in as: ' + xhr.responseText);
            };
            xhr.send('id_token=' + id_token);
        }
    </script>
</body>

</html>