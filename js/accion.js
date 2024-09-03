$(document).ready(function() {
  $('.finalizar').on('click', function() {
    var id = $(this).data('id'); // Obtener el valor del atributo data-id del botón

    // Eliminar el valor almacenado en el localStorage
    localStorage.removeItem('selectedOption-' + id);

    // Restablecer el valor seleccionado en el select
    var selectElement = $('#selectCodigo-' + id);
    selectElement.val('');

    // Actualizar el campo de resultado
    var resultElement = $('#result-' + id);
    resultElement.val('');

    // Limpiar la capa de resultado
    var capaResultado = $(this).closest('td').prev('td').find('.capaResultado');
    capaResultado.empty();
  });
});

  