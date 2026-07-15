<?php
/**
 * Investor (buyer) landing pages: same engine as seller services,
 * different persona. CTA is joining the deal list, never fake inventory.
 *
 * @package WholesalePro
 */

function shs_investors_config() {
	return array(
		'invest-fix-and-flip' => array(
			'audience' => 'investor',
			'menu'     => 'Fix & Flip Investors',
			'category' => 'fix-flip',
			'eyebrow'  => 'FIX &amp; FLIP · OFF-MARKET DEALS · OH · TX · GA',
			'title'    => 'Off-Market Fix &amp; Flip Deals With Numbers You Can Verify',
			'answer'   => 'We source distressed properties directly from motivated sellers in Ohio, Texas and Georgia before they reach the MLS. Every deal comes with the ARV comparables, a line-item repair estimate and an inspection period, so you can verify our math before a dollar moves. Join the list and deals matching your criteria reach you first.',
			'pains'    => array(
				array( 'Every MLS deal is picked over', 'By the time a distressed listing is public, twenty flippers have seen it. Direct-from-seller contracts never touch the MLS, the list gets them first.' ),
				array( 'Wholesalers inflate ARVs to sell contracts', 'Our ARV comes with the actual comparable sales attached. Pull your own comps and check us, we expect you to.' ),
				array( 'Repair estimates that double after closing', 'You get a line-item scope, not a single scary-round number. And an inspection period to walk the property with your contractor before committing.' ),
				array( 'Wasting hours on deals outside your criteria', 'Tell us your target counties, price band and margin threshold once. You only hear from us when a deal actually matches.' ),
			),
			'faq'      => array(
				array( 'How do I get access to your deals?', 'Join the buyer list with your criteria: target markets, price range and strategy. Matching deals go to the list first, before any public platform. Joining is free and there is no obligation to ever buy.' ),
				array( 'Can I inspect the property before closing?', 'Yes. Every contract includes an inspection period. Walk it with your contractor, verify the scope, and withdraw within the window if the numbers do not hold.' ),
				array( 'How are your ARVs calculated?', 'From renovated comparable sales within roughly a mile, sold in the last 90 to 180 days, similar size and bed count. The comps are listed in the deal package so you can verify each one.' ),
				array( 'Are these assignment contracts or double closings?', 'Usually assignments, which keep transaction costs low. Where the seller contract or state practice requires it, we double close. The title company is experienced with both.' ),
				array( 'What earnest money is required?', 'Typically $2,000 to $5,000 depending on the deal size, held by the licensed title company, never by us personally, and refundable inside the inspection window.' ),
				array( 'What margins do your deals target?', 'We contract deals that leave a realistic flipper margin after our assignment fee, usually 15 to 25 percent of ARV before financing costs. If a deal is thin, the package says so plainly.' ),
				array( 'Do you have inventory right now?', 'Inventory rotates as our seller pipeline closes contracts. That is exactly why the list exists: members hear about each deal the day it is signed, and the best ones go in 24 to 72 hours.' ),
				array( 'Which markets do you cover?', 'Ohio (Columbus, Cleveland, Cincinnati, Dayton metros), Texas (Houston, Dallas, San Antonio) and Georgia (Atlanta metro, Savannah, Augusta), plus the surrounding counties in each state.' ),
				array( 'Can I use hard money or do I need cash?', 'Hard money is fine as long as you can close inside the contract timeline, usually 14 to 30 days. Tell us your funding setup when you join so we only match you with workable timelines.' ),
				array( 'How do I know you are legitimate?', 'The same three tests we tell sellers to run: every closing goes through a licensed title company, every number is in writing with sources, and nobody ever asks you for an upfront fee. Verify all three before wiring anything, with us or anyone.' ),
			),
		),
		'invest-buy-and-hold' => array(
			'audience' => 'investor',
			'menu'     => 'Buy & Hold / Rentals',
			'category' => 'buy-hold',
			'eyebrow'  => 'BUY &amp; HOLD · CASH-FLOW PROPERTIES · OH · TX · GA',
			'title'    => 'Below-Market Rentals in Cash-Flow Markets That Actually Cash-Flow',
			'answer'   => 'Ohio and the right Texas and Georgia submarkets still produce genuine rental cash flow, and buying below market through off-market deals is how the numbers work from day one. We source distressed and tenant-occupied properties directly from owners, priced with realistic rent and expense figures you can check against the local market.',
			'pains'    => array(
				array( 'Retail prices kill the cash flow', 'A rental bought at full market price in 2026 rarely cash-flows. Below-market entry through distressed acquisition is the difference between an asset and a donation.' ),
				array( 'Pro-forma numbers are fantasy', 'Our packages use current market rents for the actual street, real tax bills and honest condition notes, not a spreadsheet where nothing ever breaks.' ),
				array( 'Tenant-occupied equals unknown risk', 'When a property comes with tenants, the package states the rent actually being paid, the lease status and the deposit situation, documented, not implied.' ),
				array( 'Out-of-town properties, in-town problems', 'Every deal includes the neighborhood context an out-of-area buyer cannot see: street-level condition, rental demand and which blocks the local property managers avoid.' ),
			),
			'faq'      => array(
				array( 'What kind of rental deals do you source?', 'Single-family and small multi-family (2 to 4 units) in working-class neighborhoods of Ohio, Texas and Georgia metros, usually needing light-to-moderate work, priced below market because we bought from a motivated seller.' ),
				array( 'Do the deals come with rent numbers?', 'Yes, current market rent for the street from comparable listings, plus the actual rent if tenants are in place. You can verify both against Zillow and local property managers before committing.' ),
				array( 'Can I buy with tenants already in place?', 'Often, yes, and inherited paying tenants mean income from day one. The package documents the lease, payment history as known, and deposit transfer. Non-paying occupancy situations are always disclosed and priced accordingly.' ),
				array( 'Which Ohio markets cash-flow best?', 'Columbus, Cleveland and Dayton consistently produce 1 percent-rule candidates in the right neighborhoods. Cincinnati and Toledo also work at the right entry price. The guide library on this page goes deeper per metro.' ),
				array( 'What about Texas property taxes eating the cash flow?', 'Real concern: Texas taxes run roughly double Ohio rates. Our Texas rental packages model the actual county tax bill, not a guess, so the cash flow you see survives the first tax season.' ),
				array( 'Is there an inspection period?', 'Yes, on every deal. Walk it, run your contractor and property manager through it, and verify the rent assumptions before your earnest money goes hard.' ),
				array( 'Can I use conventional or DSCR financing?', 'DSCR and portfolio loans usually work if your lender can close in 21 to 30 days. Conventional timelines are often too slow for assignment deals, tell us your financing when you join and we match accordingly.' ),
				array( 'Do you sell portfolios?', 'When landlords exit multiple doors at once we offer them as a package to the list first. Portfolio buyers should say so in their criteria.' ),
				array( 'How big is your assignment fee?', 'It is built into the price you see, the deal either works at the listed number or it does not. We never add surprise fees after you commit.' ),
				array( 'How do I verify the neighborhood from out of state?', 'The package includes street-level photos and honest area notes. Beyond that: call two local property managers and ask what they would rent the street for, ten minutes that validates or kills any deal.' ),
			),
		),
		'invest-out-of-state' => array(
			'audience' => 'investor',
			'menu'     => 'Out-of-State Investors',
			'category' => 'out-of-state',
			'eyebrow'  => 'OUT-OF-STATE &amp; INTERNATIONAL BUYERS · OH · TX · GA',
			'title'    => 'Invest in Ohio, Texas &amp; Georgia Without Living There',
			'answer'   => 'You can buy, close and own investment property in Ohio, Texas and Georgia entirely remotely: licensed title companies handle closings with mobile or online notarization, and our deal packages carry the ground-truth information you cannot see from a distance. Coastal money has been doing this in these exact markets for a decade.',
			'pains'    => array(
				array( 'You cannot walk the property yourself', 'Every package includes full photo documentation, and your local contractor or inspector can walk it during the inspection period as your eyes.' ),
				array( 'Remote closings feel risky', 'They are routine: escrowed funds, licensed title company, remote online notarization where permitted. The same structural protections we explain to sellers protect you as the buyer.' ),
				array( 'Local knowledge gap', 'A price that looks like a steal from California can be retail for the block. Our packages state the neighborhood context plainly, and our guides teach you to verify it independently.' ),
				array( 'Time zones and slow responses kill deals', 'Deal alerts hit the list simultaneously; your criteria pre-qualify you. When you respond, the package answers the first twenty questions without a phone call.' ),
			),
			'faq'      => array(
				array( 'Can I really close without traveling?', 'Yes. Documents are signed with a mobile notary or remote online notarization (permitted in Ohio, Texas and Georgia for most transaction types), funds move by wire through the title company escrow, and recording is electronic.' ),
				array( 'How do I inspect from another state?', 'Hire a local licensed inspector ($300 to $500) or have your contractor walk it during the inspection period. Video walkthroughs plus an inspection report replace your eyes reliably.' ),
				array( 'Why Ohio, Texas and Georgia specifically?', 'Entry prices that still allow cash flow, landlord-workable law, population and job growth in the metros, and enough inventory of distressed properties to source deals below market. The exact combination coastal markets lost years ago.' ),
				array( 'Can international buyers purchase?', 'Yes, foreign buyers can own US real estate. You will need an ITIN for taxes and possibly an LLC; a US bank account simplifies everything. Get a cross-border tax advisor before the first purchase, structure matters.' ),
				array( 'Should I hold in an LLC?', 'Most out-of-state investors do, for liability separation. Ohio, Texas and Georgia all recognize single-member LLCs, and Texas has no state income tax on top. Ask your attorney, we can close in whatever entity you choose.' ),
				array( 'Who manages the property afterward?', 'Local property managers run 8 to 12 percent of rent. Line one up before you close, not after, and ask them to review the deal first: a good PM saying they would happily manage that street is a real signal.' ),
				array( 'How does money transfer safely from far away?', 'Exactly one way: wire to the licensed title company escrow account, with the wire details verified by phone using a number you found independently. Never wire to an individual or an account from an email.' ),
				array( 'What taxes will I face as a non-resident of the state?', 'Texas has no state income tax. Ohio and Georgia tax rental income sourced in-state, usually creditable against your home state. Federal rules apply to everyone. One session with a CPA covers your setup.' ),
				array( 'What if something goes wrong after closing?', 'The same recourse locals have: the title insurance policy covers title defects, your inspection report covers condition disputes, and the contract governs the rest. Distance changes logistics, not rights.' ),
				array( 'How fast do I need to decide on a deal?', 'Good deals go inside 72 hours, but never faster than the inspection period protects. Decide fast on pursuing; the contract still gives you the window to verify before money goes hard.' ),
			),
		),
	);
}

/**
 * Merge seller + investor configs so one renderer serves both.
 */
function shs_all_landing_configs() {
	return array_merge( shs_services_config(), shs_investors_config() );
}
