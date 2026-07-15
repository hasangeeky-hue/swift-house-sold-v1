<?php
/**
 * Search Results Template
 *
 * @package WholesalePro
 */

get_header();

$query    = get_search_query();
$count    = $GLOBALS['wp_query']->found_posts;
?>

<header class="page-hero page-hero--compact" aria-labelledby="search-heading">
	<div class="container">
		<?php wholesalepro_breadcrumb(); ?>
		<h1 class="page-hero__title animate-on-scroll" id="search-heading">
			<?php
			if ( $query ) {
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search Results for "%s"', 'wholesalepro' ),
					esc_html( $query )
				);
			} else {
				esc_html_e( 'Search Results', 'wholesalepro' );
			}
			?>
		</h1>
		<p class="animate-on-scroll" style="transition-delay:0.1s;color:rgba(255,255,255,0.8);">
			<?php
			printf(
				esc_html( _n( '%d result found', '%d results found', $count, 'wholesalepro' ) ),
				esc_html( number_format_i18n( $count ) )
			);
			?>
		</p>
	</div>
</header>

<section class="section" aria-labelledby="search-heading">
	<div class="container">

		<div class="search-bar animate-on-scroll" style="margin-bottom:var(--space-2xl);max-width:560px;">
			<?php get_search_form(); ?>
		</div>

		<?php if ( have_posts() ) : ?>

		<div style="display:flex;flex-direction:column;gap:var(--space-xl);">
			<?php
			while ( have_posts() ) :
				the_post();
				$post_type = get_post_type();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result animate-on-scroll' ); ?> style="padding-bottom:var(--space-xl);border-bottom:1px solid var(--wp-border);">

				<?php if ( 'property' === $post_type ) : ?>
					<span class="badge badge--green" style="margin-bottom:var(--space-sm);"><?php esc_html_e( 'Deal', 'wholesalepro' ); ?></span>
				<?php else : ?>
					<?php
					$cats = get_the_category();
					if ( $cats ) :
					?>
					<span class="badge badge--navy" style="margin-bottom:var(--space-sm);"><?php echo esc_html( $cats[0]->name ); ?></span>
					<?php endif; ?>
				<?php endif; ?>

				<h2 style="margin-bottom:var(--space-sm);">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<div class="search-result__meta" style="font-size:0.875rem;color:var(--wp-gray);margin-bottom:var(--space-sm);display:flex;gap:var(--space-md);flex-wrap:wrap;">
					<span>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
					</span>
					<span><?php echo esc_url( get_permalink() ); ?></span>
				</div>

				<p style="color:var(--wp-gray);margin:0;"><?php the_excerpt(); ?></p>

				<a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--sm" style="margin-top:var(--space-sm);">
					<?php esc_html_e( 'View', 'wholesalepro' ); ?> &rarr;
				</a>

			</article>
			<?php endwhile; ?>
		</div>

		<?php
		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&larr; ' . esc_html__( 'Previous', 'wholesalepro' ),
			'next_text' => esc_html__( 'Next', 'wholesalepro' ) . ' &rarr;',
		) );
		?>

		<?php else : ?>

		<div class="empty-state">
			<div class="empty-state__icon">🔍</div>
			<h2 class="empty-state__title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'No results for "%s"', 'wholesalepro' ),
					esc_html( $query )
				);
				?>
			</h2>
			<p class="empty-state__text"><?php esc_html_e( 'Try different keywords, or browse our popular pages below.', 'wholesalepro' ); ?></p>
			<div style="display:flex;gap:var(--space-sm);flex-wrap:wrap;justify-content:center;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Homepage', 'wholesalepro' ); ?></a>
				<?php
				$deals_page = get_page_by_path( 'browse-deals' );
				if ( $deals_page ) :
				?>
				<a href="<?php echo esc_url( get_permalink( $deals_page->ID ) ); ?>" class="btn btn--buyer"><?php esc_html_e( 'Browse Deals', 'wholesalepro' ); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<?php endif; ?>

	</div>
</section>

<?php get_footer(); ?>
