<?php
/**
 * Main Index Template (fallback)
 *
 * @package WholesalePro
 */

get_header();
?>

<div class="container" style="padding-top:var(--space-2xl);padding-bottom:var(--space-2xl);">

	<?php if ( have_posts() ) : ?>

		<header class="section-header animate-on-scroll">
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<h1 class="section-header__title"><?php single_post_title(); ?></h1>
			<?php elseif ( is_search() ) : ?>
				<h1 class="section-header__title">
					<?php
					printf(
						/* translators: %s: search query */
						esc_html__( 'Search Results for: %s', 'wholesalepro' ),
						'<span>' . get_search_query() . '</span>'
					);
					?>
				</h1>
			<?php endif; ?>
		</header>

		<div class="grid grid-3" style="gap:var(--space-xl);">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card animate-on-scroll' ); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
					<div class="blog-card__image">
						<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
							<?php the_post_thumbnail( 'wholesalepro-card', array( 'loading' => 'lazy' ) ); ?>
						</a>
					</div>
					<?php endif; ?>

					<div class="blog-card__body">
						<?php
						$terms = get_the_category();
						if ( $terms && ! is_wp_error( $terms ) ) :
						?>
						<div class="blog-card__meta">
							<span class="blog-card__cat"><?php echo esc_html( $terms[0]->name ); ?></span>
						</div>
						<?php endif; ?>

						<h2 class="blog-card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>

						<p class="blog-card__excerpt"><?php the_excerpt(); ?></p>

						<div class="blog-card__footer">
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
								<?php echo esc_html( get_the_date() ); ?>
							</time>
							<a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--sm">
								<?php esc_html_e( 'Read More', 'wholesalepro' ); ?> &rarr;
							</a>
						</div>
					</div>

				</article>
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&larr; ' . esc_html__( 'Newer', 'wholesalepro' ),
			'next_text' => esc_html__( 'Older', 'wholesalepro' ) . ' &rarr;',
		) ); ?>

	<?php else : ?>

		<div class="empty-state">
			<div class="empty-state__icon">📄</div>
			<h1 class="empty-state__title"><?php esc_html_e( 'Nothing Found', 'wholesalepro' ); ?></h1>
			<p class="empty-state__text"><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Try a search.', 'wholesalepro' ); ?></p>
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>

</div>

<?php get_footer(); ?>
