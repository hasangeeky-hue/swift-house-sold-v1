<?php
/**
 * Thank You to Seller Page Template
 * Template Name: Thank You Seller
 *
 * @package WholesalePro
 */

get_header();

$phone     = get_theme_mod( 'company_phone', '' );
$phone_raw = get_theme_mod( 'company_phone_raw', '' );
$business_hours = get_theme_mod( 'business_hours', 'Mon–Fri: 8am–7pm EST · Sat: 9am–5pm EST' );
?>

<section class="section thank-you-page" aria-labelledby="ty-seller-heading">
	<div class="container narrow text-center">

		<div class="thank-you-icon animate-on-scroll" aria-hidden="true" style="font-size:5rem;margin-bottom:var(--space-lg);">✅</div>

		<h1 class="animate-on-scroll" id="ty-seller-heading" style="transition-delay:0.1s">
			We Have Received Your Inquiry
		</h1>

		<p class="animate-on-scroll" style="color:var(--wp-gray);font-size:1.125rem;max-width:560px;margin-inline:auto;transition-delay:0.2s">
			A member of our acquisitions team will call or text you within one hour.
		</p>

		<div class="animate-on-scroll" style="transition-delay:0.3s;background:var(--wp-light-gray);border-radius:var(--radius-lg);padding:var(--space-2xl);margin-top:var(--space-2xl);text-align:left;max-width:560px;margin-inline:auto;">
			<h2 style="margin-bottom:var(--space-lg);text-align:center;">What Happens Next</h2>

			<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
				Thank you for reaching out to WholesalePro. Your inquiry has been received and is being reviewed by our team right now. Here is exactly what happens from this point:
			</p>

			<div style="display:flex;flex-direction:column;gap:var(--space-lg);">
				<div style="display:flex;gap:var(--space-md);align-items:flex-start;">
					<div style="width:36px;height:36px;border-radius:50%;background:var(--wp-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">1</div>
					<div>
						<strong style="display:block;margin-bottom:4px;">Within 1 hour: Personal contact</strong>
						<span style="color:var(--wp-gray);font-size:0.9rem;">A member of our team contacts you directly by phone or text, whichever you prefer. If you submitted after hours, you receive a confirmation now and a personal call first thing tomorrow morning.</span>
					</div>
				</div>
				<div style="display:flex;gap:var(--space-md);align-items:flex-start;">
					<div style="width:36px;height:36px;border-radius:50%;background:var(--wp-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">2</div>
					<div>
						<strong style="display:block;margin-bottom:4px;">Within 24 hours: Your cash offer</strong>
						<span style="color:var(--wp-gray);font-size:0.9rem;">We complete our property research using comparable sales in your neighborhood and prepare your fair, written cash offer. We will walk through every number with you clearly.</span>
					</div>
				</div>
				<div style="display:flex;gap:var(--space-md);align-items:flex-start;">
					<div style="width:36px;height:36px;border-radius:50%;background:var(--wp-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">3</div>
					<div>
						<strong style="display:block;margin-bottom:4px;">You decide, no pressure, no deadline</strong>
						<span style="color:var(--wp-gray);font-size:0.9rem;">You accept, decline, or ask questions. There is zero pressure and zero obligation at any point in this process. The decision is entirely yours, on your timeline.</span>
					</div>
				</div>
			</div>
		</div>

		<div class="animate-on-scroll" style="transition-delay:0.4s;margin-top:var(--space-2xl);">
			<p style="font-weight:600;margin-bottom:var(--space-sm);">Need to talk to someone right now?</p>
			<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--seller btn--lg">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.82 12a19.79 19.79 0 01-3.07-8.67A2 2 0 013.73 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.91 8.91a16 16 0 006.18 6.18l1.09-1.09a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
				<?php echo esc_html( $phone ); ?>
			</a>
			<p style="font-size:0.875rem;color:var(--wp-gray);margin-top:var(--space-sm);"><?php echo esc_html( $business_hours ); ?></p>
		</div>

		<div class="animate-on-scroll" style="transition-delay:0.5s;margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--ghost">&larr; Back to Homepage</a>
		</div>

	</div>
</section>

<?php get_footer(); ?>
