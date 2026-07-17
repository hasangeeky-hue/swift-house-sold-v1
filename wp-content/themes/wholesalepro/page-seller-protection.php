<?php
/**
 * Seller Protection Center: how a seller's money, contract and title
 * are protected at every step. AEO question-structured, FAQPage schema.
 *
 * @package WholesalePro
 */

get_header();

$sell_page = get_page_by_path( 'sell-my-house-fast' );
$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
$book_page = get_page_by_path( 'book-a-call' );
$book_url  = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );

$faqs = array(
	array( 'Who actually holds my money during the sale?', 'A state-licensed escrow holder: a title insurance company in Ohio (regulated by the Ohio Department of Insurance) or Texas (Texas Department of Insurance), or a licensed closing attorney in Georgia, where attorney-supervised closings are required. Never us, and never the buyer personally.' ),
	array( 'Can the buyer take my deed without paying?', 'Not in a proper closing. The deed you sign is held by the escrow agent and recorded only when cleared funds are disbursed in the same session. The exchange is simultaneous by design.' ),
	array( 'What if there are liens or a mortgage on my house?', 'The title company finds every lien in the county records, lists each one on your settlement statement, and pays them from the sale price at closing. You never write those checks and nothing survives to chase you afterward.' ),
	array( 'How do I receive my money?', 'By wire from the escrow account, same day to one business day after recording, in the exact amount shown on the settlement statement you signed. Verify wire details by phone with the title company before closing day.' ),
	array( 'What insurance protects the transaction?', 'Title insurance covers the ownership transfer against defects, forgeries and missed liens. The escrow holder additionally carries state-required licensing, bonding and errors-and-omissions coverage. Protection is structural, not promised.' ),
	array( 'Can I verify all of this independently?', 'Yes, and you should: ask us which title company or attorney will close, then call them yourself and confirm your file. We give every seller this instruction because verification is our best credential.' ),
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

<section class="hero hero--split" aria-labelledby="sp-hero-heading" style="padding:90px 0 70px;">
	<div class="container">
		<div style="max-width:760px;">
			<p class="hero__eyebrow">SELLER PROTECTION CENTER · OHIO · TEXAS · GEORGIA</p>
			<h1 class="hero__title" id="sp-hero-heading" style="font-size:clamp(1.9rem,4vw,2.9rem);">How Your Money, Contract and Title Are Protected</h1>
			<p class="hero__subtitle">Every dollar in your sale moves through a state-licensed, insured escrow holder. Every document is exchanged simultaneously with the money. This page shows the entire machine, so you can verify it instead of trusting it.</p>
			<div class="hero__actions">
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get a Written Offer &rarr;</a>
				<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Ask Us Anything First</a>
			</div>
		</div>
	</div>
</section>

<section class="section" aria-labelledby="sp-pillars-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">THE FOUR PROTECTION LAYERS</p>
			<h2 class="section-header__title" id="sp-pillars-heading">What Stands Between You and Fraud</h2>
		</div>
		<div class="grid grid-4" style="gap:var(--space-lg);">
			<?php
			$pillars = array(
				array( '🏛️', 'Licensed Escrow', 'A title company (OH, TX) or closing attorney (GA, required by law) holds all funds and documents. Licensed, bonded, state-regulated, and answerable to regulators, not to us.' ),
				array( '💰', 'Verified Funds', 'The full purchase price must arrive and clear in escrow before closing. Promises, post-dated checks and "pay you Friday" cannot close a properly run file.' ),
				array( '📜', 'Simultaneous Exchange', 'Your signed deed is held by the escrow agent and recorded only as your money disburses. You cannot end up with no house and no payment; the sequence forbids it.' ),
				array( '🛡️', 'Title Insurance', 'The transfer is insured against forged documents, missed liens and title defects. Backed by regulated insurers, purchased at closing, priced into the deal, not into your pocket.' ),
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

<section class="section bg--light-gray" aria-labelledby="sp-flow-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">FOLLOW THE MONEY</p>
			<h2 class="section-header__title" id="sp-flow-heading">Where Every Dollar Sits, Step by Step</h2>
		</div>
		<div class="grid grid-4" style="gap:var(--space-lg);">
			<?php
			$flow = array(
				array( '1', 'Contract Signed', 'Buyer earnest money wires into the escrow account under your property file number. Call the title company and confirm receipt; they will tell you.' ),
				array( '2', 'Title Search', 'County records are searched for every mortgage, lien and judgment. Each appears on your settlement statement with its exact payoff.' ),
				array( '3', 'Funds Cleared', 'The full price arrives in escrow and clears as verified funds before closing day. Ohio\'s good-funds law (R.C. 1349.21) and Texas title rules exist for exactly this step.' ),
				array( '4', 'Simultaneous Close', 'Deed records, debts are paid from the price, and your proceeds wire to your account, all in one coordinated disbursement, documented on the statement you sign.' ),
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

<section class="section" aria-labelledby="sp-state-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">YOUR STATE, YOUR REGULATOR</p>
			<h2 class="section-header__title" id="sp-state-heading">Who Regulates Your Closing?</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$states = array(
				array( 'Ohio', 'Title agents are licensed and regulated by the Ohio Department of Insurance. The good-funds statute, R.C. 1349.21, requires cleared funds before disbursement. Franklin, Cuyahoga and Hamilton county recorders publish every deed transfer publicly.' ),
				array( 'Texas', 'Title companies operate under the Texas Department of Insurance with state-promulgated rates and forms, the strictest title regime in the country. Escrow officers are individually licensed. Harris, Dallas and Bexar county clerks record transfers publicly.' ),
				array( 'Georgia', 'Georgia law requires closings to be conducted under the supervision of a licensed attorney; the State Bar of Georgia enforces this as the unauthorized practice of law. Your closing attorney owes professional duties on top of escrow duties. Fulton and DeKalb records are public.' ),
			);
			foreach ( $states as $i => $st ) : ?>
			<div class="card animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<h3 style="font-size:1.2rem;margin-bottom:var(--space-sm);color:var(--wp-navy);"><?php echo esc_html( $st[0] ); ?></h3>
				<p style="color:var(--wp-gray);font-size:0.93rem;margin:0;"><?php echo esc_html( $st[1] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section bg--light-gray" aria-labelledby="sp-faq-heading">
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

<section class="section bg--navy" aria-labelledby="sp-cta-heading">
	<div class="container text-center">
		<h2 id="sp-cta-heading" style="color:#fff;margin-bottom:var(--space-md);">Verify Us Before You Trust Us</h2>
		<p style="color:rgba(255,255,255,0.8);max-width:600px;margin:0 auto var(--space-xl);">
			Request an offer and we name the title company in the same conversation. Call them. Confirm the file. Then decide. That order is exactly how we want it.
		</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Written Offer &rarr;</a>
			<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Book a Free Call</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
