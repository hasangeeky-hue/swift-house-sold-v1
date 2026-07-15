<?php
/**
 * 404 Not Found Template
 *
 * @package WholesalePro
 */

get_header();

$sell_url  = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );
$deals_url = ( $p = get_page_by_path( 'browse-deals' ) )       ? get_permalink( $p->ID ) : home_url( '/browse-deals' );
$how_url   = ( $p = get_page_by_path( 'how-it-works' ) )       ? get_permalink( $p->ID ) : home_url( '/how-it-works' );
?>

<section class="section page-404" aria-labelledby="error-404-heading" style="min-height:65vh;display:flex;align-items:center;">
	<div class="container narrow text-center">

		<div class="animate-on-scroll" style="font-size:6rem;line-height:1;margin-bottom:var(--space-lg);" aria-hidden="true">🏚️</div>

		<h1 class="animate-on-scroll" id="error-404-heading" style="transition-delay:0.1s;font-size:clamp(2rem,5vw,3rem);">
			This Page Does Not Exist
		</h1>

		<p class="animate-on-scroll" style="transition-delay:0.2s;color:var(--wp-gray);font-size:1.125rem;max-width:520px;margin-inline:auto;margin-top:var(--space-md);">
			But your property situation does, and we can help with that. The page you were looking for could not be found. It may have been moved, renamed, or removed. Here are some pages that might be what you were looking for:
		</p>

		<div class="animate-on-scroll" style="transition-delay:0.3s;margin-top:var(--space-2xl);display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:var(--space-md);max-width:640px;margin-inline:auto;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">
				&#127968; Sell My House
			</a>
			<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">
				&#128200; Browse Deals
			</a>
			<a href="<?php echo esc_url( $how_url ); ?>" class="btn btn--outline btn--lg">
				&#10067; How It Works
			</a>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--lg">
				&#127968; Homepage
			</a>
		</div>

		<div class="animate-on-scroll" style="transition-delay:0.4s;margin-top:var(--space-2xl);max-width:400px;margin-inline:auto;">
			<p style="font-weight:600;margin-bottom:var(--space-sm);color:var(--wp-navy);">Or search our site:</p>
			<?php get_search_form(); ?>
		</div>

	</div>
</section>

<?php get_footer(); ?>
