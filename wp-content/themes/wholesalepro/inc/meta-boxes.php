<?php
/**
 * Property Meta Boxes
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ── Register Meta Box ───────────────────────────────────────── */
function wholesalepro_register_meta_boxes() {
	add_meta_box(
		'wholesalepro_property_details',
		__( 'Property Details', 'wholesalepro' ),
		'wholesalepro_render_property_meta_box',
		'property',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'wholesalepro_register_meta_boxes' );

/* ── Meta Box Fields Definition ─────────────────────────────── */
function wholesalepro_meta_fields() {
	return array(
		// Pricing
		array( 'key' => '_property_price_asking',    'label' => __( 'Asking Price ($)', 'wholesalepro' ),               'type' => 'number',   'sanitize' => 'absint',                  'readonly' => false ),
		array( 'key' => '_property_price_arv',       'label' => __( 'After Repair Value – ARV ($)', 'wholesalepro' ),   'type' => 'number',   'sanitize' => 'absint',                  'readonly' => false ),
		array( 'key' => '_property_repairs_estimate','label' => __( 'Estimated Repairs ($)', 'wholesalepro' ),          'type' => 'number',   'sanitize' => 'absint',                  'readonly' => false ),
		array( 'key' => '_property_profit_potential','label' => __( 'Potential Profit ($) — auto-calculated', 'wholesalepro' ), 'type' => 'number', 'sanitize' => 'absint',           'readonly' => true  ),
		// Property specs
		array( 'key' => '_property_beds',            'label' => __( 'Bedrooms', 'wholesalepro' ),                       'type' => 'number',   'sanitize' => 'absint',                  'readonly' => false ),
		array( 'key' => '_property_baths',           'label' => __( 'Bathrooms (e.g. 2 or 2.5)', 'wholesalepro' ),     'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		array( 'key' => '_property_sqft',            'label' => __( 'Square Footage', 'wholesalepro' ),                 'type' => 'number',   'sanitize' => 'absint',                  'readonly' => false ),
		array( 'key' => '_property_lot_size',        'label' => __( 'Lot Size', 'wholesalepro' ),                       'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		array( 'key' => '_property_year_built',      'label' => __( 'Year Built', 'wholesalepro' ),                     'type' => 'number',   'sanitize' => 'absint',                  'readonly' => false ),
		// Location
		array( 'key' => '_property_address_full',    'label' => __( 'Full Street Address', 'wholesalepro' ),            'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		array( 'key' => '_property_city',            'label' => __( 'City', 'wholesalepro' ),                           'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		array( 'key' => '_property_state_abbr',      'label' => __( 'State (2-letter, e.g. TX)', 'wholesalepro' ),      'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false, 'maxlength' => 2 ),
		array( 'key' => '_property_zip',             'label' => __( 'ZIP Code', 'wholesalepro' ),                       'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		array( 'key' => '_property_county',          'label' => __( 'County', 'wholesalepro' ),                         'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		// Dates / Admin
		array( 'key' => '_property_closing_deadline','label' => __( 'Closing Deadline', 'wholesalepro' ),               'type' => 'date',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		array( 'key' => '_property_days_listed',     'label' => __( 'Days Listed — auto-calculated', 'wholesalepro' ),  'type' => 'number',   'sanitize' => 'absint',                  'readonly' => true  ),
		array( 'key' => '_property_mls_number',      'label' => __( 'Reference Number', 'wholesalepro' ),               'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		// Highlights
		array( 'key' => '_property_highlight_1',     'label' => __( 'Highlight Point 1', 'wholesalepro' ),              'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		array( 'key' => '_property_highlight_2',     'label' => __( 'Highlight Point 2', 'wholesalepro' ),              'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		array( 'key' => '_property_highlight_3',     'label' => __( 'Highlight Point 3', 'wholesalepro' ),              'type' => 'text',     'sanitize' => 'sanitize_text_field',     'readonly' => false ),
		// URLs
		array( 'key' => '_property_docusign_url',    'label' => __( 'DocuSign / HelloSign LOI URL', 'wholesalepro' ),   'type' => 'url',      'sanitize' => 'esc_url_raw',             'readonly' => false ),
		array( 'key' => '_property_walkthrough_url', 'label' => __( 'Virtual Walkthrough URL', 'wholesalepro' ),        'type' => 'url',      'sanitize' => 'esc_url_raw',             'readonly' => false ),
		// Textareas
		array( 'key' => '_property_comps_data',      'label' => __( 'Comparable Sales (one per line: Address | Price | Date)', 'wholesalepro' ), 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field', 'readonly' => false ),
		array( 'key' => '_property_repair_breakdown','label' => __( 'Repair Cost Breakdown (one per line: Item | Cost)', 'wholesalepro' ),      'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field', 'readonly' => false ),
	);
}

/* ── Render Meta Box HTML ────────────────────────────────────── */
function wholesalepro_render_property_meta_box( $post ) {
	wp_nonce_field( 'wholesalepro_save_property_meta', 'wholesalepro_property_nonce' );

	$days_listed = wholesalepro_get_days_listed( $post->ID );
	update_post_meta( $post->ID, '_property_days_listed', $days_listed );

	echo '<style>
		.wp-meta-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
		.wp-meta-grid .full-width { grid-column:1/-1; }
		.wp-meta-field label { display:block; font-weight:600; margin-bottom:4px; font-size:13px; }
		.wp-meta-field input, .wp-meta-field textarea { width:100%; }
		.wp-meta-field textarea { min-height:80px; }
		.wp-meta-field input[readonly], .wp-meta-field textarea[readonly] { background:#f0f0f0; cursor:not-allowed; }
		.wp-meta-section-title { grid-column:1/-1; margin:8px 0 0; padding:8px 0 4px; border-bottom:2px solid #1B2B4B; font-size:14px; font-weight:700; color:#1B2B4B; }
	</style>';

	echo '<div class="wp-meta-grid">';

	$sections = array(
		'pricing'     => array( '_property_price_asking', '_property_price_arv', '_property_repairs_estimate', '_property_profit_potential' ),
		'specs'       => array( '_property_beds', '_property_baths', '_property_sqft', '_property_lot_size', '_property_year_built' ),
		'location'    => array( '_property_address_full', '_property_city', '_property_state_abbr', '_property_zip', '_property_county' ),
		'admin'       => array( '_property_closing_deadline', '_property_days_listed', '_property_mls_number' ),
		'highlights'  => array( '_property_highlight_1', '_property_highlight_2', '_property_highlight_3' ),
		'urls'        => array( '_property_docusign_url', '_property_walkthrough_url' ),
		'textareas'   => array( '_property_comps_data', '_property_repair_breakdown' ),
	);

	$section_titles = array(
		'pricing'    => __( 'Pricing & Profit', 'wholesalepro' ),
		'specs'      => __( 'Property Specs', 'wholesalepro' ),
		'location'   => __( 'Location', 'wholesalepro' ),
		'admin'      => __( 'Admin & Dates', 'wholesalepro' ),
		'highlights' => __( 'Highlights', 'wholesalepro' ),
		'urls'       => __( 'External Links', 'wholesalepro' ),
		'textareas'  => __( 'Comps & Repairs Detail', 'wholesalepro' ),
	);

	$fields_indexed = array();
	foreach ( wholesalepro_meta_fields() as $f ) {
		$fields_indexed[ $f['key'] ] = $f;
	}

	foreach ( $sections as $section_key => $keys ) {
		echo '<div class="wp-meta-section-title">' . esc_html( $section_titles[ $section_key ] ) . '</div>';
		foreach ( $keys as $key ) {
			if ( ! isset( $fields_indexed[ $key ] ) ) {
				continue;
			}
			$field    = $fields_indexed[ $key ];
			$value    = get_post_meta( $post->ID, $field['key'], true );
			$readonly = ! empty( $field['readonly'] ) ? ' readonly' : '';
			$maxlen   = ! empty( $field['maxlength'] ) ? ' maxlength="' . absint( $field['maxlength'] ) . '"' : '';
			$full     = in_array( $field['type'], array( 'textarea', 'url' ), true ) ? ' full-width' : '';
			$id       = esc_attr( ltrim( $field['key'], '_' ) );

			echo '<div class="wp-meta-field' . esc_attr( $full ) . '">';
			echo '<label for="' . $id . '">' . esc_html( $field['label'] ) . '</label>';

			if ( 'textarea' === $field['type'] ) {
				echo '<textarea id="' . $id . '" name="' . esc_attr( $field['key'] ) . '"' . $readonly . '>' . esc_textarea( $value ) . '</textarea>';
			} else {
				echo '<input type="' . esc_attr( $field['type'] ) . '" id="' . $id . '" name="' . esc_attr( $field['key'] ) . '" value="' . esc_attr( $value ) . '"' . $readonly . $maxlen . '>';
			}
			echo '</div>';
		}
	}

	echo '</div>';

	// Inline JS for auto-calc profit
	?>
	<script>
	(function(){
		function calcProfit(){
			var arv     = parseInt(document.querySelector('[name="_property_price_arv"]').value)     || 0;
			var repairs = parseInt(document.querySelector('[name="_property_repairs_estimate"]').value) || 0;
			var asking  = parseInt(document.querySelector('[name="_property_price_asking"]').value)  || 0;
			var profit  = arv - repairs - asking;
			var el = document.querySelector('[name="_property_profit_potential"]');
			if(el){ el.value = profit >= 0 ? profit : 0; }
		}
		['_property_price_arv','_property_repairs_estimate','_property_price_asking'].forEach(function(n){
			var el = document.querySelector('[name="'+n+'"]');
			if(el){ el.addEventListener('input', calcProfit); el.addEventListener('blur', calcProfit); }
		});
	})();
	</script>
	<?php
}

/* ── Save Meta Box ───────────────────────────────────────────── */
function wholesalepro_save_property_meta( $post_id ) {
	if ( ! isset( $_POST['wholesalepro_property_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wholesalepro_property_nonce'] ) ), 'wholesalepro_save_property_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( 'property' !== get_post_type( $post_id ) ) {
		return;
	}

	foreach ( wholesalepro_meta_fields() as $field ) {
		if ( ! empty( $field['readonly'] ) ) {
			continue;
		}
		$key      = $field['key'];
		$sanitize = $field['sanitize'];

		if ( ! isset( $_POST[ $key ] ) ) {
			delete_post_meta( $post_id, $key );
			continue;
		}

		$raw_value = wp_unslash( $_POST[ $key ] );
		$value     = call_user_func( $sanitize, $raw_value );
		update_post_meta( $post_id, $key, $value );
	}

	// Auto-calculate profit
	$arv     = (int) get_post_meta( $post_id, '_property_price_arv', true );
	$repairs = (int) get_post_meta( $post_id, '_property_repairs_estimate', true );
	$asking  = (int) get_post_meta( $post_id, '_property_price_asking', true );
	$profit  = max( 0, $arv - $repairs - $asking );
	update_post_meta( $post_id, '_property_profit_potential', $profit );

	// Auto-set days listed
	$days = wholesalepro_get_days_listed( $post_id );
	update_post_meta( $post_id, '_property_days_listed', $days );
}
add_action( 'save_post', 'wholesalepro_save_property_meta' );
