// archivo para exportar los excel con extension xlsx

function exportar() {
    // Envía una solicitud AJAX al archivo PHP que maneja la exportación a Excel
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'exportar_Excel.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Descarga el archivo XLSX generado
            var downloadLink = document.createElement('a');
            downloadLink.href = window.URL.createObjectURL(xhr.response);
            downloadLink.download = 'archivo.xlsx';
            downloadLink.click();
        }
    };
    xhr.responseType = 'blob';
    xhr.send('export_data=true');
}