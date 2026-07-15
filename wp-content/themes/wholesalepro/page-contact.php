<?php
/**
 * Contact Page Template
 * Template Name: Contact
 *
 * @package WholesalePro
 */

get_header();

$company_phone   = get_theme_mod( 'company_phone', '' );
$phone_raw       = get_theme_mod( 'company_phone_raw', '' );
$company_email   = get_theme_mod( 'company_email', '' );
$company_address = get_theme_mod( 'company_address', '' );
$business_hours  = get_theme_mod( 'business_hours', 'Mon–Fri: 8am–7pm EST &middot; Sat: 9am–5pm EST' );
?>

<section class="page-hero page-hero--compact" aria-labelledby="contact-hero-heading">
	<div class="container">
		<?php wholesalepro_breadcrumb(); ?>
		<h1 class="page-hero__title animate-on-scroll" id="contact-hero-heading">
			Let Us Help You Today
		</h1>
		<p class="page-hero__subtitle animate-on-scroll" style="transition-delay:0.1s">
			Whether you are a homeowner looking for options or an investor looking for deals — every inquiry receives a personal response within one hour.
		</p>
	</div>
</section>

<!-- ━━ RESPONSE COMMITMENT BANNER ━━ -->
<div style="background:var(--wp-navy);color:#fff;padding:var(--space-lg) 0;">
	<div class="container">
		<div style="display:flex;align-items:center;gap:var(--space-lg);flex-wrap:wrap;justify-content:center;text-align:center;">
			<div style="font-size:2.5rem;" aria-hidden="true">⏱️</div>
			<div>
				<h2 style="color:#fff;font-size:1.25rem;margin-bottom:6px;">Our Response Commitment</h2>
				<p style="color:rgba(255,255,255,0.85);margin:0;max-width:680px;">
					Every single inquiry submitted through this form, our seller form, or our phone line receives a personal response within one hour during business hours and first thing the following morning for inquiries received overnight. This is not a guideline. It is the standard we hold our team to on every business day.
				</p>
			</div>
		</div>
	</div>
</div>

<section class="section" aria-labelledby="contact-section-heading">
	<div class="container">
		<h2 class="sr-only" id="contact-section-heading">Contact Information and Form</h2>
		<div class="split-layout split-layout--contact" style="gap:var(--space-2xl);">

			<!-- Contact Methods -->
			<div class="contact-methods animate-on-scroll">
				<h2 style="margin-bottom:var(--space-xl);">Reach Us Directly</h2>

				<div class="contact-method">
					<div class="contact-method__icon" aria-hidden="true">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.82 12a19.79 19.79 0 01-3.07-8.67A2 2 0 013.73 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.91 8.91a16 16 0 006.18 6.18l1.09-1.09a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
					</div>
					<div class="contact-method__info">
						<h3>Call or Text</h3>
						<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="contact-method__link"><?php echo esc_html( $company_phone ); ?></a>
						<p style="font-size:0.875rem;color:var(--wp-gray);margin:4px 0 0;"><?php echo wp_kses_post( $business_hours ); ?></p>
						<p style="font-size:0.875rem;color:var(--wp-gray);margin:2px 0 0;">Response within 1 hour during business hours</p>
					</div>
				</div>

				<?php if ( $company_email ) : ?>
				<div class="contact-method">
					<div class="contact-method__icon" aria-hidden="true">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
					</div>
					<div class="contact-method__info">
						<h3>Email</h3>
						<a href="mailto:<?php echo esc_attr( $company_email ); ?>" class="contact-method__link"><?php echo esc_html( $company_email ); ?></a>
						<p style="font-size:0.875rem;color:var(--wp-gray);margin:4px 0 0;">We respond within 2 business hours.</p>
					</div>
				</div>
				<?php endif; ?>

				<?php if ( $company_address ) : ?>
				<div class="contact-method">
					<div class="contact-method__icon" aria-hidden="true">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
					</div>
					<div class="contact-method__info">
						<h3>Office</h3>
						<address style="font-style:normal;color:var(--wp-dark);"><?php echo esc_html( $company_address ); ?></address>
					</div>
				</div>
				<?php endif; ?>

				<div class="contact-method">
					<div class="contact-method__icon" aria-hidden="true">🕒</div>
					<div class="contact-method__info">
						<h3>Business Hours</h3>
						<p style="margin:0;color:var(--wp-dark);"><?php echo wp_kses_post( $business_hours ); ?></p>
						<p style="font-size:0.875rem;color:var(--wp-gray);margin:4px 0 0;">Emergency seller situations: we answer 24/7</p>
					</div>
				</div>

				<div style="background:var(--wp-light-gray);border-radius:var(--radius-lg);padding:var(--space-xl);margin-top:var(--space-xl);">
					<h3 style="margin-bottom:var(--space-sm);">Not sure what to ask?</h3>
					<p style="color:var(--wp-gray);font-size:0.9rem;margin-bottom:var(--space-md);">Tell us whether you are a seller exploring options or an investor looking for deals and we will point you in the right direction immediately.</p>
					<ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:6px;">
						<li style="font-size:0.875rem;color:var(--wp-gray);">&#9993; Seller inquiries → acquisitions team, 1-hour response</li>
						<li style="font-size:0.875rem;color:var(--wp-gray);">&#9993; Investor inquiries → investor relations, same-day response</li>
						<li style="font-size:0.875rem;color:var(--wp-gray);">&#9993; Press and media → management team, 24-hour response</li>
					</ul>
				</div>

				<?php echo wholesalepro_social_links(); // phpcs:ignore ?>
			</div>

			<!-- Contact Form -->
			<div class="animate-on-scroll" style="transition-delay:0.2s">
				<div class="card" style="padding:var(--space-2xl);">
					<h2 style="margin-bottom:var(--space-sm);">Send Us a Message</h2>
					<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">Tell us who you are and how we can help. We respond within one hour during business hours.</p>
					<?php echo wholesalepro_render_contact_form(); // phpcs:ignore ?>
				</div>
			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>
