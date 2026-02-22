<?php
/**
 * Title: Page Right Sidebar (BlockWind)
 * Slug: bw/template-page-right-sidebar
 * Template Types: page
 * Description: Page layout with right sidebar and left content area using BlockWind flow.
 * Categories: bw/templates
 * Keywords: page, sidebar
 * Viewport Width: 1500
 * Inserter: false
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"bw-flow","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<main class="wp-block-group alignfull bw-flow" style="margin-top:0;margin-bottom:0">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">
		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column {"width":"70%","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
			<div class="wp-block-column" style="flex-basis:70%">
				<!-- wp:post-title {"level":1} /-->
				<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"30%","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
			<div class="wp-block-column" style="flex-basis:30%">
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3} -->
					<h3>Sidebar</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>Add widgets, links, or patterns here.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
