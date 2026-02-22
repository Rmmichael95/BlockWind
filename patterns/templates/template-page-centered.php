<?php
/**
 * Title: Page Centered (BlockWind)
 * Slug: bw/template-page-centered
 * Template Types: page
 * Description: Centered page layout using BlockWind flow (scope + inner gutters).
 * Categories: bw/templates
 * Keywords: page, centered
 * Viewport Width: 1500
 * Inserter: false
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"bw-flow","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<main class="wp-block-group alignfull bw-flow" style="margin-top:0;margin-bottom:0">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">
		<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:post-title {"level":1,"fontFamily":"secondary"} /-->

			<!-- wp:post-featured-image {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:post-content {"align":"wide","layout":{"type":"constrained"}} /-->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
