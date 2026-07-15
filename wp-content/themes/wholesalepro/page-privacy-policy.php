<?php
/**
 * Privacy Policy Page Template
 * Template Name: Privacy Policy
 *
 * @package WholesalePro
 */

get_header();

$company_name    = get_theme_mod( 'company_name', 'Swift House Sold' );
$company_email   = get_theme_mod( 'company_email', 'info@example.com' );
$company_address = get_theme_mod( 'company_address', '123 Main Street, Your City, ST 00000' );
?>

<section class="page-hero page-hero--inner" aria-labelledby="privacy-hero-heading">
	<div class="container">
		<nav class="breadcrumb" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<span aria-hidden="true"> / </span>
			<span aria-current="page">Privacy Policy</span>
		</nav>
		<h1 class="page-hero__title" id="privacy-hero-heading">Privacy Policy</h1>
		<p class="page-hero__sub">Last updated: <?php echo esc_html( date( 'F j, Y' ) ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container narrow">
		<div class="legal-content">

			<p>This Privacy Policy describes how <?php echo esc_html( $company_name ); ?> ("we," "us," or "our") collects, uses, and shares information about you when you use our website and services. By using our website, you agree to the terms of this Privacy Policy.</p>

			<h2>1. Information We Collect</h2>
			<p>We collect information you provide directly to us, including:</p>
			<ul>
				<li><strong>Contact information</strong> — name, email address, phone number, mailing address</li>
				<li><strong>Property information</strong> — property address, condition, situation, and any details you share about your property</li>
				<li><strong>Communication records</strong> — emails, text messages, and phone call records when you contact us</li>
				<li><strong>Form submissions</strong> — any information you submit through our online forms</li>
			</ul>
			<p>We also collect certain information automatically when you visit our website, including your IP address, browser type, pages visited, and referring URLs through cookies and similar tracking technologies.</p>

			<h2>2. How We Use Your Information</h2>
			<p>We use the information we collect to:</p>
			<ul>
				<li>Respond to your inquiries and provide cash offers on your property</li>
				<li>Communicate with you about our services via phone, email, and text message</li>
				<li>Send you follow-up communications about properties you have expressed interest in</li>
				<li>Improve our website and services</li>
				<li>Comply with applicable laws and regulations</li>
				<li>Detect and prevent fraudulent activity</li>
			</ul>

			<h2>3. Text Message Communications</h2>
			<p>By submitting your phone number, you consent to receive text messages from <?php echo esc_html( $company_name ); ?> regarding your property inquiry. Message and data rates may apply. You may opt out at any time by replying STOP to any message. For help, reply HELP or contact us at <?php echo esc_html( $company_email ); ?>.</p>

			<h2>4. How We Share Your Information</h2>
			<p>We do not sell your personal information. We may share your information with:</p>
			<ul>
				<li><strong>Service providers</strong> — third-party vendors who assist us in operating our website and conducting our business (such as CRM platforms, email providers, and title companies)</li>
				<li><strong>Business partners</strong> — other investors in our buyer network, only when you have expressed interest in selling and we are presenting your property as a deal</li>
				<li><strong>Legal requirements</strong> — when required by law, court order, or government authority</li>
				<li><strong>Business transfers</strong> — in connection with a merger, acquisition, or sale of business assets</li>
			</ul>

			<h2>5. Cookies and Tracking Technologies</h2>
			<p>We use cookies and similar tracking technologies to analyze website traffic, personalize content, and serve targeted advertisements. You can control cookie settings through your browser. Note that disabling cookies may affect website functionality.</p>
			<p>We may use third-party advertising services such as Google Ads and Facebook Pixel. These services may use cookies to serve ads based on your prior visits to our website. You can opt out of Google's use of cookies by visiting <a href="https://adssettings.google.com" target="_blank" rel="noopener noreferrer">Google Ads Settings</a>.</p>

			<h2>6. Data Retention</h2>
			<p>We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required by law. Property inquiry information is typically retained for 3 years.</p>

			<h2>7. Your Rights</h2>
			<p>Depending on your location, you may have certain rights regarding your personal information, including:</p>
			<ul>
				<li>The right to access the personal information we hold about you</li>
				<li>The right to request correction of inaccurate information</li>
				<li>The right to request deletion of your information</li>
				<li>The right to opt out of marketing communications</li>
				<li>California residents may have additional rights under the CCPA</li>
			</ul>
			<p>To exercise any of these rights, contact us at <?php echo esc_html( $company_email ); ?>.</p>

			<h2>8. Children's Privacy</h2>
			<p>Our website is not directed to children under 13, and we do not knowingly collect personal information from children under 13. If we become aware that we have collected personal information from a child under 13, we will take steps to delete that information.</p>

			<h2>9. Security</h2>
			<p>We implement reasonable security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>

			<h2>10. Changes to This Policy</h2>
			<p>We may update this Privacy Policy from time to time. We will notify you of significant changes by posting the new policy on this page with an updated date. Your continued use of our website after any changes constitutes your acceptance of the updated policy.</p>

			<h2>11. Contact Us</h2>
			<p>If you have questions about this Privacy Policy, please contact us:</p>
			<address>
				<strong><?php echo esc_html( $company_name ); ?></strong><br>
				<?php echo esc_html( $company_address ); ?><br>
				Email: <a href="mailto:<?php echo esc_attr( $company_email ); ?>"><?php echo esc_html( $company_email ); ?></a>
			</address>

		</div>
	</div>
</section>

<?php get_footer(); ?>
