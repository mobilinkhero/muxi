<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Reveal on Scroll (Intersection Observer)
        const revealCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    // Once animated, no need to observe anymore
                    observer.unobserve(entry.target);
                }
            });
        };

        const revealObserver = new IntersectionObserver(revealCallback, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom').forEach(el => {
            revealObserver.observe(el);
        });

        // 2. Cursor Glow Effect
        const glow = document.createElement('div');
        glow.className = 'cursor-glow';
        document.body.appendChild(glow);

        document.addEventListener('mousemove', (e) => {
            glow.style.left = e.clientX + 'px';
            glow.style.top = e.clientY + 'px';
        });

        // 3. Magnetic Buttons / Cards (Subtle Effect)
        document.querySelectorAll('.btn-primary, .btn-secondary, .dashboard-card').forEach(el => {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const deltaX = (x - centerX) / 10;
                const deltaY = (y - centerY) / 10;

                el.style.transform = `translateY(-5px) translate(${deltaX}px, ${deltaY}px)`;
            });

            el.addEventListener('mouseleave', () => {
                el.style.transform = '';
            });
        });

        // 4. Smooth Anchor Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        console.log('Premium Animations Initialized 🚀');
    });
</script>