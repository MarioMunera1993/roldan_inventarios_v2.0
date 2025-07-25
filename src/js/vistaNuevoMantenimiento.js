document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchMantInput');
  const table = document.getElementById('mantTable');
  if (searchInput && table) {
    searchInput.addEventListener('input', function() {
      const term = this.value.toLowerCase();
      const rows = table.querySelectorAll('tbody tr');
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
      });
    });
  }
  // Lógica para eliminar mantenimiento
  table.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-eliminar-mant')) {
      const id = e.target.getAttribute('data-id');
      if (confirm('¿Está seguro de eliminar este mantenimiento?')) {
        fetch('eliminar_mantenimiento.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'id=' + encodeURIComponent(id)
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            // Eliminar la fila de la tabla
            e.target.closest('tr').remove();
          } else {
            alert('No se pudo eliminar: ' + (data.message || 'Error desconocido'));
          }
        })
        .catch(() => alert('Error al intentar eliminar.'));
      }
    }
  });
});
