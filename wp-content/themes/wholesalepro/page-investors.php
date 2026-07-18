<?php
/**
 * Investor homepage: mirrors the seller front page structure
 * section by section, with buyer-persona content.
 *
 * @package WholesalePro
 */

get_header();

$book_page = get_page_by_path( 'book-a-call' );
$book_url  = $book_page ? get_permalink( $book_page->ID ) : home_url( '/book-a-call' );
$blog_page = get_page_by_path( 'blog' );
$blog_url  = $blog_page ? get_permalink( $blog_page->ID ) : home_url( '/blog' );
?>

<!-- ━━ HERO (same split layout as seller homepage) ━━━━━━━━━━━━━ -->
<section class="hero hero--split" aria-labelledby="inv-hero-heading">
	<div class="hero__bg" aria-hidden="true"></div>
	<div class="container">
		<div class="hero__inner">
			<div class="hero__content">
				<p class="hero__eyebrow animate-on-scroll">
					FOR INVESTORS &middot; OHIO &middot; TEXAS &middot; GEORGIA
				</p>
				<h1 class="hero__title animate-on-scroll" id="inv-hero-heading" style="transition-delay:0.1s">
					Off-Market Deals With Numbers You Can Verify
				</h1>
				<p class="hero__subtitle animate-on-scroll" style="transition-delay:0.2s">
					Tired of picked-over MLS listings and wholesalers with fantasy ARVs? We source distressed properties directly from motivated sellers. Every deal comes with the comparables, a line-item repair scope and an inspection period. Verify everything before a dollar moves.
				</p>
				<div class="hero__actions animate-on-scroll" style="transition-delay:0.3s">
					<a href="<?php echo esc_url( ( $bp = get_page_by_path( 'buyer-protection' ) ) ? get_permalink( $bp->ID ) : home_url( '/buyer-protection' ) ); ?>" class="btn btn--outline-white btn--lg">
						How Your Money Is Protected
					</a>
				</div>
				<p class="animate-on-scroll" style="transition-delay:0.4s;color:rgba(255,255,255,0.85);font-size:0.9rem;margin-top:var(--space-md);">
					Free to join &bull; No obligation to buy &bull; Deals matching your criteria only
				</p>
			</div>
			<div class="hero__form-wrap animate-on-scroll" style="transition-delay:0.2s">
				<div class="hero__form-card">
					<h2 class="hero__form-card__heading">Join the Buyer List</h2>
					<p class="hero__form-card__sub">Deals matching your criteria reach you first.</p>
					<?php echo wholesalepro_render_buyer_form( 'investor-hub' ); // phpcs:ignore ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ━━ TRUST BAR (investor version) ━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="trust-bar" aria-label="<?php esc_attr_e( 'Deal standards', 'wholesalepro' ); ?>">
	<div class="container">
		<div class="trust-bar__grid">
			<?php
			$inv_stats = array(
				array( 'ARV', 'Comps Attached, Always' ),
				array( '100%', 'Title Company Closings' ),
				array( '$0', 'Fees To Join The List' ),
				array( '72h', 'Best Deals Are Gone In' ),
				array( '501', 'Counties — OH · TX · GA' ),
			);
			foreach ( $inv_stats as $stat ) : ?>
			<div class="trust-bar__stat animate-on-scroll">
				<span class="trust-bar__number"><?php echo esc_html( $stat[0] ); ?></span>
				<span class="trust-bar__label"><?php echo esc_html( $stat[1] ); ?></span>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ PAIN POINTS (same card grid as seller situations) ━━━━━━━ -->
<section class="section" aria-labelledby="inv-pains-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">WE FIXED WHAT INVESTORS HATE ABOUT WHOLESALERS</p>
			<h2 class="section-header__title" id="inv-pains-heading">Every Deal Problem You've Had, Solved By Design</h2>
			<p class="section-header__subtitle">You've seen the inflated ARVs, the mystery repair numbers, the pressure tactics. We built the opposite, because investors who verify our math come back.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			$pains = array(
				array( '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M23 18l-9.5-9.5-5 5L1 6"/><path d="M17 18h6v-6"/></svg></div>', 'Inflated ARVs', 'Our ARV arrives with the actual comparable sales attached. Pull your own comps and check us. We expect it.' ),
				array( '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M15 12l-8.5 8.5a2.12 2.12 0 01-3-3L12 9"/><path d="M17.64 15L22 10.64l-5.34-5.35a2 2 0 00-2.83 0L11 8.12l6.64 6.88z"/></svg></div>', 'Mystery repair numbers', 'Line-item scope, not one scary round figure. Walk it with your contractor during the inspection period.' ),
				array( '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 2h4M12 14l3-3"/><circle cx="12" cy="14" r="8"/></svg></div>', 'Pressure tactics', 'Real deals survive verification. The inspection window is in the contract, not a favor we grant.' ),
				array( '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 3H2l8 9.46V19l4 2v-8.54z"/></svg></div>', 'Deals outside your box', 'Your criteria filter everything. Wrong county, wrong price band, wrong strategy: you never hear about it.' ),
				array( '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div>', 'Fees before value', 'Joining is free. Earnest money sits with the licensed title company, never in anyone\'s personal account.' ),
				array( '<div class="sit-card__icon" style="margin:0 0 12px;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>', 'Wholesalers who vanish', 'Every closing runs through a title company you can call. Ask them about us before your first deal.' ),
			);
			foreach ( $pains as $i => $pn ) : ?>
			<div class="card animate-on-scroll" style="padding:var(--space-xl);transition-delay:<?php echo esc_attr( $i * 0.08 ); ?>s">
				<?php echo $pn[0]; // phpcs:ignore ?>
				<h3 style="font-size:1.1rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $pn[1] ); ?></h3>
				<p style="color:var(--wp-gray);font-size:0.95rem;margin:0;"><?php echo esc_html( $pn[2] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ AEO ANSWER BLOCKS (same split as seller homepage) ━━━━━━━ -->
<section class="section bg--light-gray" aria-labelledby="inv-howget-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:start;">
			<div class="animate-on-scroll">
				<h2 id="inv-howget-heading" style="margin-bottom:var(--space-md);">How Do I Get Access to Off-Market Deals?</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">
					Join the buyer list with your criteria: target states and metros, price band, strategy and financing setup. When our seller pipeline signs a contract that matches, the full deal package goes to matching buyers the same day, with the ARV comps, repair scope and photos. The best deals are claimed within 24 to 72 hours.
				</p>
			</div>
			<div class="animate-on-scroll" style="transition-delay:0.15s;">
				<h2 style="margin-bottom:var(--space-md);">What Does It Cost to Join?</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">
					Nothing. The list is free, there is no membership fee, and no obligation to ever buy. Our fee is built into each deal's price: the number you see is the number you pay, verified at a licensed title company closing. If a deal doesn't work at the listed price, pass and wait for the next one.
				</p>
				<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline">Questions? Book a Free Call &rarr;</a>
			</div>
		</div>
	</div>
</section>

<!-- ━━ HOW IT WORKS (same 4 steps layout) ━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section" aria-labelledby="inv-hiw-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">SIMPLE. VERIFIABLE. REPEATABLE.</p>
			<h2 class="section-header__title" id="inv-hiw-heading">How Buying From Us Works: 4 Steps</h2>
		</div>
		<div class="grid grid-4" style="gap:var(--space-lg);">
			<?php
			$steps = array(
				array( '1', 'Set Your Criteria', 'States, metros, price band, strategy, financing. Takes 2 minutes. Your filter, our discipline.' ),
				array( '2', 'Get Matching Deal Alerts', 'Full package on day one: ARV with comps, line-item repairs, photos, occupancy status. No teasers.' ),
				array( '3', 'Verify &amp; Inspect', 'Run your own comps. Walk it with your contractor inside the inspection period. Numbers hold or you withdraw.' ),
				array( '4', 'Close at the Title Company', 'Escrowed funds, recorded deed, title insurance. Assignment or double close, handled properly.' ),
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

<!-- ━━ THREE STRATEGIES (mirrors seller three-states section) ━━ -->
<section class="section bg--navy" aria-labelledby="inv-strategies-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow" style="color:var(--wp-gold);">THREE STRATEGIES. ONE PIPELINE.</p>
			<h2 class="section-header__title" id="inv-strategies-heading" style="color:#fff;">Which Kind of Investor Are You?</h2>
			<p class="section-header__subtitle" style="color:rgba(255,255,255,0.75);">Each strategy has its own page: pain points, 10 FAQs and a 10-guide library. Pick yours.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php
			foreach ( shs_investors_config() as $slug => $svc ) :
				$page = get_page_by_path( $slug );
				$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
				?>
			<div class="card animate-on-scroll" style="padding:0;overflow:hidden;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);">
				<img src="<?php echo esc_url( shs_cat_image( $svc['category'] ) ); ?>" alt="" loading="lazy" style="width:100%;height:150px;object-fit:cover;display:block;">
				<div style="padding:var(--space-xl);">
					<h3 style="color:#fff;font-size:1.2rem;margin-bottom:var(--space-sm);"><?php echo esc_html( $svc['menu'] ); ?></h3>
					<p style="color:rgba(255,255,255,0.7);font-size:0.9rem;margin-bottom:var(--space-md);"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $svc['answer'] ), 20 ) ); ?></p>
					<a href="<?php echo esc_url( $url ); ?>" class="btn btn--seller btn--full">Explore &rarr;</a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ COMPARISON TABLE (same layout as seller homepage) ━━━━━━━ -->
<section class="section" aria-labelledby="inv-compare-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">SIDE BY SIDE</p>
			<h2 class="section-header__title" id="inv-compare-heading">Buying From Our List vs. Hunting the MLS</h2>
		</div>
		<div style="overflow-x:auto;">
			<table class="compare-table" style="width:100%;border-collapse:collapse;">
				<thead>
					<tr>
						<th style="text-align:left;padding:var(--space-md);border-bottom:2px solid var(--wp-navy);">Factor</th>
						<th style="text-align:left;padding:var(--space-md);border-bottom:2px solid var(--wp-navy);color:var(--wp-red);">Our Buyer List</th>
						<th style="text-align:left;padding:var(--space-md);border-bottom:2px solid var(--wp-navy);">MLS / Auctions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$rows = array(
						array( 'Competition', 'Matching list members only', 'Every investor in the metro' ),
						array( 'Pricing', 'Below market, fee included', 'Bid up to retail and beyond' ),
						array( 'ARV data', 'Comps attached to every deal', 'Do your own from scratch' ),
						array( 'Repair scope', 'Line-item estimate provided', 'Guess from listing photos' ),
						array( 'Inspection', 'Contract inspection period', 'Auctions: often none at all' ),
						array( 'Deal flow', 'Matched to your criteria', 'Endless scrolling and dead ends' ),
					);
					foreach ( $rows as $r ) : ?>
					<tr>
						<td style="padding:var(--space-md);border-bottom:1px solid var(--wp-gray-200);font-weight:600;"><?php echo esc_html( $r[0] ); ?></td>
						<td style="padding:var(--space-md);border-bottom:1px solid var(--wp-gray-200);color:#1a7a4a;font-weight:600;"><?php echo esc_html( $r[1] ); ?></td>
						<td style="padding:var(--space-md);border-bottom:1px solid var(--wp-gray-200);color:var(--wp-gray);"><?php echo esc_html( $r[2] ); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<!-- ━━ GUIDES (same section as seller homepage) ━━━━━━━━━━━━━━━━ -->
<?php
$inv_guides = new WP_Query( array(
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'tax_query'      => array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => array( 'fix-flip', 'buy-hold', 'out-of-state' ),
		),
	),
) );
if ( $inv_guides->have_posts() ) : ?>
<section class="section bg--light-gray" aria-labelledby="inv-guides-heading">
	<div class="container">
		<div class="section-header text-center">
			<p class="section-header__eyebrow">FREE INVESTOR GUIDES</p>
			<h2 class="section-header__title" id="inv-guides-heading">Learn the Craft Before You Wire a Dollar</h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);">
			<?php while ( $inv_guides->have_posts() ) : $inv_guides->the_post(); ?>
			<article class="card card--guide" style="padding:0;overflow:hidden;">
				<a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;display:block;">
					<img src="<?php echo esc_url( shs_cat_image( 'fix-flip' ) ); ?>" alt="" loading="lazy" style="width:100%;height:140px;object-fit:cover;display:block;">
					<div style="padding:var(--space-lg);">
						<h3 style="font-size:1rem;margin-bottom:var(--space-sm);"><?php the_title(); ?></h3>
						<span style="font-weight:600;color:var(--wp-red);">Read Guide &rarr;</span>
					</div>
				</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ━━ FINAL CTA (same navy band) ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ -->
<section class="section bg--navy" aria-labelledby="inv-final-heading">
	<div class="container text-center">
		<h2 id="inv-final-heading" style="color:#fff;margin-bottom:var(--space-md);">Your Next Deal Should Find You</h2>
		<p style="color:rgba(255,255,255,0.8);max-width:560px;margin:0 auto var(--space-xl);">
			Set your criteria once. Verify everything we send. Buy only what survives your own math.
		</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="#inv-hero-heading" class="btn btn--seller btn--lg">Join the Buyer List &rarr;</a>
			<a href="<?php echo esc_url( $book_url ); ?>" class="btn btn--outline-white btn--lg">Book a Free Call</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
