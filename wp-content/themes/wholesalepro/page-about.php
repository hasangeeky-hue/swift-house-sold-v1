<?php
/**
 * About Page Template
 * Template Name: About Us
 *
 * @package WholesalePro
 */

get_header();

$sell_url  = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );
$deals_url = ( $p = get_page_by_path( 'browse-deals' ) )       ? get_permalink( $p->ID ) : home_url( '/browse-deals' );
?>

<section class="page-hero page-hero--compact" aria-labelledby="about-hero-heading">
	<div class="container">
		<?php wholesalepro_breadcrumb(); ?>
		<h1 class="page-hero__title animate-on-scroll" id="about-hero-heading">
			The Company Behind the Deals
		</h1>
		<p class="page-hero__subtitle animate-on-scroll" style="transition-delay:0.1s">
			We are not a faceless acquisition company. We are a team of real estate professionals who built a better process for buying distressed properties — one that respects sellers, rewards investors, and creates genuine value on every deal.
		</p>
	</div>
</section>

<?php echo wholesalepro_get_trust_bar(); // phpcs:ignore ?>

<!-- ━━ STORY ━━ -->
<section class="section" aria-labelledby="about-story-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:start;">
			<div class="animate-on-scroll">
				<p class="section-header__eyebrow">WHY WE EXIST</p>
				<h2 id="about-story-heading" style="margin-bottom:var(--space-lg);">Why WholesalePro Exists</h2>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">
					WholesalePro began with a single observation: millions of American homeowners find themselves in situations where the traditional real estate process is genuinely the wrong solution. Months of showings, uncertain financing, agent commissions, and mandatory repairs — none of this helps someone who has missed four mortgage payments and needs certainty within the next 30 days.
				</p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-md);">
					We built a different kind of operation. One that uses data to find motivated sellers before they even begin searching for help, that responds within hours rather than days, and that measures success by how cleanly each seller walks away from a difficult situation — not by how wide the margin was on the deal.
				</p>
				<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">
					Today we operate across all 50 states through a combination of proprietary data infrastructure, a national network of trusted buyers and investors, and a process that has been refined by hundreds of closed transactions. For every seller who receives a fair outcome and for every investor who closes a profitable deal, the model proves itself again.
				</p>
				<div style="display:flex;gap:var(--space-lg);flex-wrap:wrap;">
					<div class="text-center" style="padding:var(--space-lg);background:var(--wp-light-gray);border-radius:var(--radius-md);min-width:120px;">
						<div style="font-size:2.5rem;font-weight:800;color:var(--wp-navy);">500+</div>
						<p style="font-size:0.85rem;color:var(--wp-gray);margin:0;">Deals Closed</p>
					</div>
					<div class="text-center" style="padding:var(--space-lg);background:var(--wp-light-gray);border-radius:var(--radius-md);min-width:120px;">
						<div style="font-size:2.5rem;font-weight:800;color:var(--wp-navy);">50</div>
						<p style="font-size:0.85rem;color:var(--wp-gray);margin:0;">States Covered</p>
					</div>
					<div class="text-center" style="padding:var(--space-lg);background:var(--wp-light-gray);border-radius:var(--radius-md);min-width:120px;">
						<div style="font-size:2.5rem;font-weight:800;color:var(--wp-navy);">4.9★</div>
						<p style="font-size:0.85rem;color:var(--wp-gray);margin:0;">Avg. Rating</p>
					</div>
					<div class="text-center" style="padding:var(--space-lg);background:var(--wp-light-gray);border-radius:var(--radius-md);min-width:120px;">
						<div style="font-size:2.5rem;font-weight:800;color:var(--wp-navy);">14</div>
						<p style="font-size:0.85rem;color:var(--wp-gray);margin:0;">Day Avg. Close</p>
					</div>
				</div>
			</div>
			<div class="animate-on-scroll" style="transition-delay:0.2s;">
				<?php echo wholesalepro_placeholder_div( 560, 420, 'WholesalePro team at work' ); // phpcs:ignore ?>
			</div>
		</div>
	</div>
</section>

<!-- ━━ VALUES ━━ -->
<section class="section bg--light-gray" aria-labelledby="values-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<p class="section-header__eyebrow">WHAT DRIVES US</p>
			<h2 class="section-header__title" id="values-heading">Four Values That Shape Every Transaction</h2>
		</div>
		<div class="grid grid-2" style="gap:var(--space-xl);margin-top:var(--space-xl);">
			<?php
			$values = array(
				array(
					'icon'  => '🔢',
					'title' => 'Transparency in Every Number',
					'body'  => 'Every offer we make shows every calculation. The comparable sales we used, the repair estimate we applied, the margin we need to operate profitably. Sellers who understand our numbers trust our offers. That trust is the foundation of every transaction we close.',
				),
				array(
					'icon'  => '⚡',
					'title' => 'Speed as a Form of Respect',
					'body'  => 'A homeowner facing a deadline does not have the luxury of waiting three weeks for a response. We treat speed as a fundamental part of our service. One-hour response times are not a marketing claim — they are an operational standard we hold our team to on every business day.',
				),
				array(
					'icon'  => '⚖️',
					'title' => 'Fairness Creates Better Outcomes',
					'body'  => 'We operate on the belief that deals are only sustainable when they are fair to every party. A seller who feels respected refers others. An investor who receives accurate numbers comes back for more deals. The business model only works when it works for everyone.',
				),
				array(
					'icon'  => '🗺️',
					'title' => 'National Reach, Local Knowledge',
					'body'  => 'Covering all 50 states is not simply about having a large footprint. It means having current comparable sales data, active cash buyers, and knowledge of local regulations in every market we operate. Scale without local accuracy is not a service — it is a liability.',
				),
			);
			foreach ( $values as $i => $val ) : ?>
			<div class="card animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s;display:flex;gap:var(--space-lg);align-items:flex-start;">
				<div style="font-size:2.5rem;flex-shrink:0;" aria-hidden="true"><?php echo $val['icon']; // phpcs:ignore ?></div>
				<div>
					<h3 style="margin-bottom:var(--space-sm);"><?php echo esc_html( $val['title'] ); ?></h3>
					<p style="color:var(--wp-gray);margin:0;"><?php echo esc_html( $val['body'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ TEAM ━━ -->
<section class="section" aria-labelledby="team-heading">
	<div class="container">
		<div class="section-header animate-on-scroll">
			<h2 class="section-header__title" id="team-heading">Meet the Team</h2>
			<p class="section-header__subtitle">Real people. Real experience. Real results.</p>
		</div>
		<div class="grid grid-4" style="gap:var(--space-lg);margin-top:var(--space-xl);">
			<?php
			$team = array(
				array( 'Alex Johnson',  'Founder &amp; CEO',              '12 years in wholesale real estate across 30+ states. Founded WholesalePro to build the process he wished had existed earlier.' ),
				array( 'Maria Santos',  'Director of Acquisitions',        'Former real estate attorney. Oversees every offer and ensures every seller receives complete, accurate information before deciding.' ),
				array( 'David Kim',     'Lead Underwriter',                'Licensed contractor background. Personally validates repair estimates on every deal to ensure investor numbers are reliable.' ),
				array( 'Priya Patel',   'Investor Relations',              'Manages relationships with over 5,000 network investors. Former hedge fund analyst — she speaks every investor\'s language.' ),
			);
			foreach ( $team as $i => $member ) : ?>
			<div class="team-card animate-on-scroll" style="transition-delay:<?php echo esc_attr( $i * 0.1 ); ?>s;text-align:center;">
				<div style="width:100px;height:100px;border-radius:50%;overflow:hidden;margin:0 auto var(--space-md);background:var(--wp-light-gray);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">
					<?php echo array( '👨‍💼', '👩‍⚖️', '👨‍🔧', '👩‍💼' )[ $i ]; // phpcs:ignore ?>
				</div>
				<h3 style="margin-bottom:4px;font-size:1.05rem;"><?php echo esc_html( $member[0] ); ?></h3>
				<p style="color:var(--wp-green);font-size:0.85rem;font-weight:600;margin-bottom:var(--space-sm);"><?php echo wp_kses_post( $member[1] ); ?></p>
				<p style="color:var(--wp-gray);font-size:0.875rem;margin:0;"><?php echo esc_html( $member[2] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ━━ CTA ━━ -->
<section class="section bg--light-gray" aria-labelledby="about-cta-heading">
	<div class="container narrow text-center animate-on-scroll">
		<h2 id="about-cta-heading" style="margin-bottom:var(--space-md);">Ready to Work With Us?</h2>
		<p style="color:var(--wp-gray);margin-bottom:var(--space-xl);">Whether you need to sell a property or you are looking for investment deals — we are here to help.</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">Get My Cash Offer</a>
			<a href="<?php echo esc_url( $deals_url ); ?>" class="btn btn--buyer btn--lg">Browse Investor Deals</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
