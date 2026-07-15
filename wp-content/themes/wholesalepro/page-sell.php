<?php
/**
 * Sell My House Fast Page Template
 * Template Name: Sell My House
 *
 * @package WholesalePro
 */

get_header();

$phone     = get_theme_mod( 'company_phone', '' );
$phone_raw = get_theme_mod( 'company_phone_raw', '' );
$sell_page = get_page_by_path( 'sell-my-house-fast' );
$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
?>

<!-- ━━ HERO ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="page-hero page-hero--seller" aria-labelledby="sell-hero-heading">
	<div class="container">
		<div class="hero__inner">
			<div class="hero__content">
				<?php wholesalepro_breadcrumb(); ?>
				<p class="hero__eyebrow animate-on-scroll">SELL MY HOUSE FAST FOR CASH</p>
				<h1 class="hero__title animate-on-scroll" id="sell-hero-heading" style="transition-delay:0.1s">
					Sell Your House For Cash, Exactly As It Is
				</h1>
				<p class="hero__subtitle animate-on-scroll" style="transition-delay:0.2s">
					No cleaning. No repairs. No agent commissions. No waiting three months for a buyer who might not qualify for their mortgage. Get a fair written cash offer within 24 hours and close on a date that works for your life, not ours.
				</p>
				<div class="animate-on-scroll" style="transition-delay:0.25s;background:rgba(230,57,70,0.1);border:1px solid rgba(230,57,70,0.3);border-radius:var(--radius-md);padding:var(--space-md);margin-bottom:var(--space-lg);">
					<p style="color:var(--wp-navy);font-size:0.9rem;margin:0;"><strong>Important if you are in pre-foreclosure:</strong> Every day you wait reduces your available options. Our team responds within one hour, including evenings and weekends.</p>
				</div>
				<ul class="checklist animate-on-scroll" style="transition-delay:0.3s">
					<li class="checklist__item checklist__item--check">No repairs or cleaning required, sell exactly as it sits</li>
					<li class="checklist__item checklist__item--check">Zero commissions, zero closing costs, nothing deducted</li>
					<li class="checklist__item checklist__item--check">No open houses, no showings, no strangers in your home</li>
					<li class="checklist__item checklist__item--check">Fair written cash offer within 24 hours of your inquiry</li>
					<li class="checklist__item checklist__item--check">Close on your timeline, as fast as 7 days or up to 60 days</li>
				</ul>
				<div class="hero__actions animate-on-scroll" style="transition-delay:0.4s">
					<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline btn--lg" style="color:var(--wp-navy);border-color:var(--wp-navy);">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.82 12a19.79 19.79 0 01-3.07-8.67A2 2 0 013.73 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.91 8.91a16 16 0 006.18 6.18l1.09-1.09a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
						<?php echo esc_html( $phone ); ?>
					</a>
				</div>
			</div>
			<div class="hero__form-wrap animate-on-scroll" id="sell-form" style="transition-delay:0.2s">
				<div class="hero__form-card">
					<h2 class="hero__form-card__heading">Start Your Free Cash Offer</h2>
					<p class="hero__form-card__sub">2 minutes. No obligation. No spam.</p>
					<?php echo wholesalepro_render_seller_form( 'sell-page' ); // phpcs:ignore ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php echo wholesalepro_get_trust_bar(); // phpcs:ignore ?>

<!-- ━━ WHAT WE BUY ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" id="situations" aria-labelledby="what-we-buy-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow">WE UNDERSTAND LIFE HAPPENS</p>
			<h2 class="section-header__title" id="what-we-buy-heading">We Buy Every Type of Property in Every Type of Situation</h2>
			<p class="section-header__subtitle">There is no situation too complicated and no property too distressed. Here is what we regularly purchase.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);margin-top:var(--space-xl);">
			<?php
			$cards = array(
				array(
					'icon'  => '💸',
					'title' => 'Behind On Mortgage Payments',
					'body'  => 'Missing mortgage payments does not mean losing your home is inevitable. A fast cash sale before the foreclosure sale date stops the process, protects your credit score from a seven-year black mark, and can put cash in your pocket above your mortgage payoff. The earlier you act, the more options remain available.',
				),
				array(
					'icon'  => '🏚️',
					'title' => 'Inherited and Probate Properties',
					'body'  => 'Inheriting a property is not always the gift it seems. Whether the home needs significant repairs, has tenants who need to be managed, or simply sits empty accumulating taxes and maintenance costs, we help families convert inherited real estate into a clean, simple cash distribution with no complications and no delays.',
				),
				array(
					'icon'  => '💔',
					'title' => 'Divorce and Separation Situations',
					'body'  => 'When a marriage ends, the shared home often becomes the most contentious part of the proceedings. We buy properties directly from both parties in a single transaction, providing each person their agreed share simultaneously and removing one of the most significant sources of conflict from an already difficult process.',
				),
				array(
					'icon'  => '🔑',
					'title' => 'Tired Landlord Exit, Any Tenancy',
					'body'  => 'Whether your tenants are paying and cooperative or months behind and resistant, we purchase occupied rental properties regularly. We take on the tenant situation independently so you never have to make another difficult call to someone living in your property. You close and move on.',
				),
				array(
					'icon'  => '🔥',
					'title' => 'Fire, Flood, and Major Damage',
					'body'  => 'Properties with significant damage, whether from fire, flooding, storm, structural failure, or years of deferred maintenance, are exactly the opportunities our investor network pursues. You do not repair a single thing. We assess the property in its current state and make our offer on what stands today.',
				),
				array(
					'icon'  => '📋',
					'title' => 'Tax Delinquency and Lien Situations',
					'body'  => 'Properties with accumulated delinquent taxes, judgment liens, or other encumbrances can still be sold. We work with properties that have title complications and structure the sale to clear all obligations from the proceeds at closing. You receive whatever remains above the total debt, without managing creditors yourself.',
				),
			);
			foreach ( $cards as $i => $card ) : ?>
			<div class="card animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<div style="font-size:2.5rem;margin-bottom:var(--space-md);" aria-hidden="true"><?php echo $card['icon']; // phpcs:ignore ?></div>
				<h3 style="margin-bottom:var(--space-sm);"><?php echo esc_html( $card['title'] ); ?></h3>
				<p style="color:var(--wp-gray);margin:0;"><?php echo esc_html( $card['body'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ PROCESS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="process-heading">
	<div class="container narrow">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="process-heading">From Your First Message to Cash in Your Account, Five Simple Steps</h2>
			<p class="section-header__subtitle">No surprises. No complications. No delays you have not been told about in advance.</p>
		</div>

		<div class="timeline animate-on-scroll" style="margin-top:var(--space-2xl);" role="list">
			<?php
			$steps = array(
				array(
					'label' => 'Step One, Today',
					'title' => 'You Reach Out to Us',
					'body'  => 'Fill out the form on this page or call us directly. Our system operates around the clock. During business hours, a real person calls you back within one hour. Outside business hours, our system acknowledges your inquiry immediately and you hear from a live team member first thing the following morning. Your information goes nowhere except to our acquisitions team. We never contact you more than you want to be contacted.',
					'time'  => 'Within 1 Hour',
				),
				array(
					'label' => 'Step Two, Within 24 Hours',
					'title' => 'We Research Your Property Thoroughly',
					'body'  => 'Using comparable sales data from the last 90 days in your specific neighborhood, our team calculates what your property would realistically sell for if fully updated. We then factor in realistic renovation costs and determine a fair offer that accounts for the current condition of your property. This process typically completes within 24 hours of your inquiry.',
					'time'  => 'Within 24 Hours',
				),
				array(
					'label' => 'Step Three, Within 48 Hours',
					'title' => 'You Receive a Written Cash Offer',
					'body'  => 'We send you a written offer showing every figure, the comparable sales we used, our repair estimate, and the exact cash amount we are offering. We schedule a call to walk through the numbers with you at a time that works for you. We answer every question you have with complete transparency. You have as much time as you need to consider the offer. There is no expiry date and no pressure tactic.',
					'time'  => 'Within 48 Hours',
				),
				array(
					'label' => 'Step Four, Your Decision',
					'title' => 'You Accept or Decline, Completely Your Choice',
					'body'  => 'If our offer works for your situation, you let us know. If it does not, we part on good terms and you are free to explore other options without any obligation whatsoever. If you accept, you tell us your preferred closing date and we open the title process through our licensed title company in your state.',
					'time'  => 'Your Timeline',
				),
				array(
					'label' => 'Step Five, Closing Day',
					'title' => 'You Sign and Receive Your Funds',
					'body'  => 'You meet at the title company or sign remotely in states where that is permitted. The title company manages all paperwork, pays off any existing mortgage from the proceeds, and wires the remaining funds to your bank account on the same business day. You hand over the keys and the property is no longer your responsibility.',
					'time'  => 'Same Business Day',
				),
			);
			foreach ( $steps as $i => $step ) : ?>
			<div class="timeline__item animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s" role="listitem">
				<div class="timeline__marker"><span class="timeline__num" aria-hidden="true"><?php echo esc_html( $i + 1 ); ?></span></div>
				<div class="timeline__content">
					<div class="timeline__header">
						<h3 class="timeline__title"><?php echo esc_html( $step['title'] ); ?></h3>
						<span class="timeline__time badge badge--gold"><?php echo esc_html( $step['time'] ); ?></span>
					</div>
					<p style="font-size:0.8rem;color:var(--wp-gold);font-weight:600;margin-bottom:4px;"><?php echo wp_kses_post( $step['label'] ); ?></p>
					<p class="timeline__desc"><?php echo esc_html( $step['body'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ COMPARISON ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="compare-sell-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="compare-sell-heading">How the Numbers Actually Compare</h2>
			<p class="section-header__subtitle">Before you decide how to sell, see how your options compare. These numbers represent the real difference between selling methods for a homeowner in a motivated situation.</p>
		</div>
		<div class="animate-on-scroll" style="margin-top:var(--space-xl);overflow-x:auto;">
			<table class="comparison-table" style="width:100%;border-collapse:collapse;">
				<caption class="sr-only">Comparison: WholesalePro cash sale vs. traditional agent listing</caption>
				<thead>
					<tr>
						<th>What You Are Comparing</th>
						<th class="comparison-table__us">WholesalePro Cash Offer</th>
						<th>Traditional Agent Listing</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$compare_rows = array(
						array( 'Time to Close',             'As fast as 7 days',               '60 to 90+ days typical' ),
						array( 'Commissions',               'Zero',                             '5 to 6% of sale price' ),
						array( 'Closing Costs',             'We pay 100% of closing costs',    'Seller often pays 1 to 3%' ),
						array( 'Repairs Before Sale',       'None, buy completely as-is',      'Buyer inspection demands repairs' ),
						array( 'Showings Required',         'No showings. No strangers.',       'Multiple showings, open houses' ),
						array( 'Deal Falls Through Risk',   'Zero, guaranteed cash close',    'High, mortgage denials common' ),
						array( 'Appraisal Required',        'No appraisal',                     'Yes, and low appraisals kill deals' ),
						array( 'Your Preparation Time',     'Under 30 minutes total',           'Weeks of staging and prep work' ),
					);
					foreach ( $compare_rows as $row ) : ?>
					<tr>
						<td><?php echo esc_html( $row[0] ); ?></td>
						<td class="comparison-table__us comparison-table__yes">&#10003; <?php echo esc_html( $row[1] ); ?></td>
						<td class="comparison-table__no">&#10007; <?php echo esc_html( $row[2] ); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<!-- ━━ FAQ ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" id="faq" aria-labelledby="sell-faq-heading">
	<div class="container narrow">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="sell-faq-heading">Every Question Sellers Ask Us</h2>
			<p class="section-header__subtitle">Twelve honest answers to the questions homeowners ask before deciding to sell for cash.</p>
		</div>
		<div class="accordion animate-on-scroll" style="margin-top:var(--space-xl);" role="list">
			<?php
			$faqs = array(
				array(
					'q' => 'How exactly do you calculate what you will offer for my house?',
					'a' => 'We use three data points. First, we find the After Repair Value, what your property would realistically sell for on the open market if it were fully updated to current standards. We find this by analyzing actual recent sales of similar homes in your immediate neighborhood. Second, we estimate realistic repair costs based on the condition you describe. Third, we calculate a fair return for the investor taking on the renovation risk. We share all of these numbers with you transparently when we present your offer.',
				),
				array(
					'q' => 'Is this genuinely free with no obligation?',
					'a' => 'Yes, completely. There is no fee to request an offer, no contract to sign until you choose to accept, and no penalty for declining. We make money only when a transaction closes to the satisfaction of both parties. There is no business reason for us to pressure anyone.',
				),
				array(
					'q' => 'What types of properties do you buy?',
					'a' => 'We buy single family homes, duplexes, small multi-family properties, townhouses, and condominiums in any condition across Ohio, Texas and Georgia. We purchase properties that need cosmetic updates, major renovation, or complete rebuilds. We buy tenant-occupied properties, vacant properties, and properties with title complications including back taxes and judgment liens.',
				),
				array(
					'q' => 'Do I need to make repairs or clean before selling?',
					'a' => 'Never. You do not repair anything, clean anything, or spend a dollar on the property before contacting us. Leave the furniture if you want. Leave the debris. Leave the damage. The condition of your property is already reflected in our offer. You take what you want and leave everything else.',
				),
				array(
					'q' => 'How is this different from using a real estate agent?',
					'a' => 'When you list with an agent, you typically wait 60 to 90 or more days for a buyer to appear, pay 5 to 6 percent in agent commissions, deal with multiple showings of your home, face repair requests from buyers after the inspection, and risk the deal falling through because a buyer\'s financing was not approved. With us, the offer is guaranteed cash, the timeline is your choice, there are no commissions or fees of any kind, and the process involves zero strangers walking through your home.',
				),
				array(
					'q' => 'What if I have tenants in the property?',
					'a' => 'We purchase tenant-occupied properties regularly and handle the tenant situation ourselves. We review the existing lease agreements, comply with all applicable landlord-tenant laws in your state, and manage the transition so you never have to have another difficult conversation with someone living in your property.',
				),
				array(
					'q' => 'Can you help if I am already in foreclosure?',
					'a' => 'Yes, and acting quickly in a foreclosure situation is genuinely important. A fast cash sale before the foreclosure sale date stops the process, prevents a foreclosure from appearing on your credit report for seven years, and may result in cash in your pocket above your mortgage payoff. The earlier you reach out, the more options remain available to you.',
				),
				array(
					'q' => 'What states do you buy in?',
					'a' => 'We buy houses in Ohio (all 88 counties), Texas (all 254 counties) and Georgia (all 159 counties). From Columbus, Cleveland and Cincinnati to Houston, Dallas and San Antonio, to Atlanta, Savannah and Augusta, metro or rural, we cover the entire state.',
				),
				array(
					'q' => 'How fast can you actually close?',
					'a' => 'Our fastest close on record was five days from first contact to funded transaction. We close most deals in 10 to 14 days. Deals involving title complications or probate situations may take 21 to 30 days. We are always transparent about the realistic timeline for your specific situation before you commit to anything.',
				),
				array(
					'q' => 'Are there any fees I should know about?',
					'a' => 'There are none. We charge zero commissions, zero administrative fees, and zero closing costs. We pay all standard closing costs ourselves. The offer we make is the amount you receive at the closing table, nothing is subtracted after the offer is accepted.',
				),
				array(
					'q' => 'What happens after I submit the form?',
					'a' => 'Our system receives your inquiry immediately and you receive an automated confirmation. During business hours, a member of our acquisitions team calls or texts you within one hour. If you submit outside business hours, you receive an immediate system acknowledgment and a personal follow-up first thing the next morning. We contact you however you prefer, phone, text, or email.',
				),
				array(
					'q' => 'Is WholesalePro a legitimate and trustworthy company?',
					'a' => 'We use licensed title companies and real estate attorneys for every transaction, and every offer we send shows the complete math behind it. We encourage you to research us thoroughly, ask every question you have, and take our offer to your own attorney before deciding.',
				),
			);
			foreach ( $faqs as $faq ) : ?>
			<div class="accordion__item" role="listitem">
				<button class="accordion__trigger" aria-expanded="false">
					<?php echo esc_html( $faq['q'] ); ?>
					<svg class="accordion__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6,9 12,15 18,9"/></svg>
				</button>
				<div class="accordion__content">
					<div class="accordion__body"><p><?php echo esc_html( $faq['a'] ); ?></p></div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ BOTTOM CTA ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="sell-cta-heading">
	<div class="container narrow text-center animate-on-scroll">
		<h2 id="sell-cta-heading" style="margin-bottom:var(--space-md);">Ready to Get Your Offer?</h2>
		<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">No pressure. No obligation. Just a fair cash offer within 24 hours.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="#sell-form" class="btn btn--seller btn--lg">Fill Out the Form Above</a>
			<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline btn--lg"><?php echo esc_html( $phone ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
