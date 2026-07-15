<?php
/**
 * Theme Helper Functions
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ── Currency Formatter ──────────────────────────────────────── */
function wholesalepro_format_currency( $amount ) {
	if ( null === $amount || '' === $amount ) {
		return '$0';
	}
	$amount = (float) $amount;
	if ( $amount < 0 ) {
		return '-$' . number_format( abs( $amount ) );
	}
	return '$' . number_format( $amount );
}

/* ── Days Listed ─────────────────────────────────────────────── */
function wholesalepro_get_days_listed( $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post ) {
		return 0;
	}
	$publish_time = strtotime( $post->post_date_gmt );
	$now          = time();
	if ( $publish_time > $now ) {
		return 0;
	}
	return (int) floor( ( $now - $publish_time ) / DAY_IN_SECONDS );
}

/* ── Urgency Class ───────────────────────────────────────────── */
function wholesalepro_urgency_class( $days ) {
	$days = (int) $days;
	if ( $days <= 7 ) {
		return 'urgency--hot';
	}
	if ( $days <= 14 ) {
		return 'urgency--warm';
	}
	return 'urgency--normal';
}

/* ── Status Badge ────────────────────────────────────────────── */
function wholesalepro_get_status_badge( $post_id ) {
	$terms = get_the_terms( $post_id, 'deal_status' );
	$status = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : 'Available';

	$class_map = array(
		'Available'      => 'badge--available',
		'Under Contract' => 'badge--contract',
		'Sold'           => 'badge--sold',
		'Off Market'     => 'badge--sold',
	);
	$badge_class = isset( $class_map[ $status ] ) ? $class_map[ $status ] : 'badge--available';

	return '<span class="badge ' . esc_attr( $badge_class ) . '">' . esc_html( $status ) . '</span>';
}

/* ── Placeholder Div ─────────────────────────────────────────── */
function wholesalepro_placeholder_div( $w, $h, $label = '' ) {
	$ratio = $h && $w ? ( $h / $w * 100 ) : 66;
	return sprintf(
		'<div class="wp-placeholder" style="background:#F8F9FA;border:2px dashed #DEE2E6;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;min-height:%dpx;width:100%%;" role="img" aria-label="%s"><span style="color:#ADB5BD;font-size:0.875rem;font-family:sans-serif;">%s</span></div>',
		absint( $h ),
		esc_attr( $label ),
		esc_html( $label ? $label : __( 'Image placeholder', 'wholesalepro' ) )
	);
}

/* ── Property Card ───────────────────────────────────────────── */
function wholesalepro_get_property_card( $post_id, $show_cta = true ) {
	$post = get_post( $post_id );
	if ( ! $post ) {
		return '';
	}

	$asking  = (int) get_post_meta( $post_id, '_property_price_asking', true );
	$arv     = (int) get_post_meta( $post_id, '_property_price_arv', true );
	$repairs = (int) get_post_meta( $post_id, '_property_repairs_estimate', true );
	$profit  = $arv - $repairs - $asking;
	$beds    = get_post_meta( $post_id, '_property_beds', true );
	$baths   = get_post_meta( $post_id, '_property_baths', true );
	$sqft    = get_post_meta( $post_id, '_property_sqft', true );
	$city    = get_post_meta( $post_id, '_property_city', true );
	$state   = get_post_meta( $post_id, '_property_state_abbr', true );
	$days    = wholesalepro_get_days_listed( $post_id );
	$u_class = wholesalepro_urgency_class( $days );
	$badge   = wholesalepro_get_status_badge( $post_id );
	$link    = get_permalink( $post_id );
	$title   = get_the_title( $post_id );

	ob_start();
	?>
	<article class="property-card animate-on-scroll">
		<div class="property-card__image">
			<?php if ( has_post_thumbnail( $post_id ) ) : ?>
				<a href="<?php echo esc_url( $link ); ?>" tabindex="-1" aria-hidden="true">
					<?php echo get_the_post_thumbnail( $post_id, 'property-thumb', array( 'alt' => esc_attr( $title ), 'loading' => 'lazy' ) ); ?>
				</a>
			<?php else : ?>
				<a href="<?php echo esc_url( $link ); ?>" tabindex="-1" aria-hidden="true">
					<?php echo wholesalepro_placeholder_div( 600, 240, $city ? $city . ', ' . $state : __( 'Property Photo', 'wholesalepro' ) ); ?>
				</a>
			<?php endif; ?>
			<div class="property-card__status"><?php echo $badge; // Already escaped. ?></div>
		</div>

		<div class="property-card__body">
			<?php if ( $city || $state ) : ?>
				<p class="property-card__location">
					<?php echo esc_html( trim( $city . ( $city && $state ? ', ' : '' ) . $state ) ); ?>
				</p>
			<?php endif; ?>

			<h3 class="property-card__title" style="font-size:var(--text-lg);margin-bottom:var(--s2);">
				<a href="<?php echo esc_url( $link ); ?>" style="color:var(--wp-navy);text-decoration:none;">
					<?php echo esc_html( $title ); ?>
				</a>
			</h3>

			<?php if ( $asking ) : ?>
				<div class="property-card__price"><?php echo esc_html( wholesalepro_format_currency( $asking ) ); ?></div>
			<?php endif; ?>

			<?php if ( $arv ) : ?>
				<div class="property-card__arv"><?php printf( esc_html__( 'ARV: %s', 'wholesalepro' ), esc_html( wholesalepro_format_currency( $arv ) ) ); ?></div>
			<?php endif; ?>

			<?php if ( $profit > 0 ) : ?>
				<div class="property-card__profit" style="margin-top:var(--s3);">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
					<?php printf( esc_html__( '%s est. profit', 'wholesalepro' ), esc_html( wholesalepro_format_currency( $profit ) ) ); ?>
				</div>
			<?php endif; ?>

			<div class="property-card__specs">
				<?php if ( $beds ) : ?>
					<span><?php echo absint( $beds ); ?> <?php esc_html_e( 'bd', 'wholesalepro' ); ?></span>
				<?php endif; ?>
				<?php if ( $baths ) : ?>
					<span><?php echo esc_html( $baths ); ?> <?php esc_html_e( 'ba', 'wholesalepro' ); ?></span>
				<?php endif; ?>
				<?php if ( $sqft ) : ?>
					<span><?php echo number_format( (int) $sqft ); ?> <?php esc_html_e( 'sqft', 'wholesalepro' ); ?></span>
				<?php endif; ?>
				<span class="property-card__days <?php echo esc_attr( $u_class ); ?>">
					<?php printf( esc_html__( '%d days listed', 'wholesalepro' ), $days ); ?>
				</span>
			</div>

			<?php if ( $show_cta ) : ?>
				<div class="property-card__actions">
					<a href="<?php echo esc_url( $link ); ?>" class="btn btn--primary btn--sm">
						<?php esc_html_e( 'View Deal', 'wholesalepro' ); ?>
					</a>
					<a href="<?php echo esc_url( $link . '#make-offer' ); ?>" class="btn btn--buyer btn--sm">
						<?php esc_html_e( 'Make Offer', 'wholesalepro' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</article>
	<?php
	return ob_get_clean();
}

/* ── Trust Bar ───────────────────────────────────────────────── */
function wholesalepro_get_trust_bar() {
	$stats = array(
		array(
			'number' => get_theme_mod( 'offer_hours', '24' ),
			'label'  => __( 'Hour Written Offer', 'wholesalepro' ),
			'suffix' => '',
		),
		array(
			'number' => get_theme_mod( 'counties_covered', '501' ),
			'label'  => __( 'Counties, OH · TX · GA', 'wholesalepro' ),
			'suffix' => '',
		),
		array(
			'number' => get_theme_mod( 'fastest_close_days', '7' ),
			'label'  => __( 'Day Fastest Close', 'wholesalepro' ),
			'suffix' => '',
		),
		array(
			'number' => get_theme_mod( 'seller_fees', '0' ),
			'label'  => __( 'Fees or Commissions', 'wholesalepro' ),
			'suffix' => '$',
		),
		array(
			'number' => get_theme_mod( 'repairs_needed', '0' ),
			'label'  => __( 'Repairs Needed, As-Is', 'wholesalepro' ),
			'suffix' => '',
		),
	);

	ob_start();
	?>
	<section class="trust-bar" aria-label="<?php esc_attr_e( 'Company statistics', 'wholesalepro' ); ?>">
		<div class="container">
			<div class="trust-bar__grid">
				<?php foreach ( $stats as $stat ) : ?>
					<div class="trust-bar__stat animate-on-scroll">
						<span class="trust-bar__number" data-count="<?php echo esc_attr( $stat['number'] ); ?>" aria-label="<?php echo esc_attr( $stat['number'] . $stat['suffix'] . ' ' . $stat['label'] ); ?>">
							<?php echo esc_html( $stat['number'] . $stat['suffix'] ); ?>
						</span>
						<span class="trust-bar__label"><?php echo esc_html( $stat['label'] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

/* ── Star Rating ─────────────────────────────────────────────── */
function wholesalepro_get_star_rating( $rating ) {
	$rating      = (float) $rating;
	$full_stars  = (int) floor( $rating );
	$half_star   = ( $rating - $full_stars ) >= 0.5;
	$empty_stars = 5 - $full_stars - ( $half_star ? 1 : 0 );
	$label       = sprintf( __( '%s out of 5 stars', 'wholesalepro' ), $rating );

	$star_full  = '<svg width="18" height="18" viewBox="0 0 24 24" fill="var(--wp-gold)" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
	$star_half  = '<svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><defs><linearGradient id="half"><stop offset="50%" stop-color="var(--wp-gold)"/><stop offset="50%" stop-color="#DEE2E6"/></linearGradient></defs><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" fill="url(#half)"/></svg>';
	$star_empty = '<svg width="18" height="18" viewBox="0 0 24 24" fill="#DEE2E6" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';

	$html  = '<span class="star-rating" aria-label="' . esc_attr( $label ) . '" role="img" style="display:inline-flex;align-items:center;gap:2px;">';
	$html .= str_repeat( $star_full, $full_stars );
	$html .= $half_star ? $star_half : '';
	$html .= str_repeat( $star_empty, $empty_stars );
	$html .= '</span>';

	return $html;
}

/* ── State Utilities ─────────────────────────────────────────── */
function wholesalepro_state_slug( $state_name ) {
	return sanitize_title( $state_name );
}

function wholesalepro_state_to_abbr( $state_name ) {
	$map = wholesalepro_state_abbr_map();
	$name = trim( $state_name );
	return isset( $map[ $name ] ) ? $map[ $name ] : '';
}

function wholesalepro_state_abbr_map() {
	return array(
		'Alabama'        => 'AL', 'Alaska'         => 'AK', 'Arizona'        => 'AZ',
		'Arkansas'       => 'AR', 'California'     => 'CA', 'Colorado'       => 'CO',
		'Connecticut'    => 'CT', 'Delaware'       => 'DE', 'Florida'        => 'FL',
		'Georgia'        => 'GA', 'Hawaii'         => 'HI', 'Idaho'          => 'ID',
		'Illinois'       => 'IL', 'Indiana'        => 'IN', 'Iowa'           => 'IA',
		'Kansas'         => 'KS', 'Kentucky'       => 'KY', 'Louisiana'      => 'LA',
		'Maine'          => 'ME', 'Maryland'       => 'MD', 'Massachusetts'  => 'MA',
		'Michigan'       => 'MI', 'Minnesota'      => 'MN', 'Mississippi'    => 'MS',
		'Missouri'       => 'MO', 'Montana'        => 'MT', 'Nebraska'       => 'NE',
		'Nevada'         => 'NV', 'New Hampshire'  => 'NH', 'New Jersey'     => 'NJ',
		'New Mexico'     => 'NM', 'New York'       => 'NY', 'North Carolina' => 'NC',
		'North Dakota'   => 'ND', 'Ohio'           => 'OH', 'Oklahoma'       => 'OK',
		'Oregon'         => 'OR', 'Pennsylvania'   => 'PA', 'Rhode Island'   => 'RI',
		'South Carolina' => 'SC', 'South Dakota'   => 'SD', 'Tennessee'      => 'TN',
		'Texas'          => 'TX', 'Utah'           => 'UT', 'Vermont'        => 'VT',
		'Virginia'       => 'VA', 'Washington'     => 'WA', 'West Virginia'  => 'WV',
		'Wisconsin'      => 'WI', 'Wyoming'        => 'WY',
	);
}

function wholesalepro_all_states_array() {
	$map = wholesalepro_state_abbr_map();
	$result = array();
	foreach ( $map as $name => $abbr ) {
		$result[ wholesalepro_state_slug( $name ) ] = $name;
	}
	return $result;
}

/* ── Breadcrumb ──────────────────────────────────────────────── */
function wholesalepro_breadcrumb() {
	if ( is_front_page() ) {
		return '';
	}

	$sep  = '<span class="breadcrumb__sep" aria-hidden="true"> › </span>';
	$home = '<a href="' . esc_url( home_url( '/' ) ) . '" class="breadcrumb__link">' . esc_html__( 'Home', 'wholesalepro' ) . '</a>';

	$crumbs   = array( $home );
	$current  = '';

	if ( is_singular( 'property' ) ) {
		$archive_url = get_post_type_archive_link( 'property' );
		if ( $archive_url ) {
			$crumbs[] = '<a href="' . esc_url( $archive_url ) . '" class="breadcrumb__link">' . esc_html__( 'Deals', 'wholesalepro' ) . '</a>';
		}
		$current = get_the_title();
	} elseif ( is_singular( 'post' ) ) {
		$blog_page_id = get_option( 'page_for_posts' );
		if ( $blog_page_id ) {
			$crumbs[] = '<a href="' . esc_url( get_permalink( $blog_page_id ) ) . '" class="breadcrumb__link">' . esc_html( get_the_title( $blog_page_id ) ) . '</a>';
		}
		$current = get_the_title();
	} elseif ( is_page() ) {
		$ancestors = get_post_ancestors( get_the_ID() );
		if ( $ancestors ) {
			foreach ( array_reverse( $ancestors ) as $ancestor_id ) {
				$crumbs[] = '<a href="' . esc_url( get_permalink( $ancestor_id ) ) . '" class="breadcrumb__link">' . esc_html( get_the_title( $ancestor_id ) ) . '</a>';
			}
		}
		$current = get_the_title();
	} elseif ( is_post_type_archive( 'property' ) ) {
		$current = esc_html__( 'Available Deals', 'wholesalepro' );
	} elseif ( is_home() ) {
		$current = esc_html__( 'Blog', 'wholesalepro' );
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$term    = get_queried_object();
		$current = $term ? esc_html( $term->name ) : '';
	} elseif ( is_search() ) {
		/* translators: %s: search query */
		$current = sprintf( esc_html__( 'Search results for "%s"', 'wholesalepro' ), get_search_query() );
	} elseif ( is_404() ) {
		$current = esc_html__( 'Page Not Found', 'wholesalepro' );
	} else {
		$current = get_the_title();
	}

	if ( $current ) {
		$crumbs[] = '<span class="breadcrumb__current" aria-current="page">' . esc_html( $current ) . '</span>';
	}

	echo '<nav class="breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'wholesalepro' ) . '"><ol class="breadcrumb__list">'
		. implode( $sep, $crumbs )
		. '</ol></nav>';
}

/* ── Share Buttons ───────────────────────────────────────────── */
function wholesalepro_share_buttons( $post_id ) {
	$url   = urlencode( get_permalink( $post_id ) );
	$title = urlencode( get_the_title( $post_id ) );

	ob_start();
	?>
	<div class="share-buttons" aria-label="<?php esc_attr_e( 'Share this page', 'wholesalepro' ); ?>">
		<span class="share-buttons__label"><?php esc_html_e( 'Share:', 'wholesalepro' ); ?></span>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; // phpcs:ignore ?>" class="share-btn share-btn--facebook" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on Facebook', 'wholesalepro' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
			Facebook
		</a>
		<a href="https://twitter.com/intent/tweet?url=<?php echo $url; // phpcs:ignore ?>&text=<?php echo $title; // phpcs:ignore ?>" class="share-btn share-btn--twitter" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on X (Twitter)', 'wholesalepro' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
			Twitter
		</a>
		<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; // phpcs:ignore ?>&title=<?php echo $title; // phpcs:ignore ?>" class="share-btn share-btn--linkedin" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'wholesalepro' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
			LinkedIn
		</a>
		<a href="mailto:?subject=<?php echo $title; // phpcs:ignore ?>&body=<?php echo $url; // phpcs:ignore ?>" class="share-btn share-btn--email" aria-label="<?php esc_attr_e( 'Share via Email', 'wholesalepro' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
			Email
		</a>
	</div>
	<?php
	return ob_get_clean();
}

/* ── Property JSON-LD Schema ─────────────────────────────────── */
function wholesalepro_property_schema( $post_id ) {
	$address  = get_post_meta( $post_id, '_property_address_full', true );
	$city     = get_post_meta( $post_id, '_property_city', true );
	$state    = get_post_meta( $post_id, '_property_state_abbr', true );
	$zip      = get_post_meta( $post_id, '_property_zip', true );
	$price    = (int) get_post_meta( $post_id, '_property_price_asking', true );
	$excerpt  = get_the_excerpt( $post_id );

	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'RealEstateListing',
		'name'        => get_the_title( $post_id ),
		'description' => $excerpt,
		'url'         => get_permalink( $post_id ),
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $address,
			'addressLocality' => $city,
			'addressRegion'   => $state,
			'postalCode'      => $zip,
			'addressCountry'  => 'US',
		),
	);

	if ( $price ) {
		$schema['offers'] = array(
			'@type'         => 'Offer',
			'price'         => $price,
			'priceCurrency' => 'USD',
			'availability'  => 'https://schema.org/InStock',
		);
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$schema['image'] = get_the_post_thumbnail_url( $post_id, 'large' );
	}

	return '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
}

/* ── Read Time ───────────────────────────────────────────────── */
function wholesalepro_read_time( $content ) {
	$words   = str_word_count( wp_strip_all_tags( $content ) );
	$minutes = (int) ceil( $words / 200 );
	$minutes = max( 1, $minutes );
	/* translators: %d: number of minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'wholesalepro' ), $minutes );
}

/* ── Related Properties ──────────────────────────────────────── */
function wholesalepro_related_properties( $post_id, $count = 3 ) {
	$terms = get_the_terms( $post_id, 'property_state' );
	$ids   = array();

	if ( $terms && ! is_wp_error( $terms ) ) {
		$term_ids = wp_list_pluck( $terms, 'term_id' );
		$q = new WP_Query( array(
			'post_type'      => 'property',
			'posts_per_page' => $count,
			'post__not_in'   => array( $post_id ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'property_state',
					'field'    => 'term_id',
					'terms'    => $term_ids,
				),
			),
			'fields'         => 'ids',
			'no_found_rows'  => true,
		) );
		$ids = $q->posts;
	}

	if ( count( $ids ) < $count ) {
		$exclude = array_merge( array( $post_id ), $ids );
		$q = new WP_Query( array(
			'post_type'      => 'property',
			'posts_per_page' => $count - count( $ids ),
			'post__not_in'   => $exclude,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'fields'         => 'ids',
			'no_found_rows'  => true,
		) );
		$ids = array_merge( $ids, $q->posts );
	}

	$ids = array_slice( $ids, 0, $count );

	if ( empty( $ids ) ) {
		return new WP_Query( array( 'post__in' => array( 0 ), 'post_type' => 'property' ) );
	}

	return new WP_Query( array(
		'post_type'      => 'property',
		'post__in'       => $ids,
		'orderby'        => 'post__in',
		'posts_per_page' => $count,
		'no_found_rows'  => true,
	) );
}

/* ── Content Helper ──────────────────────────────────────────── */
if ( ! function_exists( 'wholesalepro_content' ) ) {
	function wholesalepro_content( $marker, $fallback = '' ) {
		if ( strpos( $marker, '{{' ) === 0 && substr( $marker, -2 ) === '}}' ) {
			return wp_kses_post( $fallback );
		}
		return wp_kses_post( $marker );
	}
}
