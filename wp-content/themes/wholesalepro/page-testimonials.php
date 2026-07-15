<?php
/**
 * Testimonials Page Template
 * Template Name: Testimonials
 *
 * @package WholesalePro
 */

get_header();

$company_name = get_theme_mod( 'company_name', 'Swift House Sold' );
$phone        = get_theme_mod( 'company_phone', '' );
$phone_raw    = get_theme_mod( 'company_phone_raw', '' );
$sell_url     = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );

$testimonials = array(
	array(
		'name'     => 'Sandra M.',
		'location' => 'Dallas, TX',
		'stars'    => 5,
		'date'     => 'March 2026',
		'headline' => 'Closed in 9 days. No repairs, no hassle.',
		'text'     => 'I inherited my mother\'s house after she passed and had no idea what to do with it. It needed a new roof and the kitchen was from the 1970s. I didn\'t have the money to fix it up and didn\'t want to deal with contractors. I called and they came out within two days, gave me a fair cash offer, and we closed in 9 days. I didn\'t have to clean a single thing out. They handled everything. I wish I had called sooner.',
		'situation' => 'Inherited Property',
	),
	array(
		'name'     => 'Marcus T.',
		'location' => 'Atlanta, GA',
		'stars'    => 5,
		'date'     => 'January 2026',
		'headline' => 'Stopped foreclosure 11 days before the auction.',
		'text'     => 'I was 4 months behind on my mortgage and the bank had set an auction date. I was panicking. A friend told me to call a cash buyer. I was skeptical but I had nothing to lose. They came out the next morning, made an offer that afternoon, and we closed 11 days later — 3 days before the auction. My credit took a hit from the late payments but the foreclosure never went through. I can\'t thank them enough.',
		'situation' => 'Pre-Foreclosure',
	),
	array(
		'name'     => 'Linda and Robert K.',
		'location' => 'Columbus, OH',
		'stars'    => 5,
		'date'     => 'November 2025',
		'headline' => 'Our divorce sale was handled with complete professionalism.',
		'text'     => 'My ex-husband and I needed to sell our house quickly as part of our divorce settlement. We couldn\'t agree on anything but we both agreed we wanted it done fast. The cash offer process was straightforward, there was no back-and-forth negotiating, and they were sensitive to our situation. We closed in 14 days, split the proceeds, and both moved on. Thank you for making a hard situation easier.',
		'situation' => 'Divorce Sale',
	),
	array(
		'name'     => 'David P.',
		'location' => 'Phoenix, AZ',
		'stars'    => 5,
		'date'     => 'September 2025',
		'headline' => 'Sold my rental property with a difficult tenant still inside.',
		'text'     => 'I had a rental property with a tenant who had stopped paying rent and refused to leave. I had been trying to sell it for 6 months but no traditional buyer would touch it with the tenant situation. They bought it as-is, tenant and all. They handled the eviction after closing. I got my money and never had to deal with it again. Exactly what I needed.',
		'situation' => 'Rental Property / Problem Tenant',
	),
	array(
		'name'     => 'Patricia G.',
		'location' => 'Houston, TX',
		'stars'    => 5,
		'date'     => 'July 2025',
		'headline' => 'Relocated for work — sold in 10 days while I was already in a new city.',
		'text'     => 'My company transferred me on 3 weeks notice. I had a house I hadn\'t sold, a mortgage I couldn\'t afford to carry from across the country, and no time to deal with a traditional listing. They handled everything remotely. I signed documents electronically and the funds were wired to my account. I was already in my new city when we closed. Incredible service.',
		'situation' => 'Job Relocation',
	),
	array(
		'name'     => 'James W.',
		'location' => 'Memphis, TN',
		'stars'    => 5,
		'date'     => 'May 2025',
		'headline' => 'Fire-damaged house — no one else would touch it.',
		'text'     => 'My house had significant fire damage from an electrical fire. My insurance covered part of it but not all of it, and I didn\'t want to go through months of construction. I called three cash buyers. Two never called back. This company came out within hours, gave me a written offer the same day, and we closed in 12 days. Fair price for a damaged house. No games.',
		'situation' => 'Fire Damaged Property',
	),
	array(
		'name'     => 'Angela D.',
		'location' => 'Charlotte, NC',
		'stars'    => 5,
		'date'     => 'February 2025',
		'headline' => 'Listed for 4 months with no offers. Sold to cash buyer in 2 weeks.',
		'text'     => 'I had my house listed with a real estate agent for 4 months. Two price reductions and zero offers. The house needed work and buyers kept asking for repair credits. I decided to try a cash offer out of frustration. I was surprised how close the offer was to what I would have netted after agent fees and repairs. I should have done this first.',
		'situation' => 'Failed Listing',
	),
	array(
		'name'     => 'Michael and Cheryl B.',
		'location' => 'Nashville, TN',
		'stars'    => 5,
		'date'     => 'December 2024',
		'headline' => 'Sold a hoarder house — contents and all.',
		'text'     => 'My father had passed and left a house that was packed floor to ceiling. I\'m talking every room, every hallway. I got quotes from junk removal companies — they wanted $18,000 just to clear it out. Cash buyers bought it contents and all. They didn\'t ask us to remove a single thing. The closing check was more than we expected. Unbelievable service.',
		'situation' => 'Estate / Hoarder Property',
	),
);
?>

<section class="page-hero page-hero--seller" aria-labelledby="testimonials-hero-heading">
	<div class="container">
		<nav class="breadcrumb" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<span aria-hidden="true"> / </span>
			<span aria-current="page">Testimonials</span>
		</nav>
		<h1 class="page-hero__title animate-on-scroll" id="testimonials-hero-heading">
			Real Stories From Real Sellers
		</h1>
		<p class="page-hero__sub animate-on-scroll">
			See what homeowners across the country say about working with <?php echo esc_html( $company_name ); ?>.
		</p>
		<div class="hero-trust animate-on-scroll" style="margin-top:var(--space-lg);">
			<?php wholesalepro_get_star_rating( 4.9 ); ?>
			<span style="font-size:var(--text-lg);font-weight:700;color:#fff;margin-left:var(--space-sm);">4.9 / 5 Stars</span>
			<span style="color:rgba(255,255,255,0.7);margin-left:var(--space-sm);">— 500+ verified reviews</span>
		</div>
	</div>
</section>

<section class="section" aria-labelledby="reviews-heading">
	<div class="container">
		<h2 class="sr-only" id="reviews-heading">Customer Reviews</h2>
		<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:var(--space-lg);">
			<?php foreach ( $testimonials as $t ) : ?>
			<article class="testimonial-card card" itemscope itemtype="https://schema.org/Review" style="padding:var(--space-lg);">
				<header>
					<div style="display:flex;align-items:center;gap:var(--space-sm);margin-bottom:var(--space-sm);">
						<span class="badge badge--seller" style="font-size:var(--text-xs);">
							<?php echo esc_html( $t['situation'] ); ?>
						</span>
					</div>
					<div style="display:flex;gap:2px;margin-bottom:var(--space-sm);" aria-label="<?php echo esc_attr( $t['stars'] ); ?> out of 5 stars">
						<?php for ( $i = 0; $i < 5; $i++ ) : ?>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="<?php echo $i < $t['stars'] ? 'var(--wp-gold)' : '#ddd'; ?>" aria-hidden="true">
								<polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
							</svg>
						<?php endfor; ?>
					</div>
					<h3 class="testimonial-card__headline" style="font-size:var(--text-lg);font-weight:700;margin:0 0 var(--space-sm);" itemprop="name">
						<?php echo esc_html( $t['headline'] ); ?>
					</h3>
				</header>
				<blockquote style="margin:0 0 var(--space-md);padding:0;" itemprop="reviewBody">
					<p style="color:var(--wp-gray);font-style:italic;line-height:1.7;">"<?php echo esc_html( $t['text'] ); ?>"</p>
				</blockquote>
				<footer style="border-top:1px solid var(--wp-border);padding-top:var(--space-sm);display:flex;justify-content:space-between;align-items:center;">
					<cite style="font-style:normal;" itemprop="author" itemscope itemtype="https://schema.org/Person">
						<strong itemprop="name"><?php echo esc_html( $t['name'] ); ?></strong><br>
						<span style="color:var(--wp-gray);font-size:var(--text-sm);">
							<?php echo esc_html( $t['location'] ); ?>
						</span>
					</cite>
					<time style="font-size:var(--text-xs);color:var(--wp-gray);" itemprop="datePublished">
						<?php echo esc_html( $t['date'] ); ?>
					</time>
				</footer>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="section bg--navy text-white" aria-labelledby="testimonials-cta-heading">
	<div class="container text-center">
		<h2 id="testimonials-cta-heading" style="color:#fff;">Ready to Join Our Happy Sellers?</h2>
		<p style="font-size:var(--text-lg);color:rgba(255,255,255,0.8);margin-bottom:var(--space-lg);">
			Get your free, no-obligation cash offer in 24 hours.
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
