/* Progressive homepage interactions; no dependency on admin or legacy app.js. */
(() => {
    const header = document.querySelector('.ps-header');
    const toggle = document.querySelector('.ps-menu-toggle');
    const menu = document.getElementById('ps-mobile-menu');
    const mobile = window.matchMedia('(max-width: 1199px)');
    function closeMenu(restore = false) {
        menu.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
        if (restore) toggle.focus();
    }
    toggle.addEventListener('click', () => {
        const opening = menu.hidden;
        menu.hidden = !opening;
        toggle.setAttribute('aria-expanded', String(opening));
        if (opening) menu.querySelector('a').focus();
    });
    menu.addEventListener('click', (event) => {
        if (event.target.closest('a')) closeMenu();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !menu.hidden) closeMenu(true);
    });
    document.addEventListener('click', (event) => {
        if (!menu.hidden && !header.contains(event.target)) closeMenu();
    });
    mobile.addEventListener('change', () => { if (!mobile.matches) closeMenu(); });
    // This is an inline disclosure, not a modal drawer; keyboard focus remains free.
    let scrollQueued = false;
    window.addEventListener('scroll', () => {
        if (scrollQueued) return;
        scrollQueued = true;
        requestAnimationFrame(() => {
            header.classList.toggle('is-scrolled', window.scrollY > 20);
            scrollQueued = false;
        });
    }, { passive: true });
    const dialog = document.getElementById('ps-lightbox');
    const image = dialog.querySelector('img');
    const caption = document.getElementById('ps-lightbox-caption');
    const original = document.getElementById('ps-lightbox-original');
    let opener;
    if (typeof dialog.showModal === 'function') {
        document.querySelectorAll('[data-ps-lightbox]').forEach(link => {
            link.addEventListener('click', event => {
                if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
                event.preventDefault();
                opener = link;
                image.src = link.href;
                image.alt = link.dataset.caption || link.querySelector('img')?.alt || '';
                caption.textContent = image.alt;
                if (original) original.href = link.href;
                dialog.showModal();
                document.body.classList.add('ps-modal-open');
            });
        });
        dialog.querySelector('button').addEventListener('click', () => dialog.close());
        dialog.addEventListener('click', event => { if (event.target === dialog) { const r = dialog.getBoundingClientRect(); if (event.clientX < r.left || event.clientX > r.right || event.clientY < r.top || event.clientY > r.bottom) dialog.close(); } });
        dialog.addEventListener('close', () => { document.body.classList.remove('ps-modal-open'); opener?.focus(); });
    }
    // Keep real image links usable even without JS. Failed images do not show broken icons.
    document.querySelectorAll('img').forEach(img => {
        const fail = () => { img.hidden = true; const parent = img.closest('[data-ps-lightbox]'); if (parent) { parent.removeAttribute('data-ps-lightbox'); parent.setAttribute('aria-label', img.alt); } };
        img.addEventListener('error', fail, { once: true });
        if (img.complete && img.naturalWidth === 0) fail();
    });
})();
