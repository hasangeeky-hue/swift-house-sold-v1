<?php
/**
 * Theme Customizer Settings
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wholesalepro_customizer_register( $wp_customize ) {

	/* ── Main Panel ──────────────────────────────────────────── */
	$wp_customize->add_panel( 'wholesalepro_panel', array(
		'title'    => __( 'WholesalePro Settings', 'wholesalepro' ),
		'priority' => 30,
	) );

	/* ════════════════════════════════════════════════════════════
	   SECTION: Company Info
	   ════════════════════════════════════════════════════════════ */
	$wp_customize->add_section( 'wholesalepro_company', array(
		'title'    => __( 'Company Info', 'wholesalepro' ),
		'panel'    => 'wholesalepro_panel',
		'priority' => 10,
	) );

	$company_fields = array(
		array( 'id' => 'company_name',         'label' => __( 'Company Name', 'wholesalepro' ),              'default' => 'WholesalePro',            'type' => 'text',     'transport' => 'postMessage' ),
		array( 'id' => 'company_phone',        'label' => __( 'Phone (formatted)', 'wholesalepro' ),         'default' => '(555) 000-0000',          'type' => 'text',     'transport' => 'refresh' ),
		array( 'id' => 'company_phone_raw',    'label' => __( 'Phone (digits only for tel: links)', 'wholesalepro' ), 'default' => '5550000000',   'type' => 'text',     'transport' => 'refresh' ),
		array( 'id' => 'company_email',        'label' => __( 'Email Address', 'wholesalepro' ),             'default' => 'info@wholesalepro.com',   'type' => 'text',     'transport' => 'refresh' ),
		array( 'id' => 'company_address',      'label' => __( 'Business Address', 'wholesalepro' ),          'default' => '',                        'type' => 'textarea', 'transport' => 'refresh' ),
		array( 'id' => 'company_tagline',      'label' => __( 'Company Tagline', 'wholesalepro' ),           'default' => 'We Buy Houses For Cash',  'type' => 'text',     'transport' => 'postMessage' ),
		array( 'id' => 'company_founding_year','label' => __( 'Founding Year', 'wholesalepro' ),             'default' => '2020',                    'type' => 'text',     'transport' => 'refresh' ),
		array( 'id' => 'deals_closed_count',   'label' => __( 'Deals Closed Count', 'wholesalepro' ),        'default' => '500',                     'type' => 'text',     'transport' => 'postMessage' ),
		array( 'id' => 'states_covered',       'label' => __( 'States Covered', 'wholesalepro' ),            'default' => '50',                      'type' => 'text',     'transport' => 'postMessage' ),
		array( 'id' => 'average_close_days',   'label' => __( 'Average Close Days', 'wholesalepro' ),        'default' => '14',                      'type' => 'text',     'transport' => 'postMessage' ),
		array( 'id' => 'seller_rating',        'label' => __( 'Seller Rating (e.g. 4.9)', 'wholesalepro' ),  'default' => '4.9',                     'type' => 'text',     'transport' => 'postMessage' ),
	);
	wholesalepro_add_fields( $wp_customize, 'wholesalepro_company', $company_fields );

	/* ════════════════════════════════════════════════════════════
	   SECTION: API Keys
	   ════════════════════════════════════════════════════════════ */
	$wp_customize->add_section( 'wholesalepro_api', array(
		'title'    => __( 'API Keys', 'wholesalepro' ),
		'panel'    => 'wholesalepro_panel',
		'priority' => 20,
	) );
	$api_fields = array(
		array( 'id' => 'google_maps_key',      'label' => __( 'Google Maps API Key', 'wholesalepro' ),       'default' => '', 'type' => 'text',     'transport' => 'refresh' ),
		array( 'id' => 'google_analytics_id',  'label' => __( 'Google Analytics ID (GA4)', 'wholesalepro' ), 'default' => '', 'type' => 'text',     'transport' => 'refresh' ),
		array( 'id' => 'facebook_pixel_id',    'label' => __( 'Facebook Pixel ID', 'wholesalepro' ),         'default' => '', 'type' => 'text',     'transport' => 'refresh' ),
		array( 'id' => 'google_tag_manager',   'label' => __( 'Google Tag Manager ID', 'wholesalepro' ),     'default' => '', 'type' => 'text',     'transport' => 'refresh' ),
	);
	wholesalepro_add_fields( $wp_customize, 'wholesalepro_api', $api_fields );

	/* ════════════════════════════════════════════════════════════
	   SECTION: Social Media
	   ════════════════════════════════════════════════════════════ */
	$wp_customize->add_section( 'wholesalepro_social', array(
		'title'    => __( 'Social Media', 'wholesalepro' ),
		'panel'    => 'wholesalepro_panel',
		'priority' => 30,
	) );
	$social_fields = array(
		array( 'id' => 'social_facebook',  'label' => __( 'Facebook URL', 'wholesalepro' ),  'default' => '', 'type' => 'url', 'transport' => 'refresh' ),
		array( 'id' => 'social_instagram', 'label' => __( 'Instagram URL', 'wholesalepro' ), 'default' => '', 'type' => 'url', 'transport' => 'refresh' ),
		array( 'id' => 'social_linkedin',  'label' => __( 'LinkedIn URL', 'wholesalepro' ),  'default' => '', 'type' => 'url', 'transport' => 'refresh' ),
		array( 'id' => 'social_youtube',   'label' => __( 'YouTube URL', 'wholesalepro' ),   'default' => '', 'type' => 'url', 'transport' => 'refresh' ),
		array( 'id' => 'social_twitter',   'label' => __( 'X / Twitter URL', 'wholesalepro' ),'default'=> '', 'type' => 'url', 'transport' => 'refresh' ),
	);
	wholesalepro_add_fields( $wp_customize, 'wholesalepro_social', $social_fields );

	/* ════════════════════════════════════════════════════════════
	   SECTION: Business Settings
	   ════════════════════════════════════════════════════════════ */
	$wp_customize->add_section( 'wholesalepro_business', array(
		'title'    => __( 'Business Settings', 'wholesalepro' ),
		'panel'    => 'wholesalepro_panel',
		'priority' => 40,
	) );

	// URL fields
	$business_url_fields = array(
		array( 'id' => 'docusign_seller_url', 'label' => __( 'DocuSign Seller Contract URL', 'wholesalepro' ), 'default' => '', 'type' => 'url', 'transport' => 'refresh' ),
		array( 'id' => 'docusign_buyer_url',  'label' => __( 'DocuSign Buyer LOI URL', 'wholesalepro' ),       'default' => '', 'type' => 'url', 'transport' => 'refresh' ),
		array( 'id' => 'response_guarantee',  'label' => __( 'Response Time Guarantee', 'wholesalepro' ),      'default' => '1 hour', 'type' => 'text', 'transport' => 'refresh' ),
	);
	wholesalepro_add_fields( $wp_customize, 'wholesalepro_business', $business_url_fields );

	// Seller thank-you page
	$wp_customize->add_setting( 'seller_thankyou_page', array( 'default' => 0, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'seller_thankyou_page', array(
		'label'   => __( 'Seller Thank-You Page', 'wholesalepro' ),
		'section' => 'wholesalepro_business',
		'type'    => 'dropdown-pages',
	) );

	// Buyer thank-you page
	$wp_customize->add_setting( 'buyer_thankyou_page', array( 'default' => 0, 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'buyer_thankyou_page', array(
		'label'   => __( 'Buyer Thank-You Page', 'wholesalepro' ),
		'section' => 'wholesalepro_business',
		'type'    => 'dropdown-pages',
	) );

	/* ════════════════════════════════════════════════════════════
	   SECTION: Header / Footer
	   ════════════════════════════════════════════════════════════ */
	$wp_customize->add_section( 'wholesalepro_header_footer', array(
		'title'    => __( 'Header / Footer', 'wholesalepro' ),
		'panel'    => 'wholesalepro_panel',
		'priority' => 50,
	) );

	// Show topbar checkbox
	$wp_customize->add_setting( 'show_topbar', array( 'default' => true, 'sanitize_callback' => 'wholesalepro_sanitize_checkbox', 'transport' => 'refresh' ) );
	$wp_customize->add_control( 'show_topbar', array(
		'label'   => __( 'Show Top Bar', 'wholesalepro' ),
		'section' => 'wholesalepro_header_footer',
		'type'    => 'checkbox',
	) );

	$hf_fields = array(
		array( 'id' => 'topbar_message',     'label' => __( 'Top Bar Message', 'wholesalepro' ),     'default' => '', 'type' => 'text',     'transport' => 'postMessage' ),
		array( 'id' => 'footer_disclaimer',  'label' => __( 'Footer Disclaimer Text', 'wholesalepro' ), 'default' => '', 'type' => 'textarea', 'transport' => 'refresh' ),
	);
	wholesalepro_add_fields( $wp_customize, 'wholesalepro_header_footer', $hf_fields );

	/* ── Selective Refresh Bindings ──────────────────────────── */
	$wp_customize->selective_refresh->add_partial( 'company_name', array(
		'selector'        => '.nav-logo__text, .footer__brand-name',
		'render_callback' => function() {
			return esc_html( get_theme_mod( 'company_name', 'WholesalePro' ) );
		},
	) );
	$wp_customize->selective_refresh->add_partial( 'company_tagline', array(
		'selector'        => '.footer__tagline',
		'render_callback' => function() {
			return esc_html( get_theme_mod( 'company_tagline', 'We Buy Houses For Cash' ) );
		},
	) );
	$wp_customize->selective_refresh->add_partial( 'topbar_message', array(
		'selector'        => '.topbar__message',
		'render_callback' => function() {
			return esc_html( get_theme_mod( 'topbar_message', '' ) );
		},
	) );
}
add_action( 'customize_register', 'wholesalepro_customizer_register' );

/* ── Helper: Batch-add settings + controls ───────────────────── */
function wholesalepro_add_fields( $wp_customize, $section, $fields ) {
	foreach ( $fields as $field ) {
		$sanitize = 'url' === $field['type'] ? 'esc_url_raw' : ( 'textarea' === $field['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field' );
		$wp_customize->add_setting( $field['id'], array(
			'default'           => $field['default'],
			'sanitize_callback' => $sanitize,
			'transport'         => $field['transport'],
		) );
		$wp_customize->add_control( $field['id'], array(
			'label'   => $field['label'],
			'section' => $section,
			'type'    => $field['type'],
		) );
	}
}

/* ── Sanitize Checkbox ───────────────────────────────────────── */
function wholesalepro_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/* ── Output postMessage JS ───────────────────────────────────── */
function wholesalepro_customizer_preview_js() {
	wp_enqueue_script(
		'wholesalepro-customizer-preview',
		WHOLESALEPRO_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		WHOLESALEPRO_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'wholesalepro_customizer_preview_js' );
