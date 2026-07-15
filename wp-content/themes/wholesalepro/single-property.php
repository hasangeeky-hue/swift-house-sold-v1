<?php
/**
 * Single Property Template
 *
 * @package WholesalePro
 */

get_header();

while ( have_posts() ) :
	the_post();

	$property_id  = get_the_ID();

	// ── Pricing ──────────────────────────────────────────────────────
	$asking      = (int) get_post_meta( $property_id, '_property_price_asking', true );
	$arv         = (int) get_post_meta( $property_id, '_property_price_arv', true );
	$repairs     = (int) get_post_meta( $property_id, '_property_repairs_estimate', true );
	$profit      = $arv > 0 ? ( $arv - $repairs - $asking ) : 0;

	// ── Property Specs ───────────────────────────────────────────────
	$beds        = get_post_meta( $property_id, '_property_beds', true );
	$baths       = get_post_meta( $property_id, '_property_baths', true );
	$sqft        = (int) get_post_meta( $property_id, '_property_sqft', true );
	$lot         = get_post_meta( $property_id, '_property_lot_size', true );
	$year        = get_post_meta( $property_id, '_property_year_built', true );

	// ── Location ─────────────────────────────────────────────────────
	$address_full = get_post_meta( $property_id, '_property_address_full', true );
	$city         = get_post_meta( $property_id, '_property_city', true );
	$state_abbr   = get_post_meta( $property_id, '_property_state_abbr', true );
	$zip          = get_post_meta( $property_id, '_property_zip', true );

	// ── Highlights ───────────────────────────────────────────────────
	$hl1  = get_post_meta( $property_id, '_property_highlight_1', true );
	$hl2  = get_post_meta( $property_id, '_property_highlight_2', true );
	$hl3  = get_post_meta( $property_id, '_property_highlight_3', true );
	$highlights = array_filter( array( $hl1, $hl2, $hl3 ) );

	// ── Media URLs ───────────────────────────────────────────────────
	$video_url    = get_post_meta( $property_id, '_property_walkthrough_url', true );
	$docusign_url = get_post_meta( $property_id, '_property_docusign_url', true );

	// ── Gallery ──────────────────────────────────────────────────────
	$gallery_ids  = get_post_meta( $property_id, '_gallery_image_ids', true );
	$gallery_ids  = $gallery_ids ? array_filter( array_map( 'absint', explode( ',', $gallery_ids ) ) ) : array();

	// ── Status from Taxonomy ─────────────────────────────────────────
	$status_terms = get_the_terms( $property_id, 'deal_status' );
	$status_label = ( $status_terms && ! is_wp_error( $status_terms ) ) ? $status_terms[0]->name : 'Available';
	$status_slug  = ( $status_terms && ! is_wp_error( $status_terms ) ) ? $status_terms[0]->slug : 'available';

	// ── Property Type ────────────────────────────────────────────────
	$prop_types   = get_the_terms( $property_id, 'property_type' );
	$prop_type    = ( $prop_types && ! is_wp_error( $prop_types ) ) ? $prop_types[0]->name : '';

	// ── State (from taxonomy as fallback over meta) ───────────────────
	$state_terms  = get_the_terms( $property_id, 'property_state' );
	$state_name   = ( $state_terms && ! is_wp_error( $state_terms ) ) ? $state_terms[0]->name : '';

	// ── Urgency ──────────────────────────────────────────────────────
	$days_listed  = wholesalepro_get_days_listed( $property_id );
	$urgency_full = wholesalepro_urgency_class( $days_listed ); // e.g. 'urgency--hot'
	$urgency_mod  = str_replace( 'urgency--', '', $urgency_full ); // e.g. 'hot'

	// ── Build display address ─────────────────────────────────────────
	$address_parts = array_filter( array( $city, ( $state_abbr ?: $state_name ), $zip ) );
	$address_line  = implode( ', ', $address_parts );
?>

<article id="property-<?php echo esc_attr( $property_id ); ?>" class="single-property" itemscope itemtype="https://schema.org/RealEstateListing">

	<!-- ━━ HERO ━━ -->
	<div class="property-hero" style="background:var(--wp-light-gray);padding:var(--space-lg) 0;">
		<div class="container">
			<?php wholesalepro_breadcrumb(); ?>

			<div class="property-hero__inner" style="display:flex;flex-wrap:wrap;gap:var(--space-md);align-items:center;margin-top:var(--space-md);">
				<div style="flex:1;min-width:280px;">
					<?php echo wholesalepro_get_status_badge( $property_id ); // phpcs:ignore ?>
					<h1 class="animate-on-scroll" itemprop="name" style="margin:var(--space-sm) 0;">
						<?php the_title(); ?>
					</h1>
					<?php if ( $address_line ) : ?>
					<p style="color:var(--wp-gray);display:flex;align-items:center;gap:6px;margin:0;">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
						<span itemprop="address"><?php echo esc_html( $address_line ); ?></span>
					</p>
					<?php endif; ?>
				</div>

				<?php if ( $asking ) : ?>
				<div class="property-hero__price animate-on-scroll" style="text-align:right;">
					<div style="font-size:0.875rem;color:var(--wp-gray);text-transform:uppercase;letter-spacing:0.05em;"><?php esc_html_e( 'Asking Price', 'wholesalepro' ); ?></div>
					<div style="font-size:clamp(1.75rem,3vw,2.5rem);font-weight:800;color:var(--wp-red);" itemprop="price" content="<?php echo esc_attr( $asking ); ?>">
						<?php echo wholesalepro_format_currency( $asking ); // phpcs:ignore ?>
					</div>
					<?php if ( $profit > 0 ) : ?>
					<div style="font-size:0.95rem;color:var(--wp-green);font-weight:600;">
						⬆ <?php echo wholesalepro_format_currency( $profit ); // phpcs:ignore ?> <?php esc_html_e( 'est. profit', 'wholesalepro' ); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- ━━ MAIN LAYOUT ━━ -->
	<div class="container" style="padding-top:var(--space-2xl);padding-bottom:var(--space-2xl);">
		<div class="property-detail-layout">

			<!-- Left: Gallery + Details -->
			<div class="property-detail-main">

				<!-- Gallery -->
				<?php if ( has_post_thumbnail() || ! empty( $gallery_ids ) ) : ?>
				<div class="property-gallery animate-on-scroll" aria-label="<?php esc_attr_e( 'Property photos', 'wholesalepro' ); ?>">
					<div class="property-gallery__main">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'wholesalepro-hero', array( 'itemprop' => 'image', 'alt' => get_the_title() ) );
						} elseif ( ! empty( $gallery_ids ) ) {
							echo wp_get_attachment_image( $gallery_ids[0], 'wholesalepro-hero', false, array( 'itemprop' => 'image' ) );
						}
						?>
					</div>
					<?php if ( ! empty( $gallery_ids ) ) : ?>
					<div class="property-gallery__thumbs" role="list" aria-label="<?php esc_attr_e( 'Additional photos', 'wholesalepro' ); ?>">
						<?php foreach ( $gallery_ids as $img_id ) : ?>
						<div class="property-gallery__thumb" role="listitem">
							<?php echo wp_get_attachment_image( absint( $img_id ), 'wholesalepro-thumb', false, array( 'loading' => 'lazy' ) ); ?>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php if ( $video_url ) : ?>
					<div class="property-gallery__media-links" style="display:flex;gap:var(--space-sm);flex-wrap:wrap;margin-top:var(--space-sm);">
						<a href="<?php echo esc_url( $video_url ); ?>" target="_blank" rel="noopener" class="btn btn--ghost btn--sm">
							🥽 <?php esc_html_e( 'Virtual Walkthrough', 'wholesalepro' ); ?>
						</a>
					</div>
					<?php endif; ?>
				</div>
				<?php else : ?>
				<div style="margin-bottom:var(--space-xl);">
					<?php echo wholesalepro_placeholder_div( 800, 500, get_the_title() ); // phpcs:ignore ?>
				</div>
				<?php endif; ?>

				<!-- Property Specs -->
				<section class="property-specs animate-on-scroll" style="margin-top:var(--space-xl);" aria-labelledby="specs-heading">
					<h2 id="specs-heading" style="margin-bottom:var(--space-lg);">
						<?php esc_html_e( 'Property Details', 'wholesalepro' ); ?>
					</h2>
					<div class="property-specs__grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:var(--space-md);">
						<?php
						$specs = array_filter( array(
							array( 'label' => __( 'Type', 'wholesalepro' ),      'value' => $prop_type ),
							array( 'label' => __( 'Bedrooms', 'wholesalepro' ),  'value' => $beds ? $beds . ' bd' : '' ),
							array( 'label' => __( 'Bathrooms', 'wholesalepro' ), 'value' => $baths ? $baths . ' ba' : '' ),
							array( 'label' => __( 'Sq. Ft.', 'wholesalepro' ),   'value' => $sqft ? number_format( $sqft ) . ' sqft' : '' ),
							array( 'label' => __( 'Lot Size', 'wholesalepro' ),  'value' => $lot ),
							array( 'label' => __( 'Year Built', 'wholesalepro' ),'value' => $year ),
						), function( $s ) { return ! empty( $s['value'] ); } );
						foreach ( $specs as $spec ) :
						?>
						<div class="property-spec-item" style="background:var(--wp-light-gray);border-radius:var(--radius-md);padding:var(--space-md);">
							<div style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.07em;color:var(--wp-gray);margin-bottom:4px;">
								<?php echo esc_html( $spec['label'] ); ?>
							</div>
							<div style="font-weight:700;color:var(--wp-navy);">
								<?php echo esc_html( $spec['value'] ); ?>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</section>

				<!-- Deal Highlights -->
				<?php if ( $highlights ) : ?>
				<section class="animate-on-scroll" style="margin-top:var(--space-xl);" aria-labelledby="highlights-heading">
					<h2 id="highlights-heading" style="margin-bottom:var(--space-md);">
						<?php esc_html_e( 'Deal Highlights', 'wholesalepro' ); ?>
					</h2>
					<ul class="checklist">
						<?php foreach ( $highlights as $hl ) : ?>
						<li class="checklist__item checklist__item--check"><?php echo esc_html( $hl ); ?></li>
						<?php endforeach; ?>
					</ul>
				</section>
				<?php endif; ?>

				<!-- Main Content (post body) -->
				<?php if ( get_the_content() ) : ?>
				<section class="animate-on-scroll" style="margin-top:var(--space-xl);" aria-labelledby="investor-desc-heading">
					<h2 id="investor-desc-heading" style="margin-bottom:var(--space-md);">
						<?php esc_html_e( 'Property Description', 'wholesalepro' ); ?>
					</h2>
					<div class="entry-content" itemprop="description">
						<?php the_content(); ?>
					</div>
				</section>
				<?php endif; ?>

				<!-- Deal Analysis Table -->
				<?php if ( $arv ) : ?>
				<section class="animate-on-scroll" style="margin-top:var(--space-xl);" aria-labelledby="comps-heading">
					<h2 id="comps-heading" style="margin-bottom:var(--space-lg);">
						<?php esc_html_e( 'Deal Analysis', 'wholesalepro' ); ?>
					</h2>
					<div style="overflow-x:auto;">
						<table style="width:100%;border-collapse:collapse;font-size:0.95rem;">
							<caption class="sr-only"><?php esc_html_e( 'Financial breakdown of this deal', 'wholesalepro' ); ?></caption>
							<tbody>
								<?php
								$analysis = array_filter( array(
									array( __( 'After Repair Value (ARV)', 'wholesalepro' ),  $arv     ? wholesalepro_format_currency( $arv )     : '' ),
									array( __( 'Estimated Repair Cost', 'wholesalepro' ),      $repairs ? wholesalepro_format_currency( $repairs ) : '' ),
									array( __( 'Asking Price', 'wholesalepro' ),               $asking  ? wholesalepro_format_currency( $asking )  : '' ),
									array( __( 'Estimated Investor Profit', 'wholesalepro' ),  $profit > 0 ? wholesalepro_format_currency( $profit ) : '' ),
								), function( $r ) { return ! empty( $r[1] ); } );
								foreach ( $analysis as $row ) :
								?>
								<tr style="border-bottom:1px solid var(--wp-border);">
									<td style="padding:var(--space-sm) var(--space-md);color:var(--wp-gray);"><?php echo esc_html( $row[0] ); ?></td>
									<td style="padding:var(--space-sm) var(--space-md);font-weight:700;color:var(--wp-navy);text-align:right;"><?php echo esc_html( $row[1] ); ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php if ( $docusign_url ) : ?>
					<p style="margin-top:var(--space-sm);">
						<a href="<?php echo esc_url( $docusign_url ); ?>" target="_blank" rel="noopener nofollow" class="btn btn--ghost btn--sm">
							<?php esc_html_e( 'Sign LOI / Make Offer Online', 'wholesalepro' ); ?> ↗
						</a>
					</p>
					<?php endif; ?>
				</section>
				<?php endif; ?>

				<!-- Share -->
				<div class="animate-on-scroll" style="margin-top:var(--space-2xl);">
					<?php echo wholesalepro_share_buttons( get_the_ID() ); // phpcs:ignore ?>
				</div>

			</div>

			<!-- Right: Sidebar -->
			<aside class="deal-sidebar" aria-label="<?php esc_attr_e( 'Deal actions', 'wholesalepro' ); ?>">

				<!-- Urgency Strip -->
				<div class="urgency-strip urgency-strip--<?php echo esc_attr( $urgency_mod ); ?>" role="status" aria-live="polite">
					<?php
					if ( 'hot' === $urgency_mod ) {
						/* translators: %d: days listed */
						printf( esc_html__( '🔥 Listed %d days ago — moving fast!', 'wholesalepro' ), absint( $days_listed ) );
					} elseif ( 'warm' === $urgency_mod ) {
						/* translators: %d: days listed */
						printf( esc_html__( '⏳ %d days on market — act soon', 'wholesalepro' ), absint( $days_listed ) );
					} else {
						/* translators: %d: days listed */
						printf( esc_html__( '📅 %d days on market', 'wholesalepro' ), absint( $days_listed ) );
					}
					?>
				</div>

				<!-- CTA Card -->
				<div class="deal-sidebar__card">
					<?php if ( $asking ) : ?>
					<div class="deal-sidebar__price">
						<span class="deal-sidebar__price-label"><?php esc_html_e( 'Asking Price', 'wholesalepro' ); ?></span>
						<span class="deal-sidebar__price-value"><?php echo wholesalepro_format_currency( $asking ); // phpcs:ignore ?></span>
					</div>
					<?php endif; ?>

					<?php if ( 'available' === $status_slug || 'Available' === $status_label ) : ?>
					<div class="deal-sidebar__actions" style="margin-top:var(--space-lg);">
						<a href="#make-offer" class="btn btn--buyer btn--lg btn--full" style="margin-bottom:var(--space-sm);">
							<?php esc_html_e( 'Make an Offer', 'wholesalepro' ); ?>
						</a>
						<a href="tel:<?php echo esc_attr( get_theme_mod( 'company_phone_raw', '5550000000' ) ); ?>" class="btn btn--outline btn--lg btn--full">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.82 12a19.79 19.79 0 01-3.07-8.67A2 2 0 013.73 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.91 8.91a16 16 0 006.18 6.18l1.09-1.09a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
							<?php echo esc_html( get_theme_mod( 'company_phone', '(555) 000-0000' ) ); ?>
						</a>
					</div>
					<?php elseif ( 'under-contract' === $status_slug || 'under_contract' === $status_slug ) : ?>
					<div class="deal-sidebar__status-notice" style="background:rgba(255,193,7,0.15);border:1px solid var(--wp-gold);border-radius:var(--radius-md);padding:var(--space-md);text-align:center;margin-top:var(--space-md);">
						<strong><?php esc_html_e( 'Under Contract', 'wholesalepro' ); ?></strong>
						<p style="font-size:0.875rem;color:var(--wp-gray);margin:4px 0 0;">
							<?php esc_html_e( 'This deal is under contract. Contact us about backup offers or join our list for the next deal.', 'wholesalepro' ); ?>
						</p>
					</div>
					<?php else : ?>
					<div class="deal-sidebar__status-notice" style="background:rgba(230,57,70,0.1);border:1px solid var(--wp-red);border-radius:var(--radius-md);padding:var(--space-md);text-align:center;margin-top:var(--space-md);">
						<strong><?php echo esc_html( $status_label ); ?></strong>
						<p style="font-size:0.875rem;color:var(--wp-gray);margin:4px 0 0;">
							<?php esc_html_e( 'Join our buyer network to be first on future deals.', 'wholesalepro' ); ?>
						</p>
					</div>
					<?php endif; ?>

					<div class="deal-sidebar__trust" style="margin-top:var(--space-lg);padding-top:var(--space-lg);border-top:1px solid var(--wp-border);">
						<ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:var(--space-xs);">
							<li style="font-size:0.875rem;color:var(--wp-gray);">✅ <?php esc_html_e( 'No obligation to purchase', 'wholesalepro' ); ?></li>
							<li style="font-size:0.875rem;color:var(--wp-gray);">✅ <?php esc_html_e( 'Transparent financials', 'wholesalepro' ); ?></li>
							<li style="font-size:0.875rem;color:var(--wp-gray);">✅ <?php esc_html_e( 'Clear title guaranteed', 'wholesalepro' ); ?></li>
						</ul>
					</div>
				</div>

			</aside>

		</div>

		<!-- ━━ MAKE OFFER FORM ━━ -->
		<?php if ( 'sold' !== $status_slug ) : ?>
		<section id="make-offer" class="animate-on-scroll" style="margin-top:var(--space-3xl);scroll-margin-top:100px;" aria-labelledby="offer-form-heading">
			<div class="container narrow" style="padding:0;">
				<h2 id="offer-form-heading" style="text-align:center;margin-bottom:var(--space-sm);">
					<?php esc_html_e( 'Submit Your Offer', 'wholesalepro' ); ?>
				</h2>
				<p style="text-align:center;color:var(--wp-gray);margin-bottom:var(--space-xl);">
					<?php esc_html_e( 'Complete the form below and our team will review and respond within 24 hours.', 'wholesalepro' ); ?>
				</p>
				<div class="card" style="padding:var(--space-2xl);">
					<?php echo wholesalepro_render_offer_form( $property_id ); // phpcs:ignore ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<!-- ━━ RELATED PROPERTIES ━━ -->
		<?php
		$related = wholesalepro_related_properties( $property_id, 3 );
		if ( $related->have_posts() ) :
		?>
		<section class="animate-on-scroll" style="margin-top:var(--space-3xl);" aria-labelledby="related-deals-heading">
			<h2 id="related-deals-heading" style="margin-bottom:var(--space-xl);">
				<?php esc_html_e( 'More Available Deals', 'wholesalepro' ); ?>
			</h2>
			<div class="grid grid-3" style="gap:var(--space-lg);">
				<?php
				while ( $related->have_posts() ) :
					$related->the_post();
					echo wholesalepro_get_property_card( get_the_ID() ); // phpcs:ignore
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</section>
		<?php endif; ?>

	</div>

</article>

<?php
endwhile;
get_footer();
?>
