<?php
/**
 * Buyer Protection Center v2: visual trust page for investors.
 * Deal-flow diagram, statement mock with fee line, scam-vs-legit
 * comparison, audit cards, FAQPage schema.
 *
 * @package WholesalePro
 */

get_header();

$inv_page  = get_page_by_path( 'investors' );
$inv_url   = $inv_page ? get_permalink( $inv_page->ID ) : home_url( '/investors' );
$book_page = get_page_by_path( 'book-a-call' );
$book_url  = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );
$theme_img = get_template_directory_uri() . '/assets/images/';

$faqs = array(
	array( 'Where does my earnest money sit?', 'In the licensed title company escrow account (Ohio, Texas) or the closing attorney trust account (Georgia), under the property file number. Never in our operating account. Call the escrow holder and confirm the file exists; a legitimate deal always survives that call.' ),
	array( 'Is my deposit refundable?', 'Inside the inspection period, yes, on written notice, that is the period\'s entire purpose. After it expires the deposit goes hard, standard in all three states, and it still sits in escrow until closing where it credits toward your purchase.' ),
	array( 'How is the assignment fee paid safely?', 'As a disclosed line item on the settlement statement, paid at closing from escrowed funds. Any request for a fee outside closing, by wire, app or cash, is the signature of wholesale fraud. Texas Property Code 5.086 additionally requires disclosure of equitable-interest assignments.' ),
	array( 'What guarantees the contract I am buying is real?', 'You inspect the underlying purchase contract before committing: signed, unexpired, assignable. The title company verifies it independently when opening the file, because no title company can close on a contract that does not exist.' ),
	array( 'What insurance protects my purchase?', 'An owner\'s title insurance policy issued at closing covers the chain of title behind your deed: forgeries, missed liens, unknown heirs. The escrow holder\'s licensing, bonding and errors-and-omissions coverage protect the funds in transit.' ),
	array( 'How do I avoid wire fraud on closing day?', 'Verify wire instructions by phone using a number you found independently, never one from an email thread. The FBI\'s IC3 reports hundreds of millions in attempted real-estate wire fraud annually, almost all through spoofed emails. One phone call defeats it.' ),
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
$ic_key    = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>';
?>

<!-- ━━ HERO: split with photo + protection badges ━━━━━━━━━━━━━━ -->
<section class="hero hero--split" aria-labelledby="bp-hero-heading" style="padding:80px 0 60px;">
	<div class="container">
		<div class="hero__inner" style="align-items:center;">
			<div class="hero__content">
				<p class="hero__eyebrow">BUYER PROTECTION CENTER · OHIO · TEXAS · GEORGIA</p>
				<h1 class="hero__title" id="bp-hero-heading" style="font-size:clamp(1.9rem,4vw,2.8rem);">Audit Us Before You Wire a Dollar</h1>
				<p class="hero__subtitle">Wholesale deals are safe when three mechanics hold: escrowed deposits, on-statement fees, and simultaneous recording. This page shows each mechanic, and hands you the audit checklist to run on us or on anyone.</p>
				<div class="hero__actions">
					<a href="<?php echo esc_url( $inv_url ); ?>" class="btn btn--seller btn--lg">Join the Buyer List &rarr;</a>
					<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Audit Us On a Call</a>
				</div>
				<div class="pc-badges">
					<span class="pc-badge"><?php echo $ic_lock; // phpcs:ignore ?> Escrowed Deposits</span>
					<span class="pc-badge"><?php echo $ic_doc; // phpcs:ignore ?> On-Statement Fees</span>
					<span class="pc-badge"><?php echo $ic_shield; // phpcs:ignore ?> Insured Title</span>
				</div>
			</div>
			<div class="hero__form-wrap">
				<img src="<?php echo esc_url( $theme_img . 'handshake.jpg' ); ?>" alt="Investor and title officer completing a closing" style="width:100%;height:380px;object-fit:cover;border-radius:18px;box-shadow:0 24px 60px rgba(0,0,0,0.35);">
			</div>
		</div>
	</div>
</section>

<!-- ━━ DEAL FLOW DIAGRAM ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="bp-flow-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">FOLLOW YOUR MONEY</p>
			<h2 class="section-header__title" id="bp-flow-heading">A Deal From Alert to Recorded Deed</h2>
			<p class="section-header__subtitle">Your capital is exposed exactly nowhere in this sequence. Watch the green badges.</p>
		</div>
		<div class="pc-flow">
			<div class="pc-flow__step">
				<div class="pc-flow__icon"><?php echo $ic_search; // phpcs:ignore ?></div>
				<h3 style="font-size:1rem;margin-bottom:6px;">1. Verify the Package</h3>
				<p style="font-size:0.88rem;color:var(--wp-gray);margin:0;">ARV comps, line-item repairs, the underlying contract. Run your own comps; walk it with your contractor.</p>
				<span class="pc-flow__where">$0 AT RISK</span>
			</div>
			<div class="pc-flow__step">
				<div class="pc-flow__icon"><?php echo $ic_lock; // phpcs:ignore ?></div>
				<h3 style="font-size:1rem;margin-bottom:6px;">2. Deposit to Escrow</h3>
				<p style="font-size:0.88rem;color:var(--wp-gray);margin:0;">Earnest money wires to the title company file, refundable inside the inspection period on written notice.</p>
				<span class="pc-flow__where">REFUNDABLE IN ESCROW</span>
			</div>
			<div class="pc-flow__step">
				<div class="pc-flow__icon"><?php echo $ic_bank; // phpcs:ignore ?></div>
				<h3 style="font-size:1rem;margin-bottom:6px;">3. Title Clears</h3>
				<p style="font-size:0.88rem;color:var(--wp-gray);margin:0;">The search surfaces every lien; each is scheduled for payoff at closing. Problems appear here, before your money goes hard.</p>
				<span class="pc-flow__where">STILL IN ESCROW</span>
			</div>
			<div class="pc-flow__step">
				<div class="pc-flow__icon"><?php echo $ic_key; // phpcs:ignore ?></div>
				<h3 style="font-size:1rem;margin-bottom:6px;">4. Record and Insure</h3>
				<p style="font-size:0.88rem;color:var(--wp-gray);margin:0;">Funds disburse, the deed records in your name or LLC, the owner's title policy issues.</p>
				<span class="pc-flow__where">DEED + POLICY YOURS</span>
			</div>
		</div>
	</div>
</section>

<!-- ━━ STATEMENT MOCK WITH FEE LINE ━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="bp-stmt-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:center;">
			<div>
				<p class="section-header__eyebrow">OUR FEE, IN WRITING, ON THE RECORD</p>
				<h2 id="bp-stmt-heading" style="margin-bottom:var(--space-md);">The Assignment Fee Lives On the Statement, Or It Does Not Exist</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">The dominant wholesale scam is the off-statement fee: "wire us $5,000 today to lock the deal." The cure is procedural, not psychological: every dollar you pay in a real transaction appears on the settlement statement, disbursed by the title company, in a document all parties sign.</p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-lg);">Texas made this explicit: Property Code 5.086 requires disclosure of equitable-interest assignments. Ohio and Georgia title practice papers assignments the same way. If a fee cannot survive being printed on the statement, it was never a fee.</p>
				<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline">Ask Us To Walk Through a Real Statement &rarr;</a>
			</div>
			<div class="pc-stmt" role="img" aria-label="Example buyer settlement statement showing purchase price, seller payoff, assignment fee and title policy">
				<div class="pc-stmt__head"><span>BUYER SETTLEMENT STATEMENT</span><span>EXAMPLE</span></div>
				<div class="pc-stmt__row"><span>Purchase price (assignment)</span><span><strong>$104,000</strong></span></div>
				<div class="pc-stmt__row"><span>Earnest money credit</span><span>&minus; $3,000 (yours, applied)</span></div>
				<div class="pc-stmt__row"><span>To seller at closing</span><span>$92,000</span></div>
				<div class="pc-stmt__row"><span>Assignment fee (disclosed)</span><span>$12,000</span></div>
				<div class="pc-stmt__row"><span>Owner's title policy</span><span>Issued at closing</span></div>
				<div class="pc-stmt__row pc-stmt__row--total"><span>Deed recorded to</span><span>Your LLC</span></div>
				<div class="pc-stmt__note">Illustrative figures. Every real deal shows its actual numbers on this document before you fund.</div>
			</div>
		</div>
	</div>
</section>

<!-- ━━ SCAM VS LEGIT ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="bp-flags-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">KNOW THE DIFFERENCE IN 60 SECONDS</p>
			<h2 class="section-header__title" id="bp-flags-heading">A Legitimate Wholesaler vs. A Scam In Progress</h2>
		</div>
		<div class="pc-flags">
			<div class="pc-flags__col pc-flags__col--good">
				<div class="pc-flags__title"><?php echo $ic_shield; // phpcs:ignore ?> A legitimate deal always has</div>
				<ul>
					<li><span class="pc-flags__mark">✓</span>A named title company holding escrow, confirmable by your own phone call</li>
					<li><span class="pc-flags__mark">✓</span>The underlying purchase contract shown to you: signed, current, assignable</li>
					<li><span class="pc-flags__mark">✓</span>An inspection period with refund terms in the written agreement</li>
					<li><span class="pc-flags__mark">✓</span>ARV comps and a line-item repair scope you are invited to verify</li>
					<li><span class="pc-flags__mark">✓</span>The assignment fee as a line on the settlement statement</li>
					<li><span class="pc-flags__mark">✓</span>A recorded deed plus an owner's title policy at the end</li>
				</ul>
			</div>
			<div class="pc-flags__col pc-flags__col--bad">
				<div class="pc-flags__title"><?php echo $ic_lock; // phpcs:ignore ?> A scam in progress sounds like</div>
				<ul>
					<li><span class="pc-flags__mark">✗</span>"Wire the fee today to lock it in", any fee outside the closing statement</li>
					<li><span class="pc-flags__mark">✗</span>Earnest money payable to a person or an operating account</li>
					<li><span class="pc-flags__mark">✗</span>"The contract is confidential", you cannot see what you are buying</li>
					<li><span class="pc-flags__mark">✗</span>No inspection period, or "we can skip that for a better price"</li>
					<li><span class="pc-flags__mark">✗</span>ARV with no comps, repairs as one suspiciously round number</li>
					<li><span class="pc-flags__mark">✗</span>A fake second buyer breathing down your neck since the first email</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- ━━ THE 3-QUESTION AUDIT ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="bp-audit-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">THE 3-QUESTION AUDIT</p>
			<h2 class="section-header__title" id="bp-audit-heading">Run This On Every Wholesaler, Including Us</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$audit = array(
				array( 'calculator-tax.jpg', '1', 'Which title company holds escrow?', 'Get the name, call them independently, confirm the file and the relationship. A clean operator answers instantly; a scammer changes the subject.' ),
				array( 'documents-signing.jpg', '2', 'Show me the underlying contract.', 'Signed, unexpired, assignable. An assignment of a dead or fictional contract assigns nothing, and this one look eliminates the possibility.' ),
				array( 'keys-hand.jpg', '3', 'Inspection period and refunds, in writing?', 'The window, the notice method, and the refund mechanics, in the agreement itself. Verbal assurances are not terms.' ),
			);
			foreach ( $audit as $i => $aq ) : ?>
			<div class="card pc-pillar animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<img src="<?php echo esc_url( $theme_img . $aq[0] ); ?>" alt="" loading="lazy">
				<div class="pc-pillar__body">
					<div class="pc-pillar__icon" style="background:var(--wp-red);"><strong><?php echo esc_html( $aq[1] ); ?></strong></div>
					<h3 style="font-size:1.05rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $aq[2] ); ?></h3>
					<p style="color:var(--wp-gray);font-size:0.92rem;margin:0;"><?php echo esc_html( $aq[3] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ FAQ ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="bp-faq-heading">
	<div class="container">
		<div class="section-header text-center">
			<h2 class="section-header__title" id="bp-faq-heading">Buyer Protection Questions, Answered Directly</h2>
		</div>
		<div class="faq-list narrow" role="list" style="max-width:760px;margin:0 auto;">
			<?php foreach ( $faqs as $i => $qa ) : ?>
			<div class="faq-item" role="listitem">
				<button class="faq-item__trigger js-faq-trigger" aria-expanded="false" aria-controls="bp-faq-<?php echo esc_attr( $i ); ?>">
					<span><?php echo esc_html( $qa[0] ); ?></span>
					<svg class="faq-item__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
				</button>
				<div class="faq-item__body" id="bp-faq-<?php echo esc_attr( $i ); ?>" hidden>
					<p><?php echo esc_html( $qa[1] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ CTA ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--navy" aria-labelledby="bp-cta-heading">
	<div class="container text-center">
		<h2 id="bp-cta-heading" style="color:#fff;margin-bottom:var(--space-md);">Audit Us First. Buy Second.</h2>
		<p style="color:rgba(255,255,255,0.8);max-width:600px;margin:0 auto var(--space-xl);">Join the list, ask the three questions in your first reply, and check every answer independently. Buyers who verify hardest become the relationships this business runs on.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $inv_url ); ?>" class="btn btn--seller btn--lg">Join the Buyer List &rarr;</a>
			<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Book a Free Call</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
