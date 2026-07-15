'use strict';

const wholesalePro = {

  init() {
    this.initStickyHeader();
    this.initCounters();
    this.initScrollAnimations();
    this.initBackToTop();
    this.initSmoothScroll();
    this.initCookieConsent();
    this.initReadingProgress();
    this.initAnalytics();
  },

  /* ── Sticky Header ────────────────────────────────────────── */
  initStickyHeader() {
    const header = document.getElementById('site-header');
    if (!header) return;
    const onScroll = this.throttle(() => {
      header.classList.toggle('scrolled', window.scrollY > 80);
    }, 100);
    window.addEventListener('scroll', onScroll, { passive: true });
  },

  /* ── Counters ─────────────────────────────────────────────── */
  initCounters() {
    const els = document.querySelectorAll('.trust-bar__number[data-count]');
    if (!els.length) return;

    const easeOutQuad = t => t * (2 - t);

    const animateCounter = (el, target, isDecimal) => {
      const start     = performance.now();
      const duration  = 2000;
      const from      = 0;

      const step = now => {
        const elapsed  = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased    = easeOutQuad(progress);
        const current  = from + (target - from) * eased;
        el.textContent = isDecimal
          ? current.toFixed(1)
          : Math.floor(current).toLocaleString();
        if (progress < 1) requestAnimationFrame(step);
        else {
          el.textContent = isDecimal
            ? target.toFixed(1)
            : target.toLocaleString();
          el.classList.add('counted');
        }
      };
      requestAnimationFrame(step);
    };

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (!entry.isIntersecting) return;
          const el        = entry.target;
          const raw       = el.getAttribute('data-count');
          const isDecimal = raw.includes('.');
          const target    = parseFloat(raw);
          animateCounter(el, target, isDecimal);
          observer.unobserve(el);
        });
      }, { threshold: 0.5 });
      els.forEach(el => observer.observe(el));
    } else {
      els.forEach(el => {
        const raw = el.getAttribute('data-count');
        el.textContent = parseFloat(raw).toLocaleString();
      });
    }
  },

  /* ── Scroll Animations ────────────────────────────────────── */
  initScrollAnimations() {
    const els = document.querySelectorAll('.animate-on-scroll, .animate-left, .animate-right, .animate-scale');
    if (!els.length) return;

    if (!('IntersectionObserver' in window)) {
      els.forEach(el => el.classList.add('animated'));
      return;
    }

    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('animated');
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    els.forEach(el => observer.observe(el));
  },

  /* ── Back to Top ──────────────────────────────────────────── */
  initBackToTop() {
    const btn = document.querySelector('.back-to-top');
    if (!btn) return;
    const onScroll = this.throttle(() => {
      btn.classList.toggle('visible', window.scrollY > 400);
    }, 200);
    window.addEventListener('scroll', onScroll, { passive: true });
    btn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
      btn.blur();
    });
  },

  /* ── Smooth Scroll ────────────────────────────────────────── */
  initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', e => {
        const id = anchor.getAttribute('href');
        if (!id || id === '#') return;
        const target = document.querySelector(id);
        if (!target) return;
        e.preventDefault();
        const header      = document.getElementById('site-header');
        const headerH     = header ? header.offsetHeight : 0;
        const offset      = target.getBoundingClientRect().top + window.scrollY - headerH - 16;
        window.scrollTo({ top: offset, behavior: 'smooth' });
        // Update URL without triggering scroll
        history.pushState(null, '', id);
      });
    });
  },

  /* ── Cookie Consent ───────────────────────────────────────── */
  initCookieConsent() {
    if (localStorage.getItem('wp-cookie-consent')) return;

    const bar = document.createElement('div');
    bar.className  = 'cookie-bar';
    bar.setAttribute('role', 'region');
    bar.setAttribute('aria-label', 'Cookie notice');
    bar.innerHTML = `
      <p class="cookie-bar__text">
        We use cookies to improve your experience and analyze site traffic.
        By continuing you agree to our
        <a href="/privacy-policy" rel="noopener">Privacy Policy</a>.
      </p>
      <button class="cookie-bar__btn" type="button">Accept</button>
    `;
    document.body.appendChild(bar);

    bar.querySelector('.cookie-bar__btn').addEventListener('click', () => {
      localStorage.setItem('wp-cookie-consent', '1');
      bar.style.transition = 'transform 0.3s ease';
      bar.style.transform  = 'translateY(100%)';
      setTimeout(() => bar.remove(), 350);
    });
  },

  /* ── Reading Progress Bar ─────────────────────────────────── */
  initReadingProgress() {
    const bar = document.querySelector('.reading-progress');
    if (!bar) return;
    const onScroll = this.throttle(() => {
      const doc     = document.documentElement;
      const scrolled = doc.scrollTop || document.body.scrollTop;
      const total    = doc.scrollHeight - doc.clientHeight;
      const pct      = total > 0 ? (scrolled / total) * 100 : 0;
      bar.style.width = pct + '%';
    }, 50);
    window.addEventListener('scroll', onScroll, { passive: true });
  },

  /* ── Analytics Tracking ───────────────────────────────────── */
  initAnalytics() {
    // Phone link clicks
    document.querySelectorAll('a[href^="tel:"]').forEach(link => {
      link.addEventListener('click', () => {
        this.trackEvent('phone_click', { phone: link.href });
      });
    });
    // CTA clicks
    document.querySelectorAll('.btn--seller').forEach(btn => {
      btn.addEventListener('click', () => {
        this.trackEvent('seller_cta_click', { text: btn.textContent.trim() });
      });
    });
    document.querySelectorAll('.btn--buyer').forEach(btn => {
      btn.addEventListener('click', () => {
        this.trackEvent('buyer_cta_click', { text: btn.textContent.trim() });
      });
    });
  },

  trackEvent(name, params) {
    if (typeof gtag === 'function') {
      gtag('event', name, params);
    }
    if (typeof fbq === 'function') {
      fbq('trackCustom', name, params);
    }
  },

  /* ── Utilities ────────────────────────────────────────────── */
  throttle(fn, ms) {
    let last = 0;
    return function (...args) {
      const now = Date.now();
      if (now - last < ms) return;
      last = now;
      fn.apply(this, args);
    };
  },

  debounce(fn, ms) {
    let timer;
    return function (...args) {
      clearTimeout(timer);
      timer = setTimeout(() => fn.apply(this, args), ms);
    };
  },
};

document.addEventListener('DOMContentLoaded', () => wholesalePro.init());

// Expose globally for inline callbacks
window.wholesalePro = wholesalePro;
