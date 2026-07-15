<?php
/**
 * Custom Post Types & Taxonomies
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ── Register Property CPT ──────────────────────────────────── */
function wholesalepro_register_property_cpt() {
	$labels = array(
		'name'                  => _x( 'Properties', 'Post type general name', 'wholesalepro' ),
		'singular_name'         => _x( 'Property', 'Post type singular name', 'wholesalepro' ),
		'menu_name'             => _x( 'Properties', 'Admin Menu text', 'wholesalepro' ),
		'name_admin_bar'        => _x( 'Property', 'Add New on Toolbar', 'wholesalepro' ),
		'add_new'               => __( 'Add New', 'wholesalepro' ),
		'add_new_item'          => __( 'Add New Property', 'wholesalepro' ),
		'new_item'              => __( 'New Property', 'wholesalepro' ),
		'edit_item'             => __( 'Edit Property', 'wholesalepro' ),
		'view_item'             => __( 'View Property', 'wholesalepro' ),
		'all_items'             => __( 'All Properties', 'wholesalepro' ),
		'search_items'          => __( 'Search Properties', 'wholesalepro' ),
		'not_found'             => __( 'No properties found.', 'wholesalepro' ),
		'not_found_in_trash'    => __( 'No properties found in Trash.', 'wholesalepro' ),
		'featured_image'        => _x( 'Property Photo', 'Overrides the "Featured Image" phrase', 'wholesalepro' ),
		'set_featured_image'    => _x( 'Set property photo', 'Overrides the "Set featured image" phrase', 'wholesalepro' ),
		'remove_featured_image' => _x( 'Remove property photo', 'Overrides the "Remove featured image" phrase', 'wholesalepro' ),
		'use_featured_image'    => _x( 'Use as property photo', 'Overrides the "Use as featured image" phrase', 'wholesalepro' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'deal' ),
		'capability_type'    => 'post',
		'has_archive'        => 'deals',
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-building',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
		'taxonomies'         => array( 'property_state', 'property_type', 'deal_status' ),
	);

	register_post_type( 'property', $args );
}
add_action( 'init', 'wholesalepro_register_property_cpt' );

/* ── Register property_state Taxonomy ───────────────────────── */
function wholesalepro_register_taxonomies() {
	// Property State
	$state_labels = array(
		'name'              => _x( 'States', 'taxonomy general name', 'wholesalepro' ),
		'singular_name'     => _x( 'State', 'taxonomy singular name', 'wholesalepro' ),
		'search_items'      => __( 'Search States', 'wholesalepro' ),
		'all_items'         => __( 'All States', 'wholesalepro' ),
		'edit_item'         => __( 'Edit State', 'wholesalepro' ),
		'update_item'       => __( 'Update State', 'wholesalepro' ),
		'add_new_item'      => __( 'Add New State', 'wholesalepro' ),
		'new_item_name'     => __( 'New State Name', 'wholesalepro' ),
		'menu_name'         => __( 'States', 'wholesalepro' ),
	);
	register_taxonomy( 'property_state', array( 'property' ), array(
		'hierarchical'      => false,
		'labels'            => $state_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'state' ),
		'show_in_rest'      => true,
		'public'            => true,
	) );

	// Property Type
	$type_labels = array(
		'name'          => _x( 'Property Types', 'taxonomy general name', 'wholesalepro' ),
		'singular_name' => _x( 'Property Type', 'taxonomy singular name', 'wholesalepro' ),
		'menu_name'     => __( 'Property Types', 'wholesalepro' ),
	);
	register_taxonomy( 'property_type', array( 'property' ), array(
		'hierarchical'      => false,
		'labels'            => $type_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'property-type' ),
		'show_in_rest'      => true,
		'public'            => true,
	) );

	// Deal Status
	$status_labels = array(
		'name'          => _x( 'Deal Status', 'taxonomy general name', 'wholesalepro' ),
		'singular_name' => _x( 'Deal Status', 'taxonomy singular name', 'wholesalepro' ),
		'menu_name'     => __( 'Deal Status', 'wholesalepro' ),
	);
	register_taxonomy( 'deal_status', array( 'property' ), array(
		'hierarchical'      => false,
		'labels'            => $status_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'deal-status' ),
		'show_in_rest'      => true,
		'public'            => true,
	) );
}
add_action( 'init', 'wholesalepro_register_taxonomies' );

/* ── Insert Default Taxonomy Terms ──────────────────────────── */
function wholesalepro_insert_default_terms() {
	// All 50 US states
	$states = array(
		'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
		'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia',
		'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa',
		'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland',
		'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri',
		'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey',
		'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio',
		'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina',
		'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
		'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming',
	);
	foreach ( $states as $state ) {
		if ( ! term_exists( $state, 'property_state' ) ) {
			wp_insert_term( $state, 'property_state' );
		}
	}

	// Property types
	$types = array( 'Single Family', 'Multi-Family', 'Condo', 'Townhouse', 'Land', 'Commercial' );
	foreach ( $types as $type ) {
		if ( ! term_exists( $type, 'property_type' ) ) {
			wp_insert_term( $type, 'property_type' );
		}
	}

	// Deal statuses
	$statuses = array( 'Available', 'Under Contract', 'Sold', 'Off Market' );
	foreach ( $statuses as $status ) {
		if ( ! term_exists( $status, 'deal_status' ) ) {
			wp_insert_term( $status, 'deal_status' );
		}
	}
}
add_action( 'init', 'wholesalepro_insert_default_terms', 20 );

/* ── Admin Columns ───────────────────────────────────────────── */
function wholesalepro_property_columns( $columns ) {
	$new = array();
	foreach ( $columns as $key => $value ) {
		$new[ $key ] = $value;
		if ( 'title' === $key ) {
			$new['deal_status']   = __( 'Status', 'wholesalepro' );
			$new['property_state']= __( 'State', 'wholesalepro' );
			$new['arv']           = __( 'ARV', 'wholesalepro' );
			$new['asking_price']  = __( 'Asking Price', 'wholesalepro' );
			$new['profit']        = __( 'Est. Profit', 'wholesalepro' );
			$new['days_listed']   = __( 'Days Listed', 'wholesalepro' );
		}
	}
	return $new;
}
add_filter( 'manage_property_posts_columns', 'wholesalepro_property_columns' );

function wholesalepro_property_column_data( $column, $post_id ) {
	switch ( $column ) {
		case 'deal_status':
			$terms = get_the_terms( $post_id, 'deal_status' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$status = $terms[0]->name;
				$class  = 'Available' === $status ? 'badge--available' : ( 'Sold' === $status ? 'badge--sold' : 'badge--contract' );
				echo '<span class="badge ' . esc_attr( $class ) . '">' . esc_html( $status ) . '</span>';
			} else {
				echo '<span class="badge badge--available">' . esc_html__( 'Available', 'wholesalepro' ) . '</span>';
			}
			break;
		case 'property_state':
			$terms = get_the_terms( $post_id, 'property_state' );
			echo $terms && ! is_wp_error( $terms ) ? esc_html( $terms[0]->name ) : '—';
			break;
		case 'arv':
			$arv = get_post_meta( $post_id, '_property_price_arv', true );
			echo $arv ? esc_html( wholesalepro_format_currency( $arv ) ) : '—';
			break;
		case 'asking_price':
			$price = get_post_meta( $post_id, '_property_price_asking', true );
			echo $price ? esc_html( wholesalepro_format_currency( $price ) ) : '—';
			break;
		case 'profit':
			$arv     = (int) get_post_meta( $post_id, '_property_price_arv', true );
			$repairs = (int) get_post_meta( $post_id, '_property_repairs_estimate', true );
			$asking  = (int) get_post_meta( $post_id, '_property_price_asking', true );
			$profit  = $arv - $repairs - $asking;
			$color   = $profit >= 0 ? 'color:#2D6A4F;font-weight:700' : 'color:#E63946;font-weight:700';
			echo '<span style="' . esc_attr( $color ) . '">' . esc_html( wholesalepro_format_currency( $profit ) ) . '</span>';
			break;
		case 'days_listed':
			$days = wholesalepro_get_days_listed( $post_id );
			$class = wholesalepro_urgency_class( $days );
			echo '<span class="' . esc_attr( $class ) . '">' . absint( $days ) . ' ' . esc_html__( 'days', 'wholesalepro' ) . '</span>';
			break;
	}
}
add_action( 'manage_property_posts_custom_column', 'wholesalepro_property_column_data', 10, 2 );

function wholesalepro_sortable_property_columns( $columns ) {
	$columns['arv']          = 'arv';
	$columns['asking_price'] = 'asking_price';
	$columns['days_listed']  = 'days_listed';
	return $columns;
}
add_filter( 'manage_edit-property_sortable_columns', 'wholesalepro_sortable_property_columns' );

function wholesalepro_property_orderby( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}
	$orderby = $query->get( 'orderby' );
	$meta_map = array(
		'arv'          => '_property_price_arv',
		'asking_price' => '_property_price_asking',
		'days_listed'  => 'date',
	);
	if ( isset( $meta_map[ $orderby ] ) ) {
		if ( 'date' === $meta_map[ $orderby ] ) {
			$query->set( 'orderby', 'date' );
		} else {
			$query->set( 'meta_key', $meta_map[ $orderby ] );
			$query->set( 'orderby', 'meta_value_num' );
		}
	}
}
add_action( 'pre_get_posts', 'wholesalepro_property_orderby' );
