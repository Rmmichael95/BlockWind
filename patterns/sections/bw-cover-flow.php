<?php
/**
 * Title: Cover – Flow Hero
 * Slug: bw/cover-flow
 * Categories: bw-sections
 * Keywords: cover, hero, flow
 * Block Types: core/cover
 */
?>

<!-- wp:cover {"align":"full","className":"bw-flow","dimRatio":50,"minHeight":70,"minHeightUnit":"vh","isDark":false,"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-cover alignfull is-light bw-flow" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:70vh">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","style":{"spacing":{"blockGap":"var(--wp--custom--bw-flow--gap)"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">
		<!-- wp:heading {"level":1} -->
		<h1>Hero headline</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Support text. The cover remains full-bleed; only this inner wrapper opts into flow gutters and section padding.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Call to action</a></div>
		<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
