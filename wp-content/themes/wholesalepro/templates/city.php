<?php
/**
 * City Landing Page Template
 *
 * @package WholesalePro
 */

get_header();

$city_info    = wholesalepro_get_current_city_state();
$city_name    = $city_info['city']  ?? '';
$state_name   = $city_info['state'] ?? '';
$state_abbr   = $city_info['abbr']  ?? '';
$company_name = get_theme_mod( 'company_name', 'Swift House Sold' );
$phone        = get_theme_mod( 'company_phone', '' );
$phone_raw    = get_theme_mod( 'company_phone_raw', '' );
$sell_url     = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );
$deals_url    = ( $p = get_page_by_path( 'browse-deals' ) )       ? get_permalink( $p->ID ) : home_url( '/browse-deals' );
$city_label   = $city_name  ?: 'Your City';
$state_label  = $state_name ?: ( $state_abbr ?: 'Your State' );
$city_key     = strtoupper( $city_name );

/* ── Per-city content ────────────────────────────────────────── */
$city_content = array(

	'DALLAS' => array(
		'h1'         => 'We Buy Houses in Dallas, TX For Cash, Any Condition, Fast Close',
		'subtitle'   => 'Dallas homeowners get a fair cash offer within 24 hours. No repairs, no agent, no fees. Close in as little as 7 days.',
		'intro'      => 'Dallas is one of the most active wholesale real estate markets in the country. Strong population growth, a large working-class homeowner base in communities like Mesquite, Garland, and South Dallas, and a persistent pre-foreclosure pipeline make Dallas a primary market for our acquisition and disposition activity. We buy houses in all Dallas neighborhoods, from Far East Dallas to Oak Cliff to Irving and Farmers Branch.',
		'local_note' => 'Dallas County processes a high volume of foreclosure filings every quarter. Texas is a non-judicial foreclosure state, which means the process moves in as little as 60 days from first notice. If you have received a Notice of Default, the window to act through a traditional sale is extremely narrow. A cash sale is the fastest and most reliable path to stopping a foreclosure in Dallas.',
		'cta_sub'    => 'Serving all Dallas neighborhoods, suburbs, and surrounding communities including Garland, Irving, Mesquite, Grand Prairie, and Farmers Branch.',
	),

	'HOUSTON' => array(
		'h1'         => 'We Buy Houses in Houston, TX For Cash, All Harris County',
		'subtitle'   => 'Cash offers for Houston homeowners in any situation. Flood damage, probate, foreclosure, tired landlord, we buy it.',
		'intro'      => 'Houston is the largest city by area in the United States and has one of the most diverse motivated seller pipelines in the country. Harvey and subsequent flooding events left thousands of properties in varying states of damage across Harris and Fort Bend counties. Probate activity is high in a city with a large permanent population. Landlord exits are consistent across the Inner Loop working-class neighborhoods.',
		'local_note' => "Houston's bayou system creates persistent flood risk across many neighborhoods. Homes in the 100-year and 500-year flood plains carry significant insurance costs and face buyer resistance on the traditional market. We buy flood-zone properties, flood-damaged properties, and properties with FEMA elevation issues without requiring repairs or flood mitigation work from the seller.",
		'cta_sub'    => 'Serving Houston, Katy, Sugar Land, Pasadena, Pearland, Baytown, Missouri City, and all Harris and Fort Bend County communities.',
	),

	'ATLANTA' => array(
		'h1'         => 'We Buy Houses in Atlanta, GA For Cash, Any Condition, Your Timeline',
		'subtitle'   => 'Atlanta homeowners get a fair written cash offer within 24 hours. Close in 7–21 days on your schedule.',
		'intro'      => 'Atlanta is the fastest-growing major metro in the Southeast and one of the most active wholesale real estate markets in the country. Rapid gentrification in neighborhoods like West End, Mechanicsville, and East Point creates motivated seller situations among long-term homeowners who face rising property taxes, deferred maintenance, and financial pressure. We buy in all Atlanta neighborhoods, intown and suburban.',
		'local_note' => "Atlanta's Fulton and DeKalb county tax assessor offices conduct reassessments that regularly increase property tax burdens on long-term homeowners in gentrifying neighborhoods. Many sellers find that selling for cash is more financially advantageous than continuing to hold a property with rising taxes and maintenance costs. Georgia is a non-judicial foreclosure state, pre-foreclosure situations move quickly.",
		'cta_sub'    => 'Serving Atlanta, Decatur, College Park, East Point, Smyrna, Marietta, Jonesboro, and all metro Atlanta communities.',
	),

	'COLUMBUS' => array(
		'h1'         => 'We Buy Houses in Columbus, OH For Cash, All Franklin County',
		'subtitle'   => 'Columbus homeowners get a fair cash offer within 24 hours. Any condition, no repairs, close in days.',
		'intro'      => "Columbus is Ohio's fastest-growing city and has a consistent motivated seller pipeline across its diverse neighborhoods. From the south side communities of Merion Village and Frebis to the east side neighborhoods of Linden and Weinland Park, Columbus has significant pre-foreclosure and tax delinquency activity. The city's strong investor community makes it a high-liquidity wholesale market.",
		'local_note' => "Columbus is in Ohio, a judicial foreclosure state, meaning Ohio's court-based process gives sellers more time, typically six months or more, to pursue alternatives to foreclosure. This window is real and actionable. We help Columbus homeowners use that time effectively to secure a fair cash offer and close before their property goes to sheriff sale.",
		'cta_sub'    => 'Serving Columbus, Westerville, Grove City, Dublin, Hilliard, Gahanna, Reynoldsburg, Whitehall, and all Franklin County communities.',
	),

	'MIAMI' => array(
		'h1'         => 'We Buy Houses in Miami, FL For Cash, All Miami-Dade County',
		'subtitle'   => 'Fast cash offers for Miami homeowners in any situation. No repairs, no commissions, close on your timeline.',
		'intro'      => "Miami's real estate market is among the most complex in the country. Extreme insurance costs, HOA issues, condo special assessments, flood zone implications, and the high cost of deferred maintenance create motivated seller situations across all price points. Miami-Dade County has consistently high foreclosure filing rates, and the probate calendar is significant given the large permanent retiree population.",
		'local_note' => 'Miami homeowners face some of the highest property insurance costs in the country. Many sellers find that the annual carrying cost of their property, insurance, HOA fees, property taxes, and maintenance, has made holding the property financially untenable. We buy Miami properties in any condition and can close quickly, eliminating ongoing carrying costs immediately upon closing.',
		'cta_sub'    => 'Serving Miami, Hialeah, Coral Gables, Kendall, Homestead, Miami Gardens, North Miami, and all Miami-Dade County communities.',
	),

	'JACKSONVILLE' => array(
		'h1'         => 'We Buy Houses in Jacksonville, FL For Cash, Duval County and Beyond',
		'subtitle'   => 'Cash offers within 24 hours for Jacksonville homeowners. Any condition, any situation. Close in 7–14 days.',
		'intro'      => "Jacksonville is Florida's largest city by area and has significant motivated seller activity across its diverse neighborhoods. The city's large military population at Naval Air Station Jacksonville creates a steady stream of relocation-driven motivated seller situations. Duval County has one of the most active wholesale markets in North Florida.",
		'local_note' => "Jacksonville's large geographic footprint includes neighborhoods ranging from beachside communities to rural-edge areas. We buy in all Jacksonville neighborhoods including the Northside, Westside, Southside, Arlington, and the Jacksonville Beaches communities. No property is too remote or too distressed for our network.",
		'cta_sub'    => 'Serving Jacksonville, Orange Park, Fleming Island, Middleburg, Ponte Vedra, St. Augustine, and all surrounding communities.',
	),

	'CHARLOTTE' => array(
		'h1'         => 'We Buy Houses in Charlotte, NC For Cash, Mecklenburg County and Beyond',
		'subtitle'   => 'Charlotte homeowners get a fair cash offer in 24 hours. No cleaning, no repairs, no commissions. Your timeline.',
		'intro'      => "Charlotte has experienced explosive growth over the past decade, making it one of the most dynamic real estate markets in the Southeast. This growth creates motivated seller inventory in neighborhoods where long-term residents find themselves equity-rich but facing financial pressure from rising property taxes and the cost of maintaining aging properties. Charlotte's working-class Eastside, Westside, and University City neighborhoods see consistent pre-foreclosure activity.",
		'local_note' => "Charlotte's rapid appreciation has pushed property taxes significantly higher in many historically affordable neighborhoods. Long-term homeowners who purchased their homes for \$80,000–\$120,000 a decade ago now face tax assessments based on values of \$250,000 or more. For sellers in this situation, a cash sale often makes more financial sense than continuing to hold.",
		'cta_sub'    => 'Serving Charlotte, Concord, Gastonia, Monroe, Rock Hill SC, Kannapolis, Huntersville, and all greater Charlotte communities.',
	),

	'NASHVILLE' => array(
		'h1'         => 'We Buy Houses in Nashville, TN For Cash, Davidson County and Middle Tennessee',
		'subtitle'   => 'Nashville homeowners get a written cash offer in 24 hours. Fast, fair, and completely hassle-free.',
		'intro'      => "Nashville's extraordinary growth has transformed it from a mid-sized Southern city into one of the most expensive markets in the South. This transformation has created significant motivated seller activity among long-term residents in neighborhoods like North Nashville, Antioch, and Madison who find themselves with substantial equity but unable to maintain aging properties or absorb rising carrying costs.",
		'local_note' => "Nashville's pre-foreclosure pipeline is active across Davidson County as rising property taxes, HOA fees, and cost-of-living increases outpace income growth for many long-term homeowners. Tennessee is a non-judicial foreclosure state, the process can move quickly. If you have received a notice of default on your Nashville property, early action is essential.",
		'cta_sub'    => 'Serving Nashville, Murfreesboro, Hendersonville, Smyrna, Mount Juliet, Brentwood, and all Middle Tennessee communities.',
	),

	'PHOENIX' => array(
		'h1'         => 'We Buy Houses in Phoenix, AZ For Cash, Maricopa County and Beyond',
		'subtitle'   => 'Phoenix homeowners get a cash offer within 24 hours. Any condition. Close in as little as 7 days.',
		'intro'      => 'Phoenix is one of the most liquid wholesale real estate markets in the United States. A large active investor community, strong population growth from California migration, and consistent motivated seller inventory across the Valley\'s working-class communities make Phoenix a primary acquisition market. We buy in all Phoenix neighborhoods, from South Mountain to the West Valley.',
		'local_note' => "Arizona is a non-judicial foreclosure state with one of the fastest processes in the country, as short as 90 days from first notice to trustee sale. Phoenix homeowners who have received a Notice of Trustee's Sale have a very limited window. A cash transaction, completed before that date, stops the foreclosure and allows the seller to walk away with cash rather than losing the property entirely.",
		'cta_sub'    => 'Serving Phoenix, Glendale, Peoria, Avondale, Goodyear, Chandler, Gilbert, Mesa, Tempe, and all Maricopa County communities.',
	),

	'DETROIT' => array(
		'h1'         => 'We Buy Houses in Detroit, MI For Cash, Wayne County and Metro Detroit',
		'subtitle'   => 'Detroit homeowners and landlords get fair cash offers in 24 hours. Any condition, any neighborhood. Fast close.',
		'intro'      => 'Detroit has one of the highest concentrations of motivated seller inventory in the United States. Tax delinquency, pre-foreclosure, and vacant property issues are significant across many Wayne County neighborhoods. For investors, Detroit offers entry prices that remain among the lowest in any major market. For sellers, we provide a legitimate, hassle-free exit regardless of property condition.',
		'local_note' => "Detroit's property tax foreclosure process through the Wayne County Treasurer is one of the most active in the country, placing thousands of properties into auction each year. Homeowners who are behind on property taxes can often avoid auction by completing a cash sale before the March 31st deadline. We work with Detroit homeowners to close quickly and help them avoid the Wayne County tax auction.",
		'cta_sub'    => 'Serving Detroit, Dearborn, Hamtramck, Highland Park, Warren, Eastpointe, Harper Woods, and all Wayne and Macomb County communities.',
	),

	'MEMPHIS' => array(
		'h1'         => 'We Buy Houses in Memphis, TN For Cash, Shelby County and Beyond',
		'subtitle'   => 'Memphis homeowners get a fair cash offer within 24 hours. No repairs, no commissions, your closing date.',
		'intro'      => 'Memphis is one of the highest-volume wholesale real estate markets in the Mid-South. Shelby County has persistent pre-foreclosure and tax delinquency activity, and the city\'s large rental market generates consistent tired landlord exits. For investors, Memphis offers strong rental yield fundamentals with entry prices that pencil well on a cash flow basis.',
		'local_note' => 'Memphis and Shelby County have experienced population decline and property value challenges in many neighborhoods, creating both motivated seller situations and investment opportunities for buyers. We buy in all Memphis neighborhoods including South Memphis, Frayser, Whitehaven, Hickory Hill, and Midtown.',
		'cta_sub'    => 'Serving Memphis, Bartlett, Germantown, Collierville, Cordova, Millington, and all Shelby County communities.',
	),

	'TAMPA' => array(
		'h1'         => 'We Buy Houses in Tampa, FL For Cash, Hillsborough County and the Bay Area',
		'subtitle'   => 'Tampa homeowners get a written cash offer in 24 hours. Any condition, fast close, zero fees.',
		'intro'      => 'Tampa Bay is one of the fastest-growing metro areas in Florida and has a significant motivated seller pipeline from rising insurance costs, flood zone implications, and estate sale inventory in its large retiree population. We buy in all Tampa neighborhoods including East Tampa, Seminole Heights, Town and Country, and Brandon.',
		'local_note' => 'Tampa homeowners face some of the highest property insurance rates in Florida due to hurricane risk and flood zone designations. Many sellers find that the annual carrying cost of their property, insurance alone often exceeds $5,000–$8,000 annually, makes a cash sale the most financially sound decision.',
		'cta_sub'    => 'Serving Tampa, St. Petersburg, Clearwater, Brandon, Riverview, Wesley Chapel, Land O Lakes, and all Hillsborough and Pinellas County communities.',
	),

	'ORLANDO' => array(
		'h1'         => 'We Buy Houses in Orlando, FL For Cash, Orange County and Central Florida',
		'subtitle'   => 'Orlando homeowners get a cash offer in 24 hours. Close in days, not months. No repairs, no commissions.',
		'intro'      => "Orlando's tourism and service economy creates a large workforce homeowner population that is particularly vulnerable to income disruption from job loss or reduced hours. Orange County pre-foreclosure activity is consistent, and the large number of investment properties in tourist corridor communities generates significant tired landlord activity.",
		'local_note' => "Orlando's HOA-heavy community structure creates additional motivated seller scenarios where homeowners behind on HOA dues face lien action alongside or in addition to mortgage default. We buy properties with HOA liens, unpaid assessments, and other encumbrances, our team handles these issues as part of the transaction.",
		'cta_sub'    => 'Serving Orlando, Kissimmee, Sanford, Deltona, Altamonte Springs, Apopka, Winter Park, and all Orange and Seminole County communities.',
	),

	'CLEVELAND' => array(
		'h1'         => 'We Buy Houses in Cleveland, OH For Cash, Cuyahoga County and Northeast Ohio',
		'subtitle'   => 'Fast cash offers for Cleveland homeowners. Any condition, any situation. Fair price and a fast close.',
		'intro'      => 'Cleveland has one of the highest concentrations of distressed residential property inventory in the United States. Cuyahoga County\'s pre-foreclosure and tax delinquency pipelines are among the deepest in Ohio, and the city\'s working-class homeowner base faces persistent economic pressure. For investors, Cleveland offers entry prices with strong rental yield potential.',
		'local_note' => "Cleveland and Cuyahoga County have among the most active foreclosure dockets in Ohio. Ohio's judicial foreclosure process gives sellers meaningful time to act, typically six months or more, but that window requires proactive effort. We help Cleveland homeowners use that time to secure a fair cash offer and close before their property goes to sheriff sale.",
		'cta_sub'    => 'Serving Cleveland, Parma, Euclid, Cleveland Heights, Lakewood, Garfield Heights, East Cleveland, and all Cuyahoga County communities.',
	),

	'CINCINNATI' => array(
		'h1'         => 'We Buy Houses in Cincinnati, OH For Cash, Hamilton County and the Tri-State',
		'subtitle'   => 'Cincinnati homeowners get a fair cash offer in 24 hours. No repairs, no fees, close on your schedule.',
		'intro'      => "Cincinnati's diverse neighborhood mix, from the historic Over-The-Rhine area to the Price Hill and Bond Hill working-class communities, generates consistent motivated seller activity across Hamilton County. The city's position on the Ohio-Kentucky-Indiana tri-state border means our buyer network is active across all three states.",
		'local_note' => "Cincinnati's probate court calendar is active, reflecting a long-established homeowner population aging in place. Inherited properties, estate sales, and heirs needing to liquidate make up a significant portion of our Cincinnati acquisition pipeline. We handle all probate-related complications as part of the transaction.",
		'cta_sub'    => 'Serving Cincinnati, Norwood, Covington KY, Florence KY, Mason, Fairfield, Hamilton, and all Hamilton County and northern Kentucky communities.',
	),

	'RICHMOND' => array(
		'h1'         => 'We Buy Houses in Richmond, VA For Cash, City of Richmond and Surrounding Counties',
		'subtitle'   => 'Richmond homeowners get a written cash offer within 24 hours. Fast, fair, and completely hassle-free.',
		'intro'      => "Richmond's diverse real estate landscape, from the historic Church Hill and Manchester neighborhoods to the Southside working-class communities, creates motivated seller situations across a wide range of property types and price points. The city's large estate sale inventory reflects a stable long-term homeowner population.",
		'local_note' => "Richmond and the surrounding counties of Chesterfield, Henrico, and Hanover have a consistent pre-foreclosure pipeline. Virginia is a non-judicial foreclosure state, meaning the process can move relatively quickly. Homeowners who have received a trustee sale notice have a limited window to pursue a cash sale alternative.",
		'cta_sub'    => 'Serving Richmond, Chesterfield, Henrico, Mechanicsville, Midlothian, Colonial Heights, and all greater Richmond area communities.',
	),

	'INDIANAPOLIS' => array(
		'h1'         => 'We Buy Houses in Indianapolis, IN For Cash, Marion County and Beyond',
		'subtitle'   => 'Indianapolis homeowners get a fair cash offer in 24 hours. Close in as little as 7 days. No repairs, no fees.',
		'intro'      => "Indianapolis has a consistent motivated seller pipeline across Marion County's diverse neighborhoods. From the near Eastside and Southside working-class communities to the growing suburban edge, Indianapolis offers a broad range of acquisition opportunities. Indiana's affordable home prices mean entry-level investment deals are abundant.",
		'local_note' => "Marion County's property tax sale process puts properties with three or more years of delinquent taxes into public auction. Homeowners in this situation can often avoid auction, and the loss of all remaining equity, by completing a cash sale before the tax sale deadline. We work quickly with Indianapolis homeowners to close before critical deadlines.",
		'cta_sub'    => 'Serving Indianapolis, Carmel, Fishers, Lawrence, Beech Grove, Speedway, Southport, and all Marion County communities.',
	),

	'GRAND RAPIDS' => array(
		'h1'         => 'We Buy Houses in Grand Rapids, MI For Cash, Kent County and West Michigan',
		'subtitle'   => 'Grand Rapids homeowners get a fair cash offer in 24 hours. Any condition, fast close, no commissions.',
		'intro'      => "Grand Rapids is West Michigan's largest city and has a stable working-class homeowner population that generates consistent motivated seller activity. Kent County pre-foreclosure filings, probate inventory, and tired landlord exits make up the primary sources of our Grand Rapids acquisition pipeline.",
		'local_note' => 'Grand Rapids neighborhoods like Southeast Grand Rapids, the South Division corridor, and Westside areas have aging housing stock that creates significant distressed property inventory. We buy properties in any condition, foundation issues, roof problems, deferred maintenance, without requiring the seller to do any work before closing.',
		'cta_sub'    => 'Serving Grand Rapids, Wyoming, Kentwood, Walker, Grandville, Jenison, and all Kent County communities.',
	),

	'TUCSON' => array(
		'h1'         => 'We Buy Houses in Tucson, AZ For Cash, Pima County and Southern Arizona',
		'subtitle'   => 'Tucson homeowners get a cash offer in 24 hours. Fair price, fast close, zero hassle. Any condition.',
		'intro'      => "Tucson's large military population at Davis-Monthan Air Force Base creates consistent relocation-driven motivated seller situations. The University of Arizona's employee and faculty base generates additional seller volume. Pima County's pre-foreclosure activity, while less prominent than Maricopa County, maintains a steady pipeline for our acquisitions team.",
		'local_note' => "Arizona is a non-judicial foreclosure state with one of the fastest timelines in the country. Tucson homeowners in pre-foreclosure have as little as 90 days from Notice of Trustee's Sale to the actual trustee sale. A cash transaction, completed before that date, stops the sale entirely and allows the seller to preserve whatever equity remains in the property.",
		'cta_sub'    => 'Serving Tucson, Marana, Oro Valley, Sahuarita, South Tucson, and all Pima County communities.',
	),

	'SAVANNAH' => array(
		'h1'         => 'We Buy Houses in Savannah, GA For Cash, Chatham County and Coastal Georgia',
		'subtitle'   => 'Savannah homeowners get a fair cash offer in 24 hours. Fast close, no repairs, no commissions.',
		'intro'      => "Savannah's growing tourism and logistics economy, anchored by the Port of Savannah, attracts both population growth and investment interest. Chatham County's probate calendar is active given the city's large established homeowner population. The coastal market creates flood zone and insurance-driven motivated seller situations similar to other Southeast coastal communities.",
		'local_note' => "Savannah's historic district and surrounding neighborhoods have significant estate sale and probate activity as the city's long-term homeowner population ages. Many of these properties have deferred maintenance that makes traditional listing challenging. We buy historic and older properties in any condition without requiring remediation, updates, or cosmetic improvements.",
		'cta_sub'    => 'Serving Savannah, Pooler, Rincon, Garden City, Port Wentworth, Hinesville, and all Chatham and surrounding county communities.',
	),
);

$content = $city_content[ $city_key ] ?? array(
	'h1'         => sprintf( 'We Buy Houses in %s%s For Cash', $city_label, $state_abbr ? ', ' . $state_abbr : '' ),
	'subtitle'   => sprintf( 'Fast cash offers for %s homeowners in any situation. Any condition, fair price, close in 7–14 days.', $city_label ),
	'intro'      => sprintf( '%s buys houses in %s in any condition. No repairs, no commissions, no fees. Fair written cash offer within 24 hours, close on your timeline.', $company_name, $city_label ),
	'local_note' => sprintf( 'Our buyer network is active in %s and throughout %s. We know the local market and work with licensed local title companies to close quickly and cleanly.', $city_label, $state_label ),
	'cta_sub'    => sprintf( 'Serving %s and surrounding communities throughout %s.', $city_label, $state_label ),
);
?>

<!-- ━━ HERO ━━ -->
<section class="page-hero page-hero--seller" aria-labelledby="city-hero-heading">
	<div class="container">
		<div class="hero__inner">
			<div class="hero__content">
				<?php wholesalepro_breadcrumb(); ?>
				<p class="hero__eyebrow animate-on-scroll">
					CASH HOME BUYERS IN <?php echo esc_html( strtoupper( $city_label ) ); ?><?php if ( $state_abbr ) echo ', ' . esc_html( strtoupper( $state_abbr ) ); ?>
				</p>
				<h1 class="hero__title animate-on-scroll" id="city-hero-heading" style="transition-delay:0.1s">
					<?php echo esc_html( $content['h1'] ); ?>
				</h1>
				<p class="hero__subtitle animate-on-scroll" style="transition-delay:0.2s">
					<?php echo esc_html( $content['subtitle'] ); ?>
				</p>
				<ul class="checklist animate-on-scroll" style="transition-delay:0.3s">
					<li class="checklist__item checklist__item--check">No repairs, cleaning, or updates required</li>
					<li class="checklist__item checklist__item--check">Zero commissions or closing costs to you</li>
					<li class="checklist__item checklist__item--check">Close in 7–30 days, completely your choice</li>
					<li class="checklist__item checklist__item--check"><?php printf( 'Serving all %s neighborhoods and suburbs', esc_html( $city_label ) ); ?></li>
				</ul>
				<div class="hero__actions animate-on-scroll" style="transition-delay:0.4s">
					<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline btn--lg" style="color:var(--wp-navy);border-color:var(--wp-navy);">
						<?php echo esc_html( $phone ); ?>
					</a>
				</div>
			</div>
			<div class="hero__form-wrap animate-on-scroll" style="transition-delay:0.2s">
				<div class="hero__form-card">
					<h2 class="hero__form-card__heading"><?php printf( 'Get Your %s Cash Offer', esc_html( $city_label ) ); ?></h2>
					<p class="hero__form-card__sub">2 minutes. No obligation. No pressure.</p>
					<?php echo wholesalepro_render_seller_form( 'city-' . sanitize_title( $city_label ) ); // phpcs:ignore ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php echo wholesalepro_get_trust_bar(); // phpcs:ignore ?>

<!-- ━━ LOCAL CONTENT ━━ -->
<section class="section" aria-labelledby="city-local-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-2xl);align-items:start;">
			<div class="animate-on-scroll">
				<p class="section-header__eyebrow"><?php printf( 'SELLING IN %s', esc_html( strtoupper( $city_label ) ) ); ?></p>
				<h2 id="city-local-heading" style="margin-bottom:var(--space-lg);">
					<?php printf( 'Why %s Homeowners Choose a Cash Sale', esc_html( $city_label ) ); ?>
				</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);"><?php echo esc_html( $content['intro'] ); ?></p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);"><?php echo esc_html( $content['local_note'] ); ?></p>
				<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Free Cash Offer</a>
			</div>
			<div class="animate-on-scroll" style="transition-delay:0.2s">
				<div class="card" style="padding:var(--space-xl);">
					<h3 style="margin-bottom:var(--space-lg);"><?php printf( 'What %s Sellers Receive', esc_html( $city_label ) ); ?></h3>
					<?php
					$benefits = array(
						array( '📋', 'Written Cash Offer', sprintf( 'A fair, written cash offer for your %s property, valid for 30 days with no pressure to accept.', $city_label ) ),
						array( '📅', 'Flexible Closing Date', 'You choose the closing date. Need 7 days? Fine. Need 30? Also fine. The timeline is yours.' ),
						array( '💵', 'Zero Fees or Commissions', 'No agent commission, no closing costs, no administrative fees. What we offer is what you receive.' ),
					);
					foreach ( $benefits as $b ) : ?>
					<div style="display:flex;gap:var(--space-md);align-items:flex-start;margin-bottom:var(--space-lg);">
						<span style="font-size:1.75rem;flex-shrink:0;" aria-hidden="true"><?php echo $b[0]; // phpcs:ignore ?></span>
						<div>
							<h4 style="margin-bottom:4px;font-size:1rem;"><?php echo esc_html( $b[1] ); ?></h4>
							<p style="color:var(--wp-gray);font-size:0.875rem;margin:0;"><?php echo esc_html( $b[2] ); ?></p>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ━━ NEARBY DEALS ━━ -->
<?php
$nearby_deals = new WP_Query( array(
	'post_type'      => 'property',
	'post_status'    => 'publish',
	'posts_per_page' => 3,
	'meta_query'     => array(
		array( 'key' => '_property_status', 'value' => 'available', 'compare' => '=' ),
	),
	'tax_query' => $state_abbr ? array( array( 'taxonomy' => 'property_state', 'field' => 'slug', 'terms' => wholesalepro_state_slug( $state_abbr ) ) ) : array(),
) );
if ( $nearby_deals->have_posts() ) : ?>
<section class="section bg--light-gray" aria-labelledby="city-deals-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="city-deals-heading">
				<?php printf( 'Investment Deals Near %s', esc_html( $city_label ) ); ?>
			</h2>
			<p class="section-header__sub">Off-market wholesale deals with verified ARVs and repair estimates.</p>
		</div>
		<div class="grid grid-3" style="gap:var(--space-lg);margin-top:var(--space-xl);">
			<?php while ( $nearby_deals->have_posts() ) : $nearby_deals->the_post(); ?>
				<?php echo wholesalepro_get_property_card( get_the_ID() ); // phpcs:ignore ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div class="text-center" style="margin-top:var(--space-xl);">
			<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">View All Available Deals &rarr;</a>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ━━ CTA ━━ -->
<section class="section" aria-labelledby="city-cta-heading">
	<div class="container narrow text-center animate-on-scroll">
		<h2 id="city-cta-heading" style="margin-bottom:var(--space-md);"><?php printf( 'Ready to Sell Your %s House?', esc_html( $city_label ) ); ?></h2>
		<p style="color:var(--wp-gray);margin-bottom:4px;"><?php echo esc_html( $content['cta_sub'] ); ?></p>
		<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">No pressure. No obligation. Just a fair cash offer within 24 hours.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Free Cash Offer</a>
			<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--outline btn--lg"><?php echo esc_html( $phone ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
