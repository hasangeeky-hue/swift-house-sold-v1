<?php
/**
 * Site Header Template
 *
 * @package WholesalePro
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?php /* ── Favicon ─────────────────────────────────────────────── */ ?>
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/favicon.png">
<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/favicon.png">
<meta name="theme-color" content="#1B2B4B">

<?php /* ── Google Fonts: preconnect to eliminate FOUT ──────────── */ ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap"></noscript>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$fb_pixel = get_theme_mod( 'facebook_pixel_id', '' );
if ( $fb_pixel ) :
?>
<noscript>
	<img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=<?php echo esc_attr( $fb_pixel ); ?>&ev=PageView&noscript=1">
</noscript>
<?php endif; ?>

<a class="sr-only" href="#main-content"><?php esc_html_e( 'Skip to content', 'wholesalepro' ); ?></a>

<header class="site-header" id="site-header" role="banner">

	<?php if ( get_theme_mod( 'show_topbar', true ) ) : ?>
	<div class="topbar" role="complementary" aria-label="<?php esc_attr_e( 'Site announcements', 'wholesalepro' ); ?>">
		<div class="container">
			<div class="topbar__inner">
				<span class="topbar__message">
					<?php echo esc_html( get_theme_mod( 'topbar_message', sprintf(
						'%s | %s+ Deals Closed | We Buy Houses Nationwide',
						__( 'Serving All 50 States', 'wholesalepro' ),
						get_theme_mod( 'deals_closed_count', '500' )
					) ) ); ?>
				</span>
				<span class="topbar__contact">
					<a href="tel:<?php echo esc_attr( get_theme_mod( 'company_phone_raw', '5550000000' ) ); ?>" class="topbar__phone">
						<?php echo wholesalepro_get_star_rating( 4.9 ); // phpcs:ignore ?>
						<?php esc_html_e( 'Call:', 'wholesalepro' ); ?>
						<?php echo esc_html( get_theme_mod( 'company_phone', '(555) 000-0000' ) ); ?>
					</a>
				</span>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<nav class="main-nav" id="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'wholesalepro' ); ?>">
		<div class="container">
			<div class="nav-container">

				<div class="nav-logo">
					<?php if ( has_custom_logo() ) :
						the_custom_logo();
					else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo__text" aria-label="<?php echo esc_attr( get_theme_mod( 'company_name', get_bloginfo( 'name' ) ) ); ?> &mdash; <?php esc_attr_e( 'Home', 'wholesalepro' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg"
								 alt="<?php echo esc_attr( get_theme_mod( 'company_name', get_bloginfo( 'name' ) ) ); ?>"
								 width="220" height="52"
								 style="height:44px;width:auto;display:block;">
						</a>
					<?php endif; ?>
				</div>

				<ul class="nav-links" role="list" id="primary-menu">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'fallback_cb'    => function() {
							$nav_pages = array(
								'sell-my-house-fast' => __( 'Sell My House', 'wholesalepro' ),
								'browse-deals'       => __( 'Browse Deals', 'wholesalepro' ),
								'how-it-works'       => __( 'How It Works', 'wholesalepro' ),
								'about-us'           => __( 'About', 'wholesalepro' ),
								'contact'            => __( 'Contact', 'wholesalepro' ),
							);
							foreach ( $nav_pages as $slug => $label ) {
								$page = get_page_by_path( $slug );
								$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
								echo '<li class="nav-links__item menu-item"><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
							}
						},
					) );
					?>
				</ul>

				<div class="nav-ctas" role="group" aria-label="<?php esc_attr_e( 'Quick action buttons', 'wholesalepro' ); ?>">
					<?php
					$sell_page = get_page_by_path( 'sell-my-house-fast' );
					$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
					$deal_page = get_page_by_path( 'browse-deals' );
					$deal_url  = $deal_page ? get_permalink( $deal_page->ID ) : home_url( '/browse-deals' );
					?>
					<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--sm">
						<?php esc_html_e( 'Get Cash Offer', 'wholesalepro' ); ?>
					</a>
					<a href="<?php echo esc_url( $deal_url ); ?>" class="btn btn--outline btn--sm" style="color:var(--wp-navy);border-color:var(--wp-navy);">
						<?php esc_html_e( 'View Deals', 'wholesalepro' ); ?>
					</a>
				</div>

				<button class="nav-toggle js-nav-toggle"
					aria-expanded="false"
					aria-controls="nav-overlay"
					aria-label="<?php esc_attr_e( 'Open navigation menu', 'wholesalepro' ); ?>">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<line x1="3" y1="6" x2="21" y2="6"/>
						<line x1="3" y1="12" x2="21" y2="12"/>
						<line x1="3" y1="18" x2="21" y2="18"/>
					</svg>
				</button>

			</div>
		</div>
	</nav>
</header>

<div class="nav-overlay js-nav-overlay" id="nav-overlay" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Navigation menu', 'wholesalepro' ); ?>" aria-hidden="true">
	<button class="nav-overlay__close js-nav-close" aria-label="<?php esc_attr_e( 'Close navigation menu', 'wholesalepro' ); ?>">
		<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
			<line x1="18" y1="6" x2="6" y2="18"/>
			<line x1="6" y1="6" x2="18" y2="18"/>
		</svg>
	</button>

	<ul class="nav-overlay__links" role="list">
		<?php
		$overlay_pages = array(
			'sell-my-house-fast' => __( 'Sell My House', 'wholesalepro' ),
			'browse-deals'       => __( 'Browse Deals', 'wholesalepro' ),
			'how-it-works'       => __( 'How It Works', 'wholesalepro' ),
			'about-us'           => __( 'About Us', 'wholesalepro' ),
			'contact'            => __( 'Contact', 'wholesalepro' ),
		);
		foreach ( $overlay_pages as $slug => $label ) {
			$page = get_page_by_path( $slug );
			$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
			echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
		}
		?>
	</ul>

	<div class="nav-overlay__ctas">
		<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg btn--full">
			<?php esc_html_e( 'Get My Free Cash Offer', 'wholesalepro' ); ?>
		</a>
		<a href="<?php echo esc_url( $deal_url ); ?>" class="btn btn--outline-white btn--lg btn--full">
			<?php esc_html_e( 'View Available Deals', 'wholesalepro' ); ?>
		</a>
	</div>

	<div class="nav-overlay__contact">
		<a href="tel:<?php echo esc_attr( get_theme_mod( 'company_phone_raw', '5550000000' ) ); ?>">
			<?php echo esc_html( get_theme_mod( 'company_phone', '(555) 000-0000' ) ); ?>
		</a>
	</div>
</div>

<main id="main-content" role="main">
