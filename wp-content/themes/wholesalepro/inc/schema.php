<?php
/**
 * JSON-LD Schema Output
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wholesalepro_output_schema() {
	$schemas = array();

	$company      = get_theme_mod( 'company_name', 'Swift House Sold' );
	$phone        = get_theme_mod( 'company_phone', '' );
	$email        = get_theme_mod( 'company_email', '' );
	$address_raw  = get_theme_mod( 'company_address', '' );
	$social_urls  = array_filter( array(
		get_theme_mod( 'social_facebook', '' ),
		get_theme_mod( 'social_instagram', '' ),
		get_theme_mod( 'social_linkedin', '' ),
		get_theme_mod( 'social_youtube', '' ),
		get_theme_mod( 'social_twitter', '' ),
	) );

	// Parse address
	$address_parts = array_map( 'trim', explode( "\n", $address_raw ) );
	$street        = isset( $address_parts[0] ) ? $address_parts[0] : '';
	$city_state    = isset( $address_parts[1] ) ? $address_parts[1] : '';
	$postal        = isset( $address_parts[2] ) ? $address_parts[2] : '';

	/* ── Organization (every page) ───────────────────────────── */
	$org_schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Organization',
		'name'        => $company,
		'url'         => home_url( '/' ),
		'telephone'   => $phone,
		'email'       => $email,
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $street,
			'addressLocality' => $city_state,
			'postalCode'      => $postal,
			'addressCountry'  => 'US',
		),
		'sameAs'      => array_values( $social_urls ),
		'logo'        => array(
			'@type' => 'ImageObject',
			'url'   => get_theme_mod( 'custom_logo' ) ? wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ) : '',
		),
	);
	$schemas[] = $org_schema;

	/* ── LocalBusiness / RealEstateAgent (contact page) ─────── */
	if ( is_page_template( 'page-contact.php' ) || ( is_page() && 'contact' === get_post_field( 'post_name' ) ) ) {
		$local_schema = array(
			'@context'      => 'https://schema.org',
			'@type'         => 'RealEstateAgent',
			'name'          => $company,
			'url'           => home_url( '/' ),
			'telephone'     => $phone,
			'email'         => $email,
			'address'       => $org_schema['address'],
			'openingHours'  => 'Mo-Fr 09:00-18:00',
			'priceRange'    => '$$$',
			'areaServed'    => array(
				'@type' => 'Country',
				'name'  => 'United States',
			),
			'sameAs'        => array_values( $social_urls ),
		);
		$schemas[] = $local_schema;
	}

	/* ── RealEstateListing (single property) ─────────────────── */
	if ( is_singular( 'property' ) ) {
		$post_id  = get_the_ID();
		$address  = get_post_meta( $post_id, '_property_address_full', true );
		$city     = get_post_meta( $post_id, '_property_city', true );
		$state    = get_post_meta( $post_id, '_property_state_abbr', true );
		$zip      = get_post_meta( $post_id, '_property_zip', true );
		$price    = (int) get_post_meta( $post_id, '_property_price_asking', true );
		$beds     = (int) get_post_meta( $post_id, '_property_beds', true );
		$baths    = get_post_meta( $post_id, '_property_baths', true );
		$sqft     = (int) get_post_meta( $post_id, '_property_sqft', true );

		$listing = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'RealEstateListing',
			'name'             => get_the_title(),
			'description'      => get_the_excerpt(),
			'url'              => get_permalink(),
			'datePosted'       => get_the_date( 'c' ),
			'address'          => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $address,
				'addressLocality' => $city,
				'addressRegion'   => $state,
				'postalCode'      => $zip,
				'addressCountry'  => 'US',
			),
		);

		if ( $price ) {
			$listing['offers'] = array(
				'@type'         => 'Offer',
				'price'         => $price,
				'priceCurrency' => 'USD',
				'availability'  => 'https://schema.org/InStock',
			);
		}

		if ( has_post_thumbnail() ) {
			$listing['image'] = get_the_post_thumbnail_url( $post_id, 'large' );
		}

		if ( $beds )  $listing['numberOfRooms']    = $beds;
		if ( $sqft )  $listing['floorSize']        = array( '@type' => 'QuantitativeValue', 'value' => $sqft, 'unitCode' => 'FTK' );

		$schemas[] = $listing;
	}

	/* ── Article (blog single) ───────────────────────────────── */
	if ( is_single() && 'post' === get_post_type() ) {
		$article = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'Article',
			'headline'         => get_the_title(),
			'datePublished'    => get_the_date( 'c' ),
			'dateModified'     => get_the_modified_date( 'c' ),
			'author'           => array(
				'@type' => 'Person',
				'name'  => get_the_author(),
			),
			'publisher'        => array(
				'@type' => 'Organization',
				'name'  => $company,
				'logo'  => $org_schema['logo'],
			),
			'description'      => get_the_excerpt(),
			'url'              => get_permalink(),
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => get_permalink(),
			),
		);
		if ( has_post_thumbnail() ) {
			$article['image'] = get_the_post_thumbnail_url( get_the_ID(), 'large' );
		}
		$schemas[] = $article;
	}

	/* ── FAQPage ─────────────────────────────────────────────── */
	$faq_templates = array( 'page-sell.php', 'page-how-it-works.php', 'page-about.php' );
	$is_faq_page   = false;
	foreach ( $faq_templates as $tpl ) {
		if ( is_page_template( $tpl ) ) {
			$is_faq_page = true;
			break;
		}
	}

	if ( $is_faq_page ) {
		$faq_items = wholesalepro_get_faq_schema_items();
		if ( $faq_items ) {
			$schemas[] = array(
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $faq_items,
			);
		}
	}

	/* ── BreadcrumbList ──────────────────────────────────────── */
	$breadcrumb_items = wholesalepro_get_breadcrumb_schema_items();
	if ( count( $breadcrumb_items ) > 1 ) {
		$schemas[] = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $breadcrumb_items,
		);
	}

	foreach ( $schemas as $schema ) {
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'wholesalepro_output_schema', 5 );

/* ── FAQ Schema Items ────────────────────────────────────────── */
function wholesalepro_get_faq_schema_items() {
	$faqs = array(
		array(
			'question' => wholesalepro_content( '{{FAQ_QUESTION_1}}', 'How quickly can you close on my house?' ),
			'answer'   => wholesalepro_content( '{{FAQ_ANSWER_1}}', 'We can close in as little as 7 days or on your timeline — whatever works best for you.' ),
		),
		array(
			'question' => wholesalepro_content( '{{FAQ_QUESTION_2}}', 'Do I need to make repairs before selling?' ),
			'answer'   => wholesalepro_content( '{{FAQ_ANSWER_2}}', 'No repairs needed. We buy houses in any condition — move-in ready or completely distressed.' ),
		),
		array(
			'question' => wholesalepro_content( '{{FAQ_QUESTION_3}}', 'Are there any fees or commissions?' ),
			'answer'   => wholesalepro_content( '{{FAQ_ANSWER_3}}', 'Absolutely none. No agent commissions, no closing fees, no hidden costs. The offer we make is the cash you receive.' ),
		),
		array(
			'question' => wholesalepro_content( '{{FAQ_QUESTION_4}}', 'How do you determine your cash offer?' ),
			'answer'   => wholesalepro_content( '{{FAQ_ANSWER_4}}', 'We analyze comparable sales, the property condition, needed repairs, and local market data to make a fair cash offer.' ),
		),
		array(
			'question' => wholesalepro_content( '{{FAQ_QUESTION_5}}', 'What types of properties do you buy?' ),
			'answer'   => wholesalepro_content( '{{FAQ_ANSWER_5}}', 'We buy single-family homes, multi-family properties, condos, townhouses, land, and commercial properties in all 50 states.' ),
		),
	);

	$items = array();
	foreach ( $faqs as $faq ) {
		$items[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $faq['question'] ),
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $faq['answer'] ),
			),
		);
	}
	return $items;
}

/* ── Breadcrumb Schema Items ─────────────────────────────────── */
function wholesalepro_get_breadcrumb_schema_items() {
	$items   = array();
	$items[] = array(
		'@type'    => 'ListItem',
		'position' => 1,
		'name'     => __( 'Home', 'wholesalepro' ),
		'item'     => home_url( '/' ),
	);

	if ( is_singular( 'property' ) ) {
		$items[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => __( 'Deals', 'wholesalepro' ), 'item' => home_url( '/deals' ) );
		$items[] = array( '@type' => 'ListItem', 'position' => 3, 'name' => get_the_title() );
	} elseif ( is_single() ) {
		$cats = get_the_category();
		if ( $cats ) {
			$items[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => $cats[0]->name, 'item' => get_category_link( $cats[0]->term_id ) );
		}
		$items[] = array( '@type' => 'ListItem', 'position' => count( $items ) + 1, 'name' => get_the_title() );
	} elseif ( is_page() ) {
		$ancestors = get_post_ancestors( get_the_ID() );
		$pos       = 2;
		foreach ( array_reverse( $ancestors ) as $anc_id ) {
			$items[] = array( '@type' => 'ListItem', 'position' => $pos++, 'name' => get_the_title( $anc_id ), 'item' => get_permalink( $anc_id ) );
		}
		$items[] = array( '@type' => 'ListItem', 'position' => $pos, 'name' => get_the_title() );
	}

	return $items;
}
