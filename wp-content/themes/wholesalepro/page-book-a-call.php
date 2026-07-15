<?php
/**
 * Book a Call, free human consultation, online or phone.
 * Submits through the existing contact form handler.
 *
 * @package WholesalePro
 */

get_header();
?>

<section class="page-hero page-hero--seller" aria-labelledby="book-hero-heading">
	<div class="container">
		<p class="page-hero__eyebrow">FREE CONSULTATION, NO PRESSURE, NO OBLIGATION</p>
		<h1 class="page-hero__title" id="book-hero-heading">Talk to a Real Person About Your Situation</h1>
		<p class="page-hero__subtitle">Choose an online video call or a phone call. We'll listen, explain your options honestly, including the ones that don't involve us, and you decide from there.</p>
	</div>
</section>

<section class="section" aria-labelledby="book-form-heading">
	<div class="container">
		<div class="split-layout" style="gap:var(--space-3xl);align-items:start;max-width:1000px;margin:0 auto;">

			<div>
				<h2 id="book-form-heading" style="margin-bottom:var(--space-md);">What Happens On the Call?</h2>
				<div style="display:flex;flex-direction:column;gap:var(--space-md);">
					<?php
					$steps = array(
						array( '1', 'You tell us your situation', 'Foreclosure timeline, inherited house, divorce, liens, whatever it is, plainly.' ),
						array( '2', 'We explain your real options', 'Including listing with an agent or keeping the house, when those are genuinely better for you.' ),
						array( '3', 'You decide, nothing is signed on a call', 'If a cash offer makes sense, we prepare it in writing within 24 hours. If not, you leave with clarity.' ),
					);
					foreach ( $steps as $s ) : ?>
					<div style="display:flex;gap:var(--space-md);align-items:flex-start;">
						<div style="flex-shrink:0;width:36px;height:36px;border-radius:50%;background:var(--wp-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;"><?php echo esc_html( $s[0] ); ?></div>
						<div>
							<h3 style="font-size:1rem;margin-bottom:4px;"><?php echo esc_html( $s[1] ); ?></h3>
							<p style="color:var(--wp-gray);font-size:0.92rem;margin:0;"><?php echo esc_html( $s[2] ); ?></p>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<p style="color:var(--wp-gray);font-size:0.9rem;margin-top:var(--space-lg);">
					Calls are free, last about 15–20 minutes, and are available for sellers in Ohio, Texas and Georgia.
				</p>
			</div>

			<div class="card" style="padding:var(--space-xl);">
				<h3 style="margin-bottom:var(--space-sm);">Book Your Free Consultation</h3>
				<form class="wp-form js-ajax-form" data-action="wholesalepro_contact_form" novalidate>
					<?php wp_nonce_field( 'wholesalepro-nonce', 'nonce' ); ?>
					<input type="hidden" name="action" value="wholesalepro_contact_form">
					<input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;" aria-hidden="true">
					<input type="hidden" name="contact_subject" value="Consultation booking request">

					<div class="form-group">
						<label class="form-label" for="book_name">Full Name <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
						<input class="form-control" type="text" id="book_name" name="contact_name" required autocomplete="name" aria-required="true">
						<span class="form-error" role="alert"></span>
					</div>

					<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
						<div class="form-group">
							<label class="form-label" for="book_phone">Phone <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
							<input class="form-control" type="tel" id="book_phone" name="contact_phone" required autocomplete="tel" aria-required="true">
						</div>
						<div class="form-group">
							<label class="form-label" for="book_email">Email <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
							<input class="form-control" type="email" id="book_email" name="contact_email" required autocomplete="email" aria-required="true">
							<span class="form-error" role="alert"></span>
						</div>
					</div>

					<div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
						<div class="form-group">
							<label class="form-label" for="book_type">Call Type</label>
							<select class="form-control form-select" id="book_type" name="contact_call_type">
								<option value="Phone call">Phone call</option>
								<option value="Online video call">Online video call (Google Meet / Zoom)</option>
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="book_time">Preferred Day &amp; Time</label>
							<input class="form-control" type="text" id="book_time" name="contact_preferred_time" placeholder="e.g. Tuesday afternoon (ET)">
						</div>
					</div>

					<div class="form-group">
						<label class="form-label" for="book_msg">Your Situation (short) <span aria-hidden="true" style="color:var(--wp-red)">*</span></label>
						<textarea class="form-control form-textarea" id="book_msg" name="contact_message" required rows="4" aria-required="true" placeholder="e.g. Inherited my mother's house in Atlanta, not sure where to start..."></textarea>
						<span class="form-error" role="alert"></span>
					</div>

					<div class="form-submit-wrap">
						<button type="submit" class="btn btn--seller btn--lg btn--full js-submit">Book My Free Call &rarr;</button>
					</div>
					<p class="form-privacy">We confirm your time slot by phone or email within a few hours.</p>

					<div class="form-success" style="display:none;" role="status" aria-live="polite">
						<div style="text-align:center;padding:var(--s8);">
							<div style="font-size:3rem;margin-bottom:var(--s4);">📅</div>
							<h3 style="color:var(--wp-navy);">Request received!</h3>
							<p>We'll confirm your consultation time shortly.</p>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
	var form = document.querySelector('.js-ajax-form[data-action="wholesalepro_contact_form"]');
	if (!form) return;
	form.addEventListener('submit', function () {
		var type = form.querySelector('[name="contact_call_type"]');
		var time = form.querySelector('[name="contact_preferred_time"]');
		var msg  = form.querySelector('[name="contact_message"]');
		if (msg && !msg.value.startsWith('[BOOKING]')) {
			msg.value = '[BOOKING] Call type: ' + (type ? type.value : '-') +
				' | Preferred time: ' + (time && time.value ? time.value : 'any') +
				'\n\n' + msg.value;
		}
	}, true);
});
</script>

<?php get_footer(); ?>
