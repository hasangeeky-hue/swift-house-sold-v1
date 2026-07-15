<?php
/**
 * State Landing Page Template
 *
 * @package WholesalePro
 */

get_header();

$state_info   = wholesalepro_get_current_state_name();
$state_name   = $state_info['name'] ?? '';
$state_abbr   = $state_info['abbr'] ?? '';
$company_name = get_theme_mod( 'company_name', 'Swift House Sold' );
$phone        = get_theme_mod( 'company_phone', '' );
$phone_raw    = get_theme_mod( 'company_phone_raw', '' );
$sell_url     = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );
$deals_url    = ( $p = get_page_by_path( 'browse-deals' ) )       ? get_permalink( $p->ID ) : home_url( '/browse-deals' );
$state_label  = $state_name ?: 'Your State';
$ua           = strtoupper( $state_abbr );

/* ── Per-state content ──────────────────────────────────────── */
$state_content = array(
	'TX' => array(
		'h1'          => 'We Buy Houses In Texas For Cash — Any Condition, Any City',
		'subtitle'    => 'From Dallas-Fort Worth to Houston, San Antonio to Austin and every community in between. Get a fair cash offer within 24 hours.',
		'intro'       => 'Texas has the most active wholesale real estate market in the country, and for good reason. With no state income tax, a business-friendly legal environment, and consistent population growth driving demand, Texas remains one of the strongest markets for both motivated sellers who need speed and investors who need profitable deals. We cover all 254 Texas counties.',
		'market'      => 'The Texas market moves quickly. Pre-foreclosure filings run consistently high in the major metros, the probate calendar in Dallas and Harris counties generates significant estate sale inventory, and the continued in-migration to Texas communities creates a steady stream of relocation-driven sales where speed matters more than maximum price.',
		'cities'      => 'Dallas, Houston, San Antonio, Austin, Fort Worth, El Paso, Arlington, Corpus Christi, Plano, Lubbock, Laredo, Irving, Garland, Frisco, McKinney',
	),
	'FL' => array(
		'h1'          => 'We Buy Houses In Florida For Cash — All 67 Counties',
		'subtitle'    => 'From Miami to Jacksonville, Tampa to Orlando. Fast cash offers for Florida homeowners in any situation.',
		'intro'       => 'Florida consistently ranks among the highest states for foreclosure activity and motivated seller volume. A large retiree population means significant probate inventory. A high percentage of investment properties means a constant supply of tired landlords ready to exit. We cover every county in Florida with a network of active cash buyers who close fast.',
		'market'      => 'Florida is a judicial foreclosure state, meaning the process moves through the courts and gives motivated sellers more time to act. This creates a window where a fast cash sale genuinely helps sellers avoid the worst outcomes. Our Florida pipeline is active year-round across all major markets. Hurricane and flooding risk creates persistent motivated seller inventory from homeowners dealing with damage and rising insurance costs.',
		'cities'      => 'Miami, Jacksonville, Tampa, Orlando, St. Petersburg, Hialeah, Tallahassee, Fort Lauderdale, Cape Coral, Pembroke Pines, Hollywood, Gainesville, Clearwater, Miramar, Coral Springs',
	),
	'GA' => array(
		'h1'          => 'We Buy Houses In Georgia For Cash — Atlanta and Statewide',
		'subtitle'    => 'From Atlanta and its growing suburbs to Savannah, Augusta, and every Georgia community. Cash offers in 24 hours.',
		'intro'       => "Georgia's population growth — driven primarily by the Atlanta metropolitan area but increasingly visible in mid-sized cities like Columbus, Macon, and Augusta — creates consistent demand for below-market properties from the investor community. Georgia is a non-judicial foreclosure state, which means the process moves quickly and sellers who need to act have a narrower window.",
		'market'      => 'The Atlanta suburbs of Gwinnett, Cobb, and Clayton counties see significant distressed property activity, with tax delinquency and pre-foreclosure inventories refreshing regularly. Savannah and the coastal communities offer strong probate and estate sale opportunities as the population ages. We buy in all 159 Georgia counties.',
		'cities'      => 'Atlanta, Columbus, Savannah, Athens, Macon, Sandy Springs, Augusta, Roswell, Johns Creek, Albany, Warner Robins, Alpharetta, Marietta, Smyrna, Valdosta',
	),
	'OH' => array(
		'h1'          => 'We Buy Houses In Ohio For Cash — All 88 Counties',
		'subtitle'    => 'From Cleveland and Columbus to Cincinnati, Toledo, and every Ohio community. Any condition, fair cash offers.',
		'intro'       => 'Ohio has one of the highest concentrations of distressed property inventory in the United States. Former industrial cities like Cleveland, Youngstown, and Toledo see persistently high foreclosure rates, significant tax delinquency, and large vacant property inventories. For investors, Ohio offers some of the best entry-price opportunities in the country. For sellers, Ohio\'s motivated seller pool is large and our buyer network is deep.',
		'market'      => 'Ohio is a judicial foreclosure state with a process that typically runs six months or longer. This gives sellers meaningful time to explore a cash sale before losing their property through the court system. Our Ohio pipeline covers all 88 counties with particular depth in Cuyahoga, Franklin, Hamilton, Summit, and Lucas counties.',
		'cities'      => 'Columbus, Cleveland, Cincinnati, Toledo, Akron, Dayton, Parma, Canton, Youngstown, Lorain, Hamilton, Springfield, Kettering, Elyria, Newark',
	),
	'NC' => array(
		'h1'          => 'We Buy Houses In North Carolina — Charlotte, Raleigh, and Statewide',
		'subtitle'    => 'Fast cash offers across all 100 North Carolina counties. Any condition, any situation, close in 7–14 days.',
		'intro'       => 'North Carolina is among the fastest-growing states in the country, with Charlotte and Raleigh-Durham consistently ranked among the top relocation destinations in the Southeast. This growth creates natural motivated seller volume — people who need to sell quickly to relocate, estates of long-term residents, and landlords exiting a market that has grown more competitive for rental operations.',
		'market'      => "Charlotte's rapid growth has created displacement in historically lower-income neighborhoods, generating motivated seller inventory among long-term homeowners who find themselves equity-rich but unable to maintain aging properties. The Research Triangle's growth mirrors this pattern. We cover all 100 North Carolina counties.",
		'cities'      => 'Charlotte, Raleigh, Greensboro, Durham, Winston-Salem, Fayetteville, Cary, Wilmington, High Point, Concord, Gastonia, Asheville, Chapel Hill, Rocky Mount, Burlington',
	),
	'TN' => array(
		'h1'          => 'We Buy Houses In Tennessee For Cash — Nashville, Memphis, and Statewide',
		'subtitle'    => 'Cash offers within 24 hours across all 95 Tennessee counties. Any property, any situation, your timeline.',
		'intro'       => 'Tennessee has no state income tax and has experienced significant population growth over the past decade, particularly in the Nashville and Knoxville metropolitan areas. The growing market creates motivated seller volume from long-term homeowners who find themselves in financial difficulty alongside new inventory from the region\'s expanding population.',
		'market'      => "Nashville's extraordinary growth has transformed it into one of the most expensive mid-sized cities in the South. This creates a significant motivated seller population among long-term residents who own equity-rich properties but face financial pressure from rising property taxes and cost of living increases. Memphis is one of the highest-volume wholesale markets in the state.",
		'cities'      => 'Nashville, Memphis, Knoxville, Chattanooga, Clarksville, Murfreesboro, Franklin, Jackson, Johnson City, Bartlett, Hendersonville, Kingsport, Collierville, Smyrna, Cleveland',
	),
	'MI' => array(
		'h1'          => 'We Buy Houses In Michigan For Cash — Detroit, Grand Rapids, and Statewide',
		'subtitle'    => 'Fast cash offers across all 83 Michigan counties. Distressed properties our specialty. Close in days, not months.',
		'intro'       => 'Michigan offers some of the highest concentrations of distressed property inventory in the Midwest. Detroit and the surrounding Wayne County communities have significant pre-foreclosure and tax delinquency inventory, while mid-sized cities like Flint, Saginaw, and Lansing see consistent motivated seller volume. For investors, Michigan\'s entry prices remain among the lowest in any major market.',
		'market'      => "Detroit and Wayne County have among the highest concentrations of distressed residential property in the United States. The city's economic history has left significant tax delinquency, vacancy, and pre-foreclosure inventory across many neighborhoods. Michigan's judicial foreclosure process gives sellers time to pursue a cash sale alternative.",
		'cities'      => 'Detroit, Grand Rapids, Warren, Sterling Heights, Ann Arbor, Lansing, Flint, Dearborn, Livonia, Westland, Troy, Farmington Hills, Kalamazoo, Wyoming, Southfield',
	),
	'AZ' => array(
		'h1'          => 'We Buy Houses In Arizona For Cash — Phoenix, Tucson, and Statewide',
		'subtitle'    => 'Cash offers in 24 hours across all 15 Arizona counties. Fast close, fair price, no commissions.',
		'intro'       => 'Arizona is a non-judicial foreclosure state with one of the fastest processes in the country — as short as 90 days from first notice to trustee sale. This compressed timeline makes early action critically important for Arizona homeowners in pre-foreclosure. The Phoenix metropolitan area has a highly active investor community making it one of the most liquid wholesale markets in the western United States.',
		'market'      => "Phoenix's continued growth from California migration sustains robust buyer demand and strong ARV numbers across most neighborhoods. Tucson's large retiree and military population generates consistent probate and relocation-driven motivated seller inventory. For sellers in Arizona, acting early in the foreclosure process significantly expands available options.",
		'cities'      => 'Phoenix, Tucson, Mesa, Chandler, Scottsdale, Glendale, Gilbert, Tempe, Peoria, Surprise, Yuma, Avondale, Goodyear, Flagstaff, Lake Havasu City',
	),
	'VA' => array(
		'h1'          => 'We Buy Houses In Virginia For Cash — Richmond, Northern Virginia, and Statewide',
		'subtitle'    => 'Cash offers across all Virginia counties and independent cities. Any condition, fast close, no fees.',
		'intro'       => "Virginia's real estate market is diverse, ranging from the high-demand Northern Virginia suburbs of Washington DC to the more affordable markets of Richmond, Roanoke, and the Hampton Roads region. This diversity means motivated seller situations exist across every price point, from entry-level distressed properties to mid-market homes where sellers need speed over maximum price.",
		'market'      => 'Richmond and the surrounding counties have a steady flow of pre-foreclosure and estate sale inventory. Hampton Roads, with its large military population, sees significant relocation-driven motivated seller situations when deployment and reassignment create urgent timelines. Northern Virginia sees equity-rich homeowners who need fast sales without the disruption of traditional listing.',
		'cities'      => 'Virginia Beach, Norfolk, Chesapeake, Richmond, Newport News, Alexandria, Hampton, Roanoke, Portsmouth, Suffolk, Lynchburg, Harrisonburg, Charlottesville, Danville, Manassas',
	),
	'IN' => array(
		'h1'          => 'We Buy Houses In Indiana For Cash — Indianapolis and Statewide',
		'subtitle'    => 'Fast cash offers across all 92 Indiana counties. Any property, any condition, your closing date.',
		'intro'       => 'Indiana offers one of the most cost-effective entry points for real estate investors in the Midwest. Indianapolis has experienced consistent growth and has an active investor community. The state\'s affordable median prices mean significant equity opportunities exist for buyers willing to purchase and renovate distressed properties. Indiana is a judicial foreclosure state, giving motivated sellers meaningful time to pursue alternatives.',
		'market'      => "Indianapolis's working-class homeowner population generates significant pre-foreclosure and tax delinquency inventory across Marion County and the surrounding communities. Gary and Hammond in the northwest corner of the state, closely tied to the Chicago market, see consistent distressed property activity. Indiana's affordable entry prices attract investors from neighboring states.",
		'cities'      => 'Indianapolis, Fort Wayne, Evansville, South Bend, Carmel, Fishers, Bloomington, Hammond, Gary, Lafayette, Muncie, Terre Haute, Kokomo, Anderson, Noblesville',
	),
);

$content = $state_content[ $ua ] ?? array(
	'h1'       => sprintf( 'We Buy Houses In %s For Cash', $state_label ),
	'subtitle' => sprintf( 'Fast cash offers for %s homeowners in any situation. Any condition, fair price, close in 7–14 days.', $state_label ),
	'intro'    => sprintf( '%s buys houses in %s in any condition. No repairs, no commissions, no fees. Fair written cash offer within 24 hours and close on your timeline.', $company_name, $state_label ),
	'market'   => sprintf( 'Our buyer network covers every county in %s with active cash buyers who are ready to close quickly. Whether you are in a major metro or a small rural community, we have the resources to make you a fair offer.', $state_label ),
	'cities'   => '',
);
?>

<!-- ━━ HERO ━━ -->
<section class="page-hero page-hero--seller" aria-labelledby="state-hero-heading">
	<div class="container">
		<div class="hero__inner">
			<div class="hero__content">
				<?php wholesalepro_breadcrumb(); ?>
				<p class="hero__eyebrow animate-on-scroll">
					WE BUY HOUSES IN <?php echo esc_html( strtoupper( $state_label ) ); ?>
				</p>
				<h1 class="hero__title animate-on-scroll" id="state-hero-heading" style="transition-delay:0.1s">
					<?php echo esc_html( $content['h1'] ); ?>
				</h1>
				<p class="hero__subtitle animate-on-scroll" style="transition-delay:0.2s">
					<?php echo esc_html( $content['subtitle'] ); ?>
				</p>
				<ul class="checklist animate-on-scroll" style="transition-delay:0.3s">
					<li class="checklist__item checklist__item--check">No repairs or cleaning required</li>
					<li class="checklist__item checklist__item--check">Zero commissions or fees of any kind</li>
					<li class="checklist__item checklist__item--check">Close in 7 to 30 days — your choice</li>
					<li class="checklist__item checklist__item--check"><?php printf( 'Serving all cities and counties in %s', esc_html( $state_label ) ); ?></li>
				</ul>
				<div class="hero__actions animate-on-scroll" style="transition-delay:0.4s">
					<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline btn--lg" style="color:var(--wp-navy);border-color:var(--wp-navy);">
						<?php echo esc_html( $phone ); ?>
					</a>
				</div>
			</div>
			<div class="hero__form-wrap animate-on-scroll" style="transition-delay:0.2s">
				<div class="hero__form-card">
					<h2 class="hero__form-card__heading"><?php printf( 'Get Your %s Cash Offer', esc_html( $state_label ) ); ?></h2>
					<p class="hero__form-card__sub">2 minutes. No obligation.</p>
					<?php echo wholesalepro_render_seller_form( 'state-' . strtolower( $state_abbr ) ); // phpcs:ignore ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php echo wholesalepro_get_trust_bar(); // phpcs:ignore ?>

<!-- ━━ MARKET INTRO ━━ -->
<section class="section" aria-labelledby="state-market-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-2xl);align-items:start;">
			<div class="animate-on-scroll">
				<p class="section-header__eyebrow"><?php printf( 'SELLING IN %s', esc_html( strtoupper( $state_label ) ) ); ?></p>
				<h2 id="state-market-heading" style="margin-bottom:var(--space-lg);">
					<?php printf( 'The %s Real Estate Market — What You Need to Know', esc_html( $state_label ) ); ?>
				</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);"><?php echo esc_html( $content['intro'] ); ?></p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);"><?php echo esc_html( $content['market'] ); ?></p>
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Cash Offer</a>
			</div>
			<div class="animate-on-scroll" style="transition-delay:0.2s">
				<div class="card" style="padding:var(--space-xl);">
					<h3 style="margin-bottom:var(--space-lg);"><?php printf( 'Why %s Homeowners Choose Us', esc_html( $state_label ) ); ?></h3>
					<?php
					$reasons = array(
						array( '⚡', sprintf( 'Fastest Close in %s', $state_label ), sprintf( 'We know %s real estate law and work with licensed local title companies to close in as little as 7 days.', $state_label ) ),
						array( '🤝', 'Local Market Expertise', sprintf( 'Our team has bought and sold hundreds of properties across %s — from major metros to small towns.', $state_label ) ),
						array( '💰', 'Zero Hidden Fees', 'No commissions, no closing costs, no surprise deductions. The number we quote is the number you receive.' ),
					);
					foreach ( $reasons as $r ) : ?>
					<div style="display:flex;gap:var(--space-md);align-items:flex-start;margin-bottom:var(--space-lg);">
						<span style="font-size:1.75rem;flex-shrink:0;" aria-hidden="true"><?php echo $r[0]; // phpcs:ignore ?></span>
						<div>
							<h4 style="margin-bottom:4px;font-size:1rem;"><?php echo esc_html( $r[1] ); ?></h4>
							<p style="color:var(--wp-gray);font-size:0.875rem;margin:0;"><?php echo esc_html( $r[2] ); ?></p>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ━━ CITIES GRID ━━ -->
<?php if ( ! empty( $content['cities'] ) ) : ?>
<section class="section bg--light-gray" aria-labelledby="state-cities-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="state-cities-heading">
				<?php printf( 'Cities We Serve in %s', esc_html( $state_label ) ); ?>
			</h2>
		</div>
		<div class="state-grid animate-on-scroll" style="margin-top:var(--space-xl);display:flex;flex-wrap:wrap;gap:var(--space-sm);">
			<?php
			$cities_list = array_map( 'trim', explode( ',', $content['cities'] ) );
			foreach ( $cities_list as $city_name ) :
				if ( ! $city_name ) continue;
				$city_slug = 'we-buy-houses-' . sanitize_title( $city_name ) . '-' . strtolower( $state_abbr );
				$city_page = get_page_by_path( $city_slug );
				?>
			<div class="state-grid__item" style="background:#fff;border:1px solid var(--wp-border);border-radius:var(--radius-md);padding:8px 16px;font-size:0.875rem;">
				<?php if ( $city_page ) : ?>
				<a href="<?php echo esc_url( get_permalink( $city_page->ID ) ); ?>"><?php echo esc_html( $city_name ); ?></a>
				<?php else : ?>
				<span style="color:var(--wp-gray);"><?php echo esc_html( $city_name ); ?></span>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ━━ STATE DEALS ━━ -->
<?php if ( $state_abbr ) :
	$state_deals = new WP_Query( array( 'post_type' => 'property', 'post_status' => 'publish', 'posts_per_page' => 3, 'tax_query' => array( array( 'taxonomy' => 'property_state', 'field' => 'slug', 'terms' => wholesalepro_state_slug( $state_abbr ) ) ) ) );
	if ( $state_deals->have_posts() ) : ?>
<section class="section" aria-labelledby="state-deals-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="state-deals-heading"><?php printf( 'Available Investment Deals in %s', esc_html( $state_label ) ); ?></h2>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);margin-top:var(--space-xl);">
			<?php while ( $state_deals->have_posts() ) : $state_deals->the_post(); ?>
				<?php echo wholesalepro_get_property_card( get_the_ID() ); // phpcs:ignore ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div class="text-center" style="margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">View All <?php echo esc_html( $state_label ); ?> Deals &rarr;</a>
		</div>
	</div>
</section>
<?php endif; ?>
<?php endif; ?>

<!-- ━━ CTA ━━ -->
<section class="section bg--light-gray" aria-labelledby="state-cta-heading">
	<div class="container narrow text-center animate-on-scroll">
		<h2 id="state-cta-heading" style="margin-bottom:var(--space-md);"><?php printf( 'Ready to Sell Your %s House?', esc_html( $state_label ) ); ?></h2>
		<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">No pressure, no obligation. Just a fair cash offer.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Free Cash Offer</a>
			<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline btn--lg"><?php echo esc_html( $phone ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
