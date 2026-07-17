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
<section class="hero hero--split hero--photo" aria-labelledby="hero-heading" style="background-image:linear-gradient(rgba(16,26,48,0.88),rgba(27,43,75,0.86)),url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/house-suburban.jpg');background-size:cover;background-position:center;">
	<div class="container">
		<div class="hero__inner">
			<div class="hero__content">
				<p class="hero__eyebrow animate-on-scroll">
					CASH HOME BUYERS &middot; OHIO &middot; TEXAS &middot; GEORGIA
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

<!-- ━━ LOSS AVERSION STRIP ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<div class="loss-strip">
	<div class="container">
		<div class="loss-strip__inner">
			<span class="loss-strip__num">$1,500&ndash;$2,500</span>
			<span class="loss-strip__txt">is what a typical month of waiting costs in mortgage, taxes, insurance and utilities on a house you no longer want. A written offer this week costs $0 and decides nothing yet.</span>
		</div>
	</div>
</div>

<!-- ━━ SITUATIONS (PAIN POINTS) ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<?php
$sit_icons = array(
	'clock'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>',
	'home'   => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/></svg>',
	'scale'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3v18M3 7h18M6 7l-3 7a4 4 0 008 0zM18 7l-3 7a4 4 0 008 0z"/></svg>',
	'tool'   => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>',
	'file'   => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8"/></svg>',
	'key'    => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>',
);
?>
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
				array( 'clock', 'house-suburban.jpg', 'Behind on Mortgage / Foreclosure', 'Once the bank files, the clock moves fast. In many cases we close before the sheriff's sale and you walk away with cash instead of a foreclosure on your record.', '/stop-foreclosure/' ),
				array( 'home', 'house-brick.jpg', 'Inherited or Probate Property', 'A house you didn't ask for, in another city, full of belongings. We work with your estate attorney, buy as-is, and you never clean it out.', '/sell-probate-property/' ),
				array( 'scale', 'keys-hand.jpg', 'Divorce: a Clean, Fast Split', 'Two people who need to move on can't wait six months for a buyer. One cash sale, one closing date, both sides get certainty.', '/sell-house-divorce/' ),
				array( 'tool', 'house-porch.jpg', 'Major Repairs You Can't Afford', 'Foundation, roof, fire damage, mold. We buy the house exactly as it stands. You fix nothing, clean nothing.', '/sell-damaged-house/' ),
				array( 'file', 'calculator-tax.jpg', 'Tax Liens &amp; Code Violations', 'Liens are handled at closing, out of the sale price, not your pocket. Most owners are wrong about not being able to sell.', '/sell-house-tax-liens/' ),
				array( 'key', 'house-modern.jpg', 'Tired Landlord / Problem Tenants', 'Non-paying tenants, constant repairs, eviction costs. Sell with tenants in place and stop the bleeding this month.', '/sell-rental-property/' ),
			);
			foreach ( $situations as $i => $sit ) : ?>
			<a href="<?php echo esc_url( home_url( $sit[4] ) ); ?>" class="card card--guide sit-card animate-on-scroll" style="padding:0;overflow:hidden;text-decoration:none;color:inherit;display:block;transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $sit[1] ); ?>" alt="" loading="lazy" style="width:100%;height:140px;object-fit:cover;display:block;">
				<div style="padding:var(--space-lg) var(--space-xl) var(--space-xl);">
					<div class="sit-card__icon"><?php echo $sit_icons[ $sit[0] ]; // phpcs:ignore ?></div>
					<h3 style="font-size:1.08rem;margin-bottom:var(--space-sm);"><?php echo $sit[2]; // phpcs:ignore ?></h3>
					<p style="color:var(--wp-gray);font-size:0.94rem;margin:0 0 10px;"><?php echo $sit[3]; // phpcs:ignore ?></p>
					<span style="font-weight:700;color:var(--wp-red);font-size:0.9rem;">This is my situation &rarr;</span>
				</div>
			</a>
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
			<p class="section-header__subtitle">You shouldn't, not automatically. Judge every cash buyer by the same three tests we invite you to run on us. The full protection machine, escrow, regulators, title insurance, is documented in the <a href="/seller-protection/">Seller Protection Center</a>.</p>
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
