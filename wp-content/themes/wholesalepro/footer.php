<?php
/**
 * Site Footer Template
 *
 * @package WholesalePro
 */
?>
</main><!-- #main-content -->

<footer class="site-footer" id="site-footer" role="contentinfo">

	<div class="footer-cta-band">
		<div class="container">
			<div class="footer-cta-band__inner">
				<div class="footer-cta-band__copy">
					<h2><?php esc_html_e( 'Ready to Sell or Invest?', 'wholesalepro' ); ?></h2>
					<p><?php esc_html_e( 'Join hundreds of satisfied homeowners and investors who trust us every year.', 'wholesalepro' ); ?></p>
				</div>
				<div class="footer-cta-band__actions">
					<?php
					$sell_page = get_page_by_path( 'sell-my-house-fast' );
					$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
					$deal_page = get_page_by_path( 'browse-deals' );
					$deal_url  = $deal_page ? get_permalink( $deal_page->ID ) : home_url( '/browse-deals' );
					?>
					<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">
						<?php esc_html_e( 'Get My Cash Offer', 'wholesalepro' ); ?>
					</a>
					<a href="<?php echo esc_url( $deal_url ); ?>" class="btn btn--buyer btn--lg">
						<?php esc_html_e( 'Browse Available Deals', 'wholesalepro' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-main">
		<div class="container">
			<div class="footer-grid">

				<div class="footer-col footer-col--brand">
					<?php if ( has_custom_logo() ) :
						the_custom_logo();
					else : ?>
						<span class="footer-brand-name">
							<?php echo esc_html( get_theme_mod( 'company_name', get_bloginfo( 'name' ) ) ); ?>
						</span>
					<?php endif; ?>

					<p class="footer-tagline">
						<?php echo esc_html( get_theme_mod( 'company_tagline', __( 'We Buy Houses Fast. Fair. Simple.', 'wholesalepro' ) ) ); ?>
					</p>

					<ul class="footer-contact-list">
						<?php if ( $phone = get_theme_mod( 'company_phone', '' ) ) : ?>
						<li>
							<a href="tel:<?php echo esc_attr( get_theme_mod( 'company_phone_raw', preg_replace( '/\D/', '', $phone ) ) ); ?>">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.82 12a19.79 19.79 0 01-3.07-8.67A2 2 0 013.73 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.91 8.91a16 16 0 006.18 6.18l1.09-1.09a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
								<?php echo esc_html( $phone ); ?>
							</a>
						</li>
						<?php endif; ?>
						<?php if ( $email = get_theme_mod( 'company_email', '' ) ) : ?>
						<li>
							<a href="mailto:<?php echo esc_attr( $email ); ?>">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
								<?php echo esc_html( $email ); ?>
							</a>
						</li>
						<?php endif; ?>
						<?php if ( $address = get_theme_mod( 'company_address', '' ) ) : ?>
						<li>
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
							<?php echo esc_html( $address ); ?>
						</li>
						<?php endif; ?>
					</ul>

					<?php echo wholesalepro_social_links(); // phpcs:ignore ?>
				</div>

				<div class="footer-col">
					<h3 class="footer-col__heading"><?php esc_html_e( 'For Sellers', 'wholesalepro' ); ?></h3>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-col-1',
						'container'      => false,
						'menu_class'     => 'footer-nav',
						'fallback_cb'    => function() {
							$links = array(
								'sell-my-house-fast' => __( 'Sell My House', 'wholesalepro' ),
								'how-it-works'       => __( 'How It Works', 'wholesalepro' ),
								'faq'                => __( 'FAQs', 'wholesalepro' ),
								'testimonials'       => __( 'Reviews', 'wholesalepro' ),
							);
							echo '<ul class="footer-nav">';
							foreach ( $links as $slug => $label ) {
								$page = get_page_by_path( $slug );
								$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
								echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
							}
							echo '</ul>';
						},
					) );
					?>
				</div>

				<div class="footer-col">
					<h3 class="footer-col__heading"><?php esc_html_e( 'For Investors', 'wholesalepro' ); ?></h3>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-col-2',
						'container'      => false,
						'menu_class'     => 'footer-nav',
						'fallback_cb'    => function() {
							$links = array(
								'browse-deals'   => __( 'Browse Deals', 'wholesalepro' ),
								'buyer-criteria' => __( 'Buyer Criteria', 'wholesalepro' ),
								'contact'        => __( 'Join Buyer List', 'wholesalepro' ),
							);
							echo '<ul class="footer-nav">';
							foreach ( $links as $slug => $label ) {
								$page = get_page_by_path( $slug );
								$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
								echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
							}
							echo '</ul>';
						},
					) );
					?>
				</div>

				<div class="footer-col">
					<h3 class="footer-col__heading"><?php esc_html_e( 'Company', 'wholesalepro' ); ?></h3>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-col-3',
						'container'      => false,
						'menu_class'     => 'footer-nav',
						'fallback_cb'    => function() {
							$links = array(
								'about-us'      => __( 'About Us', 'wholesalepro' ),
								'contact'       => __( 'Contact', 'wholesalepro' ),
								'blog'          => __( 'Blog', 'wholesalepro' ),
								'privacy-policy'=> __( 'Privacy Policy', 'wholesalepro' ),
								'terms-of-service' => __( 'Terms of Service', 'wholesalepro' ),
							);
							echo '<ul class="footer-nav">';
							foreach ( $links as $slug => $label ) {
								$page = get_page_by_path( $slug );
								$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
								echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
							}
							echo '</ul>';
						},
					) );
					?>
				</div>

			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="container">
			<div class="footer-bottom__inner">
				<p class="footer-copyright">
					&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
					<?php echo esc_html( get_theme_mod( 'company_name', get_bloginfo( 'name' ) ) ); ?>.
					<?php esc_html_e( 'All rights reserved.', 'wholesalepro' ); ?>
				</p>
				<p class="footer-legal-links">
					<?php
					$legal = array(
						'privacy-policy' => __( 'Privacy Policy', 'wholesalepro' ),
						'terms-of-service' => __( 'Terms of Service', 'wholesalepro' ),
						'sitemap'        => __( 'Sitemap', 'wholesalepro' ),
					);
					$links_html = array();
					foreach ( $legal as $slug => $label ) {
						$page = get_page_by_path( $slug );
						$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
						$links_html[] = '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
					}
					echo implode( ' &middot; ', $links_html ); // phpcs:ignore
					?>
				</p>
			</div>

			<?php if ( get_theme_mod( 'footer_disclaimer', '' ) ) : ?>
			<p class="footer-disclaimer">
				<?php echo wp_kses_post( get_theme_mod( 'footer_disclaimer', '' ) ); ?>
			</p>
			<?php endif; ?>
		</div>
	</div>

</footer>

<button class="back-to-top js-back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'wholesalepro' ); ?>" aria-hidden="true" tabindex="-1">
	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
		<polyline points="18,15 12,9 6,15"/>
	</svg>
</button>

<div class="cookie-bar js-cookie-bar" id="cookie-bar" role="region" aria-label="<?php esc_attr_e( 'Cookie consent', 'wholesalepro' ); ?>" aria-live="polite" aria-atomic="true">
	<div class="cookie-bar__inner">
		<p>
			<?php
			printf(
				wp_kses(
					/* translators: %s: privacy policy link */
					__( 'We use cookies to enhance your experience. By continuing, you agree to our <a href="%s">Privacy Policy</a>.', 'wholesalepro' ),
					array( 'a' => array( 'href' => array() ) )
				),
				esc_url( home_url( '/privacy-policy' ) )
			);
			?>
		</p>
		<button class="btn btn--primary btn--sm js-cookie-accept">
			<?php esc_html_e( 'Accept', 'wholesalepro' ); ?>
		</button>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
