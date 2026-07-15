<?php
/**
 * SHS bootstrap: keeps required plugins active and configured.
 * Deployed via git; safe to run on every request (idempotent).
 */
add_action( 'init', function () {
	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	// Keep Royal MCP active.
	if ( file_exists( WP_PLUGIN_DIR . '/royal-mcp/royal-mcp.php' ) && ! is_plugin_active( 'royal-mcp/royal-mcp.php' ) ) {
		activate_plugin( 'royal-mcp/royal-mcp.php' );
	}
	// Ensure Royal MCP is enabled with the operator's API key.
	$settings = (array) get_option( 'royal_mcp_settings', array() );
	if ( empty( $settings['enabled'] ) || empty( $settings['api_key'] ) ) {
		$settings['enabled'] = true;
		if ( empty( $settings['api_key'] ) ) {
			$settings['api_key'] = '9c596966160a25d4d704eec609085b16';
		}
		update_option( 'royal_mcp_settings', $settings );
	}
	// Keep pretty permalinks.
	if ( get_option( 'permalink_structure' ) !== '/%postname%/' ) {
		update_option( 'permalink_structure', '/%postname%/' );
		flush_rewrite_rules();
	}
}, 5 );

/**
 * One-time content cleanup v1: retire investor UI + stale WholesalePro-era settings.
 */
add_action( 'init', function () {
	if ( get_option( 'shs_cleanup_v1' ) ) {
		return;
	}
	// 1. Unpublish the Browse Deals page (kept as draft for the future).
	$deals = get_page_by_path( 'browse-deals' );
	if ( $deals && 'publish' === $deals->post_status ) {
		wp_update_post( array( 'ID' => $deals->ID, 'post_status' => 'draft' ) );
	}
	// 2. Remove Browse Deals items from all nav menus.
	foreach ( wp_get_nav_menus() as $menu ) {
		foreach ( wp_get_nav_menu_items( $menu->term_id ) as $item ) {
			$title = strtolower( $item->title );
			if ( false !== strpos( $title, 'browse deals' ) || false !== strpos( $title, 'investor' ) || ( $deals && (int) $item->object_id === (int) $deals->ID ) ) {
				wp_delete_post( $item->ID, true );
			}
		}
	}
	// 3. Clear stale customizer values so new theme defaults apply.
	$stale = array(
		'company_phone'      => array( '(555) 000-0000', '(000) 000-0000' ),
		'company_phone_raw'  => array( '5550000000', '0000000000' ),
		'company_name'       => array( 'WholesalePro' ),
		'topbar_message'     => null,
		'deals_closed_count' => null,
		'states_covered'     => null,
		'seller_rating'      => null,
		'company_founding_year' => null,
	);
	foreach ( $stale as $mod => $bad_values ) {
		$current = get_theme_mod( $mod );
		if ( null === $bad_values || in_array( $current, (array) $bad_values, true ) ) {
			remove_theme_mod( $mod );
		}
	}
	update_option( 'shs_cleanup_v1', 1 );
	flush_rewrite_rules();
}, 20 );

/**
 * One-time setup v2: service categories, post assignments, Services in primary menu.
 */
add_action( 'init', function () {
	if ( get_option( 'shs_cleanup_v2' ) ) {
		return;
	}
	// 1. Categories per service.
	$cats = array(
		'foreclosure' => 'Stop Foreclosure',
		'probate'     => 'Probate & Inherited',
		'divorce'     => 'Divorce Home Sale',
		'tax-liens'   => 'Tax Liens & Back Taxes',
		'repairs'     => 'Major Repairs / As-Is',
		'landlord'    => 'Tired Landlord',
		'general'     => 'Selling Guides',
	);
	$cat_ids = array();
	foreach ( $cats as $slug => $name ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( ! $term ) {
			$res = wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
			$cat_ids[ $slug ] = is_wp_error( $res ) ? 0 : $res['term_id'];
		} else {
			$cat_ids[ $slug ] = $term->term_id;
		}
	}
	// 2. Assign existing guides to their service categories.
	$map = array(
		25 => array( 'foreclosure' ),
		26 => array( 'probate' ),
		27 => array( 'tax-liens' ),
		28 => array( 'divorce' ),
		29 => array( 'general', 'foreclosure', 'probate', 'divorce', 'tax-liens', 'repairs', 'landlord' ),
		30 => array( 'repairs' ),
	);
	foreach ( $map as $post_id => $slugs ) {
		if ( get_post( $post_id ) ) {
			$ids = array();
			foreach ( $slugs as $sl ) {
				if ( ! empty( $cat_ids[ $sl ] ) ) { $ids[] = (int) $cat_ids[ $sl ]; }
			}
			if ( $ids ) { wp_set_post_categories( $post_id, $ids, false ); }
		}
	}
}, 26 );

/**
 * Keep Services + Book a Call present in the primary menu (idempotent).
 */
add_action( 'init', function () {
	$locations = get_nav_menu_locations();
	if ( ! empty( $locations['primary'] ) ) {
		$menu_id  = (int) $locations['primary'];
		$existing = wp_get_nav_menu_items( $menu_id );
		$titles   = $existing ? wp_list_pluck( $existing, 'title' ) : array();
		$add = array(
			'services'    => 'Services',
			'book-a-call' => 'Book a Call',
		);
		foreach ( $add as $slug => $title ) {
			if ( in_array( $title, $titles, true ) ) { continue; }
			$page = get_page_by_path( $slug );
			if ( $page ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => $title,
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $page->ID,
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				) );
			}
		}
	}
}, 26 );

/**
 * Menu rebuild v3: clean primary menu with Services dropdown.
 */
add_action( 'init', function () {
	if ( get_option( 'shs_menu_v3' ) ) {
		return;
	}
	$locations = get_nav_menu_locations();
	$menu_id   = ! empty( $locations['primary'] ) ? (int) $locations['primary'] : 0;
	if ( ! $menu_id ) {
		$menu_id = wp_create_nav_menu( 'Primary' );
		if ( is_wp_error( $menu_id ) ) { return; }
		$locations['primary'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
	// Wipe existing items.
	foreach ( (array) wp_get_nav_menu_items( $menu_id ) as $item ) {
		wp_delete_post( $item->ID, true );
	}
	$add_page = function ( $slug, $title, $parent = 0 ) use ( $menu_id ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) { return 0; }
		return wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'     => $title,
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $page->ID,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent,
		) );
	};
	$add_page( 'sell-my-house-fast', 'Sell My House' );
	$services_id = $add_page( 'services', 'Services' );
	if ( $services_id && ! is_wp_error( $services_id ) ) {
		$add_page( 'stop-foreclosure',      'Stop Foreclosure',            $services_id );
		$add_page( 'sell-probate-property', 'Probate & Inherited',         $services_id );
		$add_page( 'sell-house-divorce',    'Divorce Home Sale',           $services_id );
		$add_page( 'sell-house-tax-liens',  'Tax Liens & Back Taxes',      $services_id );
		$add_page( 'sell-damaged-house',    'House Needs Major Repairs',   $services_id );
		$add_page( 'sell-rental-property',  'Tired Landlord / Rental',     $services_id );
	}
	$add_page( 'blog',         'Guides' );
	$add_page( 'how-it-works', 'How It Works' );
	$add_page( 'faq',          'FAQ' );
	$add_page( 'about-us',     'About' );
	$add_page( 'contact',      'Contact' );
	update_option( 'shs_menu_v3', 1 );
}, 30 );

/**
 * One-time v4: assign the guide library posts to service categories.
 */
add_action( 'init', function () {
	if ( get_option( 'shs_guides_v5' ) ) {
		return;
	}
	$all_cats = array( 'foreclosure', 'probate', 'divorce', 'tax-liens', 'repairs', 'landlord', 'general' );
	$map = array(
		74 => $all_cats, 75 => $all_cats, 76 => $all_cats, 77 => $all_cats,
		78 => $all_cats, 79 => $all_cats, 80 => $all_cats,
		81 => array( 'probate' ),
		82 => array( 'foreclosure' ),
		83 => array( 'divorce' ),
		84 => array( 'tax-liens' ),
		85 => array( 'repairs' ),
		86 => array( 'landlord' ),
		87 => array( 'landlord' ),
	);
	$assigned = 0;
	foreach ( $map as $post_id => $slugs ) {
		if ( ! get_post( $post_id ) ) { continue; }
		$ids = array();
		foreach ( $slugs as $sl ) {
			$term = get_term_by( 'slug', $sl, 'category' );
			if ( $term ) { $ids[] = (int) $term->term_id; }
		}
		if ( $ids ) {
			wp_set_post_categories( $post_id, $ids, false );
			$assigned++;
		}
	}
	if ( $assigned === count( $map ) ) {
		update_option( 'shs_guides_v5', 1 );
	}
}, 35 );

/**
 * v6: site identity, sitemap, and menu hygiene (idempotent).
 */
add_action( 'init', function () {
	// Proper site name + tagline for SEO.
	if ( 'swift-house-sold(SHS)' === get_option( 'blogname' ) ) {
		update_option( 'blogname', 'Swift House Sold' );
	}
	if ( '' === get_option( 'blogdescription' ) ) {
		update_option( 'blogdescription', 'Sell Your House Fast for Cash in Ohio, Texas & Georgia' );
	}
	// Remove any Book a Call item from the primary menu (button lives in header).
	$locations = get_nav_menu_locations();
	if ( ! empty( $locations['primary'] ) ) {
		foreach ( (array) wp_get_nav_menu_items( (int) $locations['primary'] ) as $it ) {
			if ( $it && 'Book a Call' === $it->title ) {
				wp_delete_post( $it->ID, true );
			}
		}
	}
}, 40 );

/* Core sitemaps stay enabled. */
add_filter( 'wp_sitemaps_enabled', '__return_true', 99 );

/**
 * Comments off sitewide: this is a lead-gen education site, not a forum.
 */
add_action( 'init', function () {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );
} );
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 10 );
