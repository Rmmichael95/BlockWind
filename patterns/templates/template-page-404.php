<?php
/**
 * Title: 404 Page (BlockWind)
 * Slug: bw/template-page-404
 * Description: 404 template pattern adapted to BlockWind flow.
 * Categories: bw/templates
 * Keywords: 404, not found
 * Viewport Width: 1500
 * Inserter: false
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"bw-flow","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<main class="wp-block-group alignfull bw-flow" style="margin-top:0;margin-bottom:0">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">
		<!-- wp:heading {"level":1} -->
		<h1>Page not found</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>It looks like nothing was found at this location.</p>
		<!-- /wp:paragraph -->

		<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search…","buttonText":"Search","buttonPosition":"button-inside","align":"left"} /-->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
