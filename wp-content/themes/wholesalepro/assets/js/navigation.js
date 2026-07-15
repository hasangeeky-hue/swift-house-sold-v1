'use strict';

const Navigation = {

  toggle:  null,
  overlay: null,
  close:   null,
  body:    null,
  focusableSelectors: 'a[href], button:not([disabled]), input:not([disabled]), [tabindex]:not([tabindex="-1"])',

  init() {
    this.toggle  = document.querySelector('.js-nav-toggle');
    this.overlay = document.querySelector('.js-nav-overlay');
    this.close   = document.querySelector('.js-nav-close');
    this.body    = document.body;

    if (!this.toggle || !this.overlay) return;

    this.initMobileMenu();
    this.initKeyboardNav();
    this.initDropdowns();
    this.initActiveLinks();
  },

  /* ── Mobile Menu ──────────────────────────────────────────── */
  initMobileMenu() {
    // Open
    this.toggle.addEventListener('click', () => this.openMenu());

    // Close button
    if (this.close) {
      this.close.addEventListener('click', () => this.closeMenu());
    }

    // Click outside (on overlay backdrop, not on links/buttons)
    this.overlay.addEventListener('click', e => {
      if (e.target === this.overlay) this.closeMenu();
    });

    // ESC key
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && this.isOpen()) this.closeMenu();
    });
  },

  openMenu() {
    this.overlay.classList.add('active');
    this.overlay.setAttribute('aria-hidden', 'false');
    this.toggle.setAttribute('aria-expanded', 'true');
    this.body.classList.add('menu-open');
    // Focus first link
    const firstLink = this.overlay.querySelector('a, button');
    if (firstLink) {
      setTimeout(() => firstLink.focus(), 50);
    }
  },

  closeMenu() {
    this.overlay.classList.remove('active');
    this.overlay.setAttribute('aria-hidden', 'true');
    this.toggle.setAttribute('aria-expanded', 'false');
    this.body.classList.remove('menu-open');
    this.toggle.focus();
  },

  isOpen() {
    return this.overlay.classList.contains('active');
  },

  /* ── Keyboard Navigation / Focus Trap ────────────────────── */
  initKeyboardNav() {
    this.overlay.addEventListener('keydown', e => {
      if (!this.isOpen()) return;
      if (e.key !== 'Tab') return;

      const focusable = Array.from(
        this.overlay.querySelectorAll(this.focusableSelectors)
      ).filter(el => !el.closest('[aria-hidden="true"]') && el.offsetParent !== null);

      if (!focusable.length) return;

      const first = focusable[0];
      const last  = focusable[focusable.length - 1];

      if (e.shiftKey) {
        if (document.activeElement === first) {
          e.preventDefault();
          last.focus();
        }
      } else {
        if (document.activeElement === last) {
          e.preventDefault();
          first.focus();
        }
      }
    });
  },

  /* ── Dropdowns ────────────────────────────────────────────── */
  initDropdowns() {
    const dropdownParents = document.querySelectorAll('.nav-links .menu-item-has-children');
    if (!dropdownParents.length) return;

    dropdownParents.forEach(parent => {
      const link     = parent.querySelector('a');
      const submenu  = parent.querySelector('.sub-menu');
      if (!submenu) return;

      submenu.setAttribute('role', 'menu');
      link.setAttribute('aria-haspopup', 'true');
      link.setAttribute('aria-expanded', 'false');

      // Desktop hover
      const isMobile = () => window.innerWidth <= 768;

      parent.addEventListener('mouseenter', () => {
        if (isMobile()) return;
        this.openDropdown(parent, link, submenu);
      });
      parent.addEventListener('mouseleave', () => {
        if (isMobile()) return;
        this.closeDropdown(parent, link, submenu);
      });

      // Click / keyboard
      link.addEventListener('click', e => {
        if (!isMobile()) return;
        e.preventDefault();
        const isExpanded = link.getAttribute('aria-expanded') === 'true';
        isExpanded
          ? this.closeDropdown(parent, link, submenu)
          : this.openDropdown(parent, link, submenu);
      });

      // Close on outside click
      document.addEventListener('click', e => {
        if (!parent.contains(e.target)) {
          this.closeDropdown(parent, link, submenu);
        }
      });

      // Keyboard: arrow keys
      parent.addEventListener('keydown', e => {
        const items = Array.from(submenu.querySelectorAll('a'));
        const idx   = items.indexOf(document.activeElement);
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          if (idx < items.length - 1) items[idx + 1].focus();
          else if (idx === -1 && items[0]) { this.openDropdown(parent, link, submenu); items[0].focus(); }
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          if (idx > 0) items[idx - 1].focus();
        } else if (e.key === 'Escape') {
          this.closeDropdown(parent, link, submenu);
          link.focus();
        }
      });
    });
  },

  openDropdown(parent, link, submenu) {
    parent.classList.add('dropdown-open');
    link.setAttribute('aria-expanded', 'true');
    submenu.removeAttribute('hidden');
  },

  closeDropdown(parent, link, submenu) {
    parent.classList.remove('dropdown-open');
    link.setAttribute('aria-expanded', 'false');
    submenu.setAttribute('hidden', '');
  },

  /* ── Active Link Highlighting ─────────────────────────────── */
  initActiveLinks() {
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-links a, .nav-overlay__links a').forEach(link => {
      try {
        const url  = new URL(link.href);
        const path = url.pathname;
        if (path !== '/' && currentPath.startsWith(path)) {
          link.closest('li')?.classList.add('current-menu-item');
          link.setAttribute('aria-current', 'page');
        } else if (path === '/' && currentPath === '/') {
          link.closest('li')?.classList.add('current-menu-item');
          link.setAttribute('aria-current', 'page');
        }
      } catch (_) { /* external links */ }
    });
  },
};

document.addEventListener('DOMContentLoaded', () => Navigation.init());
