/* Progressive homepage interactions; no dependency on admin or legacy app.js. */
(() => {
    const header = document.querySelector('.ps-header') || document.querySelector('header');
    const toggle = document.querySelector('.ps-menu-toggle') || document.getElementById('ps-mobile-toggle');
    const drawer = document.getElementById('ps-mobile-menu-drawer');
    const backdrop = document.getElementById('ps-mobile-backdrop');
    const legacyMenu = document.getElementById('ps-mobile-menu');
    const mobile = window.matchMedia('(max-width: 1279px)');

    function openMobileDrawer() {
        if (!drawer) return;
        if (backdrop) {
            backdrop.classList.remove('pointer-events-none', 'opacity-0');
            backdrop.classList.add('opacity-100');
        }
        drawer.classList.remove('translate-x-full');
        drawer.classList.add('translate-x-0');
        document.body.style.overflow = 'hidden';
        if (toggle) toggle.setAttribute('aria-expanded', 'true');
    }

    function closeMobileDrawer(restore = false) {
        if (drawer) {
            drawer.classList.remove('translate-x-0');
            drawer.classList.add('translate-x-full');
        }
        if (backdrop) {
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
        }
        document.body.style.overflow = '';
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
        if (restore && toggle) toggle.focus();
    }

    function toggleMobileDrawer() {
        if (!drawer) return;
        if (drawer.classList.contains('translate-x-0')) {
            closeMobileDrawer();
        } else {
            openMobileDrawer();
        }
    }

    window.openMobileDrawer = openMobileDrawer;
    window.closeMobileDrawer = closeMobileDrawer;
    window.toggleMobileDrawer = toggleMobileDrawer;

    if (toggle && drawer) {
        drawer.addEventListener('click', (event) => {
            if (event.target.closest('a')) closeMobileDrawer();
        });
        if (backdrop) {
            backdrop.addEventListener('click', () => closeMobileDrawer());
        }
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && drawer.classList.contains('translate-x-0')) closeMobileDrawer(true);
        });
        mobile.addEventListener('change', () => { if (!mobile.matches) closeMobileDrawer(); });
    } else if (toggle && legacyMenu) {
        function closeLegacy(restore = false) {
            legacyMenu.hidden = true;
            legacyMenu.classList.add('hidden');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
            if (restore && toggle) toggle.focus();
        }
        toggle.addEventListener('click', () => {
            const isHidden = legacyMenu.hidden || legacyMenu.classList.contains('hidden');
            legacyMenu.hidden = !isHidden;
            legacyMenu.classList.toggle('hidden', !isHidden);
            toggle.setAttribute('aria-expanded', String(isHidden));
            if (isHidden) {
                const firstLink = legacyMenu.querySelector('a');
                if (firstLink) firstLink.focus();
            }
        });
        legacyMenu.addEventListener('click', (event) => {
            if (event.target.closest('a')) closeLegacy();
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && (!legacyMenu.hidden || !legacyMenu.classList.contains('hidden'))) closeLegacy(true);
        });
        document.addEventListener('click', (event) => {
            if (header && !header.contains(event.target)) closeLegacy();
        });
        mobile.addEventListener('change', () => { if (!mobile.matches) closeLegacy(); });
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
                image.hidden = false;
                image.removeAttribute('hidden');
                image.style.display = '';
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
        if (img.id === 'ps-lightbox-img' || img.closest('#ps-lightbox')) return;
        const fail = () => { img.hidden = true; const parent = img.closest('[data-ps-lightbox]'); if (parent) { parent.removeAttribute('data-ps-lightbox'); parent.setAttribute('aria-label', img.alt); } };
        img.addEventListener('error', fail, { once: true });
        if (img.src && img.complete && img.naturalWidth === 0) fail();
    });
})();
