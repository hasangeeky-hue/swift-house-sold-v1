<?php
/**
 * WholesalePro Theme Functions
 *
 * @package WholesalePro
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ── Constants ───────────────────────────────────────────────────── */
define( 'WHOLESALEPRO_VERSION', '2.6.0' );
define( 'WHOLESALEPRO_DIR',     get_template_directory() );
define( 'WHOLESALEPRO_URI',     get_template_directory_uri() );

/* ── Theme Setup ─────────────────────────────────────────────────── */
function wholesalepro_setup() {

	// Make theme translatable
	load_theme_textdomain( 'wholesalepro', WHOLESALEPRO_DIR . '/languages' );

	// WordPress core feature support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
		'gallery', 'caption', 'style', 'script',
	) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );

	// Custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Post thumbnail sizes
	add_image_size( 'wholesalepro-property-card',  800, 500, true );
	add_image_size( 'wholesalepro-property-hero', 1200, 675, true );
	add_image_size( 'wholesalepro-blog-card',      800, 450, true );
	add_image_size( 'wholesalepro-blog-hero',     1200, 500, true );
	add_image_size( 'wholesalepro-team-photo',     400, 500, true );

	// Navigation menus
	register_nav_menus( array(
		'primary'  => esc_html__( 'Primary Navigation', 'wholesalepro' ),
		'footer-1' => esc_html__( 'Footer Column 1, Company',  'wholesalepro' ),
		'footer-2' => esc_html__( 'Footer Column 2, Sellers',  'wholesalepro' ),
		'footer-3' => esc_html__( 'Footer Column 3, Investors', 'wholesalepro' ),
	) );
}
add_action( 'after_setup_theme', 'wholesalepro_setup' );

/* ── Content Width ───────────────────────────────────────────────── */
function wholesalepro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wholesalepro_content_width', 1200 );
}
add_action( 'after_setup_theme', 'wholesalepro_content_width', 0 );

/* ── Include Core Files ──────────────────────────────────────────── */
$wholesalepro_includes = array(
	'/inc/helpers.php',
	'/inc/enqueue.php',
	'/inc/cpt.php',
	'/inc/meta-boxes.php',
	'/inc/customizer.php',
	'/inc/forms.php',
	'/inc/ajax.php',
	'/inc/seo.php',
	'/inc/schema.php',
	'/inc/services.php',
	'/inc/investors.php',
);

foreach ( $wholesalepro_includes as $file ) {
	$path = WHOLESALEPRO_DIR . $file;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

/* ── Body Classes ────────────────────────────────────────────────── */
function wholesalepro_body_classes( $classes ) {
	// Seller/buyer page detection
	$sell_page  = get_page_by_path( 'sell-my-house-fast' );
	$deals_page = get_page_by_path( 'browse-deals' );

	if ( $sell_page && is_page( $sell_page->ID ) ) {
		$classes[] = 'page-sell';
	}
	if ( $deals_page && is_page( $deals_page->ID ) ) {
		$classes[] = 'page-deals';
	}
	if ( is_singular( 'property' ) ) {
		$classes[] = 'page-property-single';
	}
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'wholesalepro_body_classes' );

/* ── Excerpt Length ──────────────────────────────────────────────── */
function wholesalepro_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'wholesalepro_excerpt_length' );

function wholesalepro_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wholesalepro_excerpt_more' );

/* ── Widgets ─────────────────────────────────────────────────────── */
function wholesalepro_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'wholesalepro' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Widgets appear in the blog sidebar.', 'wholesalepro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Property Sidebar', 'wholesalepro' ),
		'id'            => 'sidebar-property',
		'description'   => esc_html__( 'Widgets appear on property detail pages.', 'wholesalepro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wholesalepro_widgets_init' );

/* ── Custom Login Page Branding ──────────────────────────────────── */
function wholesalepro_login_logo() {
	$logo_url = WHOLESALEPRO_URI . '/assets/images/logo.svg';
	?>
	<style>
		#login h1 a {
			background-image: url('<?php echo esc_url( $logo_url ); ?>');
			background-size: contain;
			background-position: center;
			width: 220px; height: 60px;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'wholesalepro_login_logo' );

function wholesalepro_login_url()        { return home_url(); }
function wholesalepro_login_header_url() { return home_url(); }
add_filter( 'login_headerurl',  'wholesalepro_login_url' );
add_filter( 'login_headertext', function() { return get_bloginfo( 'name' ); } );

/* ── Security: Remove WordPress version from head ────────────────── */
remove_action( 'wp_head', 'wp_generator' );

/* ── Clean up <head> ─────────────────────────────────────────────── */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/* ── Disable Emoji Scripts (performance) ────────────────────────── */
function wholesalepro_disable_emojis() {
	remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles',     'print_emoji_styles' );
	remove_action( 'admin_print_styles',  'print_emoji_styles' );
	remove_filter( 'the_content_feed',    'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss',    'wp_staticize_emoji' );
	remove_filter( 'wp_mail',             'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'wholesalepro_disable_emojis' );

/* ── Pagination ──────────────────────────────────────────────────── */
function wholesalepro_pagination() {
	global $wp_query;
	$big = 999999999;
	$links = paginate_links( array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $wp_query->max_num_pages,
		'prev_text' => '&larr; Previous',
		'next_text' => 'Next &rarr;',
		'type'      => 'array',
	) );

	if ( ! $links ) {
		return;
	}

	echo '<nav class="pagination" aria-label="' . esc_attr__( 'Posts pagination', 'wholesalepro' ) . '">';
	foreach ( $links as $link ) {
		echo '<span>' . $link . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</nav>';
}

/* ── Social Links Helper ─────────────────────────────────────────── */
function wholesalepro_social_links() {
	$networks = array(
		'facebook_url'  => array( 'Facebook',  'M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z' ),
		'instagram_url' => array( 'Instagram', 'M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zM17.5 6.5h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z' ),
		'youtube_url'   => array( 'YouTube',   'M22.54 6.42a2.78 2.78 0 00-1.95-1.97C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.97A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58zM10 15V9l5.2 3-5.2 3z' ),
		'linkedin_url'  => array( 'LinkedIn',  'M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z M4 6a2 2 0 100-4 2 2 0 000 4z' ),
	);

	$has_any = false;
	foreach ( $networks as $mod => $data ) {
		if ( get_theme_mod( $mod, '' ) ) { $has_any = true; break; }
	}
	if ( ! $has_any ) return '';

	$html = '<div class="social-links">';
	foreach ( $networks as $mod => $data ) {
		$url = get_theme_mod( $mod, '' );
		if ( ! $url ) continue;
		$html .= sprintf(
			'<a href="%s" class="social-link" aria-label="%s" target="_blank" rel="noopener noreferrer">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
					<path d="%s"/>
				</svg>
			</a>',
			esc_url( $url ),
			esc_attr( $data[0] ),
			esc_attr( $data[1] )
		);
	}
	$html .= '</div>';
	return $html;
}


/* ── Theme Activation: Auto-create all required pages ───────────── */
function wholesalepro_theme_activation() {

	$pages = array(
		array( 'title' => 'Home',                                   'slug' => 'home',                'template' => 'front-page.php',           'order' => 0 ),
		array( 'title' => 'Blog',                                   'slug' => 'blog',                'template' => '',                         'order' => 1 ),
		array( 'title' => 'Sell My House Fast',                     'slug' => 'sell-my-house-fast',  'template' => 'page-sell.php',            'order' => 2 ),
		array( 'title' => 'Browse Deals',                           'slug' => 'browse-deals',        'template' => 'page-deals.php',           'order' => 3 ),
		array( 'title' => 'About Us',                               'slug' => 'about-us',            'template' => 'page-about.php',           'order' => 4 ),
		array( 'title' => 'How It Works',                           'slug' => 'how-it-works',        'template' => 'page-how-it-works.php',    'order' => 5 ),
		array( 'title' => 'Contact',                                'slug' => 'contact',             'template' => 'page-contact.php',         'order' => 6 ),
		array( 'title' => 'Thank You, We Received Your Inquiry',   'slug' => 'thank-you-seller',    'template' => 'page-thank-you-seller.php','order' => 7 ),
		array( 'title' => 'Welcome to the Buyer Network',           'slug' => 'thank-you-buyer',     'template' => 'page-thank-you-buyer.php', 'order' => 8 ),
		array( 'title' => 'Privacy Policy',                          'slug' => 'privacy-policy',      'template' => 'page-privacy-policy.php',  'order' => 9 ),
		array( 'title' => 'Terms of Service',                        'slug' => 'terms-of-service',    'template' => 'page-terms.php',           'order' => 10 ),
		array( 'title' => 'FAQ',                                     'slug' => 'faq',                 'template' => 'page-faq.php',             'order' => 11 ),
		array( 'title' => 'Testimonials',                            'slug' => 'testimonials',        'template' => 'page-testimonials.php',    'order' => 12 ),
		array( 'title' => 'Cash Sale vs. Listing With an Agent',     'slug' => 'cash-sale-vs-listing','template' => 'page-compare.php',         'order' => 13 ),
	);

	$front_page_id = 0;
	$blog_page_id  = 0;

	foreach ( $pages as $page_data ) {
		$existing = get_page_by_path( $page_data['slug'] );
		if ( $existing ) {
			if ( 'home' === $page_data['slug'] ) $front_page_id = $existing->ID;
			if ( 'blog' === $page_data['slug'] ) $blog_page_id  = $existing->ID;
			continue;
		}
		$page_id = wp_insert_post( array(
			'post_title'   => $page_data['title'],
			'post_name'    => $page_data['slug'],
			'post_content' => '',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'menu_order'   => $page_data['order'],
		) );
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			if ( $page_data['template'] ) {
				update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
			}
			if ( 'home' === $page_data['slug'] ) $front_page_id = $page_id;
			if ( 'blog' === $page_data['slug'] ) $blog_page_id  = $page_id;
		}
	}

	// Set static front page
	if ( $front_page_id ) {
		update_option( 'show_on_front',  'page' );
		update_option( 'page_on_front',  $front_page_id );
	}
	if ( $blog_page_id ) {
		update_option( 'page_for_posts', $blog_page_id );
	}

	// Create Primary Navigation menu if none exists
	$menus = get_terms( array( 'taxonomy' => 'nav_menu', 'hide_empty' => false ) );
	if ( empty( $menus ) ) {
		$menu_id = wp_create_nav_menu( 'Primary Menu' );
		if ( $menu_id && ! is_wp_error( $menu_id ) ) {
			$nav_slugs = array(
				'sell-my-house-fast' => 'Sell My House',
				'browse-deals'       => 'Browse Deals',
				'how-it-works'       => 'How It Works',
				'about-us'           => 'About Us',
				'contact'            => 'Contact',
			);
			foreach ( $nav_slugs as $slug => $label ) {
				$p = get_page_by_path( $slug );
				if ( $p ) {
					wp_update_nav_menu_item( $menu_id, 0, array(
						'menu-item-title'     => $label,
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $p->ID,
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
					) );
				}
			}
			$locations            = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	// Set a sensible blog tagline default
	if ( get_option( 'blogdescription' ) === 'Just another WordPress site' ) {
		update_option( 'blogdescription', 'We Buy Houses For Cash, Nationwide' );
	}

	// Flush rewrite rules
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'wholesalepro_theme_activation' );

/* ── Template Redirect: ensure front-page uses front-page.php ────── */
function wholesalepro_front_page_setup() {
	if ( is_front_page() && ! is_home() ) {
		return;
	}
}
add_action( 'template_redirect', 'wholesalepro_front_page_setup' );

/**
 * Ensure pretty permalinks are active (postname structure).
 * Runs once: sets the structure and flushes rewrite rules.
 */
add_action( 'init', function () {
	if ( get_option( 'permalink_structure' ) !== '/%postname%/' ) {
		update_option( 'permalink_structure', '/%postname%/' );
		flush_rewrite_rules();
	}
}, 99 );
