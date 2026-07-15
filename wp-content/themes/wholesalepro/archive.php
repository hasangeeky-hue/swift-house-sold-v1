<?php
/**
 * Blog Archive Template
 *
 * @package WholesalePro
 */

get_header();
?>

<header class="page-hero page-hero--compact" aria-labelledby="archive-page-heading">
	<div class="container">
		<?php wholesalepro_breadcrumb(); ?>
		<h1 class="page-hero__title animate-on-scroll" id="archive-page-heading">
			<?php
			if ( is_category() ) {
				echo esc_html( single_cat_title( '', false ) );
			} elseif ( is_tag() ) {
				printf( esc_html__( 'Tag: %s', 'wholesalepro' ), esc_html( single_tag_title( '', false ) ) );
			} elseif ( is_author() ) {
				printf( esc_html__( 'Author: %s', 'wholesalepro' ), esc_html( get_the_author() ) );
			} elseif ( is_year() ) {
				printf( esc_html__( 'Year: %s', 'wholesalepro' ), esc_html( get_the_date( 'Y' ) ) );
			} elseif ( is_month() ) {
				printf( esc_html__( 'Month: %s', 'wholesalepro' ), esc_html( get_the_date( 'F Y' ) ) );
			} elseif ( is_home() ) {
				esc_html_e( 'Blog', 'wholesalepro' );
			} else {
				the_archive_title();
			}
			?>
		</h1>
		<?php
		$desc = get_the_archive_description();
		if ( $desc ) :
		?>
		<p class="page-hero__subtitle animate-on-scroll" style="transition-delay:0.1s">
			<?php echo wp_kses_post( $desc ); ?>
		</p>
		<?php endif; ?>
	</div>
</header>

<section class="section" aria-labelledby="archive-page-heading">
	<div class="container">

		<?php if ( have_posts() ) : ?>

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
					$cats = get_the_category();
					if ( $cats ) :
					?>
					<div class="blog-card__meta">
						<a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>" class="blog-card__cat">
							<?php echo esc_html( $cats[0]->name ); ?>
						</a>
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
						<?php
						$read_time = wholesalepro_read_time( get_the_ID() );
						if ( $read_time ) :
						?>
						<span><?php printf( esc_html__( '%s min read', 'wholesalepro' ), esc_html( $read_time ) ); ?></span>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--sm"><?php esc_html_e( 'Read More', 'wholesalepro' ); ?> &rarr;</a>
					</div>
				</div>

			</article>
			<?php endwhile; ?>
		</div>

		<?php
		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&larr; ' . esc_html__( 'Newer Posts', 'wholesalepro' ),
			'next_text' => esc_html__( 'Older Posts', 'wholesalepro' ) . ' &rarr;',
		) );
		?>

		<?php else : ?>

		<div class="empty-state">
			<div class="empty-state__icon">📝</div>
			<h2 class="empty-state__title"><?php esc_html_e( 'No Posts Found', 'wholesalepro' ); ?></h2>
			<p class="empty-state__text"><?php esc_html_e( 'Nothing here yet. Check back soon.', 'wholesalepro' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Go to Homepage', 'wholesalepro' ); ?></a>
		</div>

		<?php endif; ?>

	</div>
</section>

<?php get_footer(); ?>
