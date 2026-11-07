<?php
/**
 * Leads admin: view sellers / buyers / newsletter subscribers,
 * export CSV, and send a newsletter email to a list.
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', function () {
	add_menu_page(
		__( 'Leads', 'wholesalepro' ),
		__( 'Leads', 'wholesalepro' ),
		'manage_options',
		'shs-leads',
		'shs_leads_admin_page',
		'dashicons-groups',
		26
	);
} );

/** Which rows belong to each tab. */
function shs_leads_get_rows( $tab ) {
	global $wpdb;
	if ( 'sellers' === $tab ) {
		return $wpdb->get_results( "SELECT id, name, email, phone, address, city, state, situation, timeline, created_at FROM {$wpdb->prefix}wholesalepro_leads ORDER BY created_at DESC LIMIT 500", ARRAY_A );
	}
	if ( 'newsletter' === $tab ) {
		return $wpdb->get_results( "SELECT id, name, email, source, created_at FROM {$wpdb->prefix}wholesalepro_buyers WHERE source LIKE 'newsletter%' ORDER BY created_at DESC LIMIT 500", ARRAY_A );
	}
	return $wpdb->get_results( "SELECT id, name, email, phone, states, property_types, close_timeline, source, created_at FROM {$wpdb->prefix}wholesalepro_buyers WHERE source NOT LIKE 'newsletter%' ORDER BY created_at DESC LIMIT 500", ARRAY_A );
}

/** CSV export. */
add_action( 'admin_post_shs_export_leads', function () {
	if ( ! current_user_can( 'manage_options' ) || ! wp_verify_nonce( $_GET['_wpnonce'] ?? '', 'shs_export' ) ) {
		wp_die( 'Not allowed.' );
	}
	$tab  = sanitize_key( $_GET['tab'] ?? 'sellers' );
	$rows = shs_leads_get_rows( $tab );
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=' . $tab . '-' . gmdate( 'Y-m-d' ) . '.csv' );
	$out = fopen( 'php://output', 'w' );
	if ( $rows ) {
		fputcsv( $out, array_keys( $rows[0] ) );
		foreach ( $rows as $r ) fputcsv( $out, $r );
	} else {
		fputcsv( $out, array( 'no data' ) );
	}
	fclose( $out );
	exit;
} );

/** Send an email to a list (batched). */
add_action( 'admin_post_shs_send_newsletter', function () {
	if ( ! current_user_can( 'manage_options' ) || ! wp_verify_nonce( $_POST['_wpnonce'] ?? '', 'shs_send' ) ) {
		wp_die( 'Not allowed.' );
	}
	$list    = sanitize_key( $_POST['shs_list'] ?? 'newsletter' );
	$subject = sanitize_text_field( wp_unslash( $_POST['shs_subject'] ?? '' ) );
	$message = wp_kses_post( wp_unslash( $_POST['shs_message'] ?? '' ) );
	if ( ! $subject || ! $message ) {
		wp_safe_redirect( admin_url( 'admin.php?page=shs-leads&tab=send&sent=empty' ) );
		exit;
	}

	$rows   = shs_leads_get_rows( 'buyers_all' === $list ? 'buyers' : $list );
	$company = get_theme_mod( 'company_name', 'Swift House Sold' );
	$sent   = 0;
	$emails = array();
	foreach ( $rows as $r ) {
		$e = sanitize_email( $r['email'] );
		if ( $e && ! isset( $emails[ $e ] ) ) $emails[ $e ] = $r['name'];
	}
	foreach ( $emails as $e => $n ) {
		$body  = '<p>Hi ' . esc_html( $n ? $n : 'there' ) . ',</p>' . wpautop( $message );
		$body .= '<p style="color:#888;font-size:12px;margin-top:24px;">You received this because you signed up at ' . esc_html( $company ) . '. To unsubscribe, reply with "unsubscribe".</p>';
		if ( wholesalepro_send_email( $e, $subject, $body ) ) $sent++;
	}
	wp_safe_redirect( admin_url( 'admin.php?page=shs-leads&tab=send&sent=' . $sent ) );
	exit;
} );

/** The admin screen. */
function shs_leads_admin_page() {
	global $wpdb;
	$tab  = sanitize_key( $_GET['tab'] ?? 'sellers' );
	$tabs = array(
		'sellers'    => __( 'Home Sellers', 'wholesalepro' ),
		'buyers'     => __( 'Investors / Buyers', 'wholesalepro' ),
		'newsletter' => __( 'Newsletter Subscribers', 'wholesalepro' ),
		'send'       => __( 'Send an Email', 'wholesalepro' ),
	);
	if ( ! isset( $tabs[ $tab ] ) ) $tab = 'sellers';

	$counts = array(
		'sellers'    => (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}wholesalepro_leads" ),
		'buyers'     => (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}wholesalepro_buyers WHERE source NOT LIKE 'newsletter%'" ),
		'newsletter' => (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}wholesalepro_buyers WHERE source LIKE 'newsletter%'" ),
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Leads', 'wholesalepro' ); ?></h1>
		<p><?php esc_html_e( 'Everyone who filled in a form on your website, newest first.', 'wholesalepro' ); ?></p>
		<nav class="nav-tab-wrapper">
			<?php foreach ( $tabs as $key => $label ) : ?>
				<a class="nav-tab <?php echo $tab === $key ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=shs-leads&tab=' . $key ) ); ?>">
					<?php echo esc_html( $label ); ?><?php if ( isset( $counts[ $key ] ) ) echo ' (' . (int) $counts[ $key ] . ')'; ?>
				</a>
			<?php endforeach; ?>
		</nav>

		<?php if ( 'send' === $tab ) : ?>
			<?php if ( isset( $_GET['sent'] ) ) : ?>
				<div class="notice notice-<?php echo 'empty' === $_GET['sent'] ? 'error' : 'success'; ?>"><p>
					<?php echo 'empty' === $_GET['sent']
						? esc_html__( 'Please write a subject and a message.', 'wholesalepro' )
						: sprintf( esc_html__( 'Done. Your email went out to %d people.', 'wholesalepro' ), (int) $_GET['sent'] ); ?>
				</p></div>
			<?php endif; ?>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="max-width:640px;margin-top:16px;">
				<?php wp_nonce_field( 'shs_send' ); ?>
				<input type="hidden" name="action" value="shs_send_newsletter">
				<table class="form-table">
					<tr>
						<th><label for="shs_list"><?php esc_html_e( 'Send to', 'wholesalepro' ); ?></label></th>
						<td>
							<select name="shs_list" id="shs_list">
								<option value="newsletter"><?php printf( esc_html__( 'Newsletter subscribers (%d)', 'wholesalepro' ), $counts['newsletter'] ); ?></option>
								<option value="buyers_all"><?php printf( esc_html__( 'Investors / buyers (%d)', 'wholesalepro' ), $counts['buyers'] ); ?></option>
								<option value="sellers"><?php printf( esc_html__( 'Home sellers (%d)', 'wholesalepro' ), $counts['sellers'] ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th><label for="shs_subject"><?php esc_html_e( 'Subject', 'wholesalepro' ); ?></label></th>
						<td><input type="text" name="shs_subject" id="shs_subject" class="regular-text" required></td>
					</tr>
					<tr>
						<th><label for="shs_message"><?php esc_html_e( 'Message', 'wholesalepro' ); ?></label></th>
						<td>
							<?php wp_editor( '', 'shs_message', array( 'textarea_name' => 'shs_message', 'textarea_rows' => 12, 'media_buttons' => false ) ); ?>
							<p class="description"><?php esc_html_e( 'Each person gets "Hi (their name)," added at the top automatically, and an unsubscribe note at the bottom.', 'wholesalepro' ); ?></p>
						</td>
					</tr>
				</table>
				<?php submit_button( __( 'Send Email Now', 'wholesalepro' ) ); ?>
			</form>
		<?php else :
			$rows = shs_leads_get_rows( $tab );
			$export_url = wp_nonce_url( admin_url( 'admin-post.php?action=shs_export_leads&tab=' . $tab ), 'shs_export' );
			?>
			<p style="margin-top:16px;">
				<a href="<?php echo esc_url( $export_url ); ?>" class="button"><?php esc_html_e( 'Download as CSV (Excel)', 'wholesalepro' ); ?></a>
			</p>
			<?php if ( ! $rows ) : ?>
				<p><em><?php esc_html_e( 'No entries yet. They will appear here as soon as someone fills in a form on the website.', 'wholesalepro' ); ?></em></p>
			<?php else : ?>
				<table class="widefat striped">
					<thead><tr>
						<?php foreach ( array_keys( $rows[0] ) as $col ) : if ( 'id' === $col ) continue; ?>
							<th><?php echo esc_html( ucwords( str_replace( '_', ' ', $col ) ) ); ?></th>
						<?php endforeach; ?>
					</tr></thead>
					<tbody>
						<?php foreach ( $rows as $r ) : ?>
							<tr>
								<?php foreach ( $r as $col => $val ) : if ( 'id' === $col ) continue; ?>
									<td><?php echo esc_html( wp_trim_words( (string) $val, 12 ) ); ?></td>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php
}
