<?php
/**
 * Compare: Cash Sale vs Traditional Listing Page Template
 * Template Name: Cash Sale vs Listing
 *
 * @package WholesalePro
 */

get_header();

$company_name = get_theme_mod( 'company_name', 'Swift House Sold' );
$phone        = get_theme_mod( 'company_phone', '' );
$phone_raw    = get_theme_mod( 'company_phone_raw', '' );
$sell_url     = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );

$comparisons = array(
	array( 'factor' => 'Time to Close',            'cash' => '7–14 days',                       'traditional' => '60–90 days' ),
	array( 'factor' => 'Repairs Required',         'cash' => 'None, sell as-is',               'traditional' => 'Usually required by lender' ),
	array( 'factor' => 'Agent Commission',         'cash' => '$0',                              'traditional' => '5–6% of sale price' ),
	array( 'factor' => 'Closing Costs',            'cash' => 'We pay all closing costs',        'traditional' => '1–3% paid by seller' ),
	array( 'factor' => 'Home Staging / Cleaning',  'cash' => 'Not required',                    'traditional' => 'Required for showings' ),
	array( 'factor' => 'Open Houses / Showings',   'cash' => 'One walkthrough, that\'s it',    'traditional' => 'Multiple showings, weekends' ),
	array( 'factor' => 'Financing Contingency',    'cash' => 'No, cash deal is guaranteed',    'traditional' => 'Yes, 14% of deals fall through' ),
	array( 'factor' => 'Appraisal Required',       'cash' => 'No',                              'traditional' => 'Yes, required by lender' ),
	array( 'factor' => 'Price Negotiation',        'cash' => 'One written offer, no games',    'traditional' => 'Back-and-forth offers/counters' ),
	array( 'factor' => 'Repair Requests',          'cash' => 'None',                            'traditional' => 'Common after inspection' ),
	array( 'factor' => 'Closing Date Flexibility', 'cash' => 'You choose the date',             'traditional' => 'Buyer\'s lender controls timeline' ),
	array( 'factor' => 'Sale Certainty',           'cash' => '100%, no contingencies',         'traditional' => 'Never guaranteed until funded' ),
);
?>

<section class="page-hero page-hero--seller" aria-labelledby="compare-hero-heading">
	<div class="container">
		<nav class="breadcrumb" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<span aria-hidden="true"> / </span>
			<span aria-current="page">Cash Sale vs. Listing</span>
		</nav>
		<h1 class="page-hero__title animate-on-scroll" id="compare-hero-heading">
			Cash Sale vs. Listing With an Agent
		</h1>
		<p class="page-hero__sub animate-on-scroll">
			Side-by-side comparison so you can make the best decision for your situation.
		</p>
	</div>
</section>

<!-- Comparison Table -->
<section class="section" aria-labelledby="compare-table-heading">
	<div class="container">
		<h2 class="sr-only" id="compare-table-heading">Comparison Table</h2>

		<div class="comparison-table-wrap" style="overflow-x:auto;">
			<table class="comparison-table" style="width:100%;border-collapse:collapse;font-size:var(--text-base);">
				<thead>
					<tr>
						<th scope="col" style="text-align:left;padding:var(--space-md);background:var(--wp-light-gray);border-bottom:2px solid var(--wp-border);width:35%;">
							Factor
						</th>
						<th scope="col" style="padding:var(--space-md);background:var(--wp-green);color:#fff;border-bottom:2px solid var(--wp-green);text-align:center;width:32.5%;">
							✅ <?php echo esc_html( $company_name ); ?> Cash Sale
						</th>
						<th scope="col" style="padding:var(--space-md);background:var(--wp-gray-3,#dee2e6);color:var(--wp-dark);border-bottom:2px solid var(--wp-border);text-align:center;width:32.5%;">
							Traditional Listing
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $comparisons as $i => $row ) : ?>
					<tr style="background:<?php echo $i % 2 === 0 ? '#fff' : 'var(--wp-light-gray)'; ?>;">
						<th scope="row" style="text-align:left;padding:var(--space-md);font-weight:600;border-bottom:1px solid var(--wp-border);">
							<?php echo esc_html( $row['factor'] ); ?>
						</th>
						<td style="padding:var(--space-md);text-align:center;border-bottom:1px solid var(--wp-border);color:var(--wp-green);font-weight:600;">
							<?php echo esc_html( $row['cash'] ); ?>
						</td>
						<td style="padding:var(--space-md);text-align:center;border-bottom:1px solid var(--wp-border);color:var(--wp-gray);">
							<?php echo esc_html( $row['traditional'] ); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<!-- Real Numbers Example -->
<section class="section bg--light-gray" aria-labelledby="example-heading">
	<div class="container">
		<div class="section-header text-center" style="margin-bottom:var(--space-xl);">
			<h2 class="section-header__title" id="example-heading">A Real Numbers Example</h2>
			<p class="section-header__sub">$220,000 home, what you actually walk away with after each method.</p>
		</div>

		<div class="split-layout" style="max-width:900px;margin:0 auto;gap:var(--space-lg);">

			<div class="card" style="padding:var(--space-lg);border-top:4px solid var(--wp-green);">
				<h3 style="color:var(--wp-green);margin-bottom:var(--space-md);">✅ Cash Sale at $185,000</h3>
				<table style="width:100%;border-collapse:collapse;">
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Sale Price</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);font-weight:600;">$185,000</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Agent Commission</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-green);">$0</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Closing Costs</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-green);">$0 (we pay)</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Repairs</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-green);">$0</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Staging / Cleaning</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-green);">$0</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Carrying Costs (7 days)</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);">~$200</td></tr>
					<tr style="background:var(--wp-green);color:#fff;">
						<td style="padding:12px;font-weight:700;font-size:var(--text-lg);">Net Proceeds</td>
						<td style="text-align:right;padding:12px;font-weight:700;font-size:var(--text-lg);">~$184,800</td>
					</tr>
				</table>
				<p style="margin-top:var(--space-md);font-size:var(--text-sm);color:var(--wp-gray);">Closed in 7 days. No showings. No repairs. Certainty of sale.</p>
			</div>

			<div class="card" style="padding:var(--space-lg);border-top:4px solid var(--wp-gray);">
				<h3 style="color:var(--wp-gray);margin-bottom:var(--space-md);">Traditional Listing at $220,000</h3>
				<table style="width:100%;border-collapse:collapse;">
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Sale Price</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);font-weight:600;">$220,000</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Agent Commission (6%)</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-red);">-$13,200</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Closing Costs (2%)</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-red);">-$4,400</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Repairs (cosmetic)</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-red);">-$12,000</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Staging / Cleaning</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-red);">-$2,500</td></tr>
					<tr><td style="padding:8px 0;border-bottom:1px solid var(--wp-border);">Carrying Costs (75 days)</td><td style="text-align:right;padding:8px 0;border-bottom:1px solid var(--wp-border);color:var(--wp-red);">-$3,800</td></tr>
					<tr style="background:var(--wp-gray);color:#fff;">
						<td style="padding:12px;font-weight:700;font-size:var(--text-lg);">Net Proceeds</td>
						<td style="text-align:right;padding:12px;font-weight:700;font-size:var(--text-lg);">~$184,100</td>
					</tr>
				</table>
				<p style="margin-top:var(--space-md);font-size:var(--text-sm);color:var(--wp-gray);">75 days. Repairs before listing. Showings every weekend. No guarantee of closing.</p>
			</div>

		</div>

		<p class="text-center" style="margin-top:var(--space-xl);font-size:var(--text-lg);font-weight:600;color:var(--wp-navy);">
			Same net proceeds, but one takes 7 days and the other takes 75. You decide which makes more sense.
		</p>
	</div>
</section>

<!-- When Listing DOES Make Sense -->
<section class="section" aria-labelledby="when-list-heading">
	<div class="container narrow">
		<h2 class="text-center" id="when-list-heading" style="margin-bottom:var(--space-lg);">When a Traditional Listing Is the Right Choice</h2>
		<p>We will always be honest with you. A cash sale is not the right move for every homeowner. A traditional listing may be the better option if:</p>
		<ul style="line-height:2;font-size:var(--text-base);">
			<li>Your property is in excellent condition and needs zero repairs</li>
			<li>You have 3–4 months and no financial urgency</li>
			<li>You are in a hot seller's market where homes sell in days at or above asking</li>
			<li>Maximizing the final sale price is more important than speed or certainty</li>
		</ul>
		<p>If none of those apply to your situation, if you need speed, certainty, or are dealing with a property that needs work, a cash sale is almost certainly the smarter financial move when you factor in all the real costs.</p>
	</div>
</section>

<!-- CTA -->
<section class="section bg--navy" aria-labelledby="compare-cta-heading">
	<div class="container text-center">
		<h2 id="compare-cta-heading" style="color:#fff;margin-bottom:var(--space-sm);">See What Your Home Is Worth in Cash</h2>
		<p style="color:rgba(255,255,255,0.8);margin-bottom:var(--space-lg);font-size:var(--text-lg);">
			Free. No obligation. No pressure. Just an honest cash offer.
		</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">
				Get My Cash Offer
			</a>
			<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline-white btn--lg">
				📞 <?php echo esc_html( $phone ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
