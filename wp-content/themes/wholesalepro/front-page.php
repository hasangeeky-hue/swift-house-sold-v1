<?php
/**
 * Front Page Template, Swift House Sold
 * Pain-point-first, OH/TX/GA focused, AEO question-structured.
 *
 * @package WholesalePro
 */

get_header();

$company_name  = get_theme_mod( 'company_name', 'Swift House Sold' );
$company_phone = get_theme_mod( 'company_phone', '' );
$phone_raw     = get_theme_mod( 'company_phone_raw', '' );
$sell_page     = get_page_by_path( 'sell-my-house-fast' );
$sell_url      = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
$how_page      = get_page_by_path( 'how-it-works' );
$how_url       = $how_page ? get_permalink( $how_page->ID ) : home_url( '/how-it-works' );
$about_page    = get_page_by_path( 'about-us' );
$about_url     = $about_page ? get_permalink( $about_page->ID ) : home_url( '/about-us' );
$faq_page      = get_page_by_path( 'faq' );
$faq_url       = $faq_page ? get_permalink( $faq_page->ID ) : home_url( '/faq' );
$contact_page  = get_page_by_path( 'contact' );
$contact_url   = $contact_page ? get_permalink( $contact_page->ID ) : home_url( '/contact' );
$compare_page  = get_page_by_path( 'cash-sale-vs-listing' );
$compare_url   = $compare_page ? get_permalink( $compare_page->ID ) : home_url( '/cash-sale-vs-listing' );
?>

<!-- ━━ HERO ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="hero hero--split" aria-labelledby="hero-heading">
	<div class="hero__bg" aria-hidden="true"></div>
	<div class="container">
		<div class="hero__inner">
			<div class="hero__content">
				<p class="hero__eyebrow animate-on-scroll">
					CASH HOME BUYERS, OHIO &middot; TEXAS &middot; GEORGIA
				</p>
				<h1 class="hero__title animate-on-scroll" id="hero-heading" style="transition-delay:0.1s">
					<?php echo esc_html( get_theme_mod( 'shs_hero_title', 'Sell Your House Fast For Cash, Like a Rocket' ) ); ?>
				</h1>
				<p class="hero__subtitle animate-on-scroll" style="transition-delay:0.2s">
					<?php echo esc_html( get_theme_mod( 'shs_hero_subtitle', "Behind on the mortgage? Inherited a house you can't keep up? Divorce forcing a sale? We buy houses in any condition across Ohio, Texas and Georgia. Written cash offer within 24 hours, no repairs, no commissions, no waiting." ) ); ?>
				</p>
				<div class="hero__actions animate-on-scroll" style="transition-delay:0.3s">
					<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">
						<?php echo esc_html( get_theme_mod( 'shs_hero_cta', 'Get My Free Cash Offer' ) ); ?>
					</a>
					<a href="<?php echo esc_url( $how_url ); ?>" class="btn btn--outline-white btn--lg">
						See How It Works
					</a>
				</div>
				<p class="animate-on-scroll" style="transition-delay:0.4s;color:rgba(255,255,255,0.85);font-size:0.9rem;margin-top:var(--space-md);">
					No obligation &bull; No fees &bull; You choose the closing date
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

<!-- ━━ SITUATIONS (PAIN POINTS) ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="situations-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">WE SPECIALIZE IN DIFFICULT SITUATIONS</p>
			<h2 class="section-header__title" id="situations-heading">Whatever You're Facing, We've Helped Someone Through It</h2>
			<p class="section-header__subtitle">A traditional listing works for a normal sale. These situations are not normal sales, they need speed, certainty and zero out-of-pocket cost.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$situations = array(
				array( '⏰', 'Behind on Mortgage / Foreclosure', 'Once the bank files, the clock moves fast. In many cases we can close before the sheriff\'s sale and you walk away with cash instead of a foreclosure on your record.' ),
				array( '🏠', 'Inherited or Probate Property', 'A house you didn\'t ask for, in another city, full of belongings. We work with your estate attorney, buy as-is, and you never have to clean it out.' ),
				array( '⚖️', 'Divorce, Need a Clean, Fast Split', 'Two people who need to move on can\'t wait six months for a buyer. One cash sale, one closing date, both sides get certainty.' ),
				array( '🔧', 'Major Repairs You Can\'t Afford', 'Foundation, roof, fire damage, mold, outdated everything. We buy the house exactly as it stands. You fix nothing, clean nothing.' ),
				array( '📋', 'Tax Liens &amp; Code Violations', 'Most owners think liens mean they can\'t sell. Usually wrong, liens are handled at closing, out of the sale price, not your pocket.' ),
				array( '🔑', 'Tired Landlord / Problem Tenants', 'Non-paying tenants, constant repairs, eviction costs. Sell the property with tenants in place and stop the bleeding this month.' ),
			);
			foreach ( $situations as $i => $s ) : ?>
			<div class="card animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<div style="font-size:2rem;margin-bottom:var(--space-sm);" aria-hidden="true"><?php echo $s[0]; // phpcs:ignore ?></div>
				<h3 style="font-size:1.1rem;margin-bottom:var(--space-sm);"><?php echo $s[1]; // phpcs:ignore ?></h3>
				<p style="color:var(--wp-gray);font-size:0.95rem;margin:0;"><?php echo $s[2]; // phpcs:ignore ?></p>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="text-center" style="margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">My Situation Is On This List &rarr;</a>
		</div>
	</div>
</section>

<!-- ━━ HOW FAST (AEO ANSWER BLOCK) ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="howfast-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:start;">
			<div class="animate-on-scroll">
				<h2 id="howfast-heading" style="margin-bottom:var(--space-md);">How Fast Can I Sell My House in Ohio, Texas or Georgia?</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">
					You can sell your house for cash in as little as 7 days in Ohio, Texas or Georgia. After you submit your address, you receive a written cash offer within 24 hours. If you accept, a licensed title company handles the closing on the date you choose, from 7 days up to 60 days if you need time. Compare that with a traditional listing, which averages 90&ndash;180 days.
				</p>
				<a href="<?php echo esc_url( $how_url ); ?>" class="btn btn--outline">See the Full 4-Step Process &rarr;</a>
			</div>
			<div class="animate-on-scroll" style="transition-delay:0.15s;">
				<h2 style="margin-bottom:var(--space-md);">How Much Does It Cost to Sell to a Cash Buyer?</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">
					Nothing. Selling to us costs you zero: no agent commission (typically 5&ndash;6% of the sale price), no closing costs (we pay them), no repair bills, and no cleaning costs. The written offer we send is the amount you receive at closing. A traditional sale of a $200,000 home often costs the seller $12,000+ in commissions alone before repairs.
				</p>
				<a href="<?php echo esc_url( $compare_url ); ?>" class="btn btn--outline">Cash Sale vs. Agent, Real Numbers &rarr;</a>
			</div>
		</div>
	</div>
</section>

<!-- ━━ HOW IT WORKS ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="hiw-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">SIMPLE. FAST. TRANSPARENT.</p>
			<h2 class="section-header__title" id="hiw-heading">How Do I Sell My House For Cash? 4 Steps.</h2>
		</div>
		<div class="grid grid-4" style="gap:var(--space-lg);">
			<?php
			$steps = array(
				array( '1', 'Tell Us About the House', 'Address, your situation, how to reach you. Under 3 minutes, on this page or by phone.' ),
				array( '2', 'Get a Written Offer in 24h', 'We check comparable sales in your area and the home\'s condition, then send a written offer showing every number.' ),
				array( '3', 'Take Your Time to Decide', 'No pressure, no deadline, no obligation. Say no and it costs you nothing.' ),
				array( '4', 'Close &amp; Get Paid', 'A licensed title company runs the closing on the date you pick. We pay all closing costs. You receive cash.' ),
			);
			foreach ( $steps as $i => $step ) : ?>
			<div class="card text-center animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--wp-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.2rem;margin:0 auto var(--space-md);"><?php echo esc_html( $step[0] ); ?></div>
				<h3 style="font-size:1.05rem;margin-bottom:var(--space-sm);"><?php echo $step[1]; // phpcs:ignore ?></h3>
				<p style="color:var(--wp-gray);font-size:0.92rem;margin:0;"><?php echo $step[2]; // phpcs:ignore ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ THREE STATES ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--navy" aria-labelledby="states-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow" style="color:var(--wp-gold);">THREE STATES. DEEP LOCAL KNOWLEDGE.</p>
			<h2 class="section-header__title" id="states-heading" style="color:#fff;">Where Do We Buy Houses?</h2>
			<p class="section-header__subtitle" style="color:rgba(255,255,255,0.75);">Ohio, Texas and Georgia, every county. We know the local foreclosure timelines, probate courts and tax rules, because we work them every week.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$states = array(
				array( 'Ohio', 'All 88 counties', 'Columbus &middot; Cleveland &middot; Cincinnati &middot; Dayton &middot; Toledo', 'Judicial foreclosure specialists. We know Ohio\'s court timeline and often close before the sheriff\'s sale.' ),
				array( 'Texas', 'All 254 counties', 'Houston &middot; Dallas &middot; San Antonio &middot; Austin &middot; Fort Worth', 'Property tax liens handled at closing. Flood and storm damage welcome, Houston to the Panhandle.' ),
				array( 'Georgia', 'All 159 counties', 'Atlanta &middot; Savannah &middot; Augusta &middot; Macon &middot; Columbus', 'Georgia probate experience. Historic and older properties welcome, code violations included.' ),
			);
			foreach ( $states as $i => $st ) : ?>
			<div class="card animate-on-scroll" style="padding:var(--space-xl);background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s">
				<h3 style="color:#fff;font-size:1.4rem;margin-bottom:var(--space-xs);"><?php echo esc_html( $st[0] ); ?></h3>
				<p style="color:var(--wp-gold);font-weight:600;font-size:0.85rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $st[1] ); ?></p>
				<p style="color:rgba(255,255,255,0.85);font-size:0.9rem;margin-bottom:var(--space-sm);"><?php echo $st[2]; // phpcs:ignore ?></p>
				<p style="color:rgba(255,255,255,0.65);font-size:0.9rem;margin-bottom:var(--space-md);"><?php echo $st[3]; // phpcs:ignore ?></p>
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--full">Sell My <?php echo esc_html( $st[0] ); ?> House &rarr;</a>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ COMPARISON TABLE ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="compare-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">SIDE BY SIDE</p>
			<h2 class="section-header__title" id="compare-heading">Is a Cash Sale Better Than Listing With an Agent?</h2>
			<p class="section-header__subtitle">It depends on your situation. If you have time and a market-ready house, list it. If you need speed, certainty, or the house needs work, here's the honest comparison.</p>
		</div>
		<div style="overflow-x:auto;">
			<table class="compare-table" style="width:100%;border-collapse:collapse;">
				<thead>
					<tr>
						<th style="text-align:left;padding:var(--space-md);border-bottom:2px solid var(--wp-navy);">Factor</th>
						<th style="text-align:left;padding:var(--space-md);border-bottom:2px solid var(--wp-navy);color:var(--wp-red);"><?php echo esc_html( $company_name ); ?></th>
						<th style="text-align:left;padding:var(--space-md);border-bottom:2px solid var(--wp-navy);">Traditional Listing</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$rows_raw = get_theme_mod( 'shs_compare_rows', '' );
					$rows = array();
					if ( $rows_raw ) {
						foreach ( explode( "
", $rows_raw ) as $line ) {
							$parts = array_map( 'trim', explode( '|', $line ) );
							if ( count( $parts ) === 3 ) { $rows[] = $parts; }
						}
					}
					if ( ! $rows ) $rows = array(
						array( 'Timeline', '7&ndash;21 days', '90&ndash;180 days' ),
						array( 'Agent commission', '$0', '5&ndash;6% of sale price' ),
						array( 'Repairs required', 'None, sold as-is', 'Often $10K&ndash;$40K+' ),
						array( 'Closing costs', 'We pay all', 'Seller pays 1&ndash;3%' ),
						array( 'Certainty', 'No financing contingencies', 'Deals fall through' ),
						array( 'Showings &amp; open houses', 'None', 'Multiple required' ),
						array( 'Closing date', 'You choose', 'Buyer controls' ),
					);
					foreach ( $rows as $r ) : ?>
					<tr>
						<td style="padding:var(--space-md);border-bottom:1px solid var(--wp-gray-200);font-weight:600;"><?php echo $r[0]; // phpcs:ignore ?></td>
						<td style="padding:var(--space-md);border-bottom:1px solid var(--wp-gray-200);color:var(--wp-green,#1a7a4a);font-weight:600;"><?php echo $r[1]; // phpcs:ignore ?></td>
						<td style="padding:var(--space-md);border-bottom:1px solid var(--wp-gray-200);color:var(--wp-gray);"><?php echo $r[2]; // phpcs:ignore ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="text-center" style="margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( $compare_url ); ?>" class="btn btn--outline btn--lg">See the Full Comparison With Real Numbers &rarr;</a>
		</div>
	</div>
</section>

<!-- ━━ WHY TRUST US ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="trust-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">STRAIGHT ANSWERS, EVERY NUMBER SHOWN</p>
			<h2 class="section-header__title" id="trust-heading">Why Should I Trust a "We Buy Houses" Company?</h2>
			<p class="section-header__subtitle">You shouldn't, not automatically. Judge every cash buyer by the same three tests we invite you to run on us.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$trust = array(
				array( '🧮', 'Every Number Explained', 'Our written offer shows how we calculated it: the comparable sales we used, our repair estimate, and our margin. If a buyer won\'t show their math, walk away.' ),
				array( '🏛️', 'Licensed Title Company Closing', 'Money and documents go through a licensed, insured title company, never directly to us. That protects you at every step.' ),
				array( '🚪', 'No Pressure, Ever', 'A real offer survives a few days of thinking. Anyone rushing you to sign today is telling you something. Take our offer to your attorney, we encourage it.' ),
			);
			foreach ( $trust as $i => $t ) : ?>
			<div class="card animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s">
				<div style="font-size:2rem;margin-bottom:var(--space-sm);" aria-hidden="true"><?php echo $t[0]; // phpcs:ignore ?></div>
				<h3 style="font-size:1.1rem;margin-bottom:var(--space-sm);"><?php echo $t[1]; // phpcs:ignore ?></h3>
				<p style="color:var(--wp-gray);font-size:0.95rem;margin:0;"><?php echo $t[2]; // phpcs:ignore ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ BLOG / GUIDES ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<?php
$recent_posts = new WP_Query( array( 'posts_per_page' => 3, 'post_status' => 'publish' ) );
if ( $recent_posts->have_posts() ) : ?>
<section class="section" aria-labelledby="blog-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">FREE GUIDES</p>
			<h2 class="section-header__title" id="blog-heading">Answers For Homeowners in Hard Situations</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
			<article class="card animate-on-scroll" style="padding:var(--space-xl);">
				<h3 style="font-size:1.05rem;margin-bottom:var(--space-sm);"><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a></h3>
				<p style="color:var(--wp-gray);font-size:0.92rem;"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
				<a href="<?php the_permalink(); ?>" class="btn btn--outline" style="margin-top:var(--space-sm);">Read Guide &rarr;</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ━━ FINAL CTA ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--navy" aria-labelledby="final-cta-heading">
	<div class="container text-center">
		<h2 id="final-cta-heading" style="color:#fff;margin-bottom:var(--space-md);">Ready For a No-Obligation Cash Offer?</h2>
		<p style="color:rgba(255,255,255,0.8);max-width:560px;margin:0 auto var(--space-xl);">
			Tell us about the house today and have a written offer in your inbox within 24 hours. Reviewing it costs nothing and commits you to nothing.
		</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Free Cash Offer &rarr;</a>
			<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn--outline-white btn--lg">Talk to a Real Person</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
