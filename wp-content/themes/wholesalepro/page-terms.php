<?php
/**
 * Terms of Service Page Template
 * Template Name: Terms of Service
 *
 * @package WholesalePro
 */

get_header();

$company_name    = get_theme_mod( 'company_name', 'WholesalePro' );
$company_email   = get_theme_mod( 'company_email', 'info@example.com' );
$company_address = get_theme_mod( 'company_address', '123 Main Street, Your City, ST 00000' );
?>

<section class="page-hero page-hero--inner" aria-labelledby="terms-hero-heading">
	<div class="container">
		<nav class="breadcrumb" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<span aria-hidden="true"> / </span>
			<span aria-current="page">Terms of Service</span>
		</nav>
		<h1 class="page-hero__title" id="terms-hero-heading">Terms of Service</h1>
		<p class="page-hero__sub">Last updated: <?php echo esc_html( date( 'F j, Y' ) ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container narrow">
		<div class="legal-content">

			<p>These Terms of Service ("Terms") govern your use of the <?php echo esc_html( $company_name ); ?> website and services. By accessing or using our website, you agree to be bound by these Terms. If you do not agree, do not use our website.</p>

			<h2>1. About Our Services</h2>
			<p><?php echo esc_html( $company_name ); ?> is a real estate investment company that purchases residential and commercial properties directly from owners for cash. We are not a real estate brokerage, and our services do not include representing buyers or sellers in traditional real estate transactions.</p>
			<p>Submitting a property inquiry through our website does not create any obligation on your part to sell, nor does it obligate us to purchase your property. Any purchase offer we make will be presented in a written purchase agreement.</p>

			<h2>2. No Offer of Purchase</h2>
			<p>Information presented on this website, including any estimated offer ranges or illustrative numbers, does not constitute a binding offer to purchase real property. A binding offer can only be made through a signed written purchase agreement executed by an authorized representative of <?php echo esc_html( $company_name ); ?>.</p>

			<h2>3. Website Use</h2>
			<p>You may use our website for lawful purposes only. You agree not to:</p>
			<ul>
				<li>Use the website in any way that violates applicable laws or regulations</li>
				<li>Submit false, misleading, or fraudulent property information</li>
				<li>Attempt to gain unauthorized access to any part of the website or its related systems</li>
				<li>Use automated tools to scrape, crawl, or extract data from the website</li>
				<li>Impersonate any person or entity or misrepresent your affiliation</li>
			</ul>

			<h2>4. Accuracy of Information</h2>
			<p>We strive to keep the information on our website accurate and up to date. However, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, or reliability of any content on the website. Any reliance you place on such information is strictly at your own risk.</p>
			<p>Property values, market data, and investment figures referenced on this website are illustrative examples only and are not guarantees of future results.</p>

			<h2>5. Third-Party Links</h2>
			<p>Our website may contain links to third-party websites. These links are provided for your convenience only. We have no control over the content of those sites and accept no responsibility for them or for any loss or damage that may arise from your use of them.</p>

			<h2>6. Intellectual Property</h2>
			<p>All content on this website — including text, graphics, logos, images, and software — is the property of <?php echo esc_html( $company_name ); ?> or its content suppliers and is protected by applicable intellectual property laws. You may not reproduce, distribute, or create derivative works without our express written permission.</p>

			<h2>7. Disclaimer of Warranties</h2>
			<p>THIS WEBSITE AND ITS CONTENT ARE PROVIDED "AS IS" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT. WE DO NOT WARRANT THAT THE WEBSITE WILL BE UNINTERRUPTED, ERROR-FREE, OR FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS.</p>

			<h2>8. Limitation of Liability</h2>
			<p>TO THE FULLEST EXTENT PERMITTED BY LAW, <?php echo esc_html( strtoupper( $company_name ) ); ?> SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES ARISING FROM YOUR USE OF THIS WEBSITE OR OUR SERVICES, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</p>

			<h2>9. Indemnification</h2>
			<p>You agree to indemnify and hold harmless <?php echo esc_html( $company_name ); ?> and its officers, directors, employees, and agents from any claims, damages, losses, liabilities, and expenses (including legal fees) arising from your use of the website, your violation of these Terms, or your submission of false or misleading information.</p>

			<h2>10. Governing Law</h2>
			<p>These Terms shall be governed by and construed in accordance with the laws of the state in which <?php echo esc_html( $company_name ); ?> is incorporated, without regard to its conflict of law provisions. Any disputes arising under these Terms shall be resolved in the courts of that jurisdiction.</p>

			<h2>11. Changes to These Terms</h2>
			<p>We reserve the right to modify these Terms at any time. Changes will be effective immediately upon posting to the website. Your continued use of the website after any changes constitutes your acceptance of the updated Terms.</p>

			<h2>12. Contact Us</h2>
			<p>If you have questions about these Terms, contact us at:</p>
			<address>
				<strong><?php echo esc_html( $company_name ); ?></strong><br>
				<?php echo esc_html( $company_address ); ?><br>
				Email: <a href="mailto:<?php echo esc_attr( $company_email ); ?>"><?php echo esc_html( $company_email ); ?></a>
			</address>

		</div>
	</div>
</section>

<?php get_footer(); ?>
