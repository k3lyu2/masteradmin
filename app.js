document.querySelector('[data-sidebar-toggle]')?.addEventListener('click', function () {
    document.querySelector('[data-sidebar]')?.classList.toggle('open');
});

document.querySelectorAll('.treeview-title').forEach(function (button) {
    button.addEventListener('click', function () {
        button.closest('.treeview')?.classList.toggle('open');
    });
});

document.querySelectorAll('[data-confirm]').forEach(function (link) {
    link.addEventListener('click', function (event) {
        if (!window.confirm(link.dataset.confirm || 'Lanjutkan proses ini?')) {
            event.preventDefault();
        }
    });
});
