$(document).ready(function () {
    $('.guardar').on('click', function () {
        var fila = $(this).closest('.fila-datos');
        var id = fila.attr('value');
        var id_aprovisionamiento = fila.find('[name="id_aprovisionamiento"]').text();
        var estado_actual = fila.find('[name="estado_actual"]').text();
        var fecha_creacion = fila.find('[name="fecha_creacion"]').text();
        var ans = fila.find('[name="ans"]').text();
        var cuenta_cliente = fila.find('[name="cuenta_cliente"]').text();
        var asignado_a = fila.find('[name="asignado_a"]').text();
        var ciudad_instalacion = fila.find('[name="ciudad_instalacion"]').text();
        var u_anotacion_resumen = fila.find('[name="u_anotacion_resumen"]').val();
        var segmento = fila.find('[name="segmento"]').text();
        var estado = fila.find('[name="estado_historial"]').val();
        var codigo_historial = fila.find('[name="codigo_historial"]').val();
        var infoCodigo = fila.find('[name="info_codigo_historial"]').text();
        var fecha_proyeccion_historial = fila.find('[name="fecha_proyeccion_historial"]').val();
        var observacion = fila.find('[name="observaciones_historial"]').val();
        
        
        if (estado !== '' && codigo_historial !== '' && infoCodigo !== '' && fecha_proyeccion_historial !== '') {
            // Enviar los datos a PHP utilizando AJAX
            $.ajax({
                url: 'guardar_historial.php',
                method: 'POST',
                data: {
                    id: id,
                    id_aprovisionamiento: id_aprovisionamiento,
                    estado_actual: estado_actual,
                    fecha_creacion: fecha_creacion,
                    ans: ans,
                    cuenta_cliente: cuenta_cliente,
                    asignado_a: asignado_a,
                    ciudad_instalacion: ciudad_instalacion,
                    u_anotacion_resumen: u_anotacion_resumen,
                    segmento: segmento,
                    estado_historial: estado,
                    codigo_historial: codigo_historial,
                    info_codigo_historial: infoCodigo,
                    fecha_proyeccion_historial: fecha_proyeccion_historial,
                    observaciones_historial: observacion
                },

                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario

                    Swal.fire({
                        title: "Éxito",
                        text: response,
                        icon: "success",
                        confirmButtonText: "Aceptar"
                    });

                    // Limpiar los datos de los inputs
                    fila.find('[name="estado_historial"]').val('');
                    fila.find('[name="codigo_historial"]').val('');
                    fila.find('[name="info_codigo_historial"]').text('');
                    fila.find('[name="fecha_proyeccion_historial"]').text('');
                    fila.find('[name="observaciones_historial"]').val('');

                    // Obtener el ID del elemento
                    var id = fila.attr('value');

                    // Cargar solo la columna actualizada
                    $.ajax({
                        url: 'obtener_datos.php', // Cambiar esto por la URL correcta que obtenga los datos actualizados de la columna
                        method: 'POST',
                        data: { id: id },
                        success: function (columnaData) {
                            fila.find('[name="u_anotacion_resumen"]').text(columnaData);
                        }
                    });

                    // Cambiar la opción seleccionada a 'SI' y guardar en almacenamiento local
                    var selectElement = fila.find('.selectCodigo');
                    var idOcElement = selectElement.closest('.fila-datos').find('#id_oc');
                    var idOc = idOcElement.val();
                    selectElement.val('1');
                    localStorage.setItem('selectedOption-' + idOc, '1');
                    updateResultElement(selectElement, '1');
                    applyFilter();
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor ingrese todos los datos'
            })
        }
    });

    $('.selectCodigo').on('change', function () {
        var idOcElement = $(this).closest('.fila-datos').find('#id_oc');
        var idOc = idOcElement.val();
        var selectedValue = $(this).val();
        localStorage.setItem('selectedOption-' + idOc, selectedValue);
        updateResultElement($(this), selectedValue);
        applyFilter();
    });
});

function updateResultElement(selectElement, selectedValue) {
    var idOcElement = selectElement.closest('.fila-datos').find('#id_oc');
    var idOc = idOcElement.val();
    var resultElement = selectElement.closest('.fila-datos').find('#result-' + idOc);
    resultElement.val(selectedValue === '1' ? 'SI' : 'NO');
}

function applyFilter() {
    var selectedOption = filtroElement.val();

    selectElements.forEach(function (selectElement) {
        var idOcElement = selectElement.closest('.fila-datos').find('#id_oc');
        if (idOcElement) {
            var idOc = idOcElement.val();
            var rowElement = $('tr[value="' + idOc + '"]');
            var resultElement = rowElement.find('#result-' + idOc);
            var resultValue = resultElement.val();

            if (selectedOption === '' || (selectedOption === '1' && resultValue === 'SI') || (selectedOption === '2' && resultValue === 'NO')) {
                rowElement.css('display', '');
            } else {
                rowElement.css('display', 'none');
            }
        }
    });
}
