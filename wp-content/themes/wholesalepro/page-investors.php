<?php
/**
 * Services hub, one card per target customer group.
 *
 * @package WholesalePro
 */

get_header();

$book_url = ( $p = get_page_by_path( 'book-a-call' ) ) ? get_permalink( $p->ID ) : home_url( '/book-a-call' );
?>

<section class="page-hero page-hero--seller" aria-labelledby="services-hero-heading">
	<div class="container">
		<p class="page-hero__eyebrow">FOR INVESTORS · OHIO · TEXAS · GEORGIA</p>
		<h1 class="page-hero__title" id="services-hero-heading">Buy Off-Market Deals With Numbers You Can Verify</h1>
		<p class="page-hero__subtitle">Three ways investors work with us. Every deal comes with verifiable numbers and an inspection period. Pick your strategy, or book a free call and tell us your criteria.</p>
	</div>
</section>

<section class="section" aria-labelledby="services-grid-heading">
	<div class="container">
		<h2 class="sr-only" id="services-grid-heading">All services</h2>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$icons = array(
				'sell-probate-property' => '🏠',
				'stop-foreclosure'      => '⏰',
				'sell-house-divorce'    => '⚖️',
				'sell-house-tax-liens'  => '📋',
				'sell-damaged-house'    => '🔧',
				'sell-rental-property'  => '🔑',
			);
			foreach ( shs_investors_config() as $slug => $svc ) :
				$page = get_page_by_path( $slug );
				$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
				?>
			<div class="card animate-on-scroll" style="padding:0;display:flex;flex-direction:column;overflow:hidden;">
				<img src="<?php echo esc_url( shs_cat_image( $svc['category'] ) ); ?>" alt="" loading="lazy" style="width:100%;height:160px;object-fit:cover;display:block;">
				<div style="padding:var(--space-lg) var(--space-xl) var(--space-xl);display:flex;flex-direction:column;flex:1;">
				<div style="font-size:2rem;margin-bottom:var(--space-sm);" aria-hidden="true"><?php echo isset( $icons[ $slug ] ) ? $icons[ $slug ] : '🏠'; // phpcs:ignore ?></div>
				<h3 style="font-size:1.1rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $svc['menu'] ); ?></h3>
				<p style="color:var(--wp-gray);font-size:0.93rem;flex:1;"><?php echo esc_html( wp_trim_words( $svc['answer'], 24 ) ); ?></p>
				<a href="<?php echo esc_url( $url ); ?>" class="btn btn--seller btn--full" style="margin-top:var(--space-md);">Learn More &rarr;</a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="text-center" style="margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline btn--lg">Not Sure Which Fits? Book a Free Call &rarr;</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
