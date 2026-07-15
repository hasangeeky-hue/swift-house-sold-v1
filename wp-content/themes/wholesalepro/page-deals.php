<?php
/**
 * Browse Deals Page Template
 * Template Name: Browse Deals
 *
 * @package WholesalePro
 */

get_header();
?>

<section class="page-hero page-hero--buyer" aria-labelledby="deals-hero-heading">
	<div class="container">
		<?php wholesalepro_breadcrumb(); ?>
		<h1 class="page-hero__title animate-on-scroll" id="deals-hero-heading">
			Exclusive Off-Market Wholesale Deals, All 50 States
		</h1>
		<p class="page-hero__subtitle animate-on-scroll" style="transition-delay:0.1s">
			Pre-analyzed below-market properties added to our network daily. Verified ARV. Repair estimates included. Seller committed to close.
		</p>
	</div>
</section>

<!-- ━━ FILTER BAR ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<div class="filter-bar" id="filter-bar" role="search" aria-label="Filter properties">
	<div class="container">
		<form class="filter-bar__form js-property-filter" method="get" aria-label="Property filter form">
			<div class="filter-bar__fields">
				<div class="filter-bar__field">
					<label for="filter-state" class="sr-only">State</label>
					<select id="filter-state" name="state" class="form-control">
						<option value="">All States</option>
						<?php
						$states = wholesalepro_all_states_array();
						foreach ( $states as $abbr => $name ) {
							echo '<option value="' . esc_attr( strtolower( $abbr ) ) . '">' . esc_html( $name ) . '</option>';
						}
						?>
					</select>
				</div>
				<div class="filter-bar__field">
					<label for="filter-type" class="sr-only">Property Type</label>
					<select id="filter-type" name="property_type" class="form-control">
						<option value="">All Types</option>
						<?php
						$types = get_terms( array( 'taxonomy' => 'property_type', 'hide_empty' => false ) );
						if ( ! is_wp_error( $types ) ) {
							foreach ( $types as $type ) {
								echo '<option value="' . esc_attr( $type->slug ) . '">' . esc_html( $type->name ) . '</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="filter-bar__field">
					<label for="filter-price-max" class="sr-only">Max Price</label>
					<select id="filter-price-max" name="price_max" class="form-control">
						<option value="">Any Price</option>
						<option value="50000">Under $50,000</option>
						<option value="100000">Under $100,000</option>
						<option value="150000">Under $150,000</option>
						<option value="200000">Under $200,000</option>
						<option value="300000">Under $300,000</option>
						<option value="500000">Under $500,000</option>
					</select>
				</div>
				<div class="filter-bar__field">
					<label for="filter-beds" class="sr-only">Bedrooms</label>
					<select id="filter-beds" name="beds" class="form-control">
						<option value="">Any Beds</option>
						<option value="1">1+ Beds</option>
						<option value="2">2+ Beds</option>
						<option value="3">3+ Beds</option>
						<option value="4">4+ Beds</option>
					</select>
				</div>
				<div class="filter-bar__field">
					<label for="filter-status" class="sr-only">Status</label>
					<select id="filter-status" name="status" class="form-control">
						<option value="available">Available Now</option>
						<option value="">All Statuses</option>
						<option value="under_contract">Under Contract</option>
						<option value="sold">Sold</option>
					</select>
				</div>
			</div>
			<div class="filter-bar__actions">
				<button type="submit" class="btn btn--buyer btn--sm">Search</button>
				<button type="button" class="btn btn--ghost btn--sm filter-reset">Reset</button>
			</div>
		</form>
	</div>
</div>

<!-- ━━ RESULTS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="deals-results-heading" aria-live="polite">
	<div class="container">
		<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-lg);flex-wrap:wrap;gap:var(--space-sm);">
			<p class="filter-count" aria-live="polite" style="font-weight:600;">
				<?php
				$all_deals = new WP_Query( array( 'post_type' => 'property', 'post_status' => 'publish', 'posts_per_page' => -1, 'fields' => 'ids', 'meta_query' => array( array( 'key' => '_deal_status', 'value' => 'available' ) ) ) );
				$deal_count = $all_deals->found_posts;
				wp_reset_postdata();
				printf( esc_html( _n( '%d property available', '%d properties available', $deal_count, 'wholesalepro' ) ), esc_html( number_format_i18n( $deal_count ) ) );
				?>
			</p>
			<p style="color:var(--wp-gray);font-size:0.875rem;">Updated daily &bull; Serious buyers respond within 24 hours on top deals</p>
		</div>
		<h2 class="sr-only" id="deals-results-heading">Property Listings</h2>
		<div class="js-property-grid grid grid-3" style="gap:var(--space-lg);">
			<?php
			$deals_query = new WP_Query( array( 'post_type' => 'property', 'post_status' => 'publish', 'posts_per_page' => 12, 'meta_query' => array( array( 'key' => '_deal_status', 'value' => 'available' ) ), 'orderby' => 'date', 'order' => 'DESC' ) );
			if ( $deals_query->have_posts() ) :
				while ( $deals_query->have_posts() ) : $deals_query->the_post();
					echo wholesalepro_get_property_card( get_the_ID() ); // phpcs:ignore
				endwhile;
				wp_reset_postdata();
			else : ?>
				<div class="empty-state" style="grid-column:1/-1">
					<div class="empty-state__icon">🏠</div>
					<h3 class="empty-state__title">No Deals Available Right Now</h3>
					<p class="empty-state__text">We are actively acquiring new properties. Join our buyer list to get notified first, before they go public.</p>
					<a href="#buyer-list" class="btn btn--buyer">Join the Buyer List</a>
				</div>
			<?php endif; ?>
		</div>
		<div class="empty-state" style="display:none;"></div>
	</div>
</section>

<!-- ━━ BUYER BENEFITS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="buyer-benefits-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow">INVESTOR ADVANTAGE</p>
			<h2 class="section-header__title" id="buyer-benefits-heading">What Network Membership Gives You</h2>
		</div>
		<div class="grid grid-4" style="gap:var(--space-md);margin-top:var(--space-xl);">
			<?php
			$benefits = array(
				array( '🎯', 'Exclusive deal alerts matched to your exact buying criteria before public listing' ),
				array( '📊', 'Verified ARV from actual comparable sales in the last 90 days' ),
				array( '🔧', 'Repair cost estimates from our contractor network included with every deal package' ),
				array( '🤝', 'Seller commitment confirmed before we present any deal to you' ),
				array( '🗺️', 'JV partnership structures available on any deal in our inventory' ),
				array( '📞', 'Direct access to our acquisitions team for questions on any deal' ),
				array( '📈', 'Market analysis reports for your active investment markets' ),
				array( '✅', 'Zero cost, completely free to join and remain a member' ),
			);
			foreach ( $benefits as $i => $b ) : ?>
			<div class="card animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.06 ); ?>s;display:flex;gap:var(--space-sm);align-items:flex-start;">
				<span style="font-size:1.5rem;flex-shrink:0;" aria-hidden="true"><?php echo $b[0]; // phpcs:ignore ?></span>
				<p style="margin:0;font-size:0.9rem;color:var(--wp-gray);"><?php echo esc_html( $b[1] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ BUYER LIST SIGNUP ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--navy" id="buyer-list" aria-labelledby="buyer-list-heading">
	<div class="container">
		<div class="split-layout">
			<div class="split-layout__content animate-on-scroll">
				<p class="hero__eyebrow" style="color:var(--wp-gold);">INVESTOR ACCESS</p>
				<h2 style="color:#fff;" id="buyer-list-heading">Join Our Buyer Network, Free</h2>
				<p style="color:rgba(255,255,255,0.85);margin-bottom:var(--space-xl);">
					Tell us exactly what you are looking for and receive deal alerts before the wider market sees them. Our network includes over 5,000 active investors. Deals at your criteria come directly to your inbox the moment they are available.
				</p>
				<ul class="checklist" style="margin-bottom:var(--space-xl);">
					<li class="checklist__item checklist__item--check" style="color:rgba(255,255,255,0.9);">First access to new wholesale deals, before they go public</li>
					<li class="checklist__item checklist__item--check" style="color:rgba(255,255,255,0.9);">Off-market and pre-market properties across all 50 states</li>
					<li class="checklist__item checklist__item--check" style="color:rgba(255,255,255,0.9);">Match alerts based on your specific buy box criteria</li>
					<li class="checklist__item checklist__item--check" style="color:rgba(255,255,255,0.9);">JV opportunities available on select deals in our inventory</li>
					<li class="checklist__item checklist__item--check" style="color:rgba(255,255,255,0.9);">Zero cost, completely free, no catch, no spam</li>
				</ul>
			</div>
			<div class="split-layout__form animate-on-scroll" style="transition-delay:0.2s">
				<div class="hero__form-card">
					<h3 class="hero__form-card__heading">Join the Buyer Network</h3>
					<p class="hero__form-card__sub">Free registration. Matched deals within 24 hours.</p>
					<?php echo wholesalepro_render_buyer_form( 'deals-page' ); // phpcs:ignore ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
