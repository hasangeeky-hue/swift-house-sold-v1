<?php
/**
 * Generic Page Template
 *
 * @package WholesalePro
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content' ); ?>>

	<header class="page-hero page-hero--compact">
		<div class="container">
			<?php wholesalepro_breadcrumb(); ?>
			<h1 class="page-hero__title animate-on-scroll"><?php the_title(); ?></h1>
		</div>
	</header>

	<div class="container">
		<div class="content-grid" style="padding-top:var(--space-2xl);padding-bottom:var(--space-2xl);">
			<div class="content-grid__main">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();

					wp_link_pages( array(
						'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page navigation', 'wholesalepro' ) . '">',
						'after'  => '</nav>',
					) );
				endwhile;
				?>
			</div>
		</div>
	</div>

</article>

<?php get_footer(); ?>
