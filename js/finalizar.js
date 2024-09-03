$(document).ready(function () {
    $('.finalizar').on('click', function () {
        var id = $(this).data('id'); // Obtener el ID del registro a finalizar

        // Aquí puedes realizar las acciones necesarias para finalizar el registro, como enviar una solicitud al servidor o actualizar el estado del registro

        // Ejemplo de solicitud AJAX para finalizar el registro
        $.ajax({
            url: 'finalizar_orden.php', // Ruta al script del servidor que maneja la finalización del registro
            type: 'POST',
            data: { id: id }, // Pasar el ID del registro como parámetro
            success: function (response) {
                // Aquí puedes realizar las actualizaciones necesarias en la interfaz de usuario si es necesario, por ejemplo, cambiar el estado del botón o realizar una recarga de la página
                Swal.fire({
                    title: "El registro se ha finalizado correctamente",
                    text: response,
                    icon: "success",
                    confirmButtonText: "Aceptar"
                }).then(function () {
                    window.location.reload();
                });
            },

            error: function (xhr, status, error) {
                // Manejo de errores en caso de que ocurra un problema en la solicitud AJAX
                console.error(error);
                alert('Ha ocurrido un error al finalizar el registro');
            }
        });
    });
});