<?php
/**
 * Escrow Agents: individual descriptions of who holds the money
 * in each state, their duties, the insurance behind them, and
 * exactly how a customer verifies them independently.
 *
 * @package WholesalePro
 */

get_header();

$sell_page = get_page_by_path( 'sell-my-house-fast' );
$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
$inv_page  = get_page_by_path( 'investors' );
$inv_url   = $inv_page ? get_permalink( $inv_page->ID ) : home_url( '/investors' );
$book_page = get_page_by_path( 'book-a-call' );
$book_url  = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );
$theme_img = get_template_directory_uri() . '/assets/images/';

$faqs = array(
	array( 'Who exactly is the escrow agent in my closing?', 'It depends on the state. In Ohio and Texas it is a licensed title insurance agent or escrow officer working for a title company. In Georgia it is a licensed real estate closing attorney, because Georgia law requires attorney-supervised closings. In every case we name your specific agent and company before you sign anything.' ),
	array( 'How do I verify an escrow agent is really licensed?', 'Every state publishes its licenses. Ohio: search the agent or agency in the Ohio Department of Insurance license gateway. Texas: use the Texas Department of Insurance agent lookup. Georgia: confirm the closing attorney in the State Bar of Georgia member directory. The searches are free and take about two minutes.' ),
	array( 'What happens if an escrow agent makes a mistake or steals?', 'Multiple insurance layers respond: the agency\'s errors-and-omissions policy, state-required bonding, the underwriter behind the title policy, and in attorney states the bar\'s client protection mechanisms. This layered backstop is why regulated escrow exists instead of trust between strangers.' ),
	array( 'Can I choose my own title company or attorney?', 'Often yes, especially on the buyer side. Where the existing contract already names one, we tell you upfront and you are free to have your own attorney review the entire file alongside them.' ),
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
$ic_check  = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>';
?>

<!-- ━━ HERO ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="hero hero--split" aria-labelledby="ea-hero-heading" style="padding:80px 0 60px;">
	<div class="container">
		<div class="hero__inner" style="align-items:center;">
			<div class="hero__content">
				<p class="hero__eyebrow">MEET THE PEOPLE WHO HOLD THE MONEY</p>
				<h1 class="hero__title" id="ea-hero-heading" style="font-size:clamp(1.9rem,4vw,2.8rem);">The Escrow Agents Behind Every Safe Closing</h1>
				<p class="hero__subtitle">Your money is never held by us and never by the other party. It is held by a licensed professional whose job, license and insurance all depend on doing this correctly. Here is exactly who that person is in your state, what they do, and how to check them yourself.</p>
				<div class="pc-badges">
					<span class="pc-badge"><?php echo $ic_shield; // phpcs:ignore ?> State Licensed</span>
					<span class="pc-badge"><?php echo $ic_shield; // phpcs:ignore ?> Bonded &amp; Insured</span>
					<span class="pc-badge"><?php echo $ic_shield; // phpcs:ignore ?> Publicly Verifiable</span>
				</div>
			</div>
			<div class="hero__form-wrap">
				<img src="<?php echo esc_url( $theme_img . 'handshake.jpg' ); ?>" alt="Escrow officer completing a real estate closing" style="width:100%;height:360px;object-fit:cover;border-radius:18px;box-shadow:0 24px 60px rgba(0,0,0,0.35);">
			</div>
		</div>
	</div>
</section>

<!-- ━━ INDIVIDUAL AGENT PROFILES PER STATE ━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="ea-profiles-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">ONE STATE, ONE KIND OF AGENT</p>
			<h2 class="section-header__title" id="ea-profiles-heading">Who Holds Your Money In Each State</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);align-items:stretch;">

			<div class="card pc-pillar animate-on-scroll">
				<img src="<?php echo esc_url( $theme_img . 'house-suburban.jpg' ); ?>" alt="" loading="lazy">
				<div class="pc-pillar__body">
					<div class="pc-pillar__icon"><?php echo $ic_shield; // phpcs:ignore ?></div>
					<h3 style="font-size:1.2rem;margin-bottom:4px;">Ohio: the Licensed Title Agent</h3>
					<p style="color:var(--wp-red);font-weight:700;font-size:0.8rem;letter-spacing:0.05em;margin-bottom:10px;">LICENSED BY THE OHIO DEPARTMENT OF INSURANCE</p>
					<p style="color:var(--wp-gray);font-size:0.93rem;">A title insurance agent runs your Ohio closing: they hold funds in a regulated escrow account, search Franklin, Cuyahoga or your county records for liens, prepare the deed, and disburse under the Ohio good-funds statute, R.C. 1349.21, which forbids paying anyone until the money has actually cleared.</p>
					<ul style="list-style:none;margin:12px 0 0;padding:0;">
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Holds: earnest money, purchase funds, signed deed</li>
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Insured by: agency E&amp;O policy plus the national title underwriter behind the policy</li>
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Verify them: license search at <a href="https://insurance.ohio.gov" target="_blank" rel="noopener noreferrer">insurance.ohio.gov</a></li>
					</ul>
				</div>
			</div>

			<div class="card pc-pillar animate-on-scroll" style="transition-delay:0.08s;">
				<img src="<?php echo esc_url( $theme_img . 'house-luxury.jpg' ); ?>" alt="" loading="lazy">
				<div class="pc-pillar__body">
					<div class="pc-pillar__icon"><?php echo $ic_shield; // phpcs:ignore ?></div>
					<h3 style="font-size:1.2rem;margin-bottom:4px;">Texas: the Licensed Escrow Officer</h3>
					<p style="color:var(--wp-red);font-weight:700;font-size:0.8rem;letter-spacing:0.05em;margin-bottom:10px;">LICENSED BY THE TEXAS DEPARTMENT OF INSURANCE</p>
					<p style="color:var(--wp-gray);font-size:0.93rem;">Texas runs the strictest title regime in the country: rates and policy forms are set by the state itself, and every escrow officer holds an individual TDI license. Your Harris, Dallas or Bexar county closing is handled by that named officer inside a licensed title agency, with your file number on every dollar.</p>
					<ul style="list-style:none;margin:12px 0 0;padding:0;">
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Holds: escrowed deposits, cleared purchase funds, documents</li>
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Insured by: statutory bonding, agency E&amp;O, state-regulated underwriters</li>
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Verify them: agent lookup at <a href="https://www.tdi.texas.gov" target="_blank" rel="noopener noreferrer">tdi.texas.gov</a></li>
					</ul>
				</div>
			</div>

			<div class="card pc-pillar animate-on-scroll" style="transition-delay:0.16s;">
				<img src="<?php echo esc_url( $theme_img . 'house-brick.jpg' ); ?>" alt="" loading="lazy">
				<div class="pc-pillar__body">
					<div class="pc-pillar__icon"><?php echo $ic_shield; // phpcs:ignore ?></div>
					<h3 style="font-size:1.2rem;margin-bottom:4px;">Georgia: the Closing Attorney</h3>
					<p style="color:var(--wp-red);font-weight:700;font-size:0.8rem;letter-spacing:0.05em;margin-bottom:10px;">MEMBER OF THE STATE BAR OF GEORGIA, REQUIRED BY LAW</p>
					<p style="color:var(--wp-gray);font-size:0.93rem;">Georgia goes one step further than most states: a licensed attorney must supervise every real estate closing, and the State Bar enforces this as the unauthorized practice of law. Your Fulton, DeKalb or Chatham county closing attorney owes you professional duties on top of escrow duties, with a law license on the line.</p>
					<ul style="list-style:none;margin:12px 0 0;padding:0;">
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Holds: all funds in an attorney trust (IOLTA) account, all documents</li>
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Insured by: malpractice coverage, bar client-protection mechanisms, title underwriter</li>
						<li style="display:flex;gap:8px;align-items:flex-start;padding:5px 0;font-size:0.88rem;color:#334155;"><span style="color:#22c55e;flex-shrink:0;"><?php echo $ic_check; // phpcs:ignore ?></span>Verify them: member directory at <a href="https://www.gabar.org" target="_blank" rel="noopener noreferrer">gabar.org</a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- ━━ THE INSURANCE STACK ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="ea-stack-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:center;">
			<div>
				<p class="section-header__eyebrow">FOUR LAYERS DEEP</p>
				<h2 id="ea-stack-heading" style="margin-bottom:var(--space-md);">The Insurance Stack Behind Your Agent</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">Escrow agents are not trusted because they seem nice. They are trusted because four independent layers of protection stand behind them, and each layer has its own money at stake if something goes wrong.</p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">Most local title agencies also write their policies on behalf of large national underwriters, the companies of the scale of First American, Fidelity National, Old Republic and Stewart, which is why a policy issued by a small-town Ohio agency carries national financial backing. The American Land Title Association maintains a national registry of verified title agents at <a href="https://www.alta.org" target="_blank" rel="noopener noreferrer">alta.org</a>.</p>
				<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline">Ask Us Who Will Hold Your File &rarr;</a>
			</div>
			<div>
				<?php
				$stack = array(
					array( '1', 'The license', 'State-issued, individually held, revocable. Losing it ends the career.' ),
					array( '2', 'The bond and E&amp;O insurance', 'State-required coverage that pays for errors and misconduct.' ),
					array( '3', 'The title underwriter', 'The national insurer behind every policy, auditing the agents who issue for them.' ),
					array( '4', 'The regulator and the courts', 'Departments of insurance, the Georgia Bar, and public county records over all of it.' ),
				);
				foreach ( $stack as $i => $st ) : ?>
				<div class="card" style="padding:18px 22px;margin-bottom:12px;display:flex;gap:16px;align-items:flex-start;">
					<div style="flex-shrink:0;width:40px;height:40px;border-radius:50%;background:var(--wp-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;"><?php echo esc_html( $st[0] ); ?></div>
					<div>
						<h3 style="font-size:1rem;margin-bottom:3px;"><?php echo $st[1]; // phpcs:ignore ?></h3>
						<p style="color:var(--wp-gray);font-size:0.9rem;margin:0;"><?php echo esc_html( $st[2] ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- ━━ OUR PROMISE ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="ea-promise-heading">
	<div class="container text-center" style="max-width:780px;">
		<h2 id="ea-promise-heading" style="margin-bottom:var(--space-md);">We Name Your Agent Before You Sign Anything</h2>
		<p style="color:var(--wp-gray);margin-bottom:var(--space-lg);">On every transaction, seller side or buyer side, we tell you which title company or closing attorney holds the file, in writing, before any signature. Then we encourage you to run the two-minute license check above and call them directly. A company that closes clean has nothing to hide, and a customer who verified once trusts the whole process.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">I Am Selling: Get My Offer &rarr;</a>
			<a href="<?php echo esc_url( $inv_url ); ?>" class="btn btn--buyer btn--lg">I Am Buying: Join the List &rarr;</a>
		</div>
	</div>
</section>

<!-- ━━ FAQ ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="ea-faq-heading">
	<div class="container">
		<div class="section-header text-center">
			<h2 class="section-header__title" id="ea-faq-heading">Escrow Agent Questions, Answered Directly</h2>
		</div>
		<div class="faq-list narrow" role="list" style="max-width:760px;margin:0 auto;">
			<?php foreach ( $faqs as $i => $qa ) : ?>
			<div class="faq-item" role="listitem">
				<button class="faq-item__trigger js-faq-trigger" aria-expanded="false" aria-controls="ea-faq-<?php echo esc_attr( $i ); ?>">
					<span><?php echo esc_html( $qa[0] ); ?></span>
					<svg class="faq-item__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
				</button>
				<div class="faq-item__body" id="ea-faq-<?php echo esc_attr( $i ); ?>" hidden>
					<p><?php echo esc_html( $qa[1] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
