<?php
/**
 * Site Footer Template
 *
 * @package WholesalePro
 */
?>
</main><!-- #main-content -->

<footer class="site-footer" id="site-footer" role="contentinfo">

	<?php if ( ! is_front_page() ) : ?>
	<div class="footer-cta-band">
		<div class="container">
			<div class="footer-cta-band__inner">
				<div class="footer-cta-band__copy">
					<h2><?php esc_html_e( 'Ready to Sell Your House Fast?', 'wholesalepro' ); ?></h2>
					<p><?php esc_html_e( 'Written cash offer in 24 hours. Ohio, Texas and Georgia. No fees, no repairs, no pressure.', 'wholesalepro' ); ?></p>
				</div>
				<div class="footer-cta-band__actions">
					<?php
					$sell_page = get_page_by_path( 'sell-my-house-fast' );
					$sell_url  = $sell_page ? get_permalink( $sell_page->ID ) : home_url( '/sell-my-house-fast' );
					$how_page = get_page_by_path( 'how-it-works' );
					$how_url  = $how_page ? get_permalink( $how_page->ID ) : home_url( '/how-it-works' );
					?>
					<a href="<?php echo esc_url( $sell_url ); ?>" class="btn btn--seller btn--lg">
						<?php esc_html_e( 'Get My Cash Offer', 'wholesalepro' ); ?>
					</a>
					<a href="<?php echo esc_url( $how_url ); ?>" class="btn btn--buyer btn--lg">
						<?php esc_html_e( 'See How It Works', 'wholesalepro' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( ! is_singular( 'post' ) ) : /* posts already have their own newsletter section */ ?>
	<div class="footer-newsletter bg--navy" id="newsletter" style="padding:48px 0;border-bottom:1px solid rgba(255,255,255,0.08);">
		<div class="container" style="max-width:720px;">
			<div class="text-center">
				<p class="section-header__eyebrow" style="color:var(--wp-gold);"><?php esc_html_e( 'FREE NEWSLETTER', 'wholesalepro' ); ?></p>
				<h2 style="color:#fff;margin-bottom:var(--space-sm);font-size:1.4rem;"><?php echo esc_html( "Get New Guides & Off-Market Deal Alerts" ); ?></h2>
				<p style="color:rgba(255,255,255,0.75);margin-bottom:var(--space-lg);"><?php echo esc_html( "One useful email at a time: new seller guides, and first access to off-market deals in Ohio, Texas and Georgia. No spam, unsubscribe anytime." ); ?></p>
			</div>
			<form class="wp-form js-ajax-form" data-action="wholesalepro_buyer_form" novalidate style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
				<?php wp_nonce_field( 'wholesalepro-nonce', 'nonce' ); ?>
				<input type="hidden" name="action" value="wholesalepro_buyer_form">
				<input type="hidden" name="form_location" value="newsletter-footer">
				<div style="position:absolute;left:-9999px;" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
				<input class="form-control" type="text" name="buyer_name" required placeholder="<?php esc_attr_e( 'Your name', 'wholesalepro' ); ?>" autocomplete="name" style="flex:1;min-width:160px;max-width:220px;">
				<input class="form-control" type="email" name="buyer_email" required placeholder="you@email.com" autocomplete="email" style="flex:2;min-width:200px;max-width:320px;">
				<button type="submit" class="btn btn--seller js-submit" style="white-space:nowrap;"><?php esc_html_e( 'Subscribe', 'wholesalepro' ); ?> &rarr;</button>
				<div class="form-success" style="display:none;flex-basis:100%;text-align:center;color:#fff;" role="status" aria-live="polite">
					<p style="margin:12px 0 0;"><?php echo esc_html( "You're on the list. Watch your inbox!" ); ?></p>
				</div>
			</form>
		</div>
	</div>
	<?php endif; ?>

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
								'seller-protection'  => __( 'Seller Protection Center', 'wholesalepro' ),
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
								'investors'            => __( 'Join the Buyer List', 'wholesalepro' ),
								'buyer-protection'     => __( 'Buyer Protection Center', 'wholesalepro' ),
								'escrow-agents'        => __( 'Meet the Escrow Agents', 'wholesalepro' ),
								'invest-fix-and-flip'  => __( 'Fix & Flip Deals', 'wholesalepro' ),
								'invest-buy-and-hold'  => __( 'Buy & Hold Rentals', 'wholesalepro' ),
								'invest-out-of-state'  => __( 'Out-of-State Investing', 'wholesalepro' ),
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
						'privacy-policy'   => __( 'Privacy Policy', 'wholesalepro' ),
						'imprint'          => __( 'Imprint', 'wholesalepro' ),
						'terms-of-service' => __( 'Terms of Service', 'wholesalepro' ),
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


<script data-no-optimize="1" data-cfasync="false">
(function(){
	if (window.__shsFaqBound) return; window.__shsFaqBound = true;
	document.addEventListener('click', function (e) {
		var t = e.target; while (t && t !== document && !(t.classList && t.classList.contains('js-faq-trigger'))) { t = t.parentNode; }
		if (!t || t === document) return;
		var body = document.getElementById(t.getAttribute('aria-controls'));
		if (!body) return;
		var open = t.getAttribute('aria-expanded') === 'true';
		t.setAttribute('aria-expanded', open ? 'false' : 'true');
		if (open) { body.setAttribute('hidden', ''); } else { body.removeAttribute('hidden'); }
		var icon = t.querySelector('.faq-item__icon');
		if (icon) { icon.style.transform = open ? '' : 'rotate(180deg)'; }
	}, true);
	// Mobile nav toggle (same optimizer-proof pattern).
	document.addEventListener('click', function (e) {
		var t = e.target;
		var toggle = null, close = null, overlayLink = false;
		while (t && t !== document) {
			if (t.classList) {
				if (t.classList.contains('js-nav-toggle')) { toggle = t; break; }
				if (t.classList.contains('js-nav-close')) { close = t; break; }
				if (t.tagName === 'A' && t.closest && t.closest('.nav-overlay')) { overlayLink = true; break; }
			}
			t = t.parentNode;
		}
		var ov = document.querySelector('.js-nav-overlay');
		if (!ov) return;
		if (toggle) {
			var opening = !ov.classList.contains('active');
			ov.classList.toggle('active', opening);
			ov.setAttribute('aria-hidden', opening ? 'false' : 'true');
			toggle.setAttribute('aria-expanded', opening ? 'true' : 'false');
			document.body.style.overflow = opening ? 'hidden' : '';
		} else if (close || overlayLink) {
			ov.classList.remove('active');
			ov.setAttribute('aria-hidden', 'true');
			document.body.style.overflow = '';
		}
	}, true);
	// Two-step seller form: reveal stage 2 after address commitment.
	document.addEventListener('click', function (e) {
		var t = e.target; while (t && t !== document && !(t.classList && t.classList.contains('js-form-continue'))) { t = t.parentNode; }
		if (!t || t === document) return;
		var form = t.closest ? t.closest('form') : null;
		if (!form) return;
		var addr = form.querySelector('[name="property_address"]');
		if (addr && !addr.value.trim()) { addr.focus(); addr.style.borderColor = '#E63946'; return; }
		var s1 = form.querySelector('.form-stage1');
		var s2 = form.querySelector('.form-stage2');
		if (s1) s1.setAttribute('hidden', '');
		if (s2) {
			s2.removeAttribute('hidden');
			s2.querySelectorAll('[data-req]').forEach(function (f) { f.setAttribute('required', ''); f.setAttribute('aria-required', 'true'); });
			var first = s2.querySelector('input:not([type=hidden])');
			if (first) first.focus();
			s2.scrollIntoView({ behavior: 'smooth', block: 'center' });
		}
	}, true);
})();
</script>


<?php $shs_wa = preg_replace( '/\D/', '', get_theme_mod( 'company_whatsapp', '' ) ); if ( $shs_wa ) : ?>
<div class="wa-float" id="wa-float">
	<div class="wa-float__bubble" id="wa-bubble" role="status" hidden>
		<button type="button" class="wa-float__close js-wa-close" aria-label="<?php esc_attr_e( 'Dismiss', 'wholesalepro' ); ?>">&times;</button>
		<p><?php echo esc_html( "Questions about selling your house? Chat with us on WhatsApp." ); ?></p>
	</div>
	<a class="wa-float__btn" target="_blank" rel="noopener"
		href="https://wa.me/<?php echo esc_attr( $shs_wa ); ?>?text=<?php echo rawurlencode( 'Hi, I have a question about selling my house.' ); ?>"
		aria-label="<?php esc_attr_e( 'Chat on WhatsApp', 'wholesalepro' ); ?>">
		<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.39-1.47-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.14-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51l-.57-.01c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.5 0 1.47 1.07 2.89 1.22 3.09.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2-1.41.25-.69.25-1.29.18-1.41-.08-.13-.28-.2-.58-.35z"/><path d="M12.05 2C6.58 2 2.13 6.45 2.13 11.92c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 004.8 1.22h.01c5.46 0 9.91-4.45 9.91-9.92 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.05 2zm0 18.17h-.01a8.2 8.2 0 01-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 01-1.26-4.39c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 012.42 5.83c0 4.54-3.7 8.24-8.24 8.24z"/></svg>
	</a>
</div>
<script data-no-optimize="1">
(function(){
	var b=document.getElementById('wa-bubble');if(!b)return;
	var k='shs_wa_dismissed';var d=false;
	try{d=sessionStorage.getItem(k)==='1';}catch(e){}
	if(!d){setTimeout(function(){b.hidden=false;},4000);}
	document.addEventListener('click',function(e){
		if(e.target.closest&&e.target.closest('.js-wa-close')){b.hidden=true;try{sessionStorage.setItem(k,'1');}catch(err){}}
	},true);
})();
</script>
<?php endif; ?>

<div class="sticky-cta" role="complementary" aria-label="<?php esc_attr_e( 'Quick action', 'wholesalepro' ); ?>">
	<a href="<?php echo esc_url( ( $scp = get_page_by_path( 'sell-my-house-fast' ) ) ? get_permalink( $scp->ID ) : home_url( '/sell-my-house-fast' ) ); ?>" class="sticky-cta__btn">
		<?php esc_html_e( 'Get My Cash Offer', 'wholesalepro' ); ?>
	</a>
	<?php if ( get_theme_mod( 'company_phone_raw', '' ) ) : ?>
	<a href="tel:<?php echo esc_attr( get_theme_mod( 'company_phone_raw', '' ) ); ?>" class="sticky-cta__call" aria-label="<?php esc_attr_e( 'Call us', 'wholesalepro' ); ?>">
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.82 12a19.79 19.79 0 01-3.07-8.67A2 2 0 013.73 1.18h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L7.91 8.91a16 16 0 006.18 6.18l1.09-1.09a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
	</a>
	<?php endif; ?>
</div>

<?php
/* GA4 conversion events */
if ( is_page( 'thank-you-seller' ) ) : ?>
<script data-no-optimize="1">if(typeof gtag==='function'){gtag('event','generate_lead',{lead_type:'seller',currency:'USD',value:100});}</script>
<?php elseif ( is_page( 'thank-you-buyer' ) ) : ?>
<script data-no-optimize="1">if(typeof gtag==='function'){gtag('event','generate_lead',{lead_type:'buyer',currency:'USD',value:25});}</script>
<?php endif; ?>
<script data-no-optimize="1">
(function(){ /* newsletter + form submit events for GA4 */
	if(typeof gtag!=='function')return;
	document.addEventListener('submit',function(e){
		var f=e.target;if(!f||!f.classList)return;
		var loc=(f.querySelector('input[name="form_location"]')||{}).value||'';
		if(loc.indexOf('newsletter')===0){gtag('event','sign_up',{method:loc});}
		else if(f.classList.contains('js-ajax-form')||f.classList.contains('wp-form')){gtag('event','form_submit_attempt',{form_location:loc||'unknown'});}
	},true);
})();
</script>
<?php wp_footer(); ?>
</body>
</html>
