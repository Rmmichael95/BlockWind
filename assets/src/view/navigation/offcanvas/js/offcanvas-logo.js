(() => {
  const ROOT = document.documentElement;

  function mount() {
    const dialog = document.querySelector('.site-nav .wp-block-navigation__responsive-dialog');
    if (!dialog) return;

    // If already mounted, bail
    if (dialog.querySelector('.offcanvas-site-logo')) return;

    const logo = document.querySelector('.wp-block-site-logo');
    if (!logo) return;

    const clone = logo.cloneNode(true);
    clone.classList.add('offcanvas-site-logo');

    // Put it at the very top of the dialog
    dialog.insertBefore(clone, dialog.firstChild);
  }

  function unmount() {
    document.querySelectorAll('.offcanvas-site-logo').forEach((n) => n.remove());
  }

  // Watch for menu open/close (WP toggles has-modal-open)
  const obs = new MutationObserver(() => {
    if (ROOT.classList.contains('has-modal-open')) mount();
    else unmount();
  });

  obs.observe(ROOT, { attributes: true, attributeFilter: ['class'] });

  // initial
  if (ROOT.classList.contains('has-modal-open')) mount();
})();
