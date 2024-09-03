$(document).on('change', '.selectCodigo', function() {
    var fila = $(this).closest('tr');
    var nombreCodigo = $(this).find('option:selected').data('nombre');
    fila.find('[name="info_codigo_historial"]').text(nombreCodigo);
});
