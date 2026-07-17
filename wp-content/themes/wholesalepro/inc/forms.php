<?php
/**
 * Form Rendering Functions
 *
 * @package WholesalePro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ── All 50 States ───────────────────────────────────────────── */
function wholesalepro_states_list() {
	return array(
		'OH' => 'Ohio',
		'TX' => 'Texas',
		'GA' => 'Georgia',
	);
}

/* ── Seller Form ─────────────────────────────────────────────── */
function wholesalepro_render_seller_form( $location = 'generic' ) {
	// Read UTM params
	$utm_source   = isset( $_GET['utm_source'] )   ? sanitize_text_field( wp_unslash( $_GET['utm_source'] ) )   : '';
	$utm_medium   = isset( $_GET['utm_medium'] )   ? sanitize_text_field( wp_unslash( $_GET['utm_medium'] ) )   : '';
	$utm_campaign = isset( $_GET['utm_campaign'] ) ? sanitize_text_field( wp_unslash( $_GET['utm_campaign'] ) ) : '';

	ob_start();
	?>
	<form class="seller-form js-seller-form" id="seller-form-<?php echo esc_attr( $location ); ?>" novalidate aria-label="<?php esc_attr_e( 'Get your free cash offer', 'wholesalepro' ); ?>">
		<?php wp_nonce_field( 'wholesalepro-nonce', 'nonce' ); ?>

		<!-- Honeypot -->
		<div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
			<label for="website-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Leave this field empty', 'wholesalepro' ); ?></label>
			<input type="text" id="website-<?php echo esc_attr( $location ); ?>" name="website" tabindex="-1" autocomplete="off">
		</div>

		<!-- Tracking -->
		<input type="hidden" name="form_location" value="<?php echo esc_attr( $location ); ?>">
		<input type="hidden" name="utm_source"    value="<?php echo esc_attr( $utm_source ); ?>">
		<input type="hidden" name="utm_medium"    value="<?php echo esc_attr( $utm_medium ); ?>">
		<input type="hidden" name="utm_campaign"  value="<?php echo esc_attr( $utm_campaign ); ?>">

		<!-- STEP 1: micro-commitment, address only -->
		<div class="form-stage1">
		<div class="form-group">
			<label class="form-label" for="property_address-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Property Address', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
			<input class="form-control" type="text" id="property_address-<?php echo esc_attr( $location ); ?>" name="property_address" required autocomplete="street-address" aria-required="true" placeholder="<?php esc_attr_e( '123 Main St', 'wholesalepro' ); ?>">
			<span class="form-error" id="err-property_address-<?php echo esc_attr( $location ); ?>" role="alert"></span>
		</div>
			<button type="button" class="btn btn--seller btn--lg btn--full js-form-continue">
				<?php echo __( 'Get My Cash Offer &rarr;', 'wholesalepro' ); ?>
			</button>
			<div class="form-trust">
				<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
				<span><?php esc_html_e( 'Secure. Never sold. Closings via licensed title companies.', 'wholesalepro' ); ?></span>
			</div>
			<p class="form-privacy" style="text-align:center;margin-top:8px;"><?php esc_html_e( 'Takes 60 seconds. No obligation.', 'wholesalepro' ); ?></p>
		</div>

		<!-- STEP 2: revealed after commitment -->
		<div class="form-stage2" hidden>
			<p class="form-stage2__head"><?php esc_html_e( 'Step 2 of 2: where do we send your written offer?', 'wholesalepro' ); ?></p>

		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="seller_name-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Your Name', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="text" id="seller_name-<?php echo esc_attr( $location ); ?>" name="seller_name" data-req="1" autocomplete="name" placeholder="<?php esc_attr_e( 'John Smith', 'wholesalepro' ); ?>">
				<span class="form-error" id="err-seller_name-<?php echo esc_attr( $location ); ?>" role="alert"></span>
			</div>
			<div class="form-group">
				<label class="form-label" for="seller_phone-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Phone Number', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="tel" id="seller_phone-<?php echo esc_attr( $location ); ?>" name="seller_phone" data-req="1" autocomplete="tel" placeholder="(555) 000-0000">
				<span class="form-error" id="err-seller_phone-<?php echo esc_attr( $location ); ?>" role="alert"></span>
			</div>
		</div>

		<div class="form-group">
			<label class="form-label" for="seller_email-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Email Address', 'wholesalepro' ); ?></label>
			<input class="form-control" type="email" id="seller_email-<?php echo esc_attr( $location ); ?>" name="seller_email" autocomplete="email" placeholder="john@example.com">
			<span class="form-error" id="err-seller_email-<?php echo esc_attr( $location ); ?>" role="alert"></span>
		</div>


		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="property_city-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'City', 'wholesalepro' ); ?></label>
				<input class="form-control" type="text" id="property_city-<?php echo esc_attr( $location ); ?>" name="property_city" autocomplete="address-level2" placeholder="<?php esc_attr_e( 'Dallas', 'wholesalepro' ); ?>">
			</div>
			<div class="form-group">
				<label class="form-label" for="property_state-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'State', 'wholesalepro' ); ?></label>
				<select class="form-control form-select" id="property_state-<?php echo esc_attr( $location ); ?>" name="property_state" autocomplete="address-level1">
					<option value=""><?php esc_html_e( 'Select State', 'wholesalepro' ); ?></option>
					<?php foreach ( wholesalepro_states_list() as $abbr => $name ) : ?>
						<option value="<?php echo esc_attr( $abbr ); ?>"><?php echo esc_html( $name ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label class="form-label" for="property_zip-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'ZIP Code', 'wholesalepro' ); ?></label>
				<input class="form-control" type="text" id="property_zip-<?php echo esc_attr( $location ); ?>" name="property_zip" autocomplete="postal-code" placeholder="75001" maxlength="10">
			</div>
		</div>

		<div class="form-group">
			<label class="form-label" for="situation-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Why are you selling? (helps us make a better offer)', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
			<textarea class="form-control form-textarea" id="situation-<?php echo esc_attr( $location ); ?>" name="situation" data-req="1" aria-required="true" rows="3" placeholder="<?php esc_attr_e( 'e.g. inherited property, behind on payments, divorce, need to relocate quickly...', 'wholesalepro' ); ?>"></textarea>
			<span class="form-error" id="err-situation-<?php echo esc_attr( $location ); ?>" role="alert"></span>
		</div>

		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="timeline-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'How soon do you need to sell?', 'wholesalepro' ); ?></label>
				<select class="form-control form-select" id="timeline-<?php echo esc_attr( $location ); ?>" name="timeline">
					<option value=""><?php esc_html_e( 'Select timeline', 'wholesalepro' ); ?></option>
					<option value="asap"><?php esc_html_e( 'ASAP (1-2 weeks)', 'wholesalepro' ); ?></option>
					<option value="1month"><?php esc_html_e( 'Within 1 month', 'wholesalepro' ); ?></option>
					<option value="3months"><?php esc_html_e( 'Within 3 months', 'wholesalepro' ); ?></option>
					<option value="flexible"><?php esc_html_e( 'Flexible', 'wholesalepro' ); ?></option>
				</select>
			</div>
			<div class="form-group">
				<label class="form-label" for="condition-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Property Condition', 'wholesalepro' ); ?></label>
				<select class="form-control form-select" id="condition-<?php echo esc_attr( $location ); ?>" name="condition">
					<option value=""><?php esc_html_e( 'Select condition', 'wholesalepro' ); ?></option>
					<option value="excellent"><?php esc_html_e( 'Move-in Ready', 'wholesalepro' ); ?></option>
					<option value="good"><?php esc_html_e( 'Minor Repairs Needed', 'wholesalepro' ); ?></option>
					<option value="fair"><?php esc_html_e( 'Major Repairs Needed', 'wholesalepro' ); ?></option>
					<option value="poor"><?php esc_html_e( 'Severe Damage / Teardown', 'wholesalepro' ); ?></option>
				</select>
			</div>
		</div>

		<div class="form-submit-wrap">
			<button type="submit" class="btn btn--seller btn--lg btn--full js-submit">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
				<?php esc_html_e( 'Get My Free Cash Offer', 'wholesalepro' ); ?>
			</button>
		</div>
		</div><!-- /.form-stage2 -->

		<p class="form-privacy">
			<?php printf(
				/* translators: %s: company name */
				esc_html__( '🔒 100%% Free, No Obligation. Your information is never shared. %s will contact you within %s.', 'wholesalepro' ),
				esc_html( get_theme_mod( 'company_name', 'Swift House Sold' ) ),
				esc_html( get_theme_mod( 'response_guarantee', '1 hour' ) )
			); ?>
		</p>

		<div class="form-success" style="display:none;" role="status" aria-live="polite">
			<div style="text-align:center;padding:var(--s8);">
				<div style="font-size:3rem;margin-bottom:var(--s4);">✅</div>
				<h3 style="color:var(--wp-green);"><?php esc_html_e( 'We received your request!', 'wholesalepro' ); ?></h3>
				<p><?php esc_html_e( 'A specialist will contact you shortly with your cash offer.', 'wholesalepro' ); ?></p>
			</div>
		</div>
	</form>
	<?php
	return ob_get_clean();
}

/* ── Buyer Form ──────────────────────────────────────────────── */
function wholesalepro_render_buyer_form( $location = 'generic' ) {
	$states = wholesalepro_states_list();
	$types  = array( 'Single Family', 'Multi-Family', 'Condo', 'Townhouse', 'Land', 'Commercial' );

	ob_start();
	?>
	<form class="buyer-form js-buyer-form" id="buyer-form-<?php echo esc_attr( $location ); ?>" novalidate aria-label="<?php esc_attr_e( 'Join our buyer network', 'wholesalepro' ); ?>">
		<?php wp_nonce_field( 'wholesalepro-nonce', 'nonce' ); ?>
		<input type="hidden" name="form_location" value="<?php echo esc_attr( $location ); ?>">
		<div style="position:absolute;left:-9999px;" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="buyer_name-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Full Name', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="text" id="buyer_name-<?php echo esc_attr( $location ); ?>" name="buyer_name" required autocomplete="name" aria-required="true">
				<span class="form-error" role="alert"></span>
			</div>
			<div class="form-group">
				<label class="form-label" for="buyer_email-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Email Address', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="email" id="buyer_email-<?php echo esc_attr( $location ); ?>" name="buyer_email" required autocomplete="email" aria-required="true">
				<span class="form-error" role="alert"></span>
			</div>
		</div>

		<div class="form-group">
			<label class="form-label" for="buyer_phone-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Phone Number', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
			<input class="form-control" type="tel" id="buyer_phone-<?php echo esc_attr( $location ); ?>" name="buyer_phone" required autocomplete="tel" aria-required="true">
			<span class="form-error" role="alert"></span>
		</div>

		<div class="form-group">
			<label class="form-label"><?php esc_html_e( 'Target States (select all that apply)', 'wholesalepro' ); ?></label>
			<div class="state-checkboxes" style="display:grid;grid-template-columns:repeat(5,1fr);gap:var(--s2);max-height:220px;overflow-y:auto;border:2px solid var(--wp-gray-3);border-radius:var(--r-md);padding:var(--s4);">
				<?php foreach ( $states as $abbr => $name ) : ?>
					<label class="form-check" style="margin:0;cursor:pointer;">
						<input class="form-check__input" type="checkbox" name="buyer_states[]" value="<?php echo esc_attr( $abbr ); ?>">
						<span style="font-size:var(--text-sm);"><?php echo esc_html( $abbr ); ?></span>
					</label>
				<?php endforeach; ?>
			</div>
			<button type="button" class="btn btn--ghost" style="color:var(--wp-navy);font-size:var(--text-sm);margin-top:var(--s2);text-decoration:underline;" onclick="this.closest('form').querySelectorAll('[name=\'buyer_states[]\']').forEach(c=>c.checked=true)"><?php esc_html_e( 'Select All States', 'wholesalepro' ); ?></button>
		</div>

		<div class="form-group">
			<label class="form-label"><?php esc_html_e( 'Property Types (select all that apply)', 'wholesalepro' ); ?></label>
			<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--s3);">
				<?php foreach ( $types as $type ) : ?>
					<label class="form-check" style="cursor:pointer;">
						<input class="form-check__input" type="checkbox" name="property_types[]" value="<?php echo esc_attr( $type ); ?>">
						<span style="font-size:var(--text-sm);"><?php echo esc_html( $type ); ?></span>
					</label>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="price_min-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Min Acquisition Price', 'wholesalepro' ); ?></label>
				<input class="form-control" type="number" id="price_min-<?php echo esc_attr( $location ); ?>" name="price_min" min="0" step="5000" placeholder="50000">
			</div>
			<div class="form-group">
				<label class="form-label" for="price_max-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Max Acquisition Price', 'wholesalepro' ); ?></label>
				<input class="form-control" type="number" id="price_max-<?php echo esc_attr( $location ); ?>" name="price_max" min="0" step="5000" placeholder="500000">
			</div>
		</div>

		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="close_timeline-<?php echo esc_attr( $location ); ?>"><?php esc_html_e( 'Typical Close Timeline', 'wholesalepro' ); ?></label>
				<select class="form-control form-select" id="close_timeline-<?php echo esc_attr( $location ); ?>" name="close_timeline">
					<option value=""><?php esc_html_e( 'Select', 'wholesalepro' ); ?></option>
					<option value="7days"><?php esc_html_e( '7 days or less', 'wholesalepro' ); ?></option>
					<option value="14days"><?php esc_html_e( '14 days', 'wholesalepro' ); ?></option>
					<option value="30days"><?php esc_html_e( '30 days', 'wholesalepro' ); ?></option>
					<option value="flexible"><?php esc_html_e( 'Flexible', 'wholesalepro' ); ?></option>
				</select>
			</div>
			<div class="form-group">
				<label class="form-label"><?php esc_html_e( 'Financing Type', 'wholesalepro' ); ?></label>
				<div style="display:flex;flex-direction:column;gap:var(--s3);margin-top:var(--s2);">
					<label class="form-check" style="cursor:pointer;">
						<input class="form-check__input" type="radio" name="financing_type" value="cash">
						<span><?php esc_html_e( 'Cash Buyer', 'wholesalepro' ); ?></span>
					</label>
					<label class="form-check" style="cursor:pointer;">
						<input class="form-check__input" type="radio" name="financing_type" value="hard_money">
						<span><?php esc_html_e( 'Hard Money', 'wholesalepro' ); ?></span>
					</label>
					<label class="form-check" style="cursor:pointer;">
						<input class="form-check__input" type="radio" name="financing_type" value="conventional">
						<span><?php esc_html_e( 'Conventional / Other', 'wholesalepro' ); ?></span>
					</label>
				</div>
			</div>
		</div>

		<div class="form-submit-wrap">
			<button type="submit" class="btn btn--buyer btn--lg btn--full js-submit">
				<?php echo __( 'Join the List &rarr;', 'wholesalepro' ) /* short CTA */; ?>
			</button>
		</div>

		<p class="form-privacy"><?php esc_html_e( '🔒 We never sell your info. You can unsubscribe from deal alerts at any time.', 'wholesalepro' ); ?></p>

		<div class="form-success" style="display:none;" role="status" aria-live="polite">
			<div style="text-align:center;padding:var(--s8);">
				<div style="font-size:3rem;margin-bottom:var(--s4);">🎉</div>
				<h3 style="color:var(--wp-green);"><?php esc_html_e( "You're in the network!", 'wholesalepro' ); ?></h3>
				<p><?php esc_html_e( 'Expect deal alerts matching your criteria straight to your inbox.', 'wholesalepro' ); ?></p>
			</div>
		</div>
	</form>
	<?php
	return ob_get_clean();
}

/* ── Offer Form ──────────────────────────────────────────────── */
function wholesalepro_render_offer_form( $property_id = 0 ) {
	$address = $property_id ? get_post_meta( $property_id, '_property_address_full', true ) : '';
	$asking  = $property_id ? (int) get_post_meta( $property_id, '_property_price_asking', true ) : 0;

	ob_start();
	?>
	<form class="offer-form js-offer-form" id="make-offer" novalidate enctype="multipart/form-data" aria-label="<?php esc_attr_e( 'Submit your offer', 'wholesalepro' ); ?>">
		<?php wp_nonce_field( 'wholesalepro-nonce', 'nonce' ); ?>
		<input type="hidden" name="property_id" value="<?php echo absint( $property_id ); ?>">
		<div style="position:absolute;left:-9999px;" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="offeror_name"><?php esc_html_e( 'Your Name', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="text" id="offeror_name" name="offeror_name" required autocomplete="name" aria-required="true">
				<span class="form-error" role="alert"></span>
			</div>
			<div class="form-group">
				<label class="form-label" for="offeror_phone"><?php esc_html_e( 'Phone Number', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="tel" id="offeror_phone" name="offeror_phone" required autocomplete="tel" aria-required="true">
				<span class="form-error" role="alert"></span>
			</div>
		</div>

		<div class="form-group">
			<label class="form-label" for="offeror_email"><?php esc_html_e( 'Email Address', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
			<input class="form-control" type="email" id="offeror_email" name="offeror_email" required autocomplete="email" aria-required="true">
			<span class="form-error" role="alert"></span>
		</div>

		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="offer_amount"><?php esc_html_e( 'Your Offer Amount ($)', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="number" id="offer_amount" name="offer_amount" required min="1" step="1000" value="<?php echo $asking ? absint( $asking ) : ''; ?>" aria-required="true">
				<?php if ( $asking ) : ?>
					<small style="color:var(--wp-gray-6);font-size:var(--text-xs);"><?php printf( esc_html__( 'Asking price: %s', 'wholesalepro' ), esc_html( wholesalepro_format_currency( $asking ) ) ); ?></small>
				<?php endif; ?>
				<span class="form-error" role="alert"></span>
			</div>
			<div class="form-group">
				<label class="form-label" for="close_date"><?php esc_html_e( 'Proposed Close Date', 'wholesalepro' ); ?></label>
				<input class="form-control" type="date" id="close_date" name="close_date" min="<?php echo esc_attr( gmdate( 'Y-m-d', strtotime( '+7 days' ) ) ); ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="form-label" for="proof_of_funds"><?php esc_html_e( 'Proof of Funds (PDF, JPG, or PNG, max 5MB)', 'wholesalepro' ); ?></label>
			<input class="form-control" type="file" id="proof_of_funds" name="proof_of_funds" accept=".pdf,.jpg,.jpeg,.png">
		</div>

		<div class="form-group">
			<label class="form-label" for="offer_notes"><?php esc_html_e( 'Additional Notes', 'wholesalepro' ); ?></label>
			<textarea class="form-control form-textarea" id="offer_notes" name="offer_notes" rows="3" placeholder="<?php esc_attr_e( 'Any contingencies, closing preferences, or questions...', 'wholesalepro' ); ?>"></textarea>
		</div>

		<div class="form-group">
			<label class="form-check" style="cursor:pointer;">
				<input class="form-check__input" type="checkbox" name="terms_agreed" id="terms_agreed" required aria-required="true">
				<span style="font-size:var(--text-sm);"><?php esc_html_e( 'I understand this is a non-binding letter of intent and subject to inspection and final due diligence.', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></span>
			</label>
			<span class="form-error" role="alert"></span>
		</div>

		<div class="form-submit-wrap">
			<button type="submit" class="btn btn--buyer btn--lg btn--full js-submit">
				<?php esc_html_e( 'Submit My Offer', 'wholesalepro' ); ?>
			</button>
		</div>

		<div class="form-success" style="display:none;" role="status" aria-live="polite">
			<div style="text-align:center;padding:var(--s8);">
				<div style="font-size:3rem;margin-bottom:var(--s4);">📨</div>
				<h3 style="color:var(--wp-green);"><?php esc_html_e( 'Offer received!', 'wholesalepro' ); ?></h3>
				<p><?php esc_html_e( 'We will review your offer and respond within 24 hours.', 'wholesalepro' ); ?></p>
			</div>
		</div>
	</form>
	<?php
	return ob_get_clean();
}

/* ── Contact Form ────────────────────────────────────────────── */
function wholesalepro_render_contact_form() {
	ob_start();
	?>
	<form class="contact-form js-contact-form" novalidate aria-label="<?php esc_attr_e( 'Contact us', 'wholesalepro' ); ?>">
		<?php wp_nonce_field( 'wholesalepro-nonce', 'nonce' ); ?>
		<div style="position:absolute;left:-9999px;" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

		<div class="form-group">
			<label class="form-label" for="contact_type"><?php esc_html_e( 'I am a:', 'wholesalepro' ); ?></label>
			<select class="form-control form-select" id="contact_type" name="contact_type">
				<option value=""><?php esc_html_e( 'Select one', 'wholesalepro' ); ?></option>
				<option value="seller"><?php esc_html_e( 'Homeowner / Seller', 'wholesalepro' ); ?></option>
				<option value="investor"><?php esc_html_e( 'Cash Investor / Buyer', 'wholesalepro' ); ?></option>
				<option value="partner"><?php esc_html_e( 'Potential Partner', 'wholesalepro' ); ?></option>
				<option value="media"><?php esc_html_e( 'Media / Press', 'wholesalepro' ); ?></option>
				<option value="other"><?php esc_html_e( 'Other', 'wholesalepro' ); ?></option>
			</select>
		</div>

		<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
			<div class="form-group">
				<label class="form-label" for="contact_name"><?php esc_html_e( 'Full Name', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="text" id="contact_name" name="contact_name" required autocomplete="name" aria-required="true">
				<span class="form-error" role="alert"></span>
			</div>
			<div class="form-group">
				<label class="form-label" for="contact_email"><?php esc_html_e( 'Email Address', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
				<input class="form-control" type="email" id="contact_email" name="contact_email" required autocomplete="email" aria-required="true">
				<span class="form-error" role="alert"></span>
			</div>
		</div>

		<div class="form-group">
			<label class="form-label" for="contact_phone"><?php esc_html_e( 'Phone Number', 'wholesalepro' ); ?></label>
			<input class="form-control" type="tel" id="contact_phone" name="contact_phone" autocomplete="tel">
		</div>

		<div class="form-group">
			<label class="form-label" for="contact_subject"><?php esc_html_e( 'Subject', 'wholesalepro' ); ?></label>
			<input class="form-control" type="text" id="contact_subject" name="contact_subject" placeholder="<?php esc_attr_e( 'How can we help?', 'wholesalepro' ); ?>">
		</div>

		<div class="form-group">
			<label class="form-label" for="contact_message"><?php esc_html_e( 'Message', 'wholesalepro' ); ?> <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
			<textarea class="form-control form-textarea" id="contact_message" name="contact_message" required rows="5" aria-required="true" placeholder="<?php esc_attr_e( 'Tell us how we can help...', 'wholesalepro' ); ?>"></textarea>
			<span class="form-error" role="alert"></span>
		</div>

		<div class="form-submit-wrap">
			<button type="submit" class="btn btn--primary btn--lg btn--full js-submit">
				<?php esc_html_e( 'Send Message', 'wholesalepro' ); ?>
			</button>
		</div>

		<p class="form-privacy"><?php printf( esc_html__( 'We respond within %s during business hours.', 'wholesalepro' ), esc_html( get_theme_mod( 'response_guarantee', '1 hour' ) ) ); ?></p>

		<div class="form-success" style="display:none;" role="status" aria-live="polite">
			<div style="text-align:center;padding:var(--s8);">
				<div style="font-size:3rem;margin-bottom:var(--s4);">✉️</div>
				<h3 style="color:var(--wp-navy);"><?php esc_html_e( 'Message sent!', 'wholesalepro' ); ?></h3>
				<p><?php esc_html_e( 'We will be in touch shortly.', 'wholesalepro' ); ?></p>
			</div>
		</div>
	</form>
	<?php
	return ob_get_clean();
}
