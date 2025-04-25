
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
        fetch(`/articles/${articleIdToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
document.querySelectorAll('#read').forEach(item => {
    item.addEventListener('click', event => {
        readArticle(item.dataset.id);
    });
});

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
