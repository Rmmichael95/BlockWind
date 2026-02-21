<?php
/**
 * Title: Features – 3 Columns
 * Slug: bw/features-3
 * Categories: bw-sections, bw-content
 * Keywords: features, columns, services
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var(--wp--custom--bw-flow--section-padding-y)","right":"var(--wp--custom--bw-flow--content-padding-x)","bottom":"var(--wp--custom--bw-flow--section-padding-y)","left":"var(--wp--custom--bw-flow--content-padding-x)"},"blockGap":"var(--wp--custom--bw-flow--gap)"}},"backgroundColor":"bw-base","textColor":"bw-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-bw-text-color has-bw-base-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--fluid-2xl);padding-right:var(--wp--preset--spacing--fluid-xl);padding-bottom:var(--wp--preset--spacing--fluid-2xl);padding-left:var(--wp--preset--spacing--fluid-xl)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|fluid-l"}}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="wp-block-heading has-text-align-center">What you get</h2>
		<!-- /wp:heading -->

		<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|fluid-l","left":"var:preset|spacing|fluid-l"}}}} -->
		<div class="wp-block-columns">
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Theme.json-first</h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph -->
				<p>Tokens live where WordPress expects them. Avoid hardcoded values in CSS.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Patterns-first</h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph -->
				<p>Compose pages from sections. Keep templates minimal and predictable.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Optional Tailwind</h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph -->
				<p>Use modular CSS only for gaps (nav/offcanvas/layout), not a second design system.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
