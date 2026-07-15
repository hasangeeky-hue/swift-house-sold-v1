'use strict';

const PropertyFilter = {

  form:        null,
  grid:        null,
  countEl:     null,
  emptyState:  null,
  resetBtn:    null,
  isLoading:   false,

  init() {
    this.form       = document.querySelector('.js-property-filter');
    if (!this.form) return;

    this.grid       = document.querySelector('.js-property-grid');
    this.countEl    = document.querySelector('.filter-count');
    this.emptyState = document.querySelector('.empty-state');
    this.resetBtn   = document.querySelector('.filter-reset');

    this.readURLParams();
    this.bindFilter();
    this.bindReset();

    // If URL has params, run filter immediately
    if (window.location.search) {
      this.applyFilter();
    }
  },

  /* ── Bind Events ──────────────────────────────────────────── */
  bindFilter() {
    this.form.addEventListener('submit', e => {
      e.preventDefault();
      this.applyFilter();
    });

    // Live filter on select change
    this.form.querySelectorAll('select').forEach(sel => {
      sel.addEventListener('change', () => this.applyFilter());
    });
  },

  bindReset() {
    if (!this.resetBtn) return;
    this.resetBtn.addEventListener('click', () => {
      this.form.reset();
      this.updateURL(new URLSearchParams());
      this.applyFilter();
    });
  },

  /* ── Apply Filter ─────────────────────────────────────────── */
  applyFilter() {
    if (this.isLoading) return;

    const params = this.gatherParams();
    this.updateURL(params);
    this.showLoadingSkeleton();

    const formData = new FormData();
    formData.set('action', 'wholesalepro_filter_properties');
    formData.set('nonce', (typeof wholesalePro !== 'undefined' ? wholesalePro.nonce : ''));
    params.forEach((val, key) => { if (val) formData.set(key, val); });

    const ajaxUrl = (typeof wholesalePro !== 'undefined' && wholesalePro.ajaxUrl)
      ? wholesalePro.ajaxUrl
      : '/wp-admin/admin-ajax.php';

    this.isLoading = true;

    fetch(ajaxUrl, { method: 'POST', body: formData })
      .then(res => {
        if (!res.ok) throw new Error('Network error');
        return res.json();
      })
      .then(data => {
        if (data.success) {
          this.renderResults(data.data);
        } else {
          this.showError(data.data?.message || 'Error loading properties.');
        }
      })
      .catch(() => {
        this.showError('Connection error. Please try again.');
      })
      .finally(() => {
        this.isLoading = false;
      });
  },

  /* ── Gather Form Values ───────────────────────────────────── */
  gatherParams() {
    const params = new URLSearchParams();
    const fields = ['state', 'price_min', 'price_max', 'beds', 'property_type', 'status'];
    fields.forEach(name => {
      const el = this.form.querySelector(`[name="${name}"]`);
      if (el && el.value.trim()) {
        params.set(name, el.value.trim());
      }
    });
    return params;
  },

  /* ── Read URL Params → pre-fill form ─────────────────────── */
  readURLParams() {
    const params = new URLSearchParams(window.location.search);
    params.forEach((val, key) => {
      const el = this.form.querySelector(`[name="${key}"]`);
      if (el) el.value = val;
    });
  },

  /* ── Render Results ───────────────────────────────────────── */
  renderResults(data) {
    if (!this.grid) return;

    const cards = data.cards || [];
    const total = data.total  || 0;

    if (this.countEl) {
      this.countEl.textContent = `${total} propert${total !== 1 ? 'ies' : 'y'} found`;
    }

    if (!cards.length) {
      this.grid.innerHTML      = '';
      if (this.emptyState) this.emptyState.style.display = 'block';
      return;
    }

    if (this.emptyState) this.emptyState.style.display = 'none';

    const html = cards.map((card, i) => {
      const delay = Math.min(i * 0.05, 0.5);
      const cardHtml = card.card_html || this.buildCardHTML(card);
      return `<div class="animate-on-scroll" style="transition-delay:${delay}s">${cardHtml}</div>`;
    }).join('');

    this.grid.innerHTML = html;

    // Trigger animations
    requestAnimationFrame(() => {
      this.grid.querySelectorAll('.animate-on-scroll').forEach(el => {
        el.classList.add('animated');
      });
    });
  },

  /* ── Fallback Card Builder ────────────────────────────────── */
  buildCardHTML(card) {
    const price  = card.asking_price ? '$' + card.asking_price.toLocaleString() : '';
    const profit = card.profit > 0   ? '$' + card.profit.toLocaleString() + ' est. profit' : '';
    const loc    = [card.city, card.state].filter(Boolean).join(', ');
    const thumb  = card.thumbnail_url
      ? `<img src="${card.thumbnail_url}" alt="${card.title}" loading="lazy">`
      : '<div style="width:100%;height:100%;background:#E9ECEF;display:flex;align-items:center;justify-content:center;color:#ADB5BD">No photo</div>';

    return `
      <article class="property-card">
        <div class="property-card__image">${thumb}</div>
        <div class="property-card__body">
          ${loc ? `<p class="property-card__location">${loc}</p>` : ''}
          <h3 class="property-card__title"><a href="${card.permalink}">${card.title}</a></h3>
          ${price  ? `<div class="property-card__price">${price}</div>` : ''}
          ${profit ? `<div class="property-card__profit">${profit}</div>` : ''}
          <div class="property-card__actions">
            <a href="${card.permalink}" class="btn btn--primary btn--sm">View Deal</a>
            <a href="${card.permalink}#make-offer" class="btn btn--buyer btn--sm">Make Offer</a>
          </div>
        </div>
      </article>`;
  },

  /* ── Loading Skeleton ─────────────────────────────────────── */
  showLoadingSkeleton() {
    if (!this.grid) return;
    if (this.emptyState) this.emptyState.style.display = 'none';

    const skeleton = `
      <div class="skeleton-card">
        <div class="skeleton skeleton-card__image"></div>
        <div class="skeleton-card__body">
          <div class="skeleton skeleton-line skeleton-line--sm"></div>
          <div class="skeleton skeleton-line skeleton-line--lg" style="margin-top:8px"></div>
          <div class="skeleton skeleton-line" style="margin-top:8px;width:40%"></div>
          <div class="skeleton skeleton-line skeleton-line--sm" style="margin-top:16px"></div>
        </div>
      </div>`;

    this.grid.innerHTML = skeleton.repeat(6);
  },

  /* ── Error State ──────────────────────────────────────────── */
  showError(msg) {
    if (!this.grid) return;
    this.grid.innerHTML = `
      <div class="empty-state" style="grid-column:1/-1">
        <div class="empty-state__icon">⚠️</div>
        <h3 class="empty-state__title">Something went wrong</h3>
        <p class="empty-state__text">${msg}</p>
        <button class="btn btn--primary" onclick="PropertyFilter.applyFilter()">Try Again</button>
      </div>`;
  },

  /* ── URL Management ───────────────────────────────────────── */
  updateURL(params) {
    const url = params.toString()
      ? window.location.pathname + '?' + params.toString()
      : window.location.pathname;
    history.replaceState(null, '', url);
  },
};

document.addEventListener('DOMContentLoaded', () => PropertyFilter.init());
window.PropertyFilter = PropertyFilter;
