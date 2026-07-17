<?php
/**
 * Buyer Protection Center: how an investor's earnest money, contract
 * and title are protected. AEO question-structured, FAQPage schema.
 *
 * @package WholesalePro
 */

get_header();

$inv_page = get_page_by_path( 'investors' );
$inv_url  = $inv_page ? get_permalink( $inv_page->ID ) : home_url( '/investors' );
$book_page = get_page_by_path( 'book-a-call' );
$book_url  = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );

$faqs = array(
	array( 'Where does my earnest money sit?', 'In the licensed title company escrow account (Ohio, Texas) or the closing attorney trust account (Georgia), under the property file number. Never in our operating account. Call the escrow holder and confirm the file exists; a legitimate deal always survives that call.' ),
	array( 'Is my deposit refundable?', 'Inside the inspection period, yes, on written notice, that is the period\'s entire purpose. After it expires the deposit goes hard, which is standard practice in all three states, and it still sits in escrow until closing.' ),
	array( 'How is the assignment fee paid safely?', 'As a disclosed line item on the settlement statement, paid at closing from escrowed funds. Any request for a fee outside closing, by wire, app or cash, is the signature of wholesale fraud. Texas Property Code 5.086 additionally requires disclosure of equitable-interest assignments.' ),
	array( 'What guarantees the contract I am buying is real?', 'You inspect the underlying purchase contract before committing: signed, unexpired, with an assignable buyer position. The title company confirms it independently when opening the file, because they cannot insure a closing on a dead contract.' ),
	array( 'What insurance protects my purchase?', 'An owner\'s title insurance policy issued at closing covers the chain of title behind your deed: forgeries, missed liens, unknown heirs. The escrow holder\'s own licensing, bonding and E&O coverage protect the funds in transit.' ),
	array( 'How do I avoid wire fraud on closing day?', 'Verify wire instructions by phone using a number you found independently, never one from an email thread. The FBI\'s IC3 reports hundreds of millions in attempted real-estate wire fraud annually, almost all through spoofed emails. One phone call defeats it.' ),
);
?>

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
	}, $faqs ),
);
echo '<script type="application/ld+json">' . wp_json_encode( $faq_ld ) . '</script>';
?>

<section class="hero hero--split" aria-labelledby="bp-hero-heading" style="padding:90px 0 70px;">
	<div class="container">
		<div style="max-width:760px;">
			<p class="hero__eyebrow">BUYER PROTECTION CENTER · OHIO · TEXAS · GEORGIA</p>
			<h1 class="hero__title" id="bp-hero-heading" style="font-size:clamp(1.9rem,4vw,2.9rem);">How Your Earnest Money, Fee and Deed Are Protected</h1>
			<p class="hero__subtitle">Wholesale deals are safe when three mechanics hold: escrowed deposits, on-statement fees, and simultaneous recording. This page shows each mechanic and how to audit it, on us or on anyone.</p>
			<div class="hero__actions">
				<a href="<?php echo esc_url( $inv_url ); ?>" class="btn btn--seller btn--lg">Join the Buyer List &rarr;</a>
				<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Audit Us On a Call</a>
			</div>
		</div>
	</div>
</section>

<section class="section" aria-labelledby="bp-pillars-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">THE FOUR PROTECTION LAYERS</p>
			<h2 class="section-header__title" id="bp-pillars-heading">What Stands Between Your Capital and Fraud</h2>
		</div>
		<div class="grid grid-4" style="gap:var(--space-lg);">
			<?php
			$pillars = array(
				array( '🏦', 'Escrowed Deposits', 'Earnest money wires to the licensed escrow holder under the property file number, refundable inside the inspection window, credited on the settlement statement at closing.' ),
				array( '🧾', 'On-Statement Fees', 'Our assignment fee is a disclosed line item paid through closing. No fee, deposit or transfer of any kind happens outside the settlement statement, ever.' ),
				array( '🔍', 'Verifiable Contract', 'You see the underlying purchase contract before committing: signed, current, assignable. The title company independently verifies it when the file opens.' ),
				array( '🛡️', 'Insured Title', 'Your deed records with an owner\'s title policy behind it, covering forgeries, missed liens and defects in the chain, issued by a regulated insurer at closing.' ),
			);
			foreach ( $pillars as $i => $pl ) : ?>
			<div class="card animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<div style="font-size:2rem;margin-bottom:var(--space-sm);" aria-hidden="true"><?php echo $pl[0]; // phpcs:ignore ?></div>
				<h3 style="font-size:1.05rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $pl[1] ); ?></h3>
				<p style="color:var(--wp-gray);font-size:0.92rem;margin:0;"><?php echo esc_html( $pl[2] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section bg--light-gray" aria-labelledby="bp-flow-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">FOLLOW YOUR MONEY</p>
			<h2 class="section-header__title" id="bp-flow-heading">A Deal From Alert to Recorded Deed</h2>
		</div>
		<div class="grid grid-4" style="gap:var(--space-lg);">
			<?php
			$flow = array(
				array( '1', 'Verify the Package', 'ARV comps, line-item repairs, the underlying contract. Run your own comps; walk it with your contractor. Nothing is owed at this stage.' ),
				array( '2', 'Deposit to Escrow', 'On signing the assignment, earnest money wires to the title company file, refundable inside the inspection period on written notice.' ),
				array( '3', 'Clear Title Opens', 'The title search surfaces every lien on the property; each is scheduled for payoff at closing. Problems appear here, before your money goes hard, not after.' ),
				array( '4', 'Record and Insure', 'Your funds disburse, the deed records in your name or LLC, and the owner\'s title policy issues. Settlement statement itemizes every dollar including our fee.' ),
			);
			foreach ( $flow as $i => $st ) : ?>
			<div class="card text-center animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--wp-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.2rem;margin:0 auto var(--space-md);"><?php echo esc_html( $st[0] ); ?></div>
				<h3 style="font-size:1.02rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $st[1] ); ?></h3>
				<p style="color:var(--wp-gray);font-size:0.9rem;margin:0;"><?php echo esc_html( $st[2] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section" aria-labelledby="bp-audit-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">THE 3-QUESTION AUDIT</p>
			<h2 class="section-header__title" id="bp-audit-heading">Run This Check on Every Wholesaler, Including Us</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$audit = array(
				array( '1', 'Which title company holds escrow?', 'Get the name, call them independently, confirm the file and the relationship. A clean operator answers instantly; a scammer changes the subject.' ),
				array( '2', 'Show me the underlying contract.', 'Signed, unexpired, assignable. An assignment of a dead or fictional contract assigns nothing, and this one look eliminates the possibility.' ),
				array( '3', 'Inspection period and refund terms, in writing?', 'The window, the notice method, and the refund mechanics, in the agreement itself. Verbal assurances are not terms.' ),
			);
			foreach ( $audit as $i => $aq ) : ?>
			<div class="card animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<div style="width:44px;height:44px;border-radius:50%;background:var(--wp-red);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;margin-bottom:var(--space-md);"><?php echo esc_html( $aq[0] ); ?></div>
				<h3 style="font-size:1.05rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $aq[1] ); ?></h3>
				<p style="color:var(--wp-gray);font-size:0.92rem;margin:0;"><?php echo esc_html( $aq[2] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section bg--light-gray" aria-labelledby="bp-faq-heading">
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

<section class="section bg--navy" aria-labelledby="bp-cta-heading">
	<div class="container text-center">
		<h2 id="bp-cta-heading" style="color:#fff;margin-bottom:var(--space-md);">Audit Us First. Buy Second.</h2>
		<p style="color:rgba(255,255,255,0.8);max-width:600px;margin:0 auto var(--space-xl);">
			Join the list, ask the three questions in your first reply, and check every answer independently. Buyers who verify hardest become the relationships this business runs on.
		</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $inv_url ); ?>" class="btn btn--seller btn--lg">Join the Buyer List &rarr;</a>
			<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Book a Free Call</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
