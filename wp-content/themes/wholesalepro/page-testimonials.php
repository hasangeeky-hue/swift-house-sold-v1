<?php
/**
 * Testimonials Page Template
 * Template Name: Testimonials
 *
 * Honest founding-promise version, no fabricated reviews.
 * Real seller stories get added here as deals close.
 *
 * @package WholesalePro
 */

get_header();

$sell_page = get_page_by_path( 'sell-my-house-fast' );
$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
$how_page  = get_page_by_path( 'how-it-works' );
$how_url   = $how_page ? get_permalink( $how_page->ID ) : home_url( '/how-it-works' );
$faq_page  = get_page_by_path( 'faq' );
$faq_url   = $faq_page ? get_permalink( $faq_page->ID ) : home_url( '/faq' );
?>

<section class="page-hero page-hero--seller" aria-labelledby="testimonials-hero-heading">
	<div class="container">
		<p class="page-hero__eyebrow">OUR PROMISE TO EVERY SELLER</p>
		<h1 class="page-hero__title" id="testimonials-hero-heading">We'd Rather Show You Nothing Than Show You Fake Reviews</h1>
		<p class="page-hero__subtitle">We're a new company. This page will fill with real seller stories, names, cities, timelines, as we close deals. Until then, here is exactly what every seller can hold us to.</p>
	</div>
</section>

<section class="section" aria-labelledby="promise-heading">
	<div class="container">
		<div class="section-header text-center">
			<h2 class="section-header__title" id="promise-heading">The Standard Every Future Review Will Be Measured Against</h2>
		</div>
		<div class="grid grid-2" style="gap:var(--space-lg);max-width:900px;margin:0 auto;">
			<?php
			$promises = array(
				array( '📄', 'A written offer within 24 hours', 'Not a phone estimate, a written document showing the price and every number behind it: the comparable sales, our repair estimate, and our margin.' ),
				array( '🚫', 'No pressure, no deadline tricks', 'Our offers do not "expire tonight." Take days. Show it to your attorney or your family. If it stops making sense for you, walk away at zero cost.' ),
				array( '🏛️', 'A licensed title company on every deal', 'Money and documents flow through a licensed, insured title company, never directly through us. Your protection is structural, not a promise.' ),
				array( '💵', 'The offer is the amount you receive', 'No commissions, no closing costs, no repair deductions discovered later. If a number ever changes after inspection, we show you exactly why, and you can decline.' ),
			);
			foreach ( $promises as $i => $pr ) : ?>
			<div class="card animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s">
				<div style="font-size:2rem;margin-bottom:var(--space-sm);" aria-hidden="true"><?php echo $pr[0]; // phpcs:ignore ?></div>
				<h3 style="font-size:1.1rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $pr[1] ); ?></h3>
				<p style="color:var(--wp-gray);font-size:0.95rem;margin:0;"><?php echo esc_html( $pr[2] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="text-center" style="margin-top:var(--space-xl);">
			<p style="color:var(--wp-gray);max-width:620px;margin:0 auto var(--space-lg);">
				Want to verify us before talking to us? Fair. Read <a href="<?php echo esc_url( $how_url ); ?>">exactly how our process works</a>, check the <a href="<?php echo esc_url( $faq_url ); ?>">questions other sellers ask</a>, and bring your own attorney to review anything we send, we encourage it.
			</p>
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get a Written Offer &amp; Judge Us Yourself &rarr;</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
