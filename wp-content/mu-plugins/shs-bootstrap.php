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
