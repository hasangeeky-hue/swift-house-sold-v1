<?php
/**
 * Service landing pages engine.
 * One config per target customer group; shared renderer with
 * AEO answer blocks, dynamic category-based guides, seller form.
 *
 * @package WholesalePro
 */


function shs_cat_image( $cat ) {
	$map = array(
		'probate'     => 'house-brick.jpg',
		'foreclosure' => 'house-suburban.jpg',
		'divorce'     => 'keys-hand.jpg',
		'tax-liens'   => 'calculator-tax.jpg',
		'repairs'     => 'house-porch.jpg',
		'landlord'    => 'house-modern.jpg',
		'general'      => 'documents-signing.jpg',
		'fix-flip'     => 'house-porch.jpg',
		'buy-hold'     => 'house-modern.jpg',
		'out-of-state' => 'house-luxury.jpg',
	);
	$file = isset( $map[ $cat ] ) ? $map[ $cat ] : 'house-suburban.jpg';
	return get_template_directory_uri() . '/assets/images/' . $file;
}

function shs_services_config() {
	return array(
		'sell-probate-property' => array(
			'menu'     => 'Probate / Inherited Property',
			'category' => 'probate',
			'eyebrow'  => 'PROBATE & INHERITED PROPERTY · OH · TX · GA',
			'title'    => 'Sell an Inherited or Probate Property Without the Burden',
			'answer'   => 'You can sell an inherited house as-is, belongings included, repairs ignored, from another state, usually as soon as the probate court grants the executor authority. We work with your estate attorney, buy the property exactly as it stands, and close on the timeline the estate needs.',
			'pains'    => array(
				array( 'The house is in another city or state', 'You never have to travel. Photos, documents and closing can all happen remotely, the title company handles signatures.' ),
				array( 'It is full of a lifetime of belongings', 'Take what matters to your family and leave the rest. We buy the house with everything in it.' ),
				array( 'Probate feels slow and confusing', 'We know the probate process in Ohio, Texas and Georgia courts and can time the sale to your case, often making an offer before probate even clears.' ),
				array( 'Family members disagree about what to do', 'A written cash offer gives everyone one concrete number to decide around, instead of months of listing debates.' ),
			),
			'faq'      => array(
				array( 'Can I sell before probate is finished?', 'Usually yes, once the court issues letters testamentary, the executor can sell. If the will grants power of sale, it can be even earlier. We can prepare the offer while you wait so no time is lost.' ),
				array( 'What about the mortgage on the inherited house?', 'It gets paid off at closing out of the sale price. If payments are behind, selling quickly protects the estate from foreclosure.' ),
				array( 'Do I pay taxes when I sell an inherited house?', 'Inherited property gets a stepped-up basis to its value at the date of death, so selling soon after inheriting usually means little or no capital gains tax. Confirm with a tax professional.' ),
				array( 'Is selling to a cash buyer legal during probate?', 'Yes. Probate sales to cash buyers are a normal, court-recognized transaction in Ohio, Texas and Georgia. The executor signs with the authority the court granted, a licensed title company records everything, and the proceeds go into the estate account. Your estate attorney reviews every document before you sign.' ),
				array( 'How does the money actually reach the estate?', 'Never in cash and never to a personal account. The buyer wires funds to the title company escrow account before closing. After recording, the title company disburses directly to the estate account by wire or check. Every transfer is documented for the court.' ),
				array( 'How do I avoid probate property scams?', 'Three checks protect you: the buyer closes through a licensed title company you can call yourself, the offer is written with the price calculation shown, and nobody asks you for any upfront fee. Anyone failing one of those three tests should not get a second phone call.' ),
				array( 'What documents do I need to sell an inherited house?', 'Typically the death certificate, the letters testamentary or letters of administration from the probate court, your photo ID, and any existing deed or mortgage statement you can find. The title company pulls the rest from public records.' ),
				array( 'How is the offer price for an inherited house calculated?', 'We start from recent comparable sales in the neighborhood, subtract the realistic cost of bringing the house to that condition, and subtract our margin. All three numbers appear in the written offer so your family and attorney can verify them.' ),
				array( 'Does the sale price affect estate taxes?', 'Federal estate tax only touches estates above roughly $13 million, so most families owe none. Income tax matters more: thanks to the stepped-up basis, selling near the date-of-death value usually creates little or no taxable gain. A tax professional can confirm your exact numbers.' ),
				array( 'Can heirs in different states all sign remotely?', 'Yes. Title companies routinely use mobile notaries and, where permitted, remote online notarization. Heirs in different states, or different countries, sign without traveling.' ),
			),
		),
		'stop-foreclosure' => array(
			'menu'     => 'Stop Foreclosure',
			'category' => 'foreclosure',
			'eyebrow'  => 'PRE-FORECLOSURE · ACT BEFORE THE SALE DATE',
			'title'    => 'Behind on Your Mortgage? Sell Before the Foreclosure Sale',
			'answer'   => 'You can stop a foreclosure by selling your house for cash before the auction, the loan is paid off at closing, the foreclosure ends, and you keep your remaining equity instead of losing it at the sheriff\'s sale. In Ohio, Texas and Georgia we can often close within 7–14 days.',
			'pains'    => array(
				array( 'The sale date is getting close', 'Cash closings take days, not months. Tell us your sale date and we will tell you honestly whether we can beat it.' ),
				array( 'You are afraid of losing your equity', 'At auction, houses sell for far below market value and fees eat the rest. A pre-auction sale protects what you have built.' ),
				array( 'A foreclosure would follow you for years', 'Foreclosure stays on your credit for 7 years and blocks most future mortgages. A completed sale does neither.' ),
				array( 'The bank is impossible to deal with', 'Once you have a signed contract, the title company handles the payoff with the bank directly. You stop being the go-between.' ),
			),
			'faq'      => array(
				array( 'How late is too late to sell?', 'In Ohio you can generally sell up to the court\'s confirmation of the sheriff\'s sale. In Texas and Georgia the timeline is shorter, weeks, not months, so act on the first notice, not the last.' ),
				array( 'What if I owe more than the house is worth?', 'A short sale may be possible with lender approval. Send us the numbers, we will tell you honestly what is achievable.' ),
				array( 'Will you lowball me because I am in trouble?', 'Our offer shows the comparable sales, repair estimate and our margin in writing. You can verify every number and walk away at zero cost.' ),
				array( 'Is it legal to sell my house while the bank is foreclosing?', 'Completely. Until the foreclosure is finalized, the house is still yours to sell. The sale pays the bank in full through the title company, which legally ends the foreclosure case. Banks generally prefer a payoff over an auction.' ),
				array( 'How does the payoff and money transfer work?', 'The title company requests an official payoff statement from your lender, collects the buyer funds in escrow, pays the bank the exact payoff at closing, and wires you whatever remains. You never handle the bank payoff yourself.' ),
				array( 'How do I spot foreclosure rescue scams?', 'Walk away from anyone who asks for an upfront fee, tells you to sign the deed over \'temporarily\', asks you to make payments to them instead of the bank, or pressures you to skip your own attorney. A legitimate cash sale always closes through a licensed title company and costs you nothing upfront.' ),
				array( 'What paperwork do I need to sell before the auction?', 'Your mortgage statement, any foreclosure court papers you received, and photo ID. We and the title company assemble the rest, including the official payoff figures, so you are not chasing documents in a crisis week.' ),
				array( 'How is my offer calculated when time is short?', 'The same way as any offer: comparable sales minus repairs minus our margin, all in writing. Urgency changes the speed, not the math. You can still take a day to have someone you trust review it.' ),
				array( 'Will I owe taxes if I sell before foreclosure?', 'If you lived in the house 2 of the last 5 years, up to $250,000 of gain ($500,000 married) is tax-free under the federal home sale exclusion, so most pre-foreclosure sellers owe nothing. Losing the house at auction offers no such protection for your equity.' ),
				array( 'What if the auction is only days away?', 'Call us anyway. Sales have closed in under a week when the payoff was clear, and lenders sometimes postpone an auction when a signed contract with escrowed funds is presented. The honest answer depends on your county and lender, and we will give it to you straight.' ),
			),
		),
		'sell-house-divorce' => array(
			'menu'     => 'Divorce Home Sale',
			'category' => 'divorce',
			'eyebrow'  => 'DIVORCE · ONE CLEAN CLOSING · TWO FRESH STARTS',
			'title'    => 'Sell the House During Divorce: Fast, Neutral, Final',
			'answer'   => 'The fastest clean way to divide a house in divorce is a cash sale: one written offer both attorneys can review, no repairs to argue over, a closing date that fits the settlement, and proceeds wired separately to each party if instructed. Often done in under 3 weeks.',
			'pains'    => array(
				array( 'Every listing decision becomes a new argument', 'A single as-is cash offer removes months of joint decisions about agents, prices, repairs and buyers.' ),
				array( 'You both keep paying for a house nobody wants', 'Every month of listing costs mortgage, insurance and utilities. A fast close stops the bleeding for both sides.' ),
				array( 'You need clean numbers for the settlement', 'A written offer is an exact figure your attorneys can put straight into the agreement, no estimates, no contingencies that collapse.' ),
				array( 'You worry the buyer will back out mid-settlement', 'Cash means no financing contingency. When we sign, the deal closes.' ),
			),
			'faq'      => array(
				array( 'Do both spouses have to agree to sell?', 'If both names are on the deed, yes, both must sign. A neutral written offer is often what gets both sides to yes.' ),
				array( 'Can the proceeds be split at closing?', 'Yes. The title company can wire each party\'s share separately according to the settlement agreement or joint instruction.' ),
				array( 'What if the divorce is not final yet?', 'Houses are commonly sold during proceedings with both parties\' consent or a court order. Coordinate with your attorneys, we can time the closing to the case.' ),
				array( 'Is a cash sale legally safe during divorce proceedings?', 'Yes, with both signatures. The sale is documented like any other: written contract, licensed title company, recorded deed. Many family law attorneys prefer it because the fixed price and date remove the biggest unknown from the settlement.' ),
				array( 'How is the money divided and transferred?', 'The title company follows written instructions: one wire split into two accounts, exact percentages or amounts per the settlement agreement. Neither spouse has to trust the other to forward money.' ),
				array( 'How do we avoid being taken advantage of in a stressful time?', 'Insist on the same three protections we recommend to everyone: title company closing, written offer with the math shown, zero upfront fees. Have both attorneys read the contract. Pressure tactics have no place in a divorce sale and we never use them.' ),
				array( 'What documents are needed to sell during a divorce?', 'The deed or mortgage statement, both photo IDs, and, if the case is underway, the settlement agreement or a court order authorizing the sale. The title company coordinates with both attorneys directly if you prefer.' ),
				array( 'How is the house price determined fairly for both sides?', 'Our written offer shows the comparable sales, repair estimate and margin behind the number. Because both spouses see the identical math, neither side can claim the price favored the other. Some couples also order an independent appraisal for the file; we welcome that.' ),
				array( 'What are the tax consequences of selling in a divorce?', 'Selling while still married usually preserves the $500,000 joint exclusion on gains, which often beats selling after the divorce finalizes with only $250,000 each. Timing matters, so ask your attorney or CPA before choosing a closing date.' ),
				array( 'What if one spouse refuses to sell?', 'If both names are on the deed, a voluntary sale needs both signatures. When agreement is impossible, courts can order a sale in the divorce judgment. A concrete written offer sometimes breaks the deadlock because it replaces arguments with a number.' ),
			),
		),
		'sell-house-tax-liens' => array(
			'menu'     => 'Tax Liens & Back Taxes',
			'category' => 'tax-liens',
			'eyebrow'  => 'TAX LIENS · CODE VIOLATIONS · JUDGMENTS',
			'title'    => 'Sell a House With Tax Liens: The Debt Is Paid at Closing',
			'answer'   => 'A tax lien does not block the sale of your house. At closing, the title company pays the county directly out of the purchase price, you never write a check. This works for property tax debt, code violation fines, and most judgment liens in Ohio, Texas and Georgia.',
			'pains'    => array(
				array( 'The debt keeps growing every month', 'Texas penalties alone can reach 47% in year one. Every month of waiting transfers more of your equity to the county.' ),
				array( 'You are afraid the county will foreclose', 'Tax foreclosure moves faster than bank foreclosure, especially in Texas. Selling first keeps the equity in your hands.' ),
				array( 'You assume nobody will buy a liened house', 'We buy them routinely. Liens are a closing line-item, not a deal-breaker.' ),
				array( 'You cannot afford to pay the liens first', 'You do not have to. They come out of the sale price at closing.' ),
			),
			'faq'      => array(
				array( 'How do I find out exactly what I owe?', 'The county tax office provides a payoff statement, it is public record and we can help you pull it as part of preparing your offer.' ),
				array( 'What if the liens are more than the house value?', 'Rare, but options exist: penalty negotiations or structured sales with the county. The worst move is waiting until foreclosure wipes out the choice.' ),
				array( 'Do code violation fines work the same way?', 'Yes, municipal fines and most judgment liens are paid from the proceeds at closing, exactly like tax liens.' ),
				array( 'Is it legal to sell a house that has liens on it?', 'Yes. Liens attach to the sale proceeds, not to your right to sell. The title company identifies every lien in the title search, pays each one from the purchase money at closing, and records a clean deed for the buyer.' ),
				array( 'How does the money flow when liens are involved?', 'Buyer funds go into the title company escrow. At closing the title company pays the county, the city, and any judgment holders in legal priority order, then wires you the remainder with a settlement statement listing every payment.' ),
				array( 'How do I avoid lien-related scams?', 'Never pay anyone who promises to \'remove\' your lien for an upfront fee, and never deed your house to someone who says they will \'take care of the taxes\'. Legitimate resolution happens only at a title company closing where the debt is actually paid from real funds.' ),
				array( 'What documents should I gather?', 'Any lien notices or county letters you received, your mortgage statement if there is one, and photo ID. We pull the official payoff amounts from the county and courts, you do not need to calculate anything.' ),
				array( 'How is my offer calculated with liens on the property?', 'Liens do not change the value math: comparable sales minus repairs minus margin. They only change the disbursement, what part of the price goes to debts versus to you. The written offer and the settlement statement show both clearly.' ),
				array( 'Do I owe income tax after selling a liened house?', 'Paying off liens does not create extra income tax. If the house was your primary residence for 2 of the last 5 years, the usual exclusion of up to $250,000 gain ($500,000 married) applies to whatever you keep. A tax professional can confirm your case.' ),
				array( 'What if the county has already started tax foreclosure?', 'There is still a window, but it is shorter than people think, especially in Texas. A sale that pays the county in full stops the process. Send us the notice you received and we will tell you honestly how much time the calendar gives you.' ),
			),
		),
		'sell-damaged-house' => array(
			'menu'     => 'House Needs Major Repairs',
			'category' => 'repairs',
			'eyebrow'  => 'AS-IS · ANY CONDITION · ZERO REPAIRS',
			'title'    => 'Sell a House That Needs Major Repairs: Spend Nothing',
			'answer'   => 'You can sell a house needing major repairs completely as-is: no fixing, no cleaning, no inspections to pass. Foundation problems, fire or water damage, mold, ancient wiring, we price the work into a written offer and close in as little as 7 days.',
			'pains'    => array(
				array( 'Contractors quoted more than you can spend', 'Repair quotes routinely overrun 20–40%. Selling as-is means the renovation risk is our problem, priced honestly into the offer.' ),
				array( 'Retail buyers\' lenders reject the house', 'FHA and VA loans fail on bad roofs and foundations. Your real market is cash, and that is us.' ),
				array( 'You are embarrassed to show the house', 'Nobody stages anything for us. We have bought hoarder houses, fire damage and fifty years of deferred maintenance.' ),
				array( 'The house eats money every month it sits', 'Taxes, insurance and utilities on an unsellable house never stop. A 7-day close does.' ),
			),
			'faq'      => array(
				array( 'How do you price a damaged house?', 'Backward from the after-repair value: what it sells for fixed, minus true repair costs, minus our margin, all shown in writing. If any buyer will not show that math, walk away from them.' ),
				array( 'Do I need to clean out the house?', 'No. Take your documents and what you love; leave everything else, including furniture and junk.' ),
				array( 'Will you still buy if there is mold or fire damage?', 'Yes. Structural, environmental and cosmetic damage are all buyable, they change the number, not the answer.' ),
				array( 'Is an as-is sale legally different from a normal sale?', 'The contract simply states the buyer accepts the property in its current condition. You must still answer disclosure questions honestly about what you know, and everything closes through a licensed title company exactly like a retail sale. As-is protects you from repair demands, not from telling the truth.' ),
				array( 'How does payment work on an as-is sale?', 'Identically to any sale: funds sit in the title company escrow before closing and are wired to you after recording. The condition of the house changes the price, never the safety of the payment.' ),
				array( 'How do I avoid scams targeting owners of damaged houses?', 'Damaged-house owners attract bad actors because they feel unsellable. The same three tests apply: title company closing, written math, zero upfront fees. Add a fourth: never sign a deed before closing day, no matter what story accompanies the request.' ),
				array( 'What paperwork do I need for a house in poor condition?', 'Just the basics: deed or mortgage statement, photo ID, and any insurance claims or repair estimates you happen to have. Nothing needs to be organized or complete, we work from what exists.' ),
				array( 'How exactly do you price a damaged house?', 'After-repair value from comparable renovated sales, minus a written line-item repair estimate, minus our margin. You see all three numbers. If a competing buyer offers more, take it, but make them show their math first.' ),
				array( 'Are there tax issues when selling below the original purchase price?', 'Selling a damaged house at a loss on your primary residence is generally not deductible, but it also creates no tax bill. If it was a rental or investment property, a loss may actually reduce your taxes, worth a conversation with a CPA.' ),
				array( 'Does insurance damage money affect the sale?', 'Open insurance claims can usually be settled or assigned as part of the transaction, and the offer accounts for it either way. Bring whatever claim paperwork you have and the title company will structure it correctly.' ),
			),
		),
		'sell-rental-property' => array(
			'menu'     => 'Tired Landlord / Rental',
			'category' => 'landlord',
			'eyebrow'  => 'LANDLORDS · EXIT WITH TENANTS IN PLACE',
			'title'    => 'Tired Landlord? Sell Your Rental: Tenants and All',
			'answer'   => 'You can sell a rental property with tenants still in it, paying or not. We buy tenant-occupied properties as-is in Ohio, Texas and Georgia, take over the lease situation completely, and close on your schedule. No evictions to run, no make-ready repairs.',
			'pains'    => array(
				array( 'Tenants are not paying and eviction is expensive', 'Sell with the tenants in place. The occupancy situation becomes ours the day we close.' ),
				array( 'Every month brings another repair call', 'Stop funding a property that stopped paying you back. One closing ends the 2am phone calls.' ),
				array( 'You cannot show a unit a tenant lives in', 'We do not need showings, staging or tenant cooperation to make a written offer.' ),
				array( 'You are done with the whole business', 'Whether it is one door or a small portfolio, we can buy the lot and let you exit in weeks.' ),
			),
			'faq'      => array(
				array( 'Can you really buy with a non-paying tenant inside?', 'Yes. We price the occupancy situation into the offer and handle it after closing, legally and professionally.' ),
				array( 'What about the security deposits and leases?', 'Deposits and lease obligations transfer at closing per standard practice; the title company documents it. You are released going forward.' ),
				array( 'Do you buy multiple properties at once?', 'Yes, portfolio purchases are welcome and usually close on one coordinated date.' ),
				array( 'Is selling with tenants inside legal?', 'Yes. The lease and the tenants transfer with the property at closing. Tenant rights are respected, nothing about the sale requires an eviction, and the closing itself looks like any other: title company, escrow, recorded deed.' ),
				array( 'How does the money transfer work on a rental sale?', 'Buyer funds in escrow, payoff of any mortgage, then the remainder wired to you, documented on a settlement statement. Security deposits transfer to the buyer as a credit, which the statement also shows, so the accounting is clean.' ),
				array( 'How do I avoid scams as a burned-out landlord?', 'Exhausted owners get targeted with \'creative\' offers: land contracts, subject-to deals, lease options. Some are legitimate tools, but each leaves you tied to the property. If you want a clean exit, insist on a straight cash purchase through a title company with the math in writing.' ),
				array( 'What documents do I need to sell a rental?', 'The leases, a rent roll if you have multiple units, your mortgage statement, and photo ID. Missing leases are workable, month-to-month situations are common and we buy them regularly.' ),
				array( 'How do you price a tenant-occupied property?', 'Comparable sales for the property itself, adjusted for condition and for the occupancy situation: paying tenants on a lease can add value, non-paying occupants reduce it by the realistic cost of resolution. Every adjustment appears in the written offer.' ),
				array( 'What about capital gains and depreciation recapture?', 'Rental sales have real tax consequences: gains above your adjusted basis are taxable and prior depreciation is recaptured at up to 25%. A 1031 exchange can defer everything if you plan to reinvest. Talk to a CPA before closing, the timing of the sale can change your bill significantly.' ),
				array( 'Can I sell several rentals at once?', 'Yes, portfolio sales are welcome. One coordinated closing date, one settlement statement per property, and you exit the whole business in a single afternoon.' ),
			),
		),
	);
}

/**
 * Render a complete service landing page for the given service key.
 */
function shs_render_service_page( $key ) {
	$all = function_exists( 'shs_all_landing_configs' ) ? shs_all_landing_configs() : shs_services_config();
	if ( ! isset( $all[ $key ] ) ) {
		return;
	}
	$svc      = $all[ $key ];
	$investor = ! empty( $svc['audience'] ) && 'investor' === $svc['audience'];
	$sell_url = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );
	$book_url = ( $p = get_page_by_path( 'book-a-call' ) ) ? get_permalink( $p->ID ) : home_url( '/book-a-call' );
	?>

	<section class="hero hero--split" aria-labelledby="svc-hero-heading">
		<div class="container">
			<div class="hero__inner">
				<div class="hero__content">
					<p class="hero__eyebrow"><?php echo esc_html( $svc['eyebrow'] ); ?></p>
					<h1 class="hero__title" id="svc-hero-heading" style="font-size:clamp(1.9rem,4vw,2.9rem);"><?php echo esc_html( $svc['title'] ); ?></h1>
					<p class="hero__subtitle"><?php echo esc_html( $svc['answer'] ); ?></p>
					<div class="hero__actions">
						<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Book a Free Consultation</a>
					</div>
				</div>
				<div class="hero__form-wrap">
					<div class="hero__form-card">
						<h2 class="hero__form-card__heading"><?php echo $investor ? 'Join the Buyer List' : 'Get Your Free Cash Offer'; ?></h2>
						<p class="hero__form-card__sub"><?php echo $investor ? 'Free. Deals matching your criteria reach you first.' : 'Takes less than 2 minutes. No obligation.'; ?></p>
						<?php echo $investor ? wholesalepro_render_buyer_form( 'investor-' . $key ) : wholesalepro_render_seller_form( 'service-' . $key ); // phpcs:ignore ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section" aria-labelledby="svc-pains-heading">
		<div class="container">
			<div class="section-header text-center">
				<h2 class="section-header__title" id="svc-pains-heading">We Built This Service Around Your Actual Problems</h2>
			</div>
			<div class="grid grid-2" style="gap:var(--space-lg);max-width:960px;margin:0 auto;">
				<?php foreach ( $svc['pains'] as $i => $pain ) : ?>
				<div class="card animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
					<h3 style="font-size:1.05rem;margin-bottom:var(--space-sm);color:var(--wp-navy);">&ldquo;<?php echo esc_html( $pain[0] ); ?>&rdquo;</h3>
					<p style="color:var(--wp-gray);font-size:0.95rem;margin:0;"><?php echo esc_html( $pain[1] ); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	$faq_ld = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array_map( function ( $qa ) {
			return array(
				'@type'          => 'Question',
				'name'           => $qa[0],
				'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $qa[1] ),
			);
		}, $svc['faq'] ),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $faq_ld ) . '</script>';
	?>
	<section class="section bg--light-gray" aria-labelledby="svc-faq-heading">
		<div class="container">
			<div class="section-header text-center">
				<h2 class="section-header__title" id="svc-faq-heading">Questions People In Your Situation Ask</h2>
			</div>
			<div class="faq-list narrow" role="list" style="max-width:760px;margin:0 auto;">
				<?php foreach ( $svc['faq'] as $i => $qa ) : ?>
				<div class="faq-item" role="listitem" itemscope itemtype="https://schema.org/Question">
					<button class="faq-item__trigger js-faq-trigger" aria-expanded="false" aria-controls="svc-faq-<?php echo esc_attr( $i ); ?>" itemprop="name">
						<span><?php echo esc_html( $qa[0] ); ?></span>
						<svg class="faq-item__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
					</button>
					<div class="faq-item__body" id="svc-faq-<?php echo esc_attr( $i ); ?>" hidden itemscope itemtype="https://schema.org/Answer">
						<div itemprop="text"><p><?php echo esc_html( $qa[1] ); ?></p></div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	$guides = new WP_Query( array(
		'posts_per_page' => 10,
		'post_status'    => 'publish',
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $svc['category'],
			),
		),
	) );
	if ( $guides->have_posts() ) : ?>
	<section class="section" aria-labelledby="svc-guides-heading">
		<div class="container">
			<div class="section-header text-center">
				<p class="section-header__eyebrow">RESEARCH &amp; GUIDES</p>
				<h2 class="section-header__title" id="svc-guides-heading">Learn Everything Before You Decide</h2>
			</div>
			<div class="grid grid-2" style="gap:var(--space-lg);max-width:960px;margin:0 auto;">
				<?php while ( $guides->have_posts() ) : $guides->the_post(); ?>
				<article class="card card--guide" style="padding:0;overflow:hidden;">
					<img src="<?php echo esc_url( shs_cat_image( $svc['category'] ) ); ?>" alt="" loading="lazy" style="width:100%;height:150px;object-fit:cover;display:block;">
					<div style="padding:var(--space-lg) var(--space-xl) var(--space-xl);">
					<h3 style="font-size:1.05rem;margin-bottom:var(--space-sm);"><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a></h3>
					<p style="color:var(--wp-gray);font-size:0.92rem;"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
					<a href="<?php the_permalink(); ?>" style="font-weight:600;color:var(--wp-red);text-decoration:none;">Read Guide &rarr;</a>
					</div>
				</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<section class="section bg--navy" aria-labelledby="svc-cta-heading">
		<div class="container text-center">
			<h2 id="svc-cta-heading" style="color:#fff;margin-bottom:var(--space-md);"><?php echo $investor ? 'Questions Before You Join?' : 'Talk It Through With a Real Person First?'; ?></h2>
			<p style="color:rgba(255,255,255,0.8);max-width:560px;margin:0 auto var(--space-xl);">
				<?php echo $investor ? 'Book a free call, online or by phone. Tell us your strategy and we will tell you honestly whether our pipeline fits it.' : 'Book a free consultation, online or by phone. No pressure, no obligation. Or get your written cash offer right away.'; ?>
			</p>
			<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
				<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Book a Free Call</a>
				<?php if ( ! $investor ) : ?>
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Cash Offer &rarr;</a>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}
