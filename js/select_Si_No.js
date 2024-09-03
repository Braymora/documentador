var selectElements = document.querySelectorAll('.selectCodigo');
var filtroElement = document.getElementById('filtro');

selectElements.forEach(function (selectElement) {
    var idOcElement = selectElement.parentNode.querySelector('#id_oc');

    if (idOcElement) {
        var idOc = idOcElement.value;
        var storedValue = localStorage.getItem('selectedOption-' + idOc);

        // Establecer valor predeterminado a "NO" si no hay ningún valor almacenado previamente
        if (!storedValue) {
            storedValue = '2'; // '2' representa "NO"
            localStorage.setItem('selectedOption-' + idOc, storedValue);
        }

        selectElement.value = storedValue;
        updateResultElement(selectElement, storedValue);

        selectElement.addEventListener('change', function () {
            var selectedValue = selectElement.value;
            localStorage.setItem('selectedOption-' + idOc, selectedValue);
            updateResultElement(selectElement, selectedValue);
            applyFilter();
        });
    }
});

filtroElement.addEventListener('change', function () {
    applyFilter();
});

function updateResultElement(selectElement, selectedValue) {
    var idOcElement = selectElement.parentNode.querySelector('#id_oc');

    if (idOcElement) {
        var idOc = idOcElement.value;
        var resultElement = document.getElementById('result-' + idOc);
        resultElement.value = selectedValue === '1' ? 'SI' : 'NO';
    }
}

function applyFilter() {
    var selectedOption = filtroElement.value;

    selectElements.forEach(function (selectElement) {
        var idOcElement = selectElement.parentNode.querySelector('#id_oc');

        if (idOcElement) {
            var idOc = idOcElement.value;
            var rowElement = document.querySelector('tr[value="' + idOc + '"]');
            var resultElement = document.getElementById('result-' + idOc);
            var resultValue = resultElement.value;

            if (selectedOption === '' || (selectedOption === '1' && resultValue === 'SI') || (selectedOption === '2' && resultValue === 'NO')) {
                rowElement.style.display = '';
            } else {
                rowElement.style.display = 'none';
            }
        }
    });
}
