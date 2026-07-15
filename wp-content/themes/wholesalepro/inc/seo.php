<?php
/**
 * SEO Meta Tags & Sitemap
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ── Remove WP default title tag (we handle it) ─────────────── */
add_filter( 'document_title_separator', function() { return '|'; } );

/* ── Output Meta Tags ────────────────────────────────────────── */
function wholesalepro_seo_meta() {
	$company   = get_theme_mod( 'company_name', 'Swift House Sold' );
	$site_url  = home_url( '/' );
	$current   = ( is_ssl() ? 'https://' : 'http://' ) . sanitize_text_field( $_SERVER['HTTP_HOST'] ?? '' ) . sanitize_text_field( $_SERVER['REQUEST_URI'] ?? '' );
	$canonical = esc_url( $current );
	$og_image  = get_theme_mod( 'custom_logo' ) ? wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'large' ) : esc_url( get_template_directory_uri() . '/assets/img/og-default.jpg' );

	$title       = '';
	$description = '';
	$og_type     = 'website';

	if ( is_front_page() ) {
		$title       = $company . ' | We Buy Houses For Cash | All 50 States';
		$description = wholesalepro_content( '{{META_HOME}}', 'We buy houses fast for cash in all 50 states. No repairs, no commissions, no hassle. Get your free no-obligation cash offer today.' );

	} elseif ( is_page_template( 'page-sell.php' ) ) {
		$title       = 'Sell My House Fast For Cash | ' . $company . ' | Any Condition';
		$description = wholesalepro_content( '{{META_SELL}}', 'Need to sell your house fast? ' . $company . ' buys houses in any condition, as-is, for cash. Get a fair offer in 24 hours.' );

	} elseif ( is_page_template( 'page-deals.php' ) || is_post_type_archive( 'property' ) ) {
		$title       = 'Wholesale Real Estate Deals | Off-Market Properties | ' . $company;
		$description = wholesalepro_content( '{{META_DEALS}}', 'Browse verified off-market wholesale real estate deals. Deep discounts, high profit potential. Join our buyer network for first access.' );

	} elseif ( is_singular( 'property' ) ) {
		$og_type   = 'article';
		$address   = get_post_meta( get_the_ID(), '_property_address_full', true );
		$arv       = (int) get_post_meta( get_the_ID(), '_property_price_arv', true );
		$city      = get_post_meta( get_the_ID(), '_property_city', true );
		$state     = get_post_meta( get_the_ID(), '_property_state_abbr', true );
		$title_loc = $address ? $address : get_the_title();
		$title     = $title_loc . ( $arv ? ' | ARV ' . wholesalepro_format_currency( $arv ) : '' ) . ' | ' . $company;
		$exc       = get_the_excerpt();
		$description = $exc ? $exc : sprintf( 'Investment property in %s%s. Off-market wholesale deal.', $city, $state ? ', ' . $state : '' );
		$og_image  = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: $og_image;

	} elseif ( is_page_template( 'templates/state.php' ) ) {
		$state_name = wholesalepro_get_current_state_name();
		$title      = 'We Buy Houses In ' . $state_name . ' | Cash Offers | ' . $company;
		$description = sprintf( 'Sell your house fast for cash in %s. We buy houses in any condition, any city. Free offer within 24 hours. No commissions, no repairs required.', $state_name );

	} elseif ( is_page_template( 'templates/city.php' ) ) {
		$city_state  = wholesalepro_get_current_city_state();
		$title       = 'We Buy Houses In ' . $city_state . ' | ' . $company;
		$description = sprintf( 'Need to sell your house in %s? %s buys houses fast for cash. Any condition, any situation. Get a free offer today.', $city_state, $company );

	} elseif ( is_single() ) {
		$og_type     = 'article';
		$title       = get_the_title() . ' | ' . $company;
		$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 25 );
		$og_image    = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: $og_image;

	} elseif ( is_page() ) {
		$title       = get_the_title() . ' | ' . $company;
		$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 25 );

	} elseif ( is_category() ) {
		$title       = single_cat_title( '', false ) . ' | ' . $company;
		$description = category_description() ?: 'Browse articles in ' . single_cat_title( '', false );

	} elseif ( is_search() ) {
		$title       = sprintf( 'Search: %s | %s', get_search_query(), $company );
		$description = sprintf( 'Search results for "%s" on %s.', get_search_query(), $company );

	} elseif ( is_404() ) {
		$title       = '404 Page Not Found | ' . $company;
		$description = 'The page you are looking for could not be found.';

	} else {
		$title       = wp_title( '|', false, 'right' ) . $company;
		$description = get_bloginfo( 'description' );
	}

	$title       = esc_html( $title );
	$description = esc_attr( wp_strip_all_tags( $description ) );

	echo "\n<!-- WholesalePro SEO -->\n";
	echo '<meta name="description" content="' . $description . '">' . "\n";
	echo '<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";
	echo '<link rel="canonical" href="' . $canonical . '">' . "\n";

	// Open Graph
	echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . $description . '">' . "\n";
	echo '<meta property="og:url" content="' . $canonical . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $company ) . '">' . "\n";
	if ( $og_image ) {
		echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
		echo '<meta property="og:image:width" content="1200">' . "\n";
		echo '<meta property="og:image:height" content="630">' . "\n";
	}

	// Twitter Card
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . $description . '">' . "\n";
	if ( $og_image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
	}
	echo "<!-- /WholesalePro SEO -->\n\n";
}
add_action( 'wp_head', 'wholesalepro_seo_meta', 1 );

/* ── Sitemap link in head ────────────────────────────────────── */
function wholesalepro_sitemap_link() {
	echo '<link rel="sitemap" type="application/xml" title="Sitemap" href="' . esc_url( home_url( '/wp-sitemap.xml' ) ) . '">' . "\n";
}
add_action( 'wp_head', 'wholesalepro_sitemap_link', 2 );

/* ── Helpers for dynamic state/city templates ────────────────── */
function wholesalepro_get_current_state_name() {
	global $post;
	if ( ! $post ) return '';
	$slug  = $post->post_name;
	$states = wholesalepro_all_states_array();
	return isset( $states[ $slug ] ) ? $states[ $slug ] : ucwords( str_replace( '-', ' ', $slug ) );
}

function wholesalepro_get_current_city_state() {
	global $post;
	if ( ! $post ) return '';
	$slug  = $post->post_name;
	$parts = explode( '-', $slug );
	$state_abbr = strtoupper( array_pop( $parts ) );
	$city  = ucwords( implode( ' ', $parts ) );
	return $city . ( $state_abbr ? ', ' . $state_abbr : '' );
}
