<?php
/**
 * Seller Protection Center v2: visual trust page.
 * Money-flow diagram, settlement statement mock, scam-vs-legit
 * comparison, photo pillars, regulator badges, FAQPage schema.
 *
 * @package WholesalePro
 */

get_header();

$sell_page = get_page_by_path( 'sell-my-house-fast' );
$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
$book_page = get_page_by_path( 'book-a-call' );
$book_url  = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );
$theme_img = get_template_directory_uri() . '/assets/images/';

$faqs = array(
	array( 'Who actually holds my money during the sale?', 'A state-licensed escrow holder: a title insurance company in Ohio (regulated by the Ohio Department of Insurance) or Texas (Texas Department of Insurance), or a licensed closing attorney in Georgia, where attorney-supervised closings are required by law. Never us, and never the buyer personally.' ),
	array( 'Can the buyer take my deed without paying?', 'Not in a proper closing. The deed you sign is held by the escrow agent and recorded only when cleared funds are disbursed in the same session. The exchange is simultaneous by design, which is the entire point of escrow.' ),
	array( 'What if there are liens or a mortgage on my house?', 'The title company finds every lien in the county records, lists each one on your settlement statement with its exact payoff, and pays them from the sale price at closing. You never write those checks and nothing survives to chase you afterward.' ),
	array( 'How do I receive my money?', 'By wire from the escrow account, same day to one business day after recording, in the exact amount shown on the settlement statement you signed. Verify wire details by phone with the title company before closing day, on a number you looked up yourself.' ),
	array( 'What insurance protects the transaction?', 'Title insurance covers the ownership transfer against defects, forgeries and missed liens. The escrow holder additionally carries state-required licensing, bonding and errors-and-omissions coverage. The protection is structural, not promised.' ),
	array( 'Can I verify all of this independently?', 'Yes, and you should: ask us which title company or attorney will close, then call them yourself and confirm your file exists. We give every seller this instruction in writing, because verification is our best credential.' ),
);

$faq_ld = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array_map( function ( $qa ) {
		return array(
			'@type'          => 'Question',
			'name'           => $qa[0],
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $qa[1] ),
		);
	}, $faqs ),
);
echo '<script type="application/ld+json">' . wp_json_encode( $faq_ld ) . '</script>';

$ic_shield = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>';
$ic_bank   = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M6 10v11M10 10v11M14 10v11M18 10v11"/></svg>';
$ic_doc    = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>';
$ic_lock   = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>';
$ic_search = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>';
$ic_wire   = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>';
?>

<!-- ━━ HERO: split with photo + regulator badges ━━━━━━━━━━━━━━━ -->
<section class="hero hero--split" aria-labelledby="sp-hero-heading" style="padding:80px 0 60px;">
	<div class="container">
		<div class="hero__inner" style="align-items:center;">
			<div class="hero__content">
				<p class="hero__eyebrow">SELLER PROTECTION CENTER · OHIO · TEXAS · GEORGIA</p>
				<h1 class="hero__title" id="sp-hero-heading" style="font-size:clamp(1.9rem,4vw,2.8rem);">Your Money Is Protected Before You Ever Trust Us</h1>
				<p class="hero__subtitle">Every dollar moves through a state-licensed, insured escrow holder. Your deed and the buyer's money change hands simultaneously, or not at all. This page shows the entire machine so you can verify it instead of believing it.</p>
				<div class="hero__actions">
					<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get a Written Offer &rarr;</a>
					<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Ask Us Anything First</a>
				</div>
				<div class="pc-badges">
					<span class="pc-badge"><?php echo $ic_shield; // phpcs:ignore ?> Ohio Dept. of Insurance</span>
					<span class="pc-badge"><?php echo $ic_shield; // phpcs:ignore ?> Texas Dept. of Insurance</span>
					<span class="pc-badge"><?php echo $ic_shield; // phpcs:ignore ?> Georgia Attorney Closings</span>
				</div>
			</div>
			<div class="hero__form-wrap">
				<img src="<?php echo esc_url( $theme_img . 'documents-signing.jpg' ); ?>" alt="Signing closing documents at a title company" style="width:100%;height:380px;object-fit:cover;border-radius:18px;box-shadow:0 24px 60px rgba(0,0,0,0.35);">
			</div>
		</div>
	</div>
</section>

<!-- ━━ MONEY FLOW DIAGRAM ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="sp-flow-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">FOLLOW THE MONEY</p>
			<h2 class="section-header__title" id="sp-flow-heading">Where Every Dollar Sits, From Contract to Your Account</h2>
			<p class="section-header__subtitle">At no point does your money or your deed pass through our hands. Watch the green badges.</p>
		</div>
		<div class="pc-flow">
			<div class="pc-flow__step">
				<div class="pc-flow__icon"><?php echo $ic_doc; // phpcs:ignore ?></div>
				<h3 style="font-size:1rem;margin-bottom:6px;">1. Contract Signed</h3>
				<p style="font-size:0.88rem;color:var(--wp-gray);margin:0;">Buyer earnest money wires to the title company under your file number. Call them and confirm receipt.</p>
				<span class="pc-flow__where">HELD IN ESCROW</span>
			</div>
			<div class="pc-flow__step">
				<div class="pc-flow__icon"><?php echo $ic_search; // phpcs:ignore ?></div>
				<h3 style="font-size:1rem;margin-bottom:6px;">2. Title Searched</h3>
				<p style="font-size:0.88rem;color:var(--wp-gray);margin:0;">County records checked for every mortgage, lien and judgment. Each gets an exact payoff on your statement.</p>
				<span class="pc-flow__where">PUBLIC RECORDS</span>
			</div>
			<div class="pc-flow__step">
				<div class="pc-flow__icon"><?php echo $ic_bank; // phpcs:ignore ?></div>
				<h3 style="font-size:1rem;margin-bottom:6px;">3. Funds Cleared</h3>
				<p style="font-size:0.88rem;color:var(--wp-gray);margin:0;">The full price arrives in escrow as verified funds. Ohio's good-funds law, R.C. 1349.21, requires it before any disbursement.</p>
				<span class="pc-flow__where">VERIFIED IN ESCROW</span>
			</div>
			<div class="pc-flow__step">
				<div class="pc-flow__icon"><?php echo $ic_wire; // phpcs:ignore ?></div>
				<h3 style="font-size:1rem;margin-bottom:6px;">4. Simultaneous Close</h3>
				<p style="font-size:0.88rem;color:var(--wp-gray);margin:0;">Deed records, debts are paid from the price, your proceeds wire out. One coordinated disbursement.</p>
				<span class="pc-flow__where">WIRED TO YOU</span>
			</div>
		</div>
	</div>
</section>

<!-- ━━ SETTLEMENT STATEMENT MOCK ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="sp-stmt-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:center;">
			<div>
				<p class="section-header__eyebrow">THE DOCUMENT THAT PROVES IT</p>
				<h2 id="sp-stmt-heading" style="margin-bottom:var(--space-md);">Every Dollar, On One Page You Sign</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">Before closing you receive the settlement statement: the sale price at the top, every payoff itemized below it, and the exact amount wiring to you at the bottom. Nothing is deducted that is not printed on this page, and you sign it before anything moves.</p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-lg);">This is why "hidden fees" cannot exist in a real closing: the document structure forbids them. If a number ever looked wrong, you would decline to sign and nothing would happen. That veto is yours until the last minute.</p>
				<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline">Walk Through a Sample Statement With Us &rarr;</a>
			</div>
			<div class="pc-stmt" role="img" aria-label="Example settlement statement showing sale price minus payoffs equals seller proceeds">
				<div class="pc-stmt__head"><span>SETTLEMENT STATEMENT</span><span>EXAMPLE</span></div>
				<div class="pc-stmt__row"><span>Sale price</span><span><strong>$182,000</strong></span></div>
				<div class="pc-stmt__row pc-stmt__row--minus"><span>Mortgage payoff (verified with lender)</span><span>&minus; $96,400</span></div>
				<div class="pc-stmt__row pc-stmt__row--minus"><span>County tax lien (paid at closing)</span><span>&minus; $4,120</span></div>
				<div class="pc-stmt__row pc-stmt__row--minus"><span>Water bill balance</span><span>&minus; $310</span></div>
				<div class="pc-stmt__row"><span>Closing costs</span><span>Paid by buyer</span></div>
				<div class="pc-stmt__row"><span>Commissions</span><span>$0</span></div>
				<div class="pc-stmt__row pc-stmt__row--total"><span>Wired to seller at closing</span><span>$81,170</span></div>
				<div class="pc-stmt__note">Illustrative figures. Your statement shows your real numbers, and you sign it before disbursement.</div>
			</div>
		</div>
	</div>
</section>

<!-- ━━ SCAM VS LEGIT COMPARISON ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="sp-flags-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">KNOW THE DIFFERENCE IN 60 SECONDS</p>
			<h2 class="section-header__title" id="sp-flags-heading">A Legitimate Closing vs. A Scam In Progress</h2>
		</div>
		<div class="pc-flags">
			<div class="pc-flags__col pc-flags__col--good">
				<div class="pc-flags__title"><?php echo $ic_shield; // phpcs:ignore ?> A legitimate closing always has</div>
				<ul>
					<li><span class="pc-flags__mark">✓</span>A named title company or closing attorney you can call yourself</li>
					<li><span class="pc-flags__mark">✓</span>Earnest money deposited into escrow, confirmed by the escrow holder</li>
					<li><span class="pc-flags__mark">✓</span>A written offer showing the price and how it was calculated</li>
					<li><span class="pc-flags__mark">✓</span>The deed signed only at closing, exchanged simultaneously with funds</li>
					<li><span class="pc-flags__mark">✓</span>A settlement statement you sign before any money moves</li>
					<li><span class="pc-flags__mark">✓</span>Time and encouragement to have your own attorney review everything</li>
				</ul>
			</div>
			<div class="pc-flags__col pc-flags__col--bad">
				<div class="pc-flags__title"><?php echo $ic_lock; // phpcs:ignore ?> A scam in progress sounds like</div>
				<ul>
					<li><span class="pc-flags__mark">✗</span>"Sign the deed now, we'll pay you Friday" (deed theft, the classic)</li>
					<li><span class="pc-flags__mark">✗</span>Any request for money from you: processing fees, contract fees, insurance fees</li>
					<li><span class="pc-flags__mark">✗</span>Payment offered outside escrow: apps, personal checks, parking-lot cash</li>
					<li><span class="pc-flags__mark">✗</span>Wire instructions arriving by email with "urgent account update"</li>
					<li><span class="pc-flags__mark">✗</span>"No need for a title company, it just adds cost"</li>
					<li><span class="pc-flags__mark">✗</span>Pressure to sign tonight, and discouragement from calling an attorney</li>
				</ul>
			</div>
		</div>
		<p style="text-align:center;color:var(--wp-gray);font-size:0.9rem;margin-top:var(--space-lg);max-width:640px;margin-left:auto;margin-right:auto;">The FBI's IC3 unit logs hundreds of millions of dollars in attempted real-estate wire fraud each year, nearly all through spoofed emails. One phone call to a number you found yourself defeats almost all of it.</p>
	</div>
</section>

<!-- ━━ STATE REGULATOR CARDS (with photos) ━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="sp-state-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">YOUR STATE, YOUR REGULATOR</p>
			<h2 class="section-header__title" id="sp-state-heading">Who Watches the People Holding Your Money?</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$states = array(
				array( 'house-suburban.jpg', 'Ohio', 'Title agents licensed by the Ohio Department of Insurance. Good-funds statute R.C. 1349.21 requires cleared money before disbursement. Franklin, Cuyahoga and Hamilton county recorders publish every transfer.' ),
				array( 'house-luxury.jpg', 'Texas', 'The strictest title regime in the country: state-promulgated rates and forms under the Texas Department of Insurance, individually licensed escrow officers. Harris, Dallas and Bexar county clerks record publicly.' ),
				array( 'house-brick.jpg', 'Georgia', 'Closings must run under a licensed attorney; the State Bar of Georgia enforces this as unauthorized practice of law. Your closing attorney owes professional duties on top of escrow duties.' ),
			);
			foreach ( $states as $i => $st ) : ?>
			<div class="card pc-pillar animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<img src="<?php echo esc_url( $theme_img . $st[0] ); ?>" alt="" loading="lazy">
				<div class="pc-pillar__body">
					<div class="pc-pillar__icon"><?php echo $ic_shield; // phpcs:ignore ?></div>
					<h3 style="font-size:1.15rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $st[1] ); ?></h3>
					<p style="color:var(--wp-gray);font-size:0.92rem;margin:0;"><?php echo esc_html( $st[2] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ FAQ ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="sp-faq-heading">
	<div class="container">
		<div class="section-header text-center">
			<h2 class="section-header__title" id="sp-faq-heading">Seller Protection Questions, Answered Directly</h2>
		</div>
		<div class="faq-list narrow" role="list" style="max-width:760px;margin:0 auto;">
			<?php foreach ( $faqs as $i => $qa ) : ?>
			<div class="faq-item" role="listitem">
				<button class="faq-item__trigger js-faq-trigger" aria-expanded="false" aria-controls="sp-faq-<?php echo esc_attr( $i ); ?>">
					<span><?php echo esc_html( $qa[0] ); ?></span>
					<svg class="faq-item__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
				</button>
				<div class="faq-item__body" id="sp-faq-<?php echo esc_attr( $i ); ?>" hidden>
					<p><?php echo esc_html( $qa[1] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ CTA ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--navy" aria-labelledby="sp-cta-heading">
	<div class="container text-center">
		<h2 id="sp-cta-heading" style="color:#fff;margin-bottom:var(--space-md);">Verify Us Before You Trust Us</h2>
		<p style="color:rgba(255,255,255,0.8);max-width:600px;margin:0 auto var(--space-xl);">Request an offer and we name the title company in the same conversation. Call them. Confirm the file. Then decide. That order is exactly how we want it.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Written Offer &rarr;</a>
			<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Book a Free Call</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
