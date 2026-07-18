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
					<?php echo esc_html( get_theme_mod( 'topbar_message',
						__( 'We Buy Houses in Ohio, Texas & Georgia | Written Cash Offer in 24 Hours | $0 Fees', 'wholesalepro' )
					) ); ?>
				</span>
				<span class="topbar__contact">
					<?php if ( get_theme_mod( 'company_phone_raw', '' ) ) : ?>
					<a href="tel:<?php echo esc_attr( get_theme_mod( 'company_phone_raw', '' ) ); ?>" class="topbar__phone">
						<?php esc_html_e( 'Call:', 'wholesalepro' ); ?>
						<?php echo esc_html( get_theme_mod( 'company_phone', '' ) ); ?>
					</a>
					<?php endif; ?>
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
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo__text" aria-label="<?php echo esc_attr( get_theme_mod( 'company_name', get_bloginfo( 'name' ) ) ); ?>, <?php esc_attr_e( 'Home', 'wholesalepro' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg?v=<?php echo esc_attr( WHOLESALEPRO_VERSION ); ?>"
								 alt="<?php echo esc_attr( get_theme_mod( 'company_name', get_bloginfo( 'name' ) ) ); ?>"
								 width="220" height="52"
								 style="height:44px;width:auto;display:block;">
						</a>
					<?php endif; ?>
				</div>

				<ul class="nav-links" role="list" id="primary-menu">
					<?php
					$svc_page = get_page_by_path( 'services' );
					$svc_url  = $svc_page ? get_permalink( $svc_page->ID ) : home_url( '/services' );
					$inv_page = get_page_by_path( 'investors' );
					$inv_url  = $inv_page ? get_permalink( $inv_page->ID ) : home_url( '/investors' );
					$book_page = get_page_by_path( 'book-a-call' );
					$book_url2 = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );
					$situations = array(
						'stop-foreclosure'      => __( "I'm behind on my mortgage", 'wholesalepro' ),
						'sell-probate-property' => __( 'I inherited a house', 'wholesalepro' ),
						'sell-house-divorce'    => __( "We're divorcing", 'wholesalepro' ),
						'sell-house-tax-liens'  => __( 'I owe back taxes or have liens', 'wholesalepro' ),
						'sell-damaged-house'    => __( 'The house needs major repairs', 'wholesalepro' ),
						'sell-rental-property'  => __( "I'm a tired landlord", 'wholesalepro' ),
					);
					?>
					<li class="nav-links__item menu-item menu-item-has-children">
						<a href="<?php echo esc_url( $svc_url ); ?>"><?php esc_html_e( 'Sell My House', 'wholesalepro' ); ?> <span aria-hidden="true" style="font-size:0.65em;">&#9662;</span></a>
						<ul class="sub-menu">
							<li class="sub-menu__label"><?php esc_html_e( 'WHAT IS YOUR SITUATION?', 'wholesalepro' ); ?></li>
							<?php
							foreach ( $situations as $slug => $label ) {
								$p = get_page_by_path( $slug );
								echo '<li><a href="' . esc_url( $p ? get_permalink( $p->ID ) : home_url( '/' . $slug ) ) . '">' . esc_html( $label ) . '</a></li>';
							}
							?>
							<li class="sub-menu__divider" aria-hidden="true"></li>
							<li><a href="<?php echo esc_url( $svc_url ); ?>"><?php esc_html_e( 'See all situations →', 'wholesalepro' ); ?></a></li>
							<li><a href="<?php echo esc_url( $book_url2 ); ?>"><?php esc_html_e( 'Book a free call', 'wholesalepro' ); ?></a></li>
						<li><a href="<?php echo esc_url( ( $pp = get_page_by_path( 'seller-protection' ) ) ? get_permalink( $pp->ID ) : home_url( '/seller-protection' ) ); ?>"><?php esc_html_e( 'How your money is protected', 'wholesalepro' ); ?></a></li>
						<li><a href="<?php echo esc_url( ( $ea = get_page_by_path( 'escrow-agents' ) ) ? get_permalink( $ea->ID ) : home_url( '/escrow-agents' ) ); ?>"><?php esc_html_e( 'Meet the escrow agents', 'wholesalepro' ); ?></a></li>
						</ul>
					</li>
					<?php
					$plain = array(
						'how-it-works' => __( 'How It Works', 'wholesalepro' ),
						'blog'         => __( 'Guides', 'wholesalepro' ),
						'faq'          => __( 'FAQ', 'wholesalepro' ),
					);
					foreach ( $plain as $slug => $label ) {
						$p = get_page_by_path( $slug );
						echo '<li class="nav-links__item menu-item"><a href="' . esc_url( $p ? get_permalink( $p->ID ) : home_url( '/' . $slug ) ) . '">' . esc_html( $label ) . '</a></li>';
					}
					?>
					<li class="nav-links__divider" aria-hidden="true"></li>
					<li class="nav-links__item menu-item">
						<a href="<?php echo esc_url( $inv_url ); ?>" class="nav-investors"><?php esc_html_e( 'For Investors', 'wholesalepro' ); ?></a>
					</li>
				</ul>

				<div class="nav-ctas" role="group" aria-label="<?php esc_attr_e( 'Quick action buttons', 'wholesalepro' ); ?>">
					<?php
					$sell_page = get_page_by_path( 'sell-my-house-fast' );
					$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
					$book_page = get_page_by_path( 'book-a-call' );
					$book_url  = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );
					?>
					<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--sm">
						<?php esc_html_e( 'Get Cash Offer', 'wholesalepro' ); ?>
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
			'stop-foreclosure'      => __( "I'm behind on my mortgage", 'wholesalepro' ),
			'sell-probate-property' => __( 'I inherited a house', 'wholesalepro' ),
			'sell-house-divorce'    => __( "We're divorcing", 'wholesalepro' ),
			'sell-house-tax-liens'  => __( 'I owe back taxes or liens', 'wholesalepro' ),
			'sell-damaged-house'    => __( 'The house needs repairs', 'wholesalepro' ),
			'sell-rental-property'  => __( "I'm a tired landlord", 'wholesalepro' ),
			'how-it-works'          => __( 'How It Works', 'wholesalepro' ),
			'blog'                  => __( 'Guides', 'wholesalepro' ),
			'faq'                   => __( 'FAQ', 'wholesalepro' ),
			'book-a-call'           => __( 'Book a Free Call', 'wholesalepro' ),
			'investors'             => __( 'For Investors', 'wholesalepro' ),
			'contact'               => __( 'Contact', 'wholesalepro' ),
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
	</div>

	<div class="nav-overlay__contact">
		<a href="tel:<?php echo esc_attr( get_theme_mod( 'company_phone_raw', '' ) ); ?>">
			<?php echo esc_html( get_theme_mod( 'company_phone', '' ) ); ?>
		</a>
	</div>
</div>

<main id="main-content" role="main">
