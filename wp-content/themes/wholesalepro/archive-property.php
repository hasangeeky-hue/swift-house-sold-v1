<?php
/**
 * Property Archive Template (redirects to Browse Deals page)
 *
 * @package WholesalePro
 */

// If a Browse Deals page exists, redirect to it.
$deals_page = get_page_by_path( 'browse-deals' );
if ( $deals_page ) {
	wp_safe_redirect( get_permalink( $deals_page->ID ), 301 );
	exit;
}

// Fallback: render inline archive.
get_header();
?>

<section class="page-hero page-hero--compact" aria-labelledby="archive-hero-heading">
	<div class="container">
		<?php wholesalepro_breadcrumb(); ?>
		<h1 class="page-hero__title animate-on-scroll" id="archive-hero-heading">
			<?php esc_html_e( 'Available Deals', 'wholesalepro' ); ?>
		</h1>
	</div>
</section>

<section class="section" aria-labelledby="archive-results-heading">
	<div class="container">
		<h2 class="sr-only" id="archive-results-heading"><?php esc_html_e( 'Property Listings', 'wholesalepro' ); ?></h2>
		<?php if ( have_posts() ) : ?>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			while ( have_posts() ) :
				the_post();
				echo wholesalepro_get_property_card( get_the_ID() ); // phpcs:ignore
			endwhile;
			?>
		</div>
		<?php the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&larr; ' . esc_html__( 'Previous', 'wholesalepro' ),
			'next_text' => esc_html__( 'Next', 'wholesalepro' ) . ' &rarr;',
		) ); ?>
		<?php else : ?>
		<div class="empty-state">
			<div class="empty-state__icon">🏠</div>
			<h3 class="empty-state__title"><?php esc_html_e( 'No Deals Right Now', 'wholesalepro' ); ?></h3>
			<p class="empty-state__text"><?php esc_html_e( 'New deals are added regularly. Check back soon or join our buyer list.', 'wholesalepro' ); ?></p>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
