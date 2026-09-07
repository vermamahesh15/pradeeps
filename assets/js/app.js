/**
 * PRADEEP SARANG - INTERACTIVE APPLICATION ENGINE
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Native Smooth Reveal
    const revealElements = document.querySelectorAll('.fade-in-up');
    if ('IntersectionObserver' in window && revealElements.length > 0) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        revealElements.forEach(el => revealObserver.observe(el));
    }

    // 2. Interactive Typewriter Headline Effect
    const typeWriterEl = document.getElementById('typeWriterText');
    if (typeWriterEl) {
        const words = ['सामाजिक कार्यकर्ता', 'संवेदनशील साहित्यकार', 'पर्यावरण संरक्षक', 'रक्तदान प्रेरक', 'समर्पित जनसेवक'];
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typeSpeed = 100;

        function type() {
            const currentWord = words[wordIndex];
            if (isDeleting) {
                typeWriterEl.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
                typeSpeed = 50;
            } else {
                typeWriterEl.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
                typeSpeed = 100;
            }

            if (!isDeleting && charIndex === currentWord.length) {
                isDeleting = true;
                typeSpeed = 1800; // Pause at end of word
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                typeSpeed = 400; // Pause before typing next word
            }

            setTimeout(type, typeSpeed);
        }
        type();
    }

    // 3. Rolling Animated Counters (Intersection Observer)
    const counters = document.querySelectorAll('.stat-number-animated');
    if (counters.length > 0) {
        const countUpObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target') || '0', 10);
                    const suffix = counter.getAttribute('data-suffix') || '+';
                    const duration = 2000;
                    const stepTime = 20;
                    const steps = duration / stepTime;
                    const increment = target / steps;
                    let current = 0;

                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            counter.textContent = target.toLocaleString('en-IN') + suffix;
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(current).toLocaleString('en-IN') + suffix;
                        }
                    }, stepTime);

                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.2 });

        counters.forEach(counter => countUpObserver.observe(counter));
    }

    // 4. Interactive 3D Tilt Card on Hero
    const tiltCard = document.querySelector('.interactive-3d-card');
    if (tiltCard) {
        tiltCard.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            const rotateX = -(y / rect.height) * 14;
            const rotateY = (x / rect.width) * 14;
            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        }, { passive: true });

        tiltCard.addEventListener('mouseleave', function () {
            this.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        });
    }

    // 5. Interactive Category Filter (Portfolio & Impacts)
    const filterButtons = document.querySelectorAll('.interactive-filter-btn');
    const filterCards = document.querySelectorAll('.filterable-card');
    if (filterButtons.length > 0 && filterCards.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                filterButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const category = this.getAttribute('data-filter');

                filterCards.forEach(card => {
                    const cardCat = card.getAttribute('data-category') || '';
                    if (category === 'all' || cardCat.toLowerCase().includes(category.toLowerCase())) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0) scale(1)';
                        }, 50);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(15px) scale(0.95)';
                        setTimeout(() => { card.style.display = 'none'; }, 250);
                    }
                });
            });
        });
    }

    // 6. Interactive Quick Excerpt Modal for Literary Works
    document.querySelectorAll('.quick-read-trigger').forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            const title = this.getAttribute('data-title');
            const author = this.getAttribute('data-author') || 'प्रदीप सारंग';
            const category = this.getAttribute('data-category') || 'साहित्य';
            const excerpt = this.getAttribute('data-excerpt');
            const link = this.getAttribute('data-link');

            const modalHtml = `
                <div class="modal fade" id="quickReadModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg" style="background:#faf6ee;border:2px solid #e3d7c3;border-radius:12px;">
                            <div class="modal-header border-bottom border-warning border-opacity-25 pb-3">
                                <div>
                                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill small">${category}</span>
                                    <h4 class="modal-title fw-bold text-dark mt-1" style="font-family:'Noto Serif Devanagari',serif;">${title}</h4>
                                    <small class="text-muted">लेखक: ${author}</small>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body py-4" style="font-family:'Noto Serif Devanagari',serif;font-size:1.15rem;line-height:2.2;text-align:justify;color:#2c2420;">
                                <div class="p-3 bg-white rounded-3 border shadow-sm mb-3">
                                    <p class="mb-0 text-indent">${excerpt}</p>
                                </div>
                                <div class="alert alert-warning d-flex align-items-center gap-2 small mb-0">
                                    <i class="fa-solid fa-book-open"></i>
                                    <span>यह केवल एक प्रारंभिक झलक है। पूरी रचना को पुस्तक स्वरूप में पढ़ने के लिए नीचे दिए गए बटन पर क्लिक करें।</span>
                                </div>
                            </div>
                            <div class="modal-footer border-top border-warning border-opacity-25 justify-content-between">
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">बंद करें</button>
                                <a href="${link}" class="btn btn-brand">
                                    <i class="fa-solid fa-book-open me-1"></i> पूरा आलेख / पुस्तक रूप में पढ़ें
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;

            const existingModal = document.getElementById('quickReadModal');
            if (existingModal) existingModal.remove();

            document.body.insertAdjacentHTML('beforeend', modalHtml);
            const modalInstance = new bootstrap.Modal(document.getElementById('quickReadModal'));
            modalInstance.show();
        });
    });

    // 7. Interactive Lightbox for Images & Newspaper Cuttings
    document.querySelectorAll('.lightbox-trigger').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const imgSrc = this.getAttribute('href') || this.getAttribute('data-img');
            const caption = this.getAttribute('data-title') || 'छायाचित्र संकलन';

            const modalHtml = `
                <div class="modal fade" id="imageLightboxModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content bg-transparent border-0">
                            <div class="position-relative text-center">
                                <button type="button" class="btn btn-light rounded-circle position-absolute top-0 end-0 m-3 shadow" data-bs-dismiss="modal" style="width:40px;height:40px;z-index:10;"><i class="fa-solid fa-xmark"></i></button>
                                <img src="${imgSrc}" class="img-fluid rounded-4 shadow-lg border border-4 border-white" style="max-height:85vh;object-fit:contain;" alt="${caption}">
                                <div class="p-3 bg-dark bg-opacity-75 text-white rounded-3 mt-2 d-inline-block shadow">${caption}</div>
                            </div>
                        </div>
                    </div>
                </div>`;

            const existingModal = document.getElementById('imageLightboxModal');
            if (existingModal) existingModal.remove();

            document.body.insertAdjacentHTML('beforeend', modalHtml);
            const modalInstance = new bootstrap.Modal(document.getElementById('imageLightboxModal'));
            modalInstance.show();
        });
    });

    // 8. Floating Speed-Dial Action Hub Toggle
    const speedDialToggle = document.getElementById('speedDialToggle');
    const speedDialMenu = document.getElementById('speedDialMenu');
    if (speedDialToggle && speedDialMenu) {
        speedDialToggle.addEventListener('click', function () {
            speedDialMenu.classList.toggle('active');
            this.classList.toggle('open');
        });
    }
});
