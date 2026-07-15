<?php
/**
 * Asset Enqueueing
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ── Google Fonts Preconnect ─────────────────────────────────── */
function wholesalepro_preconnect_fonts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'wholesalepro_preconnect_fonts', 1 );

/* ── GTM Head Snippet ────────────────────────────────────────── */
function wholesalepro_gtm_head() {
	$gtm = get_theme_mod( 'google_tag_manager', '' );
	if ( ! $gtm ) {
		return;
	}
	?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?php echo esc_js( $gtm ); ?>');</script>
	<!-- End Google Tag Manager -->
	<?php
}
add_action( 'wp_head', 'wholesalepro_gtm_head', 2 );

/* ── GTM Body Snippet ────────────────────────────────────────── */
function wholesalepro_gtm_body() {
	$gtm = get_theme_mod( 'google_tag_manager', '' );
	if ( ! $gtm ) {
		return;
	}
	echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr( $gtm ) . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>' . "\n";
}
add_action( 'wp_body_open', 'wholesalepro_gtm_body', 1 );

/* ── GA4 ─────────────────────────────────────────────────────── */
function wholesalepro_ga4() {
	$ga_id = get_theme_mod( 'google_analytics_id', '' );
	if ( ! $ga_id ) {
		return;
	}
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga_id ); ?>"></script>
	<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo esc_js( $ga_id ); ?>');</script>
	<?php
}
add_action( 'wp_head', 'wholesalepro_ga4', 3 );

/* ── Front-end Assets ────────────────────────────────────────── */
function wholesalepro_enqueue_assets() {
	$ver = WHOLESALEPRO_VERSION;
	$uri = WHOLESALEPRO_URI;

	// Google Fonts — loaded via <link rel="preload"> in header.php for FOUT elimination
	// wp_enqueue_style( 'wholesalepro-google-fonts', ... ) intentionally removed

	// Core stylesheets
	wp_enqueue_style( 'wholesalepro-base',       $uri . '/assets/css/base.css',       array(), $ver );
	wp_enqueue_style( 'wholesalepro-layout',     $uri . '/assets/css/layout.css',     array( 'wholesalepro-base' ), $ver );
	wp_enqueue_style( 'wholesalepro-components', $uri . '/assets/css/components.css', array( 'wholesalepro-layout' ), $ver );
	wp_enqueue_style( 'wholesalepro-animations', $uri . '/assets/css/animations.css', array( 'wholesalepro-components' ), $ver );
	wp_enqueue_style( 'wholesalepro-responsive', $uri . '/assets/css/responsive.css', array( 'wholesalepro-components' ), $ver );

	// Conditional: page templates
	if ( is_page() || is_singular() || is_archive() || is_home() || is_search() ) {
		wp_enqueue_style( 'wholesalepro-pages', $uri . '/assets/css/pages.css', array( 'wholesalepro-components' ), $ver );
	}

	// Conditional: property pages
	if ( is_singular( 'property' ) || is_post_type_archive( 'property' ) || is_tax( 'property_state' ) || is_tax( 'property_type' ) || is_tax( 'deal_status' ) ) {
		wp_enqueue_style( 'wholesalepro-property', $uri . '/assets/css/property.css', array( 'wholesalepro-components' ), $ver );
	}

	// Design enhancements — loaded last so they override base styles
	wp_enqueue_style( 'wholesalepro-enhancements', $uri . '/assets/css/enhancements.css', array( 'wholesalepro-responsive' ), $ver );

	// Core scripts
	wp_enqueue_script( 'wholesalepro-app',        $uri . '/assets/js/app.js',        array(), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
	wp_enqueue_script( 'wholesalepro-navigation', $uri . '/assets/js/navigation.js', array(), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
	wp_enqueue_script( 'wholesalepro-forms',      $uri . '/assets/js/forms.js',      array(), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
	wp_enqueue_script( 'wholesalepro-animations', $uri . '/assets/js/animations.js', array(), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );

	// Conditional: deals page filter
	if ( is_post_type_archive( 'property' ) || is_page_template( 'page-deals.php' ) ) {
		wp_enqueue_script( 'wholesalepro-filter', $uri . '/assets/js/filter.js', array(), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
	}

	// Conditional: Google Maps
	$maps_key = get_theme_mod( 'google_maps_key', '' );
	if ( $maps_key ) {
		wp_enqueue_script( 'wholesalepro-map', $uri . '/assets/js/map.js', array(), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
	}

	// Localise data for JS
	$seller_page_id  = (int) get_theme_mod( 'seller_thankyou_page', 0 );
	$buyer_page_id   = (int) get_theme_mod( 'buyer_thankyou_page', 0 );
	$seller_thankyou = $seller_page_id ? get_permalink( $seller_page_id ) : home_url( '/thank-you-seller' );
	$buyer_thankyou  = $buyer_page_id  ? get_permalink( $buyer_page_id )  : home_url( '/thank-you-buyer' );

	wp_localize_script( 'wholesalepro-app', 'wholesalePro', array(
		'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
		'nonce'         => wp_create_nonce( 'wholesalepro-nonce' ),
		'phone'         => get_theme_mod( 'company_phone', '' ),
		'email'         => get_theme_mod( 'company_email', 'info@wholesalepro.com' ),
		'sellerThankyou'=> esc_url( $seller_thankyou ),
		'buyerThankyou' => esc_url( $buyer_thankyou ),
		'mapsKey'       => sanitize_text_field( $maps_key ),
		'isRTL'         => is_rtl(),
		'siteUrl'       => esc_url( home_url( '/' ) ),
	) );

	// Comments reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wholesalepro_enqueue_assets' );

/* ── Admin Assets ────────────────────────────────────────────── */
function wholesalepro_admin_enqueue( $hook ) {
	$screen = get_current_screen();

	// Meta box calc script — property edit screen
	if ( $screen && 'property' === $screen->post_type && in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		wp_enqueue_script(
			'wholesalepro-meta-calc',
			WHOLESALEPRO_URI . '/assets/js/admin-meta-calc.js',
			array(),
			WHOLESALEPRO_VERSION,
			true
		);
	}

	// Global admin styles
	wp_enqueue_style(
		'wholesalepro-admin',
		WHOLESALEPRO_URI . '/assets/css/admin.css',
		array(),
		WHOLESALEPRO_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'wholesalepro_admin_enqueue' );
