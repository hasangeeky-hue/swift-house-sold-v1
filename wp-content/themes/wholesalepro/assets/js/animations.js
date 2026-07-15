'use strict';

const Animations = {

  init() {
    this.initTabs();
    this.initAccordion();
    this.initScrollFade();
  },

  /* ── Tabs ─────────────────────────────────────────────────── */
  initTabs() {
    document.querySelectorAll('.js-tabs').forEach(tabGroup => {
      const buttons  = Array.from(tabGroup.querySelectorAll('.tab-btn'));
      const contents = Array.from(tabGroup.querySelectorAll('.tab-content'));

      if (!buttons.length) return;

      // Set ARIA roles
      const tabList = tabGroup.querySelector('.tabs__nav');
      if (tabList) tabList.setAttribute('role', 'tablist');

      buttons.forEach((btn, i) => {
        const panelId  = `tab-panel-${Math.random().toString(36).slice(2, 7)}-${i}`;
        const btnId    = `tab-btn-${Math.random().toString(36).slice(2, 7)}-${i}`;

        btn.setAttribute('role', 'tab');
        btn.setAttribute('id', btnId);
        btn.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
        btn.setAttribute('tabindex', i === 0 ? '0' : '-1');
        if (contents[i]) {
          contents[i].setAttribute('role', 'tabpanel');
          contents[i].setAttribute('id', panelId);
          contents[i].setAttribute('aria-labelledby', btnId);
          if (i !== 0) contents[i].setAttribute('hidden', '');
        }

        btn.addEventListener('click', () => {
          this.activateTab(buttons, contents, i);
        });

        // Keyboard navigation
        btn.addEventListener('keydown', e => {
          let newIdx = i;
          if (e.key === 'ArrowRight') { newIdx = (i + 1) % buttons.length; }
          else if (e.key === 'ArrowLeft') { newIdx = (i - 1 + buttons.length) % buttons.length; }
          else if (e.key === 'Home') { newIdx = 0; }
          else if (e.key === 'End')  { newIdx = buttons.length - 1; }
          else return;
          e.preventDefault();
          this.activateTab(buttons, contents, newIdx);
          buttons[newIdx].focus();
        });
      });

      // Activate first
      if (buttons[0]) this.activateTab(buttons, contents, 0);
    });
  },

  activateTab(buttons, contents, activeIdx) {
    buttons.forEach((btn, i) => {
      const isActive = i === activeIdx;
      btn.classList.toggle('active', isActive);
      btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
      btn.setAttribute('tabindex', isActive ? '0' : '-1');
    });
    contents.forEach((content, i) => {
      const isActive = i === activeIdx;
      content.classList.toggle('active', isActive);
      if (isActive) {
        content.removeAttribute('hidden');
      } else {
        content.setAttribute('hidden', '');
      }
    });
  },

  /* ── Accordion ────────────────────────────────────────────── */
  initAccordion() {
    document.querySelectorAll('.accordion__trigger').forEach(trigger => {
      trigger.setAttribute('role', 'button');
      const item    = trigger.closest('.accordion__item');
      const content = item?.querySelector('.accordion__content');
      if (!content) return;

      // Generate IDs for ARIA
      const triggerId = `accordion-trigger-${Math.random().toString(36).slice(2, 8)}`;
      const contentId = `accordion-content-${Math.random().toString(36).slice(2, 8)}`;
      trigger.setAttribute('id', triggerId);
      trigger.setAttribute('aria-expanded', 'false');
      trigger.setAttribute('aria-controls', contentId);
      content.setAttribute('id', contentId);
      content.setAttribute('role', 'region');
      content.setAttribute('aria-labelledby', triggerId);

      trigger.addEventListener('click', () => {
        const isOpen = item.classList.contains('active');

        // Close all siblings in same accordion group
        const group = trigger.closest('.accordion');
        if (group) {
          group.querySelectorAll('.accordion__item.active').forEach(openItem => {
            if (openItem === item) return;
            const sibContent = openItem.querySelector('.accordion__content');
            const sibTrigger = openItem.querySelector('.accordion__trigger');
            openItem.classList.remove('active');
            if (sibContent) sibContent.style.maxHeight = null;
            if (sibTrigger) sibTrigger.setAttribute('aria-expanded', 'false');
          });
        }

        if (isOpen) {
          item.classList.remove('active');
          content.style.maxHeight = null;
          trigger.setAttribute('aria-expanded', 'false');
        } else {
          item.classList.add('active');
          content.style.maxHeight = content.scrollHeight + 'px';
          trigger.setAttribute('aria-expanded', 'true');
        }
      });

      // Keyboard: Enter/Space
      trigger.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          trigger.click();
        }
      });
    });
  },

  /* ── Scroll Fade ──────────────────────────────────────────── */
  initScrollFade() {
    const els = document.querySelectorAll('.animate-on-scroll, .animate-left, .animate-right, .animate-scale');
    if (!els.length) return;

    if (!('IntersectionObserver' in window)) {
      els.forEach(el => el.classList.add('animated'));
      return;
    }

    const observer = new IntersectionObserver(
      entries => {
        entries.forEach(entry => {
          if (!entry.isIntersecting) return;
          entry.target.classList.add('animated');
          observer.unobserve(entry.target);
        });
      },
      { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
    );

    els.forEach(el => observer.observe(el));
  },
};

document.addEventListener('DOMContentLoaded', () => Animations.init());
