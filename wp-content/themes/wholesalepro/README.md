# WholesalePro WordPress Theme

A production-ready wholesale real estate WordPress theme for US companies that buy distressed houses for cash and assign contracts to investors.

---

## Features

- **Dual-audience design** — Seller pages (emotional, trust-driven) and Buyer/Investor pages (logical, data-driven)
- **Custom Post Type** — `property` (slug: `deal`, archive: `deals`) with 23 meta fields
- **Custom Taxonomies** — All 50 US States, Property Types, Deal Status
- **AJAX Forms** — Seller lead, Buyer signup, Offer submission, Contact — with honeypot, rate limiting, nonce verification
- **Custom DB Tables** — `wp_wholesalepro_leads`, `wp_wholesalepro_buyers`, `wp_wholesalepro_offers`
- **SEO** — Dynamic meta tags, Open Graph, Twitter Cards, JSON-LD Schema (Organization, RealEstateAgent, RealEstateListing, Article, FAQPage, BreadcrumbList)
- **Google Maps Integration** — Coverage map with navy theme, property markers, InfoWindow
- **Geo Templates** — State and City landing page templates for local SEO
- **Customizer** — Full theme options: Company Info, API Keys, Social Media, Business Settings, Header/Footer
- **Design System** — CSS custom properties, fluid typography (`clamp()`), 8px spacing grid
- **Accessibility** — ARIA roles, keyboard navigation, focus management, skip-to-content, `prefers-reduced-motion`
- **Performance** — Conditional asset loading, lazy images, IntersectionObserver animations
- **Analytics** — GTM, GA4, Facebook Pixel integration with conversion tracking

---

## Installation

1. Upload the `wholesalepro` folder to `/wp-content/themes/`
2. Activate the theme from **Appearance → Themes**
3. Go to **Appearance → Customize → WholesalePro Settings** and fill in:
   - Company name, phone, email, address
   - Google Maps API key (for coverage map)
   - Google Tag Manager ID and/or GA4 Measurement ID
   - Facebook Pixel ID (optional)
4. Create the following pages and assign their templates:
   | Page Title | Slug | Template |
   |---|---|---|
   | Sell My House Fast | `sell-my-house-fast` | Sell My House |
   | Browse Deals | `browse-deals` | Browse Deals |
   | How It Works | `how-it-works` | How It Works |
   | About Us | `about` | About Us |
   | Contact | `contact` | Contact |
   | Thank You – Seller | `thank-you-seller` | Thank You Seller |
   | Thank You – Buyer | `thank-you-buyer` | Thank You Buyer |

5. Set your **Front Page** to a static page (homepage) in **Settings → Reading**
6. Register navigation menus under **Appearance → Menus**

---

## Content Markers

Content blocks use `{{CONTENT_BLOCK_NAME}}` markers for CMS replacement via the `wholesalepro_content()` helper. Each marker has a sensible default value and can be overridden in code or a future admin UI.

**Example markers:**
- `hero_headline` — Homepage hero H1
- `sell_hero_title` — Sell page hero H1
- `testimonial_1_quote` / `testimonial_1_name` / `testimonial_1_location`
- `hiw_step_1_title` through `hiw_step_5_title`
- `sell_faq_1_q` / `sell_faq_1_a` through `sell_faq_5_q` / `sell_faq_5_a`

---

## Geo Pages

For state/city landing pages (local SEO):

1. Create a new **Page** with slug pattern:
   - State: `we-buy-houses-texas` or `sell-my-house-arizona`
   - City: `we-buy-houses-phoenix-az` or `sell-my-house-houston-tx`
2. The theme auto-detects state/city from the slug and renders the appropriate template

---

## File Structure

```
wholesalepro/
├── assets/
│   ├── css/
│   │   ├── admin.css
│   │   ├── animations.css
│   │   ├── base.css
│   │   ├── components.css
│   │   ├── layout.css
│   │   ├── pages.css
│   │   ├── property.css
│   │   └── responsive.css
│   └── js/
│       ├── admin-meta-calc.js
│       ├── animations.js
│       ├── app.js
│       ├── filter.js
│       ├── forms.js
│       ├── map.js
│       └── navigation.js
├── inc/
│   ├── ajax.php
│   ├── cpt.php
│   ├── customizer.php
│   ├── enqueue.php
│   ├── forms.php
│   ├── helpers.php
│   ├── meta-boxes.php
│   ├── schema.php
│   ├── seo.php
│   └── setup.php
├── templates/
│   ├── city.php
│   └── state.php
├── 404.php
├── archive-property.php
├── archive.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── page-about.php
├── page-contact.php
├── page-deals.php
├── page-how-it-works.php
├── page-sell.php
├── page-thank-you-buyer.php
├── page-thank-you-seller.php
├── page.php
├── README.md
├── screenshot.png
├── single-property.php
├── single.php
└── style.css
```

---

## Requirements

- WordPress 6.0+
- PHP 7.4+
- MySQL 5.7+ or MariaDB 10.3+

---

## Customization

### Colors (CSS Custom Properties)

Edit `:root` in `assets/css/base.css`:

```css
--wp-navy:      #1B2B4B;  /* Primary brand color */
--wp-red:       #E63946;  /* Seller CTA color */
--wp-green:     #2D6A4F;  /* Buyer CTA color */
--wp-gold:      #F4A261;  /* Accent / trust */
--wp-dark-navy: #0F1C33;  /* Dark variant */
```

### Fonts

Replace Google Fonts import in `assets/css/base.css`. Default: **Playfair Display** (headings) + **Inter** (body).

---

## License

Commercial use. All rights reserved.
