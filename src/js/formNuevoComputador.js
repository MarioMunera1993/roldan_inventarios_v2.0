document.addEventListener('DOMContentLoaded', function() {
    const marcaSelect = document.getElementById('idMarca');
    const modeloSelect = document.getElementById('idModelo');

    // Limpiar modelos al inicio
    modeloSelect.innerHTML = '<option value="">Seleccione primero una marca</option>';

    // Función para cargar los modelos según la marca seleccionada
    marcaSelect.addEventListener('change', function() {
        const idMarca = this.value;
        
        // Si no hay marca seleccionada, limpiar y deshabilitar el select de modelos
        if (!idMarca) {
            modeloSelect.innerHTML = '<option value="">Seleccione primero una marca</option>';
            return;
        }

        modeloSelect.innerHTML = '<option value="">Cargando modelos...</option>';

        if (!idMarca) {
            modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
            return;
        }

        // Realizar la petición AJAX
        const formData = new FormData();
        formData.append('idMarca', idMarca);

        fetch('../php/getModelosPorMarca.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(modelos => {
            modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
            modelos.forEach(modelo => {
                const option = document.createElement('option');
                option.value = modelo.IdModelo;
                option.textContent = modelo.NombreModelo;
                modeloSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            modeloSelect.innerHTML = '<option value="">Error al cargar modelos</option>';
        });
    });
});
