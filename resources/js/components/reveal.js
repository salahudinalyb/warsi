const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const easeOutExpo = (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t));

const runCountUp = (el) => {
    const target = parseFloat(el.dataset.countTo);
    if (Number.isNaN(target)) return;

    const decimals = parseInt(el.dataset.countDecimals || '0', 10);
    const duration = parseInt(el.dataset.countDuration || '1400', 10);
    const formatter = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals,
    });

    if (prefersReducedMotion()) {
        el.textContent = formatter.format(target);
        return;
    }

    const start = performance.now();
    const tick = (now) => {
        const progress = Math.min(1, (now - start) / duration);
        const value = target * easeOutExpo(progress);
        el.textContent = formatter.format(value);
        if (progress < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
};

export const initReveal = () => {
    const revealEls = document.querySelectorAll('[data-reveal]');
    const countEls = document.querySelectorAll('[data-count-to]');

    if (prefersReducedMotion()) {
        countEls.forEach(runCountUp);
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            if (entry.target.hasAttribute('data-count-to')) {
                runCountUp(entry.target);
            }
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.25, rootMargin: '0px 0px -40px 0px' });

    revealEls.forEach((el) => observer.observe(el));
    countEls.forEach((el) => {
        if (!el.hasAttribute('data-reveal')) observer.observe(el);
    });
};

export default initReveal;
