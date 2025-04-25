<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href=" {{ asset('css/admin.css') }}">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">

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
            
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión <i class="uil uil-arrow-right"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="content-admin">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <h1>Administrar Usuarios</h1>
            <input type="text" id="searchInput" placeholder="Buscar por Username o Email" onkeyup="searchUsers()">
            <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-body table-responsive">
                    <table class="table" id="usersTable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Acció</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="#" onclick="openDeleteModal({{ $user->id }})">Eliminar</a></td>
                            </tr>
                            @endforeach
                        <?php
                    //require_once 'Model/Usuarios.php'; // Incluir el modelo que maneja los usuarios

                    // Obtener la lista de usuarios
                    // $usuarios = obtenerUsuarios(); // Asegúrate de tener esta función en tu modelo

                    // foreach ($usuarios as $usuario) {
                    //     echo "<tr>";
                    //     echo "<td>" . htmlspecialchars($usuario['username']) . "</td>";
                    //     echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                    //     echo "<td><a href='#' onclick='openDeleteModal(" . htmlspecialchars($usuario['id']) . ")'>Eliminar</a></td>";
                    //     echo "</tr>";
                    // }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
            <button><a href="{{ route('myArticles') }}">Volver</a></button>

            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" id="closeModal">&times;</span>
                        <h2>Confirmar Eliminación</h2>
                    </div>
                    {{-- <p>¿Desea eliminar este usuario? <input type="text" readonly value="<?php echo htmlspecialchars($usuario['username'])?>"></p> --}}
                    <p>¿También desea eliminar todos los artículos asociados?</p>
                    <form id="deleteForm" method="POST" action="{{ route('deleteUser') }}">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <input type="hidden" name="delete_articles" id="delete_articles" value="false">
                        <button type="button" id="confirmDelete" class="btn">Eliminar Usuario y Artículos</button>
                        <button type="button" id="confirmDeleteUser" class="btn">Eliminar Solo Usuario</button>
                        <button type="button" id="cancelDelete" class="btn">Cancelar</button>
                    </form>
                </div>
            </div>







                    
        </div>
    </div>
    <script>
    // Función para abrir el modal de eliminación
    function openDeleteModal(userId) {
        document.getElementById("user_id").value = userId; // Establecer el ID del usuario a eliminar
        document.getElementById("deleteModal").style.display = "block"; // Mostrar el modal
    }

    // Cerrar el modal cuando se hace clic en la X
    document.getElementById("closeModal").onclick = function() {
        document.getElementById("deleteModal").style.display = "none"; // Cerrar el modal
    }

    // Cerrar el modal cuando se hace clic en "Cancelar"
    document.getElementById("cancelDelete").onclick = function() {
        document.getElementById("deleteModal").style.display = "none"; // Cerrar el modal
    }

    // Confirmar eliminación de usuario y artículos
    document.getElementById("confirmDelete").onclick = function() {
        document.getElementById("delete_articles").value = "true"; // Indicar que se deben eliminar los artículos
        document.getElementById("deleteForm").submit(); // Enviar el formulario
    }

    // Confirmar eliminación solo del usuario
    document.getElementById("confirmDeleteUser").onclick = function() {
        document.getElementById("delete_articles").value = "false"; // Indicar que no se deben eliminar los artículos
        document.getElementById("deleteForm").submit(); // Enviar el formulario
    }

    // Asegúrate de que el modal esté oculto al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("deleteModal").style.display = "none"; // Asegúrate de que el modal esté oculto
    });

    function searchUsers() {
        // Obtener el valor del campo de búsqueda
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase(); // Convertir a minúsculas para hacer la búsqueda insensible a mayúsculas
        const table = document.getElementById('usersTable');
        const tr = table.getElementsByTagName('tr'); // Obtener todas las filas de la tabla

        // Iterar a través de todas las filas de la tabla (excepto la primera que es el encabezado)
        for (let i = 1; i < tr.length; i++) {
            const tdUsername = tr[i].getElementsByTagName('td')[0]; // Obtener la celda de Username
            const tdEmail = tr[i].getElementsByTagName('td')[1]; // Obtener la celda de Email

            if (tdUsername || tdEmail) {
                const usernameValue = tdUsername.textContent || tdUsername.innerText; // Obtener el texto del Username
                const emailValue = tdEmail.textContent || tdEmail.innerText; // Obtener el texto del Email

                // Comprobar si el texto del Username o Email incluye el texto de búsqueda
                if (usernameValue.toLowerCase().indexOf(filter) > -1 || emailValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; // Mostrar la fila si coincide
                } else {
                    tr[i].style.display = "none"; // Ocultar la fila si no coincide
                }
            }
        }
    }
</script>
</body>

</html>