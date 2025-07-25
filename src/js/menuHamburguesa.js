document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('appSidebar');
    let overlay = null;

    if (!btn || !sidebar) return;

    btn.addEventListener('click', function() {
        sidebar.classList.toggle('open');
        if (sidebar.classList.contains('open')) {
            overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            document.body.appendChild(overlay);
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                document.body.removeChild(overlay);
            });
        } else if (overlay) {
            document.body.removeChild(overlay);
        }
    });
});
