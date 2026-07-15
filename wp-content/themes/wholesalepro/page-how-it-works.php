<?php
/**
 * How It Works Page Template
 * Template Name: How It Works
 *
 * @package WholesalePro
 */

get_header();

$sell_url  = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );
$deals_url = ( $p = get_page_by_path( 'browse-deals' ) )       ? get_permalink( $p->ID ) : home_url( '/browse-deals' );
$phone     = get_theme_mod( 'company_phone', '' );
$phone_raw = get_theme_mod( 'company_phone_raw', '' );
?>

<section class="page-hero page-hero--compact" aria-labelledby="hiw-hero-heading">
	<div class="container">
		<?php wholesalepro_breadcrumb(); ?>
		<h1 class="page-hero__title animate-on-scroll" id="hiw-hero-heading">
			How WholesalePro Works, For Sellers and Investors
		</h1>
		<p class="page-hero__subtitle animate-on-scroll" style="transition-delay:0.1s">
			Two simple processes. Complete transparency throughout. No surprises at any stage.
		</p>
	</div>
</section>

<?php echo wholesalepro_get_trust_bar(); // phpcs:ignore ?>

<!-- ━━ SELLER PROCESS ━━ -->
<section class="section" aria-labelledby="seller-process-heading">
	<div class="container narrow">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow" style="color:var(--wp-red);">FOR HOMEOWNERS WHO NEED TO SELL</p>
			<h2 class="section-header__title" id="seller-process-heading">From Your First Message to Cash in Your Account</h2>
			<p class="section-header__subtitle">No surprises. No complications. No delays you have not been told about in advance. Here is the exact process every seller goes through.</p>
		</div>

		<div class="timeline animate-on-scroll" style="margin-top:var(--space-2xl);" role="list">
			<?php
			$seller_steps = array(
				array(
					'num'   => '01',
					'time'  => 'Today, Within 1 Hour',
					'title' => 'You Reach Out to Us',
					'body'  => 'Fill out the short form on our Sell My House page or call us directly. Our system operates around the clock. During business hours, a real member of our acquisitions team calls or texts you within one hour. Outside business hours, our system sends you an immediate confirmation and you receive a personal response first thing the following morning. Your information is completely confidential and goes only to our internal team, we never share, sell, or disclose your details to anyone under any circumstances.',
				),
				array(
					'num'   => '02',
					'time'  => 'Within 24 Hours',
					'title' => 'We Research Your Property Thoroughly',
					'body'  => 'Using comparable sales data from the last 90 days in your specific neighborhood, our team calculates the After Repair Value, what your property would realistically sell for if fully updated. We then factor in realistic renovation costs and determine a fair offer price that accounts honestly for the current condition of your property. For most properties, this entire process completes within 24 hours of your first contact.',
				),
				array(
					'num'   => '03',
					'time'  => 'Within 48 Hours',
					'title' => 'You Receive a Written Cash Offer',
					'body'  => 'We send you a written offer that shows every figure we used: the comparable sales we found in your neighborhood, our repair cost estimate, and the exact cash amount we are offering. We schedule a call at a time that works for you to walk through every number in plain language. We answer every question you have. You have as much time as you need to consider the offer. There is no expiry date, no pressure tactic, and no penalty for taking your time.',
				),
				array(
					'num'   => '04',
					'time'  => 'Your Decision, No Deadline',
					'title' => 'You Accept or Decline, Completely Your Choice',
					'body'  => 'If our offer works for your situation, you let us know and we proceed immediately. If the offer does not work for you, we part on good terms with no obligation and no hard feelings. We genuinely want you to make the best decision for your situation, even if that decision is not us. If you accept, you tell us your preferred closing date and we open the title process.',
				),
				array(
					'num'   => '05',
					'time'  => 'As Fast as 7 Days',
					'title' => 'You Sign, Receive Your Funds, and Move Forward',
					'body'  => 'You meet with our licensed title company, in person or remotely in states where remote closing is permitted. The title company manages all paperwork, pays off any existing mortgage directly from the proceeds, clears all liens, and wires your net funds to your bank account on the same business day as closing. You hand over the keys and the property is no longer your responsibility.',
				),
			);
			foreach ( $seller_steps as $i => $step ) : ?>
			<div class="timeline__item animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s" role="listitem">
				<div class="timeline__marker"><span class="timeline__num" aria-hidden="true"><?php echo esc_html( $step['num'] ); ?></span></div>
				<div class="timeline__content">
					<div class="timeline__header">
						<h3 class="timeline__title"><?php echo esc_html( $step['title'] ); ?></h3>
						<span class="timeline__time badge badge--red"><?php echo esc_html( $step['time'] ); ?></span>
					</div>
					<p class="timeline__desc"><?php echo esc_html( $step['body'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="text-center animate-on-scroll" style="margin-top:var(--space-2xl);">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Start the Process Now, Free</a>
		</div>
	</div>
</section>

<!-- ━━ BUYER PROCESS ━━ -->
<section class="section bg--light-gray" aria-labelledby="buyer-process-heading">
	<div class="container narrow">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow" style="color:var(--wp-green);">FOR INVESTORS LOOKING FOR DEALS</p>
			<h2 class="section-header__title" id="buyer-process-heading">How to Access Our Wholesale Deal Pipeline</h2>
			<p class="section-header__subtitle">From registration to closing your first deal. Three steps that take less than 15 minutes of your time before you start receiving matched opportunities.</p>
		</div>

		<div class="timeline animate-on-scroll" style="margin-top:var(--space-2xl);" role="list">
			<?php
			$buyer_steps = array(
				array(
					'num'   => '01',
					'time'  => 'Under 2 Minutes',
					'title' => 'Join Our Investor Network',
					'body'  => 'Register free in under two minutes. Tell us your exact buying criteria, which states you operate in, your price range, the property types you prefer, and how quickly you can typically close. We use this profile to match deals specifically to your requirements. You receive only deals that match your criteria. No irrelevant listings. No wasted time.',
				),
				array(
					'num'   => '02',
					'time'  => 'Within 24 Hours',
					'title' => 'Receive Matched Deal Alerts',
					'body'  => 'The moment a deal matching your profile becomes available in our pipeline, you receive an alert with the key numbers immediately. Every alert includes the asking price, ARV derived from verified comparable sales in the last 90 days, our contractor\'s estimated repair costs, potential investor profit, and property photos. You review the complete deal package online before speaking to anyone on our team.',
				),
				array(
					'num'   => '03',
					'time'  => 'Average 12 Days to Close',
					'title' => 'Submit Your Offer and Close Fast',
					'body'  => 'Submit your offer through our platform. We facilitate the entire process from there. Title work is already underway on every deal we present, so there are no weeks of waiting for a basic title search. Our average time from accepted offer to funded closing is 12 days. JV partnership structures, where we co-own and split the deal with you, are available on select inventory if that structure works better for your situation.',
				),
			);
			foreach ( $buyer_steps as $i => $step ) : ?>
			<div class="timeline__item animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s" role="listitem">
				<div class="timeline__marker"><span class="timeline__num" aria-hidden="true"><?php echo esc_html( $step['num'] ); ?></span></div>
				<div class="timeline__content">
					<div class="timeline__header">
						<h3 class="timeline__title"><?php echo esc_html( $step['title'] ); ?></h3>
						<span class="timeline__time badge badge--green"><?php echo esc_html( $step['time'] ); ?></span>
					</div>
					<p class="timeline__desc"><?php echo esc_html( $step['body'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="text-center animate-on-scroll" style="margin-top:var(--space-2xl);">
			<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">Join the Investor Network Free</a>
		</div>
	</div>
</section>

<!-- ━━ SELLER FAQ ━━ -->
<section class="section" id="seller-faq" aria-labelledby="seller-faq-heading">
	<div class="container narrow">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow" style="color:var(--wp-red);">SELLER QUESTIONS</p>
			<h2 class="section-header__title" id="seller-faq-heading">Questions Sellers Ask About Our Process</h2>
		</div>
		<div class="accordion animate-on-scroll" style="margin-top:var(--space-xl);" role="list">
			<?php
			$seller_faqs = array(
				array(
					'q' => 'What types of properties do you buy?',
					'a' => 'We buy single family homes, multi-family properties up to four units, condos, townhouses, and vacant land across Ohio, Texas and Georgia. We buy in any condition, cosmetic fixer-uppers, properties needing major renovation, fire or flood damage, and properties that have been vacant for years. We also buy occupied properties with tenants in place.',
				),
				array(
					'q' => 'What states do you operate in?',
					'a' => 'All 50 US states. We have a network of trusted local buyers, title companies, and real estate attorneys in every state, so geography is never a barrier. From the major metropolitan markets of Texas, Florida, and Georgia to the smaller communities of Wyoming, Montana, and Vermont.',
				),
				array(
					'q' => 'Do you buy properties with liens or back taxes?',
					'a' => 'Yes, in most cases. We work with our title company to identify all liens, delinquent taxes, and judgment encumbrances on the property at the outset. These obligations are typically cleared from the sale proceeds at closing. We will be transparent with you upfront about how any existing debt affects your net proceeds.',
				),
				array(
					'q' => 'How is selling to you different from a short sale?',
					'a' => 'A short sale requires your lender to agree to accept less than the full mortgage balance and typically takes four to six months to complete. It also appears on your credit report as a negative item, though less severely than a foreclosure. Selling to us for cash closes without lender approval and, if we can close before a foreclosure is recorded, leaves no negative item on your credit report at all.',
				),
			);
			foreach ( $seller_faqs as $faq ) : ?>
			<div class="accordion__item" role="listitem">
				<button class="accordion__trigger" aria-expanded="false">
					<?php echo esc_html( $faq['q'] ); ?>
					<svg class="accordion__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6,9 12,15 18,9"/></svg>
				</button>
				<div class="accordion__content"><div class="accordion__body"><p><?php echo esc_html( $faq['a'] ); ?></p></div></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ BUYER FAQ ━━ -->
<section class="section bg--light-gray" id="buyer-faq" aria-labelledby="buyer-faq-heading">
	<div class="container narrow">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow" style="color:var(--wp-green);">INVESTOR QUESTIONS</p>
			<h2 class="section-header__title" id="buyer-faq-heading">Questions Investors Ask About Our Deals</h2>
		</div>
		<div class="accordion animate-on-scroll" style="margin-top:var(--space-xl);" role="list">
			<?php
			$buyer_faqs = array(
				array(
					'q' => 'How do you verify the ARV on your deals?',
					'a' => 'Our underwriting team uses comparable sales from the MLS and public records from the last 90 days within a quarter-mile to half-mile radius of each property, adjusted for bed and bath count, square footage, and condition. Our lead underwriter is a licensed contractor who validates repair estimates independently. We share the full comp data with every deal package.',
				),
				array(
					'q' => 'What is included in every deal package?',
					'a' => 'Every deal package includes: the asking price and assignment fee, ARV with supporting comparable sales, repair cost estimate from our contractor network, photos and video tour where available, property details (beds, baths, square footage, lot size, year built), and seller motivation and timeline. Title work is already initiated before we send the deal.',
				),
				array(
					'q' => 'Can I do my own due diligence before committing?',
					'a' => 'Absolutely. We encourage it. You can walk the property, bring your own contractor, and verify the numbers independently. We provide a due diligence period on every deal. The only thing we ask is that you communicate your timeline clearly so we can manage the seller relationship appropriately.',
				),
				array(
					'q' => 'How do JV partnerships work?',
					'a' => 'On select deals where we hold the contract directly, we offer JV (joint venture) structures where you fund the purchase and renovation and we split the profit according to an agreed formula. Typical splits range from 50/50 to 60/40 depending on your capital contribution and involvement in the renovation. We handle sourcing, seller management, and title. You handle funding and rehab.',
				),
			);
			foreach ( $buyer_faqs as $faq ) : ?>
			<div class="accordion__item" role="listitem">
				<button class="accordion__trigger" aria-expanded="false">
					<?php echo esc_html( $faq['q'] ); ?>
					<svg class="accordion__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6,9 12,15 18,9"/></svg>
				</button>
				<div class="accordion__content"><div class="accordion__body"><p><?php echo esc_html( $faq['a'] ); ?></p></div></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ CTA ━━ -->
<section class="section" aria-labelledby="hiw-cta-heading">
	<div class="container narrow text-center animate-on-scroll">
		<h2 id="hiw-cta-heading" style="margin-bottom:var(--space-md);">Ready to Get Started?</h2>
		<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">Takes 2 minutes. No obligation. Just a fair offer, or matched deals.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Free Cash Offer</a>
			<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">Join Buyer Network</a>
			<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline btn--lg"><?php echo esc_html( $phone ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
