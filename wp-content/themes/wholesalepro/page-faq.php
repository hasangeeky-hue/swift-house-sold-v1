<?php
/**
 * FAQ Page Template
 * Template Name: FAQ
 *
 * @package WholesalePro
 */

get_header();

$company_name = get_theme_mod( 'company_name', 'Swift House Sold' );
$phone        = get_theme_mod( 'company_phone', '' );
$phone_raw    = get_theme_mod( 'company_phone_raw', '' );
$sell_url     = ( $p = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $p->ID ) : home_url( '/sell-my-house-fast' );
$deals_url    = ( $p = get_page_by_path( 'browse-deals' ) )       ? get_permalink( $p->ID ) : home_url( '/browse-deals' );

$seller_faqs = array(
	array(
		'q' => 'How fast can you close on my house?',
		'a' => 'We can close in as little as 7 days. The timeline depends on the title search and your schedule. If you need more time to move out, we can also close in 30, 45, or 60 days, whatever works best for you. You set the closing date.',
	),
	array(
		'q' => 'Do I need to make repairs before selling?',
		'a' => 'No. We buy houses in any condition, roof problems, foundation issues, water damage, fire damage, full of belongings, code violations. You do not need to clean, repair, or stage anything. We handle it all after closing.',
	),
	array(
		'q' => 'How do you determine your cash offer?',
		'a' => 'We look at the property\'s location, current condition, and what comparable homes have sold for in the area after renovation. We also factor in our estimated repair costs and the time it will take to resell. Our goal is to make you a fair offer that works for both sides.',
	),
	array(
		'q' => 'Are there any fees or commissions?',
		'a' => 'None. We are not real estate agents. We do not charge commissions, listing fees, or closing cost fees. What we offer is what you receive at closing, no deductions.',
	),
	array(
		'q' => 'Will you really pay cash?',
		'a' => 'Yes. We use our own funds, not bank financing, to purchase properties. This means there is no loan approval process and no risk of the deal falling through due to financing. The sale is not contingent on anything.',
	),
	array(
		'q' => 'What if my house is in foreclosure?',
		'a' => 'We regularly purchase pre-foreclosure properties. As long as the foreclosure auction has not yet taken place, we can work with your timeline. In many cases, selling before the auction date protects your credit and allows you to walk away with cash instead of nothing.',
	),
	array(
		'q' => 'What types of properties do you buy?',
		'a' => 'We buy single-family homes, duplexes, multi-family properties, condos, townhouses, mobile homes, and vacant land. Occupied, vacant, rented, inherited, divorce situations, we handle all of them.',
	),
	array(
		'q' => 'Do I have to accept the offer?',
		'a' => 'No. There is zero obligation. Getting a cash offer from us is completely free and does not require you to sell. Many homeowners simply want to know what their property is worth to a cash buyer before deciding what to do.',
	),
	array(
		'q' => 'What happens after I submit my information?',
		'a' => 'One of our team members will contact you within 24 hours, often within hours. We will ask a few questions about the property, schedule a walkthrough at your convenience, and present you with a written cash offer. The entire process from first contact to offer typically takes 24-48 hours.',
	),
	array(
		'q' => 'Is my information kept private?',
		'a' => 'Yes. Your information is never sold or shared with third parties for marketing purposes. We only share information with our title company and closing attorney as required to complete the transaction.',
	),
);

?>

<section class="page-hero page-hero--inner" aria-labelledby="faq-hero-heading">
	<div class="container">
		<nav class="breadcrumb" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<span aria-hidden="true"> / </span>
			<span aria-current="page">FAQ</span>
		</nav>
		<h1 class="page-hero__title" id="faq-hero-heading">Frequently Asked Questions</h1>
		<p class="page-hero__sub">Everything you need to know about selling your house for cash or buying wholesale deals.</p>
	</div>
</section>

<!-- Seller FAQs -->
<section class="section" aria-labelledby="seller-faq-heading">
	<div class="container">
		<div class="section-header text-center" style="margin-bottom:var(--space-xl);">
			<span class="section-header__eyebrow badge badge--seller">For Sellers</span>
			<h2 class="section-header__title" id="seller-faq-heading">Selling Your House For Cash</h2>
			<p class="section-header__sub">Common questions from homeowners considering a cash sale.</p>
		</div>

		<div class="faq-list narrow" role="list">
			<?php foreach ( $seller_faqs as $i => $faq ) : ?>
			<div class="faq-item" role="listitem" itemscope itemtype="https://schema.org/Question">
				<button class="faq-item__trigger js-faq-trigger"
					aria-expanded="false"
					aria-controls="faq-seller-<?php echo $i; ?>"
					itemprop="name">
					<span><?php echo esc_html( $faq['q'] ); ?></span>
					<svg class="faq-item__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<polyline points="6 9 12 15 18 9"/>
					</svg>
				</button>
				<div class="faq-item__body" id="faq-seller-<?php echo $i; ?>" hidden
					itemscope itemtype="https://schema.org/Answer">
					<div itemprop="text">
						<p><?php echo esc_html( $faq['a'] ); ?></p>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="section" aria-labelledby="faq-cta-heading">
	<div class="container text-center">
		<h2 id="faq-cta-heading">Still Have Questions?</h2>
		<p style="font-size:var(--text-lg);color:var(--wp-gray);margin-bottom:var(--space-lg);">
			Call us directly, a real person answers every call.
		</p>
		<div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
			<a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="btn btn--seller btn--lg">
				📞 Call <?php echo esc_html( $phone ); ?>
			</a>
			<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--outline btn--lg">
				Get a Cash Offer
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
