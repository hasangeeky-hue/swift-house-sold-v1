<?php
/**
 * AJAX Handlers
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ── Database Table Creation ─────────────────────────────────── */
function wholesalepro_create_tables() {
	global $wpdb;
	$charset = $wpdb->get_charset_collate();

	$leads_table = $wpdb->prefix . 'wholesalepro_leads';
	$sql_leads   = "CREATE TABLE IF NOT EXISTS {$leads_table} (
		id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		name        VARCHAR(200)        NOT NULL DEFAULT '',
		email       VARCHAR(200)        NOT NULL DEFAULT '',
		phone       VARCHAR(50)         NOT NULL DEFAULT '',
		address     VARCHAR(500)        NOT NULL DEFAULT '',
		city        VARCHAR(200)        NOT NULL DEFAULT '',
		state       VARCHAR(100)        NOT NULL DEFAULT '',
		zip         VARCHAR(20)         NOT NULL DEFAULT '',
		situation   TEXT                NOT NULL DEFAULT '',
		timeline    VARCHAR(100)        NOT NULL DEFAULT '',
		condition   VARCHAR(100)        NOT NULL DEFAULT '',
		utm_source  VARCHAR(200)        NOT NULL DEFAULT '',
		utm_medium  VARCHAR(200)        NOT NULL DEFAULT '',
		utm_campaign VARCHAR(200)       NOT NULL DEFAULT '',
		ip_address  VARCHAR(45)         NOT NULL DEFAULT '',
		created_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		KEY email (email),
		KEY created_at (created_at)
	) {$charset};";

	$buyers_table = $wpdb->prefix . 'wholesalepro_buyers';
	$sql_buyers   = "CREATE TABLE IF NOT EXISTS {$buyers_table} (
		id             BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		name           VARCHAR(200)        NOT NULL DEFAULT '',
		email          VARCHAR(200)        NOT NULL DEFAULT '',
		phone          VARCHAR(50)         NOT NULL DEFAULT '',
		states         TEXT                NOT NULL DEFAULT '',
		property_types TEXT                NOT NULL DEFAULT '',
		price_min      BIGINT(20)          NOT NULL DEFAULT 0,
		price_max      BIGINT(20)          NOT NULL DEFAULT 0,
		close_timeline VARCHAR(100)        NOT NULL DEFAULT '',
		financing_type VARCHAR(100)        NOT NULL DEFAULT '',
		ip_address     VARCHAR(45)         NOT NULL DEFAULT '',
		created_at     DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		KEY email (email)
	) {$charset};";

	$offers_table = $wpdb->prefix . 'wholesalepro_offers';
	$sql_offers   = "CREATE TABLE IF NOT EXISTS {$offers_table} (
		id              BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		property_id     BIGINT(20)          NOT NULL DEFAULT 0,
		property_title  VARCHAR(500)        NOT NULL DEFAULT '',
		offeror_name    VARCHAR(200)        NOT NULL DEFAULT '',
		offeror_email   VARCHAR(200)        NOT NULL DEFAULT '',
		offeror_phone   VARCHAR(50)         NOT NULL DEFAULT '',
		offer_amount    BIGINT(20)          NOT NULL DEFAULT 0,
		close_date      DATE,
		pof_filename    VARCHAR(500)        NOT NULL DEFAULT '',
		notes           TEXT                NOT NULL DEFAULT '',
		ip_address      VARCHAR(45)         NOT NULL DEFAULT '',
		created_at      DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		KEY property_id (property_id)
	) {$charset};";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql_leads );
	dbDelta( $sql_buyers );
	dbDelta( $sql_offers );

	// Add the source column to buyers (newsletter vs investor signups), once.
	$col = $wpdb->get_results( "SHOW COLUMNS FROM {$buyers_table} LIKE 'source'" );
	if ( empty( $col ) ) {
		$wpdb->query( "ALTER TABLE {$buyers_table} ADD COLUMN source VARCHAR(100) NOT NULL DEFAULT '' AFTER financing_type" );
	}
}
add_action( 'after_switch_theme', 'wholesalepro_create_tables' );

/* ── Rate Limiter ────────────────────────────────────────────── */
function wholesalepro_rate_limit_check( $action, $limit = 5, $window = HOUR_IN_SECONDS ) {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$key = 'wp_rl_' . md5( $action . $ip );
	$count = (int) get_transient( $key );
	if ( $count >= $limit ) {
		return false;
	}
	set_transient( $key, $count + 1, $window );
	return true;
}

/* ── Send HTML Email Helper ──────────────────────────────────── */
function wholesalepro_send_email( $to, $subject, $body, $priority = false ) {
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	if ( $priority ) {
		$headers[] = 'X-Priority: 1 (Highest)';
		$headers[] = 'X-MSMail-Priority: High';
		$headers[] = 'Importance: High';
	}
	$from_name  = get_theme_mod( 'company_name', 'Swift House Sold' );
	$from_email = get_theme_mod( 'company_email', get_option( 'admin_email' ) );
	$headers[]  = 'From: ' . $from_name . ' <' . $from_email . '>';
	wp_mail( $to, $subject, $body, $headers );
}

/* ════════════════════════════════════════════════════════════════
   HANDLER 1, Seller Form
   ════════════════════════════════════════════════════════════════ */
add_action( 'wp_ajax_wholesalepro_seller_form',        'wholesalepro_handle_seller_form' );
add_action( 'wp_ajax_nopriv_wholesalepro_seller_form', 'wholesalepro_handle_seller_form' );

function wholesalepro_handle_seller_form() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'wholesalepro-nonce' ) ) {
		wp_send_json_error( array( 'message' => __( 'Security check failed. Please refresh and try again.', 'wholesalepro' ) ), 403 );
	}

	if ( ! wholesalepro_rate_limit_check( 'seller_form' ) ) {
		wp_send_json_error( array( 'message' => __( 'Too many submissions. Please wait an hour and try again.', 'wholesalepro' ) ), 429 );
	}

	// Honeypot check
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'message' => 'ok' ) );
	}

	$name      = isset( $_POST['seller_name'] )      ? sanitize_text_field( wp_unslash( $_POST['seller_name'] ) )      : '';
	$email     = isset( $_POST['seller_email'] )     ? sanitize_email( wp_unslash( $_POST['seller_email'] ) )           : '';
	$phone     = isset( $_POST['seller_phone'] )     ? sanitize_text_field( wp_unslash( $_POST['seller_phone'] ) )     : '';
	$address   = isset( $_POST['property_address'] ) ? sanitize_text_field( wp_unslash( $_POST['property_address'] ) ) : '';
	$city      = isset( $_POST['property_city'] )    ? sanitize_text_field( wp_unslash( $_POST['property_city'] ) )    : '';
	$state     = isset( $_POST['property_state'] )   ? sanitize_text_field( wp_unslash( $_POST['property_state'] ) )   : '';
	$zip       = isset( $_POST['property_zip'] )     ? sanitize_text_field( wp_unslash( $_POST['property_zip'] ) )     : '';
	$situation = isset( $_POST['situation'] )        ? sanitize_textarea_field( wp_unslash( $_POST['situation'] ) )    : '';
	$timeline  = isset( $_POST['timeline'] )         ? sanitize_text_field( wp_unslash( $_POST['timeline'] ) )         : '';
	$condition = isset( $_POST['condition'] )        ? sanitize_text_field( wp_unslash( $_POST['condition'] ) )        : '';
	$utm_s     = isset( $_POST['utm_source'] )       ? sanitize_text_field( wp_unslash( $_POST['utm_source'] ) )       : '';
	$utm_m     = isset( $_POST['utm_medium'] )       ? sanitize_text_field( wp_unslash( $_POST['utm_medium'] ) )       : '';
	$utm_c     = isset( $_POST['utm_campaign'] )     ? sanitize_text_field( wp_unslash( $_POST['utm_campaign'] ) )     : '';

	$errors = array();
	if ( ! $name )    $errors['seller_name']      = __( 'Name is required.', 'wholesalepro' );
	if ( ! $phone )   $errors['seller_phone']     = __( 'Phone is required.', 'wholesalepro' );
	if ( ! $address ) $errors['property_address'] = __( 'Property address is required.', 'wholesalepro' );
	if ( ! $situation ) $errors['situation']      = __( 'Please describe your situation.', 'wholesalepro' );

	if ( $errors ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'wholesalepro' ), 'errors' => $errors ) );
	}

	global $wpdb;
	wholesalepro_create_tables();
	$wpdb->insert(
		$wpdb->prefix . 'wholesalepro_leads',
		array(
			'name'        => $name,
			'email'       => $email,
			'phone'       => $phone,
			'address'     => $address,
			'city'        => $city,
			'state'       => $state,
			'zip'         => $zip,
			'situation'   => $situation,
			'timeline'    => $timeline,
			'condition'   => $condition,
			'utm_source'  => $utm_s,
			'utm_medium'  => $utm_m,
			'utm_campaign'=> $utm_c,
			'ip_address'  => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
		),
		array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
	);

	$admin_email   = get_theme_mod( 'company_email', get_option( 'admin_email' ) );
	$company_name  = get_theme_mod( 'company_name', 'Swift House Sold' );
	$admin_subject = sprintf( '🏠 New Seller Lead: %s, %s', $address, $name );
	$admin_body    = "<h2 style='color:#1B2B4B'>New Seller Lead</h2><table cellpadding='8' style='width:100%;border-collapse:collapse'>";
	$admin_body   .= "<tr><td><strong>Name</strong></td><td>" . esc_html( $name ) . "</td></tr>";
	$admin_body   .= "<tr style='background:#f9f9f9'><td><strong>Phone</strong></td><td>" . esc_html( $phone ) . "</td></tr>";
	$admin_body   .= "<tr><td><strong>Email</strong></td><td>" . esc_html( $email ) . "</td></tr>";
	$admin_body   .= "<tr style='background:#f9f9f9'><td><strong>Property</strong></td><td>" . esc_html( $address . ', ' . $city . ', ' . $state . ' ' . $zip ) . "</td></tr>";
	$admin_body   .= "<tr><td><strong>Situation</strong></td><td>" . esc_html( $situation ) . "</td></tr>";
	$admin_body   .= "<tr style='background:#f9f9f9'><td><strong>Timeline</strong></td><td>" . esc_html( $timeline ) . "</td></tr>";
	$admin_body   .= "<tr><td><strong>Condition</strong></td><td>" . esc_html( $condition ) . "</td></tr>";
	$admin_body   .= "<tr style='background:#f9f9f9'><td><strong>Source</strong></td><td>" . esc_html( $utm_s . '/' . $utm_m ) . "</td></tr>";
	$admin_body   .= "</table>";
	wholesalepro_send_email( $admin_email, $admin_subject, $admin_body, true );

	if ( $email ) {
		$confirm_subject = sprintf( __( 'We received your request, %s', 'wholesalepro' ), $company_name );
		$confirm_body    = "<p>Hi " . esc_html( $name ) . ",</p>";
		$confirm_body   .= "<p>Thank you for reaching out! We've received your information and one of our local specialists will contact you within <strong>" . esc_html( get_theme_mod( 'response_guarantee', '1 hour' ) ) . "</strong>.</p>";
		$confirm_body   .= "<p>Here's what happens next:</p><ol><li>We review your property information</li><li>We prepare your no-obligation cash offer</li><li>We call you to walk through the offer</li></ol>";
		$confirm_body   .= "<p>Questions? Call us at <a href='tel:" . esc_attr( get_theme_mod( 'company_phone_raw', '' ) ) . "'>" . esc_html( get_theme_mod( 'company_phone', '' ) ) . "</a></p>";
		$confirm_body   .= "<p>The " . esc_html( $company_name ) . " Team</p>";
		wholesalepro_send_email( $email, $confirm_subject, $confirm_body );
	}

	$seller_page_id  = (int) get_theme_mod( 'seller_thankyou_page', 0 );
	$redirect        = $seller_page_id ? get_permalink( $seller_page_id ) : home_url( '/thank-you-seller' );

	wp_send_json_success( array( 'message' => __( 'Thank you! We will be in touch shortly.', 'wholesalepro' ), 'redirect' => $redirect ) );
}

/* ════════════════════════════════════════════════════════════════
   HANDLER 2, Buyer Form
   ════════════════════════════════════════════════════════════════ */
add_action( 'wp_ajax_wholesalepro_buyer_form',        'wholesalepro_handle_buyer_form' );
add_action( 'wp_ajax_nopriv_wholesalepro_buyer_form', 'wholesalepro_handle_buyer_form' );

function wholesalepro_handle_buyer_form() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'wholesalepro-nonce' ) ) {
		wp_send_json_error( array( 'message' => __( 'Security check failed.', 'wholesalepro' ) ), 403 );
	}
	if ( ! wholesalepro_rate_limit_check( 'buyer_form' ) ) {
		wp_send_json_error( array( 'message' => __( 'Too many submissions. Please wait and try again.', 'wholesalepro' ) ), 429 );
	}
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'message' => 'ok' ) );
	}

	$name           = isset( $_POST['buyer_name'] )      ? sanitize_text_field( wp_unslash( $_POST['buyer_name'] ) )      : '';
	$email          = isset( $_POST['buyer_email'] )     ? sanitize_email( wp_unslash( $_POST['buyer_email'] ) )           : '';
	$phone          = isset( $_POST['buyer_phone'] )     ? sanitize_text_field( wp_unslash( $_POST['buyer_phone'] ) )     : '';
	$states_raw     = isset( $_POST['buyer_states'] )    ? (array) $_POST['buyer_states']                                  : array();
	$types_raw      = isset( $_POST['property_types'] )  ? (array) $_POST['property_types']                                : array();
	$price_min      = isset( $_POST['price_min'] )       ? absint( $_POST['price_min'] )                                   : 0;
	$price_max      = isset( $_POST['price_max'] )       ? absint( $_POST['price_max'] )                                   : 0;
	$close_timeline = isset( $_POST['close_timeline'] )  ? sanitize_text_field( wp_unslash( $_POST['close_timeline'] ) )  : '';
	$financing_type = isset( $_POST['financing_type'] )  ? sanitize_text_field( wp_unslash( $_POST['financing_type'] ) )  : '';

	$states = array_map( 'sanitize_text_field', $states_raw );
	$types  = array_map( 'sanitize_text_field', $types_raw );

	$errors = array();
	$is_newsletter = isset( $_POST['form_location'] ) && 0 === strpos( sanitize_text_field( wp_unslash( $_POST['form_location'] ) ), 'newsletter' );
	if ( ! $name )  $errors['buyer_name']  = __( 'Name is required.', 'wholesalepro' );
	if ( ! $email ) $errors['buyer_email'] = __( 'Email is required.', 'wholesalepro' );
	if ( ! $phone && ! $is_newsletter ) $errors['buyer_phone'] = __( 'Phone is required.', 'wholesalepro' );

	if ( $errors ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'wholesalepro' ), 'errors' => $errors ) );
	}

	global $wpdb;
	wholesalepro_create_tables();
	$wpdb->insert(
		$wpdb->prefix . 'wholesalepro_buyers',
		array(
			'name'           => $name,
			'email'          => $email,
			'phone'          => $phone,
			'states'         => implode( ', ', $states ),
			'property_types' => implode( ', ', $types ),
			'price_min'      => $price_min,
			'price_max'      => $price_max,
			'close_timeline' => $close_timeline,
			'financing_type' => $financing_type,
			'source'         => isset( $_POST['form_location'] ) ? sanitize_text_field( wp_unslash( $_POST['form_location'] ) ) : 'buyer-form',
			'ip_address'     => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
		),
		array( '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s', '%s', '%s' )
	);

	$admin_email   = get_theme_mod( 'company_email', get_option( 'admin_email' ) );
	$company_name  = get_theme_mod( 'company_name', 'Swift House Sold' );
	$admin_subject = sprintf( '💼 New Buyer Sign-Up: %s', $name );
	$admin_body    = "<h2 style='color:#1B2B4B'>New Buyer Network Sign-Up</h2>";
	$admin_body   .= "<p><strong>Name:</strong> " . esc_html( $name ) . "<br><strong>Email:</strong> " . esc_html( $email ) . "<br><strong>Phone:</strong> " . esc_html( $phone ) . "</p>";
	$admin_body   .= "<p><strong>Target States:</strong> " . esc_html( implode( ', ', $states ) ) . "<br><strong>Property Types:</strong> " . esc_html( implode( ', ', $types ) ) . "<br><strong>Price Range:</strong> " . wholesalepro_format_currency( $price_min ) . " to " . wholesalepro_format_currency( $price_max ) . "<br><strong>Close Timeline:</strong> " . esc_html( $close_timeline ) . "<br><strong>Financing:</strong> " . esc_html( $financing_type ) . "</p>";
	wholesalepro_send_email( $admin_email, $admin_subject, $admin_body );

	$welcome_subject = sprintf( __( "You're in! Welcome to the %s Buyer Network", 'wholesalepro' ), $company_name );
	$welcome_body    = "<p>Hi " . esc_html( $name ) . ",</p>";
	$welcome_body   .= "<p>Welcome to the <strong>" . esc_html( $company_name ) . "</strong> buyer network! Here's what you can expect:</p>";
	$welcome_body   .= "<ul><li>Off-market deals sent directly to your inbox as they become available</li><li>Properties matching your criteria: " . esc_html( implode( ', ', $states ) ) . "</li><li>Price range: " . wholesalepro_format_currency( $price_min ) . " to " . wholesalepro_format_currency( $price_max ) . "</li><li>Response expected within 48 hours of deal alerts</li></ul>";
	$welcome_body   .= "<p>Questions? Call <a href='tel:" . esc_attr( get_theme_mod( 'company_phone_raw', '' ) ) . "'>" . esc_html( get_theme_mod( 'company_phone', '' ) ) . "</a></p>";
	$welcome_body   .= "<p>The " . esc_html( $company_name ) . " Team</p>";
	wholesalepro_send_email( $email, $welcome_subject, $welcome_body );

	$buyer_page_id = (int) get_theme_mod( 'buyer_thankyou_page', 0 );
	$redirect      = $buyer_page_id ? get_permalink( $buyer_page_id ) : home_url( '/thank-you-buyer' );

	wp_send_json_success( array( 'message' => __( 'Welcome to the network!', 'wholesalepro' ), 'redirect' => $redirect ) );
}

/* ════════════════════════════════════════════════════════════════
   HANDLER 3, Offer Form
   ════════════════════════════════════════════════════════════════ */
add_action( 'wp_ajax_wholesalepro_offer_form',        'wholesalepro_handle_offer_form' );
add_action( 'wp_ajax_nopriv_wholesalepro_offer_form', 'wholesalepro_handle_offer_form' );

function wholesalepro_handle_offer_form() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'wholesalepro-nonce' ) ) {
		wp_send_json_error( array( 'message' => __( 'Security check failed.', 'wholesalepro' ) ), 403 );
	}
	if ( ! wholesalepro_rate_limit_check( 'offer_form', 3 ) ) {
		wp_send_json_error( array( 'message' => __( 'Too many submissions. Please wait and try again.', 'wholesalepro' ) ), 429 );
	}

	$property_id   = isset( $_POST['property_id'] )    ? absint( $_POST['property_id'] )                                    : 0;
	$offeror_name  = isset( $_POST['offeror_name'] )   ? sanitize_text_field( wp_unslash( $_POST['offeror_name'] ) )        : '';
	$offeror_email = isset( $_POST['offeror_email'] )  ? sanitize_email( wp_unslash( $_POST['offeror_email'] ) )             : '';
	$offeror_phone = isset( $_POST['offeror_phone'] )  ? sanitize_text_field( wp_unslash( $_POST['offeror_phone'] ) )       : '';
	$offer_amount  = isset( $_POST['offer_amount'] )   ? absint( $_POST['offer_amount'] )                                   : 0;
	$close_date    = isset( $_POST['close_date'] )     ? sanitize_text_field( wp_unslash( $_POST['close_date'] ) )          : '';
	$notes         = isset( $_POST['offer_notes'] )    ? sanitize_textarea_field( wp_unslash( $_POST['offer_notes'] ) )     : '';

	$errors = array();
	if ( ! $offeror_name )  $errors['offeror_name']  = __( 'Name is required.', 'wholesalepro' );
	if ( ! $offeror_email ) $errors['offeror_email'] = __( 'Email is required.', 'wholesalepro' );
	if ( ! $offeror_phone ) $errors['offeror_phone'] = __( 'Phone is required.', 'wholesalepro' );
	if ( ! $offer_amount )  $errors['offer_amount']  = __( 'Offer amount is required.', 'wholesalepro' );

	if ( $errors ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'wholesalepro' ), 'errors' => $errors ) );
	}

	// Handle proof of funds upload
	$pof_filename = '';
	if ( ! empty( $_FILES['proof_of_funds']['name'] ) ) {
		$allowed_types = array( 'application/pdf', 'image/jpeg', 'image/png' );
		$file_type     = sanitize_text_field( $_FILES['proof_of_funds']['type'] );
		$file_size     = (int) $_FILES['proof_of_funds']['size'];

		if ( ! in_array( $file_type, $allowed_types, true ) ) {
			wp_send_json_error( array( 'message' => __( 'Proof of funds must be PDF, JPG, or PNG.', 'wholesalepro' ) ) );
		}
		if ( $file_size > 5 * MB_IN_BYTES ) {
			wp_send_json_error( array( 'message' => __( 'File must be under 5MB.', 'wholesalepro' ) ) );
		}

		require_once ABSPATH . 'wp-admin/includes/file.php';
		$uploaded = wp_handle_upload( $_FILES['proof_of_funds'], array( 'test_form' => false ) );
		if ( $uploaded && ! isset( $uploaded['error'] ) ) {
			$pof_filename = $uploaded['url'];
		}
	}

	$property_title = $property_id ? get_the_title( $property_id ) : '';

	global $wpdb;
	wholesalepro_create_tables();
	$wpdb->insert(
		$wpdb->prefix . 'wholesalepro_offers',
		array(
			'property_id'    => $property_id,
			'property_title' => $property_title,
			'offeror_name'   => $offeror_name,
			'offeror_email'  => $offeror_email,
			'offeror_phone'  => $offeror_phone,
			'offer_amount'   => $offer_amount,
			'close_date'     => $close_date,
			'pof_filename'   => $pof_filename,
			'notes'          => $notes,
			'ip_address'     => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
		),
		array( '%d', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s' )
	);

	$admin_email   = get_theme_mod( 'company_email', get_option( 'admin_email' ) );
	$admin_subject = sprintf( '💰 New Offer Received: %s, %s', wholesalepro_format_currency( $offer_amount ), $property_title );
	$admin_body    = "<h2 style='color:#1B2B4B'>New Property Offer</h2>";
	$admin_body   .= "<p><strong>Property:</strong> " . esc_html( $property_title ) . "<br><strong>Offer Amount:</strong> " . wholesalepro_format_currency( $offer_amount ) . "<br><strong>Close Date:</strong> " . esc_html( $close_date ) . "</p>";
	$admin_body   .= "<p><strong>From:</strong> " . esc_html( $offeror_name ) . "<br><strong>Email:</strong> " . esc_html( $offeror_email ) . "<br><strong>Phone:</strong> " . esc_html( $offeror_phone ) . "</p>";
	if ( $pof_filename ) $admin_body .= "<p><strong>Proof of Funds:</strong> <a href='" . esc_url( $pof_filename ) . "'>View File</a></p>";
	if ( $notes ) $admin_body .= "<p><strong>Notes:</strong> " . esc_html( $notes ) . "</p>";
	wholesalepro_send_email( $admin_email, $admin_subject, $admin_body, true );

	if ( $offeror_email ) {
		$confirm_subject = __( 'Offer Received, We\'ll Be In Touch Shortly', 'wholesalepro' );
		$confirm_body    = "<p>Hi " . esc_html( $offeror_name ) . ",</p><p>We received your offer of <strong>" . wholesalepro_format_currency( $offer_amount ) . "</strong> on <strong>" . esc_html( $property_title ) . "</strong>. Our team will review and respond within 24 hours.</p>";
		wholesalepro_send_email( $offeror_email, $confirm_subject, $confirm_body );
	}

	wp_send_json_success( array( 'message' => __( 'Offer received! We will be in touch within 24 hours.', 'wholesalepro' ) ) );
}

/* ════════════════════════════════════════════════════════════════
   HANDLER 4, Filter Properties
   ════════════════════════════════════════════════════════════════ */
add_action( 'wp_ajax_wholesalepro_filter_properties',        'wholesalepro_handle_filter_properties' );
add_action( 'wp_ajax_nopriv_wholesalepro_filter_properties', 'wholesalepro_handle_filter_properties' );

function wholesalepro_handle_filter_properties() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'wholesalepro-nonce' ) ) {
		wp_send_json_error( array( 'message' => __( 'Security check failed.', 'wholesalepro' ) ), 403 );
	}

	$state         = isset( $_POST['state'] )         ? sanitize_text_field( wp_unslash( $_POST['state'] ) )         : '';
	$price_min     = isset( $_POST['price_min'] )     ? absint( $_POST['price_min'] )                                : 0;
	$price_max     = isset( $_POST['price_max'] )     ? absint( $_POST['price_max'] )                                : 0;
	$beds          = isset( $_POST['beds'] )          ? absint( $_POST['beds'] )                                     : 0;
	$property_type = isset( $_POST['property_type'] ) ? sanitize_text_field( wp_unslash( $_POST['property_type'] ) ) : '';
	$status        = isset( $_POST['status'] )        ? sanitize_text_field( wp_unslash( $_POST['status'] ) )        : '';
	$paged         = isset( $_POST['paged'] )         ? absint( $_POST['paged'] )                                    : 1;

	$args = array(
		'post_type'      => 'property',
		'posts_per_page' => 12,
		'paged'          => $paged,
		'meta_query'     => array( 'relation' => 'AND' ),
		'tax_query'      => array( 'relation' => 'AND' ),
	);

	if ( $price_min ) {
		$args['meta_query'][] = array( 'key' => '_property_price_asking', 'value' => $price_min, 'compare' => '>=', 'type' => 'NUMERIC' );
	}
	if ( $price_max ) {
		$args['meta_query'][] = array( 'key' => '_property_price_asking', 'value' => $price_max, 'compare' => '<=', 'type' => 'NUMERIC' );
	}
	if ( $beds ) {
		$args['meta_query'][] = array( 'key' => '_property_beds', 'value' => $beds, 'compare' => '>=', 'type' => 'NUMERIC' );
	}
	if ( $state ) {
		$args['tax_query'][] = array( 'taxonomy' => 'property_state', 'field' => 'slug', 'terms' => $state );
	}
	if ( $property_type ) {
		$args['tax_query'][] = array( 'taxonomy' => 'property_type', 'field' => 'slug', 'terms' => $property_type );
	}
	if ( $status ) {
		$args['tax_query'][] = array( 'taxonomy' => 'deal_status', 'field' => 'slug', 'terms' => $status );
	}

	$query = new WP_Query( $args );
	$cards = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID();
			$cards[] = array(
				'id'            => $post_id,
				'title'         => get_the_title(),
				'permalink'     => get_permalink(),
				'thumbnail_url' => get_the_post_thumbnail_url( $post_id, 'property-thumb' ),
				'asking_price'  => (int) get_post_meta( $post_id, '_property_price_asking', true ),
				'arv'           => (int) get_post_meta( $post_id, '_property_price_arv', true ),
				'profit'        => (int) get_post_meta( $post_id, '_property_profit_potential', true ),
				'beds'          => (int) get_post_meta( $post_id, '_property_beds', true ),
				'baths'         => get_post_meta( $post_id, '_property_baths', true ),
				'sqft'          => (int) get_post_meta( $post_id, '_property_sqft', true ),
				'city'          => get_post_meta( $post_id, '_property_city', true ),
				'state'         => get_post_meta( $post_id, '_property_state_abbr', true ),
				'days'          => wholesalepro_get_days_listed( $post_id ),
				'card_html'     => wholesalepro_get_property_card( $post_id, true ),
			);
		}
		wp_reset_postdata();
	}

	wp_send_json_success( array(
		'cards'       => $cards,
		'total'       => $query->found_posts,
		'pages'       => $query->max_num_pages,
		'message'     => empty( $cards ) ? __( 'No properties match your criteria. Try adjusting your filters.', 'wholesalepro' ) : '',
	) );
}

/* ════════════════════════════════════════════════════════════════
   HANDLER 5, Contact Form
   ════════════════════════════════════════════════════════════════ */
add_action( 'wp_ajax_wholesalepro_contact_form',        'wholesalepro_handle_contact_form' );
add_action( 'wp_ajax_nopriv_wholesalepro_contact_form', 'wholesalepro_handle_contact_form' );

function wholesalepro_handle_contact_form() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'wholesalepro-nonce' ) ) {
		wp_send_json_error( array( 'message' => __( 'Security check failed.', 'wholesalepro' ) ), 403 );
	}
	if ( ! wholesalepro_rate_limit_check( 'contact_form' ) ) {
		wp_send_json_error( array( 'message' => __( 'Too many submissions. Please try again later.', 'wholesalepro' ) ), 429 );
	}
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'message' => 'ok' ) );
	}

	$contact_name    = isset( $_POST['contact_name'] )    ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) )    : '';
	$contact_email   = isset( $_POST['contact_email'] )   ? sanitize_email( wp_unslash( $_POST['contact_email'] ) )         : '';
	$contact_phone   = isset( $_POST['contact_phone'] )   ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) )   : '';
	$contact_type    = isset( $_POST['contact_type'] )    ? sanitize_text_field( wp_unslash( $_POST['contact_type'] ) )    : '';
	$contact_subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
	$contact_message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

	$errors = array();
	if ( ! $contact_name )    $errors['contact_name']    = __( 'Name is required.', 'wholesalepro' );
	if ( ! $contact_email )   $errors['contact_email']   = __( 'Email is required.', 'wholesalepro' );
	if ( ! $contact_message ) $errors['contact_message'] = __( 'Message is required.', 'wholesalepro' );

	if ( $errors ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'wholesalepro' ), 'errors' => $errors ) );
	}

	$admin_email   = get_theme_mod( 'company_email', get_option( 'admin_email' ) );
	$company_name  = get_theme_mod( 'company_name', 'Swift House Sold' );
	$admin_subject = sprintf( 'Contact Form: %s, %s', $contact_subject, $contact_name );
	$admin_body    = "<h2 style='color:#1B2B4B'>New Contact Form Submission</h2>";
	$admin_body   .= "<p><strong>Name:</strong> " . esc_html( $contact_name ) . "<br><strong>Email:</strong> " . esc_html( $contact_email ) . "<br><strong>Phone:</strong> " . esc_html( $contact_phone ) . "<br><strong>Type:</strong> " . esc_html( $contact_type ) . "<br><strong>Subject:</strong> " . esc_html( $contact_subject ) . "</p>";
	$admin_body   .= "<p><strong>Message:</strong><br>" . nl2br( esc_html( $contact_message ) ) . "</p>";
	wholesalepro_send_email( $admin_email, $admin_subject, $admin_body );

	if ( $contact_email ) {
		$confirm_subject = sprintf( __( "We received your message, %s", 'wholesalepro' ), $company_name );
		$confirm_body    = "<p>Hi " . esc_html( $contact_name ) . ",</p><p>Thank you for contacting us. We've received your message and will respond within <strong>" . esc_html( get_theme_mod( 'response_guarantee', '1 hour' ) ) . "</strong> during business hours.</p><p>The " . esc_html( $company_name ) . " Team</p>";
		wholesalepro_send_email( $contact_email, $confirm_subject, $confirm_body );
	}

	wp_send_json_success( array( 'message' => __( 'Message sent! We will be in touch soon.', 'wholesalepro' ) ) );
}
