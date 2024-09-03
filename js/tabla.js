//Funcion para crear la tabla con datatable

$(document).ready(function() {
    var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        }
    });

    // Creamos una fila en el head de la tabla y lo clonamos para cada columna
    $('#example thead tr').clone(true).appendTo('#example thead');

    $('#example thead tr:eq(1) th').each(function(i) {
        var title = $(this).text(); // es el nombre de la columna
        $(this).html('<input type="text" placeholder="Buscar...' + title + '" />');

        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });
    
});


