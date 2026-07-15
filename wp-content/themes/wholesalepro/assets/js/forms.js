'use strict';

const WPForms = {

  init() {
    this.bindSellerForm();
    this.bindBuyerForm();
    this.bindOfferForm();
    this.bindContactForm();
  },

  /* ── Bind ─────────────────────────────────────────────────── */
  bindSellerForm() {
    document.querySelectorAll('.js-seller-form').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        this.handleSubmit(form, 'wholesalepro_seller_form', this.getSellerRedirect());
      });
    });
  },

  bindBuyerForm() {
    document.querySelectorAll('.js-buyer-form').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        this.handleSubmit(form, 'wholesalepro_buyer_form', this.getBuyerRedirect());
      });
    });
  },

  bindOfferForm() {
    document.querySelectorAll('.js-offer-form').forEach(form => {
      // File size validation
      const fileInput = form.querySelector('input[type="file"]');
      if (fileInput) {
        fileInput.addEventListener('change', () => {
          const file = fileInput.files[0];
          if (file && file.size > 5 * 1024 * 1024) {
            this.showFieldError(fileInput, 'File must be under 5MB.');
            fileInput.value = '';
          } else {
            this.clearFieldError(fileInput);
          }
        });
      }
      form.addEventListener('submit', e => {
        e.preventDefault();
        this.handleSubmit(form, 'wholesalepro_offer_form', null);
      });
    });
  },

  bindContactForm() {
    document.querySelectorAll('.js-contact-form').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        this.handleSubmit(form, 'wholesalepro_contact_form', null);
      });
    });
  },

  /* ── Handle Submit ────────────────────────────────────────── */
  handleSubmit(form, action, redirect) {
    if (!this.validate(form)) return;

    const formData = new FormData(form);
    formData.set('action', action);

    // Append nonce from localized data if not already in form
    if (typeof wholesalePro !== 'undefined' && wholesalePro.nonce) {
      if (!formData.has('nonce')) {
        formData.set('nonce', wholesalePro.nonce);
      }
    }

    this.setLoading(form, true);

    const ajaxUrl = (typeof wholesalePro !== 'undefined' && wholesalePro.ajaxUrl)
      ? wholesalePro.ajaxUrl
      : '/wp-admin/admin-ajax.php';

    fetch(ajaxUrl, { method: 'POST', body: formData })
      .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
      })
      .then(data => {
        if (data.success) {
          this.trackConversion(action);
          if (redirect) {
            window.location.href = redirect;
          } else {
            this.showSuccess(form, data.data?.message || '');
          }
        } else {
          const msg    = data.data?.message || 'An error occurred. Please try again.';
          const errors = data.data?.errors  || {};
          this.showErrors(form, msg, errors);
        }
      })
      .catch(() => {
        this.showErrors(form, 'Connection error. Please check your internet and try again.', {});
      })
      .finally(() => {
        this.setLoading(form, false);
      });
  },

  /* ── Validation ───────────────────────────────────────────── */
  validate(form) {
    let valid = true;
    this.clearAllErrors(form);

    form.querySelectorAll('[required]').forEach(field => {
      const val = field.type === 'checkbox'
        ? field.checked
        : field.value.trim();

      if (!val) {
        this.showFieldError(field, this.getRequiredMessage(field));
        valid = false;
      }
    });

    // Phone validation
    form.querySelectorAll('[type="tel"]').forEach(field => {
      if (!field.value.trim()) return;
      const phoneRegex = /^[\d\s\-\+\(\)]{7,}$/;
      if (!phoneRegex.test(field.value.trim())) {
        this.showFieldError(field, 'Please enter a valid phone number.');
        valid = false;
      }
    });

    // Email validation
    form.querySelectorAll('[type="email"]').forEach(field => {
      if (!field.value.trim()) return;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(field.value.trim())) {
        this.showFieldError(field, 'Please enter a valid email address.');
        valid = false;
      }
    });

    if (!valid) {
      const firstError = form.querySelector('.form-error.visible, .form-control.error');
      if (firstError) {
        const header = document.getElementById('site-header');
        const offset = header ? header.offsetHeight + 16 : 80;
        const top    = firstError.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    }

    return valid;
  },

  getRequiredMessage(field) {
    const labels = {
      seller_name:      'Name is required.',
      seller_phone:     'Phone number is required.',
      seller_email:     'Email address is required.',
      property_address: 'Property address is required.',
      situation:        'Please describe your situation.',
      buyer_name:       'Name is required.',
      buyer_email:      'Email is required.',
      buyer_phone:      'Phone is required.',
      offeror_name:     'Your name is required.',
      offeror_email:    'Email is required.',
      offeror_phone:    'Phone is required.',
      offer_amount:     'Offer amount is required.',
      contact_name:     'Name is required.',
      contact_email:    'Email is required.',
      contact_message:  'Message is required.',
      terms_agreed:     'You must agree to the terms.',
    };
    return labels[field.name] || 'This field is required.';
  },

  /* ── Loading State ────────────────────────────────────────── */
  setLoading(form, loading) {
    const btn = form.querySelector('.js-submit');
    if (!btn) return;
    if (loading) {
      btn.disabled = true;
      btn.classList.add('btn--loading');
      btn.setAttribute('data-original-text', btn.innerHTML);
      btn.innerHTML = '<span class="spinner"></span> Sending...';
      form.classList.add('form--loading');
    } else {
      btn.disabled = false;
      btn.classList.remove('btn--loading');
      const orig = btn.getAttribute('data-original-text');
      if (orig) btn.innerHTML = orig;
      form.classList.remove('form--loading');
    }
  },

  /* ── Success ──────────────────────────────────────────────── */
  showSuccess(form) {
    const successEl = form.querySelector('.form-success');
    if (successEl) {
      form.querySelectorAll('.form-group, .form-row, .form-submit-wrap, .form-privacy').forEach(el => {
        el.style.display = 'none';
      });
      successEl.style.display = 'block';
    }
  },

  /* ── Errors ───────────────────────────────────────────────── */
  showErrors(form, generalMsg, fieldErrors) {
    // Field-specific errors
    Object.entries(fieldErrors).forEach(([fieldName, msg]) => {
      const field = form.querySelector(`[name="${fieldName}"]`);
      if (field) this.showFieldError(field, msg);
    });

    // General message at top if present
    if (generalMsg && !Object.keys(fieldErrors).length) {
      let alertEl = form.querySelector('.form-general-error');
      if (!alertEl) {
        alertEl = document.createElement('div');
        alertEl.className = 'form-general-error';
        alertEl.setAttribute('role', 'alert');
        alertEl.style.cssText = 'background:rgba(230,57,70,0.1);border:1px solid var(--wp-red);border-radius:0.5rem;padding:0.75rem 1rem;color:var(--wp-red);font-size:0.9rem;margin-bottom:1rem;';
        form.insertBefore(alertEl, form.firstChild);
      }
      alertEl.textContent = generalMsg;
    }
  },

  showFieldError(field, msg) {
    field.classList.add('error');
    let errEl = field.parentElement?.querySelector('.form-error');
    if (!errEl) {
      errEl = document.createElement('span');
      errEl.className = 'form-error';
      errEl.setAttribute('role', 'alert');
      field.parentElement?.appendChild(errEl);
    }
    errEl.textContent = msg;
    errEl.classList.add('visible');
    field.setAttribute('aria-invalid', 'true');
    field.setAttribute('aria-describedby', errEl.id || '');
  },

  clearFieldError(field) {
    field.classList.remove('error');
    field.removeAttribute('aria-invalid');
    const errEl = field.parentElement?.querySelector('.form-error');
    if (errEl) { errEl.textContent = ''; errEl.classList.remove('visible'); }
  },

  clearAllErrors(form) {
    form.querySelectorAll('.form-control.error, .form-check__input.error').forEach(f => {
      this.clearFieldError(f);
    });
    const general = form.querySelector('.form-general-error');
    if (general) general.remove();
  },

  /* ── Redirects ────────────────────────────────────────────── */
  getSellerRedirect() {
    return (typeof wholesalePro !== 'undefined' && wholesalePro.sellerThankyou)
      ? wholesalePro.sellerThankyou
      : '/thank-you-seller';
  },

  getBuyerRedirect() {
    return (typeof wholesalePro !== 'undefined' && wholesalePro.buyerThankyou)
      ? wholesalePro.buyerThankyou
      : '/thank-you-buyer';
  },

  /* ── Conversion Tracking ──────────────────────────────────── */
  trackConversion(formType) {
    const eventMap = {
      wholesalepro_seller_form:  { ga: 'generate_lead',    fb: 'Lead' },
      wholesalepro_buyer_form:   { ga: 'sign_up',          fb: 'CompleteRegistration' },
      wholesalepro_offer_form:   { ga: 'purchase_intent',  fb: 'InitiateCheckout' },
      wholesalepro_contact_form: { ga: 'contact',          fb: 'Contact' },
    };
    const events = eventMap[formType] || { ga: 'form_submit', fb: 'Lead' };

    if (typeof gtag === 'function') {
      gtag('event', events.ga, { event_category: 'form', event_label: formType });
    }
    if (typeof fbq === 'function') {
      fbq('track', events.fb);
    }
  },
};

document.addEventListener('DOMContentLoaded', () => WPForms.init());
