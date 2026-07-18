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
		<p class="page-hero__eyebrow">OUR SERVICES, OHIO · TEXAS · GEORGIA</p>
		<h1 class="page-hero__title" id="services-hero-heading">Whatever You're Facing, There's a Service Built For It</h1>
		<p class="page-hero__subtitle">Every situation below has its own dedicated process, timeline knowledge, and guides. Pick yours, or book a free consultation and we'll figure it out together.</p>
	</div>
</section>

<?php
$svg_icons = array(
	'sell-probate-property' => '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/></svg></div>',
	'stop-foreclosure' => '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>',
	'sell-house-divorce' => '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3v18M3 7h18M6 7l-3 7a4 4 0 008 0zM18 7l-3 7a4 4 0 008 0z"/></svg></div>',
	'sell-house-tax-liens' => '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8"/></svg></div>',
	'sell-damaged-house' => '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg></div>',
	'sell-rental-property' => '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg></div>',
	'default' => '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/></svg></div>',
);
?>
<section class="section" aria-labelledby="services-grid-heading">
	<div class="container">
		<h2 class="sr-only" id="services-grid-heading">All services</h2>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			foreach ( shs_services_config() as $slug => $svc ) :
				$page = get_page_by_path( $slug );
				$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
				?>
			<div class="card animate-on-scroll" style="padding:0;display:flex;flex-direction:column;overflow:hidden;">
				<img src="<?php echo esc_url( shs_cat_image( $svc['category'] ) ); ?>" alt="" loading="lazy" style="width:100%;height:160px;object-fit:cover;display:block;">
				<div style="padding:var(--space-lg) var(--space-xl) var(--space-xl);display:flex;flex-direction:column;flex:1;">
				<?php echo isset( $svg_icons[ $slug ] ) ? $svg_icons[ $slug ] : $svg_icons['default']; // phpcs:ignore ?>
				<h3 style="font-size:1.1rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $svc['menu'] ); ?></h3>
				<p style="color:var(--wp-gray);font-size:0.93rem;flex:1;"><?php echo esc_html( wp_trim_words( $svc['answer'], 24 ) ); ?></p>
				<a href="<?php echo esc_url( $url ); ?>" class="btn btn--seller btn--full" style="margin-top:var(--space-md);">Learn More &rarr;</a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="text-center" style="margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline btn--lg">Not Sure Which Fits? Book a Free Consultation &rarr;</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
