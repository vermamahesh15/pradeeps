/* Progressive homepage interactions; no dependency on admin or legacy app.js. */
(() => {
    const header = document.querySelector('.ps-header') || document.querySelector('header');
    const toggle = document.querySelector('.ps-menu-toggle') || document.getElementById('ps-mobile-toggle');
    const menu = document.getElementById('ps-mobile-menu') || document.getElementById('ps-mobile-menu-drawer');
    const mobile = window.matchMedia('(max-width: 1199px)');
    function closeMenu(restore = false) {
        if (!menu) return;
        menu.hidden = true;
        menu.classList.add('hidden');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
        if (restore && toggle) toggle.focus();
    }
    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            const isHidden = menu.hidden || menu.classList.contains('hidden');
            menu.hidden = !isHidden;
            menu.classList.toggle('hidden', !isHidden);
            toggle.setAttribute('aria-expanded', String(isHidden));
            if (isHidden) {
                const firstLink = menu.querySelector('a');
                if (firstLink) firstLink.focus();
            }
        });
        menu.addEventListener('click', (event) => {
            if (event.target.closest('a')) closeMenu();
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && (!menu.hidden || !menu.classList.contains('hidden'))) closeMenu(true);
        });
        document.addEventListener('click', (event) => {
            if (header && !header.contains(event.target)) closeMenu();
        });
        mobile.addEventListener('change', () => { if (!mobile.matches) closeMenu(); });
    }
    // This is an inline disclosure, not a modal drawer; keyboard focus remains free.
    let scrollQueued = false;
    if (header) {
        window.addEventListener('scroll', () => {
            if (scrollQueued) return;
            scrollQueued = true;
            requestAnimationFrame(() => {
                header.classList.toggle('is-scrolled', window.scrollY > 20);
                scrollQueued = false;
            });
        }, { passive: true });
    }
    const dialog = document.getElementById('ps-lightbox');
    const image = dialog ? dialog.querySelector('img') : null;
    const caption = document.getElementById('ps-lightbox-caption');
    const original = document.getElementById('ps-lightbox-original');
    let opener;
    if (dialog && image && typeof dialog.showModal === 'function') {
        document.querySelectorAll('[data-ps-lightbox]').forEach(link => {
            link.addEventListener('click', event => {
                if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
                event.preventDefault();
                opener = link;
                image.src = link.href;
                image.alt = link.dataset.caption || link.querySelector('img')?.alt || '';
                if (caption) caption.textContent = image.alt;
                if (original) original.href = link.href;
                dialog.showModal();
                document.body.classList.add('ps-modal-open');
            });
        });
        const closeBtn = dialog.querySelector('button');
        if (closeBtn) closeBtn.addEventListener('click', () => dialog.close());
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
