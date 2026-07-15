<?php
/**
 * Thank You – Buyer Page Template
 * Template Name: Thank You Buyer
 *
 * @package WholesalePro
 */

get_header();

$phone     = get_theme_mod( 'company_phone', '' );
$phone_raw = get_theme_mod( 'company_phone_raw', '' );
$deals_url = ( $p = get_page_by_path( 'browse-deals' ) ) ? get_permalink( $p->ID ) : home_url( '/browse-deals' );
?>

<section class="section thank-you-page" aria-labelledby="ty-buyer-heading">
	<div class="container narrow text-center">

		<div class="thank-you-icon animate-on-scroll" aria-hidden="true" style="font-size:5rem;margin-bottom:var(--space-lg);">🎯</div>

		<h1 class="animate-on-scroll" id="ty-buyer-heading" style="transition-delay:0.1s">
			Welcome to the WholesalePro Buyer Network
		</h1>

		<p class="animate-on-scroll" style="color:var(--wp-gray);font-size:1.125rem;max-width:560px;margin-inline:auto;transition-delay:0.2s">
			You will receive your first matched deal alert within 24 hours.
		</p>

		<div class="animate-on-scroll" style="transition-delay:0.3s;background:var(--wp-light-gray);border-radius:var(--radius-lg);padding:var(--space-2xl);margin-top:var(--space-2xl);text-align:left;max-width:560px;margin-inline:auto;">
			<h2 style="margin-bottom:var(--space-lg);text-align:center;">What to Expect</h2>

			<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
				Your buyer profile has been created and you are now part of our active investor network. Here is exactly what happens from here:
			</p>

			<div style="display:flex;flex-direction:column;gap:var(--space-lg);">
				<div style="display:flex;gap:var(--space-md);align-items:flex-start;">
					<div style="width:36px;height:36px;border-radius:50%;background:var(--wp-green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">1</div>
					<div>
						<strong style="display:block;margin-bottom:4px;">Within 24 hours: First deal alerts</strong>
						<span style="color:var(--wp-gray);font-size:0.9rem;">You receive any currently available deals that match your buying criteria. If nothing matches exactly today, you are in the queue and will receive the next matching deal the moment it enters our pipeline.</span>
					</div>
				</div>
				<div style="display:flex;gap:var(--space-md);align-items:flex-start;">
					<div style="width:36px;height:36px;border-radius:50%;background:var(--wp-green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">2</div>
					<div>
						<strong style="display:block;margin-bottom:4px;">Ongoing: Instant match alerts</strong>
						<span style="color:var(--wp-gray);font-size:0.9rem;">The moment a new deal matching your profile becomes available — before it goes to the wider network — you receive an alert with the key numbers, photos, and deal package.</span>
					</div>
				</div>
				<div style="display:flex;gap:var(--space-md);align-items:flex-start;">
					<div style="width:36px;height:36px;border-radius:50%;background:var(--wp-green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">3</div>
					<div>
						<strong style="display:block;margin-bottom:4px;">Direct access: Real team members</strong>
						<span style="color:var(--wp-gray);font-size:0.9rem;">Questions about any deal go directly to our acquisitions team — not a call center, not an automated system. Real people who know the numbers on every deal we present.</span>
					</div>
				</div>
			</div>
		</div>

		<div class="animate-on-scroll" style="transition-delay:0.4s;margin-top:var(--space-2xl);">
			<ul class="checklist" style="text-align:left;max-width:400px;margin-inline:auto;margin-bottom:var(--space-xl);">
				<li class="checklist__item checklist__item--check">Verified ARV from 90-day comparable sales</li>
				<li class="checklist__item checklist__item--check">Contractor-estimated repair costs included</li>
				<li class="checklist__item checklist__item--check">Seller commitment confirmed before we send</li>
				<li class="checklist__item checklist__item--check">JV structures available on select deals</li>
			</ul>
		</div>

		<div class="animate-on-scroll" style="transition-delay:0.5s;display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">Browse Current Deals &rarr;</a>
			<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline btn--lg"><?php echo esc_html( $phone ); ?></a>
		</div>

		<div class="animate-on-scroll" style="transition-delay:0.6s;margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--ghost">&larr; Back to Homepage</a>
		</div>

	</div>
</section>

<?php get_footer(); ?>
