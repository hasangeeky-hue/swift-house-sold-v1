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
