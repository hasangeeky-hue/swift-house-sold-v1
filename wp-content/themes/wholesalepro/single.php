<?php
/**
 * Single Blog Post Template
 *
 * @package WholesalePro
 */

get_header();

while ( have_posts() ) :
	the_post();

	$read_time    = wholesalepro_read_time( get_the_content() );
	$author_id    = get_the_author_meta( 'ID' );
	$author_name  = get_the_author();
	$author_bio   = get_the_author_meta( 'description' );
	$author_url   = get_author_posts_url( $author_id );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?> itemscope itemtype="https://schema.org/Article">

	<div class="reading-progress-bar" id="reading-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-label="<?php esc_attr_e( 'Reading progress', 'wholesalepro' ); ?>"></div>

	<header class="post-hero" aria-labelledby="post-hero-heading">
		<div class="container narrow">
			<?php wholesalepro_breadcrumb(); ?>

			<?php
			$cats = get_the_category();
			if ( $cats ) :
			?>
			<div class="post-meta__cats" style="margin-bottom:var(--space-sm);">
				<?php foreach ( $cats as $cat ) : ?>
				<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="badge badge--navy">
					<?php echo esc_html( $cat->name ); ?>
				</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<h1 class="animate-on-scroll" id="post-hero-heading" itemprop="headline"><?php the_title(); ?></h1>

			<div class="post-meta animate-on-scroll" style="transition-delay:0.1s;display:flex;flex-wrap:wrap;gap:var(--space-md);align-items:center;margin-top:var(--space-md);">
				<span style="display:flex;align-items:center;gap:8px;">
					<?php echo get_avatar( $author_id, 36, '', '', array( 'class' => 'post-meta__avatar' ) ); ?>
					<a href="<?php echo esc_url( $author_url ); ?>" itemprop="author" itemscope itemtype="https://schema.org/Person">
						<span itemprop="name"><?php echo esc_html( $author_name ); ?></span>
					</a>
				</span>
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
				<?php if ( $read_time ) : ?>
				<span><?php printf( esc_html__( '%s min read', 'wholesalepro' ), esc_html( $read_time ) ); ?></span>
				<?php endif; ?>
			</div>

		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-featured-image animate-on-scroll" style="margin:var(--space-xl) 0;">
		<div class="container">
			<?php the_post_thumbnail( 'wholesalepro-hero', array( 'itemprop' => 'image', 'class' => 'post-featured-image__img' ) ); ?>
		</div>
	</div>
	<?php endif; ?>

	<div class="container narrow">
		<div class="post-layout">

			<div class="post-content entry-content animate-on-scroll" itemprop="articleBody">
				<?php
				the_content( sprintf(
					wp_kses(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wholesalepro' ),
						array( 'span' => array( 'class' => array() ) )
					),
					wp_kses_post( get_the_title() )
				) );
				wp_link_pages( array(
					'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page navigation', 'wholesalepro' ) . '">',
					'after'  => '</nav>',
				) );
				?>
			</div>

			<?php
			$tags = get_the_tags();
			if ( $tags ) :
			?>
			<div class="post-tags animate-on-scroll" style="margin-top:var(--space-xl);padding-top:var(--space-lg);border-top:1px solid var(--wp-border);">
				<strong style="margin-right:var(--space-sm);"><?php esc_html_e( 'Tags:', 'wholesalepro' ); ?></strong>
				<?php foreach ( $tags as $tag ) : ?>
				<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="badge badge--outline" style="margin-right:4px;margin-bottom:4px;">
					<?php echo esc_html( $tag->name ); ?>
				</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php echo wholesalepro_share_buttons( get_the_ID() ); // phpcs:ignore ?>

			<?php if ( $author_bio ) : ?>
			<div class="author-box animate-on-scroll" style="margin-top:var(--space-2xl);" itemscope itemtype="https://schema.org/Person">
				<div class="author-box__avatar">
					<?php echo get_avatar( $author_id, 80, '', '', array( 'itemprop' => 'image' ) ); ?>
				</div>
				<div class="author-box__info">
					<h3 class="author-box__name">
						<a href="<?php echo esc_url( $author_url ); ?>" itemprop="url">
							<span itemprop="name"><?php echo esc_html( $author_name ); ?></span>
						</a>
					</h3>
					<p class="author-box__bio" itemprop="description"><?php echo esc_html( $author_bio ); ?></p>
				</div>
			</div>
			<?php endif; ?>

			<?php
			$prev = get_previous_post();
			$next = get_next_post();
			if ( $prev || $next ) :
			?>
			<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Post navigation', 'wholesalepro' ); ?>" style="margin-top:var(--space-2xl);padding-top:var(--space-xl);border-top:1px solid var(--wp-border);display:flex;justify-content:space-between;gap:var(--space-lg);flex-wrap:wrap;">
				<?php if ( $prev ) : ?>
				<div>
					<span style="font-size:0.8rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--wp-gray);"><?php esc_html_e( '← Previous', 'wholesalepro' ); ?></span>
					<div style="margin-top:4px;"><a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" style="font-weight:600;"><?php echo esc_html( get_the_title( $prev->ID ) ); ?></a></div>
				</div>
				<?php endif; ?>
				<?php if ( $next ) : ?>
				<div style="text-align:right;">
					<span style="font-size:0.8rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--wp-gray);"><?php esc_html_e( 'Next →', 'wholesalepro' ); ?></span>
					<div style="margin-top:4px;"><a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" style="font-weight:600;"><?php echo esc_html( get_the_title( $next->ID ) ); ?></a></div>
				</div>
				<?php endif; ?>
			</nav>
			<?php endif; ?>

		</div>
	</div>

</article>

<?php
/* Newsletter: deal list & seller tips (replaces comments sitewide) */
?>
<section class="section bg--navy" aria-labelledby="newsletter-heading">
	<div class="container" style="max-width:720px;">
		<div class="text-center">
			<p class="section-header__eyebrow" style="color:var(--wp-gold);">FREE NEWSLETTER</p>
			<h2 id="newsletter-heading" style="color:#fff;margin-bottom:var(--space-sm);">Get New Guides &amp; Off-Market Deal Alerts</h2>
			<p style="color:rgba(255,255,255,0.75);margin-bottom:var(--space-lg);">One useful email at a time: new seller guides, and first access to off-market deals in Ohio, Texas and Georgia when they go live. No spam, unsubscribe anytime.</p>
		</div>
		<form class="wp-form js-ajax-form" data-action="wholesalepro_buyer_form" novalidate style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
			<?php wp_nonce_field( 'wholesalepro-nonce', 'nonce' ); ?>
			<input type="hidden" name="action" value="wholesalepro_buyer_form">
			<input type="hidden" name="form_location" value="newsletter-post">
			<div style="position:absolute;left:-9999px;" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
			<input class="form-control" type="text" name="buyer_name" required placeholder="Your name" autocomplete="name" style="flex:1;min-width:160px;max-width:220px;">
			<input class="form-control" type="email" name="buyer_email" required placeholder="you@email.com" autocomplete="email" style="flex:2;min-width:200px;max-width:320px;">
			<button type="submit" class="btn btn--seller js-submit" style="white-space:nowrap;">Subscribe &rarr;</button>
			<div class="form-success" style="display:none;flex-basis:100%;text-align:center;color:#fff;" role="status" aria-live="polite">
				<p style="margin:12px 0 0;">You're on the list. Watch your inbox!</p>
			</div>
		</form>
	</div>
</section>

<?php
/* Related guides: interactive cards + internal linking */
$rel_cats = wp_get_post_categories( get_the_ID() );
if ( $rel_cats ) :
	$related = new WP_Query( array(
		'posts_per_page' => 3,
		'post__not_in'   => array( get_the_ID() ),
		'category__in'   => $rel_cats,
		'post_status'    => 'publish',
	) );
	if ( $related->have_posts() ) :
		$rel_cat_slug = get_category( $rel_cats[0] )->slug;
?>
<section class="section" aria-labelledby="related-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">KEEP LEARNING</p>
			<h2 class="section-header__title" id="related-heading">Related Guides</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php while ( $related->have_posts() ) : $related->the_post(); ?>
			<article class="card card--guide" style="padding:0;overflow:hidden;">
				<a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;display:block;">
					<img src="<?php echo esc_url( shs_cat_image( $rel_cat_slug ) ); ?>" alt="" loading="lazy" style="width:100%;height:140px;object-fit:cover;display:block;">
					<div style="padding:var(--space-lg);">
						<h3 style="font-size:1rem;margin-bottom:var(--space-sm);"><?php the_title(); ?></h3>
						<span style="font-weight:600;color:var(--wp-red);">Read Guide &rarr;</span>
					</div>
				</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; endif; ?>

<?php
/* CTA band: the reason the guides exist */
$sell_page = get_page_by_path( 'sell-my-house-fast' );
$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
$book_page = get_page_by_path( 'book-a-call' );
$book_url  = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );
?>
<section class="section bg--light-gray" aria-labelledby="post-cta-heading">
	<div class="container text-center">
		<h2 id="post-cta-heading" style="margin-bottom:var(--space-sm);">Ready to Talk About Your House?</h2>
		<p style="color:var(--wp-gray);max-width:520px;margin:0 auto var(--space-lg);">Written cash offer in 24 hours, or a free consultation first. Both cost nothing and commit you to nothing.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Free Cash Offer &rarr;</a>
			<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline btn--lg">Book a Free Consultation</a>
		</div>
	</div>
</section>

<?php
endwhile;
get_footer();
?>
