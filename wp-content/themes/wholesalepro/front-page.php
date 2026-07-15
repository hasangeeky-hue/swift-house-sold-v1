<?php
/**
 * Front Page Template
 *
 * @package WholesalePro
 */

get_header();

$company_name  = get_theme_mod( 'company_name', 'WholesalePro' );
$company_phone = get_theme_mod( 'company_phone', '(555) 000-0000' );
$phone_raw     = get_theme_mod( 'company_phone_raw', '5550000000' );
$sell_page     = get_page_by_path( 'sell-my-house-fast' );
$sell_url      = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
$deals_page    = get_page_by_path( 'browse-deals' );
$deals_url     = $deals_page ? get_permalink( $deals_page->ID ) : home_url( '/browse-deals' );
$how_page      = get_page_by_path( 'how-it-works' );
$how_url       = $how_page ? get_permalink( $how_page->ID ) : home_url( '/how-it-works' );
$about_page    = get_page_by_path( 'about-us' );
$about_url     = $about_page ? get_permalink( $about_page->ID ) : home_url( '/about-us' );
?>

<!-- ━━ HERO ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="hero hero--split" aria-labelledby="hero-heading">
	<div class="hero__bg" aria-hidden="true"></div>
	<div class="container">
		<div class="hero__inner">
			<div class="hero__content">
				<p class="hero__eyebrow animate-on-scroll">
					TRUSTED CASH HOME BUYERS &mdash; ALL 50 STATES
				</p>
				<h1 class="hero__title animate-on-scroll" id="hero-heading" style="transition-delay:0.1s">
					Sell Your House For Cash, Exactly As It Is
				</h1>
				<p class="hero__subtitle animate-on-scroll" style="transition-delay:0.2s">
					No repairs. No agent commissions. No waiting three months for a buyer who might back out. Get a fair written cash offer within 24 hours and close on a date that works for your life.
				</p>
				<div class="hero__actions animate-on-scroll" style="transition-delay:0.3s">
					<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">
						Get My Free Cash Offer
					</a>
					<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline-white btn--lg">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.82 12a19.79 19.79 0 01-3.07-8.67A2 2 0 013.73 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.91 8.91a16 16 0 006.18 6.18l1.09-1.09a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
						<?php echo esc_html( $company_phone ); ?>
					</a>
				</div>
				<p class="animate-on-scroll" style="transition-delay:0.4s;color:rgba(255,255,255,0.85);font-size:0.9rem;margin-top:var(--space-md);">
					&#9733;&#9733;&#9733;&#9733;&#9733; Rated 4.9 by 500+ homeowners
				</p>
			</div>
			<div class="hero__form-wrap animate-on-scroll" style="transition-delay:0.2s">
				<div class="hero__form-card">
					<h2 class="hero__form-card__heading">Get Your Free Cash Offer</h2>
					<p class="hero__form-card__sub">Takes less than 2 minutes. No obligation.</p>
					<?php echo wholesalepro_render_seller_form( 'hero' ); // phpcs:ignore ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ━━ TRUST BAR ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<?php echo wholesalepro_get_trust_bar(); // phpcs:ignore ?>

<!-- ━━ COUNTERS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="stats-heading">
	<div class="container">
		<h2 class="sr-only" id="stats-heading">Our Track Record</h2>
		<div class="grid grid-4" style="gap:var(--space-lg);">
			<?php
			$stats = array(
				array( 'value' => '500', 'suffix' => '+', 'label' => 'Deals Closed',        'icon' => '🏠' ),
				array( 'value' => '50',  'suffix' => '',  'label' => 'States Covered',       'icon' => '🗺️' ),
				array( 'value' => '4.9', 'suffix' => '★', 'label' => 'Average Rating',       'icon' => '⭐' ),
				array( 'value' => '14',  'suffix' => '',  'label' => 'Day Average Close',     'icon' => '⚡' ),
			);
			foreach ( $stats as $i => $stat ) : ?>
			<div class="text-center animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s">
				<div style="font-size:2.5rem;margin-bottom:var(--space-xs);" aria-hidden="true"><?php echo $stat['icon']; // phpcs:ignore ?></div>
				<div class="counter-value" style="font-size:clamp(2.5rem,5vw,3.5rem);font-weight:800;color:var(--wp-navy);font-family:var(--font-heading);" data-target="<?php echo esc_attr( $stat['value'] ); ?>" data-suffix="<?php echo esc_attr( $stat['suffix'] ); ?>">
					<?php echo esc_html( $stat['value'] . $stat['suffix'] ); ?>
				</div>
				<p style="color:var(--wp-gray);font-weight:500;margin:0;"><?php echo esc_html( $stat['label'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ STORY ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="story-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:center;">
			<div class="animate-on-scroll">
				<p class="section-header__eyebrow">OUR STORY</p>
				<h2 id="story-heading" style="margin-bottom:var(--space-lg);">We Are Not Your Typical Real Estate Company</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">
					Most real estate companies see a transaction when they look at your home. A number on a spreadsheet. A file in a system. WholesalePro was built on a different belief — that behind every distressed property is a real person dealing with a real situation that deserves more than a formulaic process and a lowball offer.
				</p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">
					We operate across all 50 states, covering every county in America through a combination of proprietary data technology and genuine human expertise. Our system finds motivated sellers before they even begin searching for solutions. Our team ensures every seller receives a fair offer, clear communication, and a closing experience that feels nothing like the stress that preceded it.
				</p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
					For investors, we bring something more valuable than deals — we bring certainty. Every property in our pipeline has verified numbers, a committed seller, and a title process already underway. You spend your time evaluating and closing deals. We handle everything that comes before.
				</p>
				<a href="<?php echo esc_url( $about_url ); ?>" class="btn btn--outline btn--lg">Learn Our Story &rarr;</a>
			</div>
			<div class="animate-on-scroll" style="transition-delay:0.2s;">
				<div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-md);">
					<?php
					$pillars = array(
						array( '🤝', 'Integrity First',        'We show you every number we use to arrive at your offer.' ),
						array( '⚡', 'One-Hour Response',      'Real people respond within 60 minutes, day or evening.' ),
						array( '💰', 'Zero Fees, Ever',        'No commissions, no closing costs, nothing deducted.' ),
						array( '🗺️', 'All 50 States',         'Every county in America. Any situation.' ),
					);
					foreach ( $pillars as $p ) : ?>
					<div class="card" style="padding:var(--space-lg);text-align:center;">
						<div style="font-size:2rem;margin-bottom:var(--space-sm);" aria-hidden="true"><?php echo $p[0]; // phpcs:ignore ?></div>
						<h3 style="font-size:1rem;margin-bottom:6px;"><?php echo esc_html( $p[1] ); ?></h3>
						<p style="color:var(--wp-gray);font-size:0.875rem;margin:0;"><?php echo esc_html( $p[2] ); ?></p>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ━━ SELLER VALUE SECTION ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="seller-value-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:start;">
			<div class="animate-on-scroll">
				<p class="section-header__eyebrow">FOR HOMEOWNERS</p>
				<h2 id="seller-value-heading" style="margin-bottom:var(--space-md);">Is Your Property Becoming a Burden?</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
					You are not alone. Every month, thousands of homeowners across America find themselves in a situation where their property creates more stress than value. Whatever your circumstances, there is a straightforward path forward.
				</p>
				<ul class="checklist" style="margin-bottom:var(--space-xl);">
					<li class="checklist__item checklist__item--check">You have missed mortgage payments and foreclosure feels like it is getting closer</li>
					<li class="checklist__item checklist__item--check">A divorce means both parties need to sell and move forward separately</li>
					<li class="checklist__item checklist__item--check">You inherited a property you cannot afford to repair, manage, or maintain</li>
					<li class="checklist__item checklist__item--check">Your tenants have left the property in poor condition and you are exhausted</li>
					<li class="checklist__item checklist__item--check">You need to relocate for work or family and cannot wait 90 days for a buyer</li>
					<li class="checklist__item checklist__item--check">The property needs significant repairs that you simply cannot afford to make</li>
				</ul>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
					We have helped homeowners in every one of these situations sell quickly, fairly, and without the complexity of the traditional process. Get a free, no-obligation cash offer today.
				</p>
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Free Cash Offer</a>
			</div>
			<div class="animate-on-scroll" style="transition-delay:0.2s;">
				<p class="section-header__eyebrow">FOR INVESTORS</p>
				<h2 style="margin-bottom:var(--space-md);">Stop Receiving Deals That Are Already Gone</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
					The best wholesale deals in any market disappear within 48 hours. If you are not in the right network, you are always seeing opportunities that already have a buyer. Our network gives you access before the wider market sees it.
				</p>
				<ul class="checklist" style="margin-bottom:var(--space-xl);">
					<li class="checklist__item checklist__item--check">Exclusive off-market properties sourced before they appear on any public platform</li>
					<li class="checklist__item checklist__item--check">Every deal pre-analyzed with ARV verified from the last 90 days of comparable sales</li>
					<li class="checklist__item checklist__item--check">Repair estimates provided so your numbers are ready before you even make a call</li>
					<li class="checklist__item checklist__item--check">Seller commitment confirmed — no chasing people who are not serious about selling</li>
					<li class="checklist__item checklist__item--check">All 50 states covered — wherever you invest, we have a pipeline there</li>
					<li class="checklist__item checklist__item--check">JV partnership available on any deal in our current inventory</li>
				</ul>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
					Join over 5,000 investors who receive exclusive deal alerts matched to their exact buying criteria. Free to join. No spam. Only relevant opportunities.
				</p>
				<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">Join the Buyer Network &rarr;</a>
			</div>
		</div>
	</div>
</section>

<!-- ━━ HOW IT WORKS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="hiw-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow">SIMPLE PROCESS</p>
			<h2 class="section-header__title" id="hiw-heading">From Inquiry to Cash in Three Steps</h2>
		</div>

		<div class="grid grid-2" style="gap:var(--space-3xl);margin-top:var(--space-2xl);">

			<div>
				<h3 style="margin-bottom:var(--space-xl);color:var(--wp-red);font-size:1rem;text-transform:uppercase;letter-spacing:0.08em;">For Sellers</h3>
				<?php
				$seller_steps = array(
					array(
						'num'   => '1',
						'title' => 'Share Your Situation With Us',
						'body'  => 'Fill out our simple property form online — it takes under two minutes — or call us directly at any hour. A member of our team contacts you within one hour. There is no obligation and your information remains completely confidential. We never share your details with anyone under any circumstances.',
					),
					array(
						'num'   => '2',
						'title' => 'Receive Your Fair Written Cash Offer',
						'body'  => 'Within 24 hours of your inquiry, we research recent comparable sales in your neighborhood, assess the condition of your property from the information you provide, and present you with a fair written cash offer. We walk you through every number on a call if you would like. No pressure. No tactics. Just honest numbers.',
					),
					array(
						'num'   => '3',
						'title' => 'Close on a Date That Works For You',
						'body'  => 'You decide if our offer works for you, completely on your own timeline. If you accept, you choose the closing date. We can close in as few as seven days or give you up to 60 days to make your arrangements. On closing day, you sign, hand over the keys, and receive your funds by wire transfer.',
					),
				);
				foreach ( $seller_steps as $i => $step ) : ?>
				<div class="animate-on-scroll" style="display:flex;gap:var(--space-lg);margin-bottom:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s">
					<div style="width:48px;height:48px;border-radius:50%;background:var(--wp-red);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.25rem;flex-shrink:0;"><?php echo esc_html( $step['num'] ); ?></div>
					<div>
						<h4 style="margin-bottom:6px;"><?php echo esc_html( $step['title'] ); ?></h4>
						<p style="color:var(--wp-gray);margin:0;"><?php echo esc_html( $step['body'] ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller">Start Your Offer Now</a>
			</div>

			<div>
				<h3 style="margin-bottom:var(--space-xl);color:var(--wp-green);font-size:1rem;text-transform:uppercase;letter-spacing:0.08em;">For Investors</h3>
				<?php
				$buyer_steps = array(
					array(
						'num'   => '1',
						'title' => 'Join Our Investor Network',
						'body'  => 'Register free in under two minutes. Tell us your exact buying criteria — which states you operate in, your price range, the property types you prefer, and how quickly you can close. We use this profile to match deals specifically to your requirements. You receive only deals that match your criteria.',
					),
					array(
						'num'   => '2',
						'title' => 'Receive Matched Deal Alerts',
						'body'  => 'The moment a deal matching your profile becomes available, you receive an alert with the key numbers immediately. Every alert includes the asking price, ARV from verified comparable sales, estimated repair costs, and potential profit. You review the complete deal package online before speaking to anyone.',
					),
					array(
						'num'   => '3',
						'title' => 'Analyze, Offer, and Close Fast',
						'body'  => 'Submit your offer through our platform. Title work is already underway on every deal we present, so there are no weeks of waiting for basic paperwork. Our average time from accepted offer to closing is 12 days. JV partnership structures are available on any deal in our inventory.',
					),
				);
				foreach ( $buyer_steps as $i => $step ) : ?>
				<div class="animate-on-scroll" style="display:flex;gap:var(--space-lg);margin-bottom:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s">
					<div style="width:48px;height:48px;border-radius:50%;background:var(--wp-green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.25rem;flex-shrink:0;"><?php echo esc_html( $step['num'] ); ?></div>
					<div>
						<h4 style="margin-bottom:6px;"><?php echo esc_html( $step['title'] ); ?></h4>
						<p style="color:var(--wp-gray);margin:0;"><?php echo esc_html( $step['body'] ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
				<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer">Join Free &rarr;</a>
			</div>

		</div>
	</div>
</section>

<!-- ━━ SUCCESS STORIES ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--navy" aria-labelledby="stories-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow" style="color:var(--wp-gold);">REAL RESULTS</p>
			<h2 class="section-header__title" id="stories-heading" style="color:#fff;">What Happens When People Call Us</h2>
		</div>

		<div class="grid grid-3" style="gap:var(--space-lg);margin-top:var(--space-2xl);">

			<article class="card animate-on-scroll" style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);color:#fff;" aria-label="Success story: James">
				<span class="badge badge--gold" style="margin-bottom:var(--space-md);">FORECLOSURE RESCUE</span>
				<h3 style="color:#fff;margin-bottom:var(--space-md);">How James Protected His Credit Score and Walked Away With $52,000 Cash</h3>
				<p style="color:rgba(255,255,255,0.8);font-size:0.9rem;margin-bottom:var(--space-md);">
					James was a warehouse worker in Dallas who had missed four consecutive mortgage payments after a medical emergency left him unable to work for three months. His lender had filed a Notice of Default and he had 47 days before the foreclosure sale date. He found WholesalePro through a Google search at 11pm on a Tuesday night. We called him within the hour, made a written cash offer within 24 hours, and sat at the title company table within 16 days of his first contact. James received $52,000 in cash — enough to pay his medical bills, secure a new rental, and begin rebuilding. His credit report shows no foreclosure record.
				</p>
				<blockquote style="border-left:3px solid var(--wp-gold);padding-left:var(--space-md);margin-bottom:var(--space-md);">
					<p style="color:rgba(255,255,255,0.9);font-style:italic;font-size:0.9rem;margin:0;">"I did not think there was a way out of this. They called me the same night, explained everything clearly, and did exactly what they said they would do."</p>
				</blockquote>
				<p style="color:var(--wp-gold);font-size:0.875rem;font-weight:600;">James M. &mdash; Dallas, TX</p>
				<p style="color:rgba(255,255,255,0.6);font-size:0.8rem;margin-top:var(--space-sm);">Closed in 16 days &bull; $52,000 received &bull; Credit score protected</p>
			</article>

			<article class="card animate-on-scroll" style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);color:#fff;transition-delay:0.1s" aria-label="Success story: Williams Family">
				<span class="badge badge--gold" style="margin-bottom:var(--space-md);">PROBATE &amp; ESTATE SALE</span>
				<h3 style="color:#fff;margin-bottom:var(--space-md);">Three Siblings Finally Resolved Their Parents' Estate Without a Single Conflict</h3>
				<p style="color:rgba(255,255,255,0.8);font-size:0.9rem;margin-bottom:var(--space-md);">
					When both parents passed within six months of each other, their three adult children living in different states inherited a Cincinnati home that none of them could agree on what to do with. The property needed roof replacement, had outdated electrical, and had not been updated since 1987. WholesalePro made a single cash offer for the property exactly as it sat. One offer. One closing. Three equal distributions wired on the same afternoon. All three siblings received their share within 28 days of our first call. No repairs. No arguments. No legal complications.
				</p>
				<blockquote style="border-left:3px solid var(--wp-gold);padding-left:var(--space-md);margin-bottom:var(--space-md);">
					<p style="color:rgba(255,255,255,0.9);font-style:italic;font-size:0.9rem;margin:0;">"Our relationship as siblings was being damaged by the stress of this house. WholesalePro removed the problem and put money in all of our accounts."</p>
				</blockquote>
				<p style="color:var(--wp-gold);font-size:0.875rem;font-weight:600;">The Williams Family &mdash; Cincinnati, OH</p>
				<p style="color:rgba(255,255,255,0.6);font-size:0.8rem;margin-top:var(--space-sm);">Closed in 28 days &bull; Three siblings paid simultaneously &bull; Zero repairs required</p>
			</article>

			<article class="card animate-on-scroll" style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);color:#fff;transition-delay:0.2s" aria-label="Success story: Patricia">
				<span class="badge badge--gold" style="margin-bottom:var(--space-md);">LANDLORD EXIT STRATEGY</span>
				<h3 style="color:#fff;margin-bottom:var(--space-md);">After 14 Years as a Landlord, Patricia Finally Got Her Retirement Back</h3>
				<p style="color:rgba(255,255,255,0.8);font-size:0.9rem;margin-bottom:var(--space-md);">
					Patricia had owned two Atlanta rental properties for 14 years. She was 61 years old, exhausted by maintenance calls, and had just spent $8,000 repairing damage from tenants who left without notice. She believed she would need to wait for vacancies before she could sell. WholesalePro purchased both properties simultaneously in a single transaction, handled the tenant transitions independently, and closed both properties within 24 days. Patricia received funds for both properties and booked the Portugal trip she had been delaying for a decade.
				</p>
				<blockquote style="border-left:3px solid var(--wp-gold);padding-left:var(--space-md);margin-bottom:var(--space-md);">
					<p style="color:rgba(255,255,255,0.9);font-style:italic;font-size:0.9rem;margin:0;">"I did not know I could sell both properties with tenants still inside. They managed everything and I never had to make another maintenance call."</p>
				</blockquote>
				<p style="color:var(--wp-gold);font-size:0.875rem;font-weight:600;">Patricia O. &mdash; Atlanta, GA</p>
				<p style="color:rgba(255,255,255,0.6);font-size:0.8rem;margin-top:var(--space-sm);">Both properties sold together &bull; Closed in 24 days &bull; Retirement trip booked</p>
			</article>

		</div>
	</div>
</section>

<!-- ━━ TESTIMONIALS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="testimonials-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow">REAL HOMEOWNERS</p>
			<h2 class="section-header__title" id="testimonials-heading">Don&#8217;t Just Take Our Word For It</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);margin-top:var(--space-xl);">
			<?php
			$testimonials = array(
				array(
					'quote'    => 'I needed to sell quickly after a divorce. They gave me a fair offer within 24 hours and we closed in 10 days. The whole process was completely stress-free when everything else in my life felt impossible.',
					'name'     => 'Sarah M.',
					'location' => 'Phoenix, AZ',
					'rating'   => 5,
				),
				array(
					'quote'    => 'My house needed a new roof, foundation repairs, and the electrical was a disaster. No traditional buyer would touch it. These guys bought it as-is for a fair price and paid cash in two weeks. An absolute lifesaver.',
					'name'     => 'James R.',
					'location' => 'Atlanta, GA',
					'rating'   => 5,
				),
				array(
					'quote'    => 'Facing foreclosure, I called on a Monday and had a signed contract by Wednesday. The offer was fair, the process was clear, and they did exactly what they said they would do. Professional and honest from start to finish.',
					'name'     => 'Linda K.',
					'location' => 'Houston, TX',
					'rating'   => 5,
				),
			);
			foreach ( $testimonials as $i => $t ) : ?>
			<article class="testimonial-card animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s" aria-label="Testimonial from <?php echo esc_attr( $t['name'] ); ?>">
				<div class="testimonial-card__stars" aria-label="<?php echo esc_attr( $t['rating'] ); ?> out of 5 stars">
					<?php echo wholesalepro_get_star_rating( $t['rating'] ); // phpcs:ignore ?>
				</div>
				<blockquote class="testimonial-card__quote"><p>"<?php echo esc_html( $t['quote'] ); ?>"</p></blockquote>
				<footer class="testimonial-card__footer">
					<strong class="testimonial-card__name"><?php echo esc_html( $t['name'] ); ?></strong>
					<span class="testimonial-card__location"><?php echo esc_html( $t['location'] ); ?></span>
				</footer>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ FEATURED DEALS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<?php
$featured_deals = new WP_Query( array(
	'post_type'      => 'property',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'meta_query'     => array( array( 'key' => '_deal_status', 'value' => 'available' ) ),
	'orderby'        => 'date',
	'order'          => 'DESC',
) );
if ( $featured_deals->have_posts() ) : ?>
<section class="section bg--light-gray" aria-labelledby="deals-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow">CURRENT OPPORTUNITIES</p>
			<h2 class="section-header__title" id="deals-heading">Available Deals Right Now</h2>
			<p class="section-header__subtitle">Every property pre-analyzed. Seller committed. Numbers verified. New deals added to our network daily.</p>
			<p style="color:var(--wp-red);font-weight:600;margin-top:var(--space-sm);">&#9889; Serious buyers typically respond within 24 hours on our best deals.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);margin-top:var(--space-xl);">
			<?php while ( $featured_deals->have_posts() ) : $featured_deals->the_post(); ?>
				<?php echo wholesalepro_get_property_card( get_the_ID() ); // phpcs:ignore ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div class="text-center" style="margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">View All Available Deals &rarr;</a>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ━━ SITUATIONS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="situations-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="situations-heading">We Buy Houses in Any Situation</h2>
		</div>
		<div class="grid grid-4" style="gap:var(--space-md);margin-top:var(--space-xl);">
			<?php
			$situations = array(
				array( '🏚️', 'Inherited Property' ), array( '⚡', 'Facing Foreclosure' ),
				array( '💔', 'Divorce or Separation' ), array( '🔧', 'Major Repairs Needed' ),
				array( '📦', 'Relocating Out of State' ), array( '💸', 'Behind on Payments' ),
				array( '👴', 'Downsizing or Retiring' ), array( '🏘️', 'Vacant or Abandoned' ),
			);
			foreach ( $situations as $i => $s ) : ?>
			<div class="animate-on-scroll text-center" style="transition-delay:<?php echo esc_attr( $i * 0.06 ); ?>s;padding:var(--space-lg);background:var(--wp-light-gray);border-radius:var(--radius-lg);">
				<div style="font-size:2rem;margin-bottom:var(--space-sm);" aria-hidden="true"><?php echo $s[0]; // phpcs:ignore ?></div>
				<p style="font-weight:600;color:var(--wp-navy);margin:0;"><?php echo esc_html( $s[1] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="text-center" style="margin-top:var(--space-2xl);">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Cash Offer &mdash; Whatever My Situation</a>
		</div>
	</div>
</section>

<!-- ━━ COMPARISON TABLE ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="compare-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="compare-heading">Why Sell to Us vs. Listing With an Agent?</h2>
			<p class="section-header__subtitle">Before you decide how to sell, see how your options compare. These numbers represent the real difference for a motivated seller.</p>
		</div>
		<div class="animate-on-scroll" style="margin-top:var(--space-xl);overflow-x:auto;">
			<table class="comparison-table" style="width:100%;border-collapse:collapse;">
				<caption class="sr-only">Comparison of selling to WholesalePro vs. using a traditional agent</caption>
				<thead>
					<tr>
						<th>Factor</th>
						<th class="comparison-table__us">WholesalePro Cash Sale</th>
						<th>Traditional Agent Listing</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$rows = array(
						array( 'Closing Time',              'As fast as 7 days',          '60 to 90+ days' ),
						array( 'Commissions & Fees',        'Zero — nothing deducted',    '5 to 6 percent of sale price' ),
						array( 'Repairs Required',          'None — buy as-is',           'Often extensive, buyer-requested' ),
						array( 'Showings & Open Houses',    'No disruption to your life', 'Multiple strangers through your home' ),
						array( 'Deal Certainty',            'Guaranteed cash close',      'Financing can fall through at any time' ),
						array( 'Closing Cost Assistance',   'We pay all closing costs',   'Negotiated — often seller pays' ),
						array( 'Your Time Investment',      'Under 30 minutes total',     'Weeks of preparation and waiting' ),
					);
					foreach ( $rows as $row ) : ?>
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

<!-- ━━ COVERAGE ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--navy" aria-labelledby="coverage-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow" style="color:var(--wp-gold);">NATIONWIDE COVERAGE</p>
			<h2 class="section-header__title" id="coverage-heading" style="color:#fff;">We Buy Houses In Every State, Every County, Every City</h2>
			<p class="section-header__subtitle" style="color:rgba(255,255,255,0.8);">From the coastal markets of Florida to the industrial heartland of Ohio. From the growing suburbs of Texas to the rural communities of Montana. Our buyer network and data infrastructure covers every corner of the United States and refreshes daily.</p>
		</div>
		<div class="coverage-map-wrap animate-on-scroll" id="coverage-map" style="transition-delay:0.2s;">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/us-map.svg"
				 alt="WholesalePro coverage map — we buy houses in all 50 states"
				 width="960" height="620"
				 loading="lazy"
				 style="width:100%;height:auto;display:block;">
		</div>
		<div style="margin-top:var(--space-xl);text-align:center;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Start My Cash Offer</a>
		</div>
	</div>
</section>

<!-- ━━ BLOG ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<?php
$recent_posts = new WP_Query( array( 'posts_per_page' => 3, 'post_status' => 'publish' ) );
if ( $recent_posts->have_posts() ) : ?>
<section class="section" aria-labelledby="blog-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow">KNOWLEDGE CENTER</p>
			<h2 class="section-header__title" id="blog-heading">Free Guides for Sellers and Investors</h2>
			<p class="section-header__subtitle">Whether you are a homeowner exploring your options or an investor building your portfolio, our resource library gives you the knowledge to make confident decisions.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);margin-top:var(--space-xl);">
			<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card animate-on-scroll' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="blog-card__image">
					<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
						<?php the_post_thumbnail( 'wholesalepro-card', array( 'loading' => 'lazy' ) ); ?>
					</a>
				</div>
				<?php endif; ?>
				<div class="blog-card__body">
					<h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="blog-card__excerpt"><?php the_excerpt(); ?></p>
					<div class="blog-card__footer">
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
						<a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--sm">Read More &rarr;</a>
					</div>
				</div>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ━━ FINAL CTA ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="cta-grid-heading">
	<div class="container">
		<h2 class="sr-only" id="cta-grid-heading">Get Started</h2>
		<div class="grid grid-2" style="gap:var(--space-2xl);">

			<div class="card animate-on-scroll" style="padding:var(--space-2xl);border-top:4px solid var(--wp-red);">
				<h3 style="margin-bottom:var(--space-md);">Your Property Problem Has a Solution</h3>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
					Every day you remain in a difficult property situation costs you money, credit, and peace of mind. Whether you are facing foreclosure, navigating a divorce, dealing with an inherited property, or simply ready to stop being a landlord — we have helped thousands of homeowners in your exact situation find a fast, fair resolution. Get your free, no-obligation cash offer today. It takes 60 seconds.
				</p>
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg btn--full">Get My Free Cash Offer</a>
				<p style="font-size:0.8rem;color:var(--wp-gray);margin-top:var(--space-sm);text-align:center;">No repairs &bull; No commissions &bull; No obligation</p>
			</div>

			<div class="card animate-on-scroll" style="padding:var(--space-2xl);border-top:4px solid var(--wp-green);transition-delay:0.1s">
				<h3 style="margin-bottom:var(--space-md);">Your Next Best Deal Is In Our Network</h3>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
					Our system monitors all 3,143 counties in the United States daily, identifying motivated sellers before they begin searching for buyers. Every deal we present has been analyzed, numbers verified, and seller commitment confirmed. You spend your time evaluating and closing. Not searching and chasing. Join free and receive your first matched deal alert within 24 hours.
				</p>
				<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg btn--full">Join the Buyer Network Free</a>
				<p style="font-size:0.8rem;color:var(--wp-gray);margin-top:var(--space-sm);text-align:center;">5,000+ active investors &bull; Free forever &bull; Cancel anytime</p>
			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>
