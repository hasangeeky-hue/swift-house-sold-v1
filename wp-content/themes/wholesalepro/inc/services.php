<?php
/**
 * Service landing pages engine.
 * One config per target customer group; shared renderer with
 * AEO answer blocks, dynamic category-based guides, seller form.
 *
 * @package WholesalePro
 */

function shs_services_config() {
	return array(
		'sell-probate-property' => array(
			'menu'     => 'Probate / Inherited Property',
			'category' => 'probate',
			'eyebrow'  => 'PROBATE & INHERITED PROPERTY — OH · TX · GA',
			'title'    => 'Sell an Inherited or Probate Property Without the Burden',
			'answer'   => 'You can sell an inherited house as-is — belongings included, repairs ignored, from another state — usually as soon as the probate court grants the executor authority. We work with your estate attorney, buy the property exactly as it stands, and close on the timeline the estate needs.',
			'pains'    => array(
				array( 'The house is in another city or state', 'You never have to travel. Photos, documents and closing can all happen remotely — the title company handles signatures.' ),
				array( 'It is full of a lifetime of belongings', 'Take what matters to your family and leave the rest. We buy the house with everything in it.' ),
				array( 'Probate feels slow and confusing', 'We know the probate process in Ohio, Texas and Georgia courts and can time the sale to your case — often making an offer before probate even clears.' ),
				array( 'Family members disagree about what to do', 'A written cash offer gives everyone one concrete number to decide around, instead of months of listing debates.' ),
			),
			'faq'      => array(
				array( 'Can I sell before probate is finished?', 'Usually yes — once the court issues letters testamentary, the executor can sell. If the will grants power of sale, it can be even earlier. We can prepare the offer while you wait so no time is lost.' ),
				array( 'What about the mortgage on the inherited house?', 'It gets paid off at closing out of the sale price. If payments are behind, selling quickly protects the estate from foreclosure.' ),
				array( 'Do I pay taxes when I sell an inherited house?', 'Inherited property gets a stepped-up basis to its value at the date of death, so selling soon after inheriting usually means little or no capital gains tax. Confirm with a tax professional.' ),
			),
		),
		'stop-foreclosure' => array(
			'menu'     => 'Stop Foreclosure',
			'category' => 'foreclosure',
			'eyebrow'  => 'PRE-FORECLOSURE — ACT BEFORE THE SALE DATE',
			'title'    => 'Behind on Your Mortgage? Sell Before the Foreclosure Sale',
			'answer'   => 'You can stop a foreclosure by selling your house for cash before the auction — the loan is paid off at closing, the foreclosure ends, and you keep your remaining equity instead of losing it at the sheriff\'s sale. In Ohio, Texas and Georgia we can often close within 7–14 days.',
			'pains'    => array(
				array( 'The sale date is getting close', 'Cash closings take days, not months. Tell us your sale date and we will tell you honestly whether we can beat it.' ),
				array( 'You are afraid of losing your equity', 'At auction, houses sell for far below market value and fees eat the rest. A pre-auction sale protects what you have built.' ),
				array( 'A foreclosure would follow you for years', 'Foreclosure stays on your credit for 7 years and blocks most future mortgages. A completed sale does neither.' ),
				array( 'The bank is impossible to deal with', 'Once you have a signed contract, the title company handles the payoff with the bank directly. You stop being the go-between.' ),
			),
			'faq'      => array(
				array( 'How late is too late to sell?', 'In Ohio you can generally sell up to the court\'s confirmation of the sheriff\'s sale. In Texas and Georgia the timeline is shorter — weeks, not months — so act on the first notice, not the last.' ),
				array( 'What if I owe more than the house is worth?', 'A short sale may be possible with lender approval. Send us the numbers — we will tell you honestly what is achievable.' ),
				array( 'Will you lowball me because I am in trouble?', 'Our offer shows the comparable sales, repair estimate and our margin in writing. You can verify every number and walk away at zero cost.' ),
			),
		),
		'sell-house-divorce' => array(
			'menu'     => 'Divorce Home Sale',
			'category' => 'divorce',
			'eyebrow'  => 'DIVORCE — ONE CLEAN CLOSING, TWO FRESH STARTS',
			'title'    => 'Sell the House During Divorce — Fast, Neutral, Final',
			'answer'   => 'The fastest clean way to divide a house in divorce is a cash sale: one written offer both attorneys can review, no repairs to argue over, a closing date that fits the settlement, and proceeds wired separately to each party if instructed. Often done in under 3 weeks.',
			'pains'    => array(
				array( 'Every listing decision becomes a new argument', 'A single as-is cash offer removes months of joint decisions about agents, prices, repairs and buyers.' ),
				array( 'You both keep paying for a house nobody wants', 'Every month of listing costs mortgage, insurance and utilities. A fast close stops the bleeding for both sides.' ),
				array( 'You need clean numbers for the settlement', 'A written offer is an exact figure your attorneys can put straight into the agreement — no estimates, no contingencies that collapse.' ),
				array( 'You worry the buyer will back out mid-settlement', 'Cash means no financing contingency. When we sign, the deal closes.' ),
			),
			'faq'      => array(
				array( 'Do both spouses have to agree to sell?', 'If both names are on the deed, yes — both must sign. A neutral written offer is often what gets both sides to yes.' ),
				array( 'Can the proceeds be split at closing?', 'Yes. The title company can wire each party\'s share separately according to the settlement agreement or joint instruction.' ),
				array( 'What if the divorce is not final yet?', 'Houses are commonly sold during proceedings with both parties\' consent or a court order. Coordinate with your attorneys — we can time the closing to the case.' ),
			),
		),
		'sell-house-tax-liens' => array(
			'menu'     => 'Tax Liens & Back Taxes',
			'category' => 'tax-liens',
			'eyebrow'  => 'TAX LIENS · CODE VIOLATIONS · JUDGMENTS',
			'title'    => 'Sell a House With Tax Liens or Back Taxes — Liens Are Paid at Closing',
			'answer'   => 'A tax lien does not block the sale of your house. At closing, the title company pays the county directly out of the purchase price — you never write a check. This works for property tax debt, code violation fines, and most judgment liens in Ohio, Texas and Georgia.',
			'pains'    => array(
				array( 'The debt keeps growing every month', 'Texas penalties alone can reach 47% in year one. Every month of waiting transfers more of your equity to the county.' ),
				array( 'You are afraid the county will foreclose', 'Tax foreclosure moves faster than bank foreclosure, especially in Texas. Selling first keeps the equity in your hands.' ),
				array( 'You assume nobody will buy a liened house', 'We buy them routinely. Liens are a closing line-item, not a deal-breaker.' ),
				array( 'You cannot afford to pay the liens first', 'You do not have to. They come out of the sale price at closing.' ),
			),
			'faq'      => array(
				array( 'How do I find out exactly what I owe?', 'The county tax office provides a payoff statement — it is public record and we can help you pull it as part of preparing your offer.' ),
				array( 'What if the liens are more than the house value?', 'Rare, but options exist: penalty negotiations or structured sales with the county. The worst move is waiting until foreclosure wipes out the choice.' ),
				array( 'Do code violation fines work the same way?', 'Yes — municipal fines and most judgment liens are paid from the proceeds at closing, exactly like tax liens.' ),
			),
		),
		'sell-damaged-house' => array(
			'menu'     => 'House Needs Major Repairs',
			'category' => 'repairs',
			'eyebrow'  => 'AS-IS — ANY CONDITION, ZERO REPAIRS',
			'title'    => 'Sell a House That Needs Major Repairs — Without Spending a Dollar',
			'answer'   => 'You can sell a house needing major repairs completely as-is: no fixing, no cleaning, no inspections to pass. Foundation problems, fire or water damage, mold, ancient wiring — we price the work into a written offer and close in as little as 7 days.',
			'pains'    => array(
				array( 'Contractors quoted more than you can spend', 'Repair quotes routinely overrun 20–40%. Selling as-is means the renovation risk is our problem, priced honestly into the offer.' ),
				array( 'Retail buyers\' lenders reject the house', 'FHA and VA loans fail on bad roofs and foundations. Your real market is cash — and that is us.' ),
				array( 'You are embarrassed to show the house', 'Nobody stages anything for us. We have bought hoarder houses, fire damage and fifty years of deferred maintenance.' ),
				array( 'The house eats money every month it sits', 'Taxes, insurance and utilities on an unsellable house never stop. A 7-day close does.' ),
			),
			'faq'      => array(
				array( 'How do you price a damaged house?', 'Backward from the after-repair value: what it sells for fixed, minus true repair costs, minus our margin — all shown in writing. If any buyer will not show that math, walk away from them.' ),
				array( 'Do I need to clean out the house?', 'No. Take your documents and what you love; leave everything else, including furniture and junk.' ),
				array( 'Will you still buy if there is mold or fire damage?', 'Yes. Structural, environmental and cosmetic damage are all buyable — they change the number, not the answer.' ),
			),
		),
		'sell-rental-property' => array(
			'menu'     => 'Tired Landlord / Rental',
			'category' => 'landlord',
			'eyebrow'  => 'LANDLORDS — EXIT WITH TENANTS IN PLACE',
			'title'    => 'Tired Landlord? Sell Your Rental — Tenants and All',
			'answer'   => 'You can sell a rental property with tenants still in it — paying or not. We buy tenant-occupied properties as-is in Ohio, Texas and Georgia, take over the lease situation completely, and close on your schedule. No evictions to run, no make-ready repairs.',
			'pains'    => array(
				array( 'Tenants are not paying and eviction is expensive', 'Sell with the tenants in place. The occupancy situation becomes ours the day we close.' ),
				array( 'Every month brings another repair call', 'Stop funding a property that stopped paying you back. One closing ends the 2am phone calls.' ),
				array( 'You cannot show a unit a tenant lives in', 'We do not need showings, staging or tenant cooperation to make a written offer.' ),
				array( 'You are done with the whole business', 'Whether it is one door or a small portfolio, we can buy the lot and let you exit in weeks.' ),
			),
			'faq'      => array(
				array( 'Can you really buy with a non-paying tenant inside?', 'Yes. We price the occupancy situation into the offer and handle it after closing — legally and professionally.' ),
				array( 'What about the security deposits and leases?', 'Deposits and lease obligations transfer at closing per standard practice; the title company documents it. You are released going forward.' ),
				array( 'Do you buy multiple properties at once?', 'Yes — portfolio purchases are welcome and usually close on one coordinated date.' ),
			),
		),
	);
}

/**
 * Render a complete service landing page for the given service key.
 */
function shs_render_service_page( $key ) {
	$all = shs_services_config();
	if ( ! isset( $all[ $key ] ) ) {
		return;
	}
	$svc      = $all[ $key ];
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
						<h2 class="hero__form-card__heading">Get Your Free Cash Offer</h2>
						<p class="hero__form-card__sub">Takes less than 2 minutes. No obligation.</p>
						<?php echo wholesalepro_render_seller_form( 'service-' . $key ); // phpcs:ignore ?>
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
				<article class="card" style="padding:var(--space-xl);">
					<h3 style="font-size:1.05rem;margin-bottom:var(--space-sm);"><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a></h3>
					<p style="color:var(--wp-gray);font-size:0.92rem;"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
					<a href="<?php the_permalink(); ?>" style="font-weight:600;color:var(--wp-red);text-decoration:none;">Read Guide &rarr;</a>
				</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<section class="section bg--navy" aria-labelledby="svc-cta-heading">
		<div class="container text-center">
			<h2 id="svc-cta-heading" style="color:#fff;margin-bottom:var(--space-md);">Talk It Through With a Real Person First?</h2>
			<p style="color:rgba(255,255,255,0.8);max-width:560px;margin:0 auto var(--space-xl);">
				Book a free consultation — online or by phone. No pressure, no obligation. Or get your written cash offer right away.
			</p>
			<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
				<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Book a Free Consultation</a>
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Cash Offer &rarr;</a>
			</div>
		</div>
	</section>
	<?php
}
