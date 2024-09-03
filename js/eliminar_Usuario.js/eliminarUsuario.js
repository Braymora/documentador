// Función para establecer el ID y nombre del usuario en el modal
function setUsuarioID(id, nombre) {
    document.getElementById('idUsuario').value = id;
    document.getElementById('nombreUsuario').textContent = nombre;
}

// Función para eliminar el usuario
function eliminarUsuario() {
    var idUsuario = document.getElementById('idUsuario').value;
    var url = 'controller/eliminar_usuarioC.php?id=' + idUsuario;
    window.location.href = url;
}