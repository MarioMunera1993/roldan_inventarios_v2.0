document.addEventListener('DOMContentLoaded', function() {
    // Obtener el botón de generar Excel
    const excelButton = document.querySelector('.button--excel');

    // Función para descargar el Excel
    function descargarExcel() {
        // Mostrar indicador de carga en el botón
        const textoOriginal = excelButton.innerHTML;
        excelButton.innerHTML = '⌛ Generando...';
        excelButton.style.pointerEvents = 'none';

        // Redirigir directamente al archivo PHP
        window.location.href = 'descargaExcelComputadores.php';

        // Restaurar el botón después de un breve delay
        setTimeout(() => {
            excelButton.innerHTML = textoOriginal;
            excelButton.style.pointerEvents = 'auto';
        }, 1000);
    }

    // Agregar evento al botón
    excelButton.addEventListener('click', function(e) {
        e.preventDefault();
        descargarExcel();
    });
});
