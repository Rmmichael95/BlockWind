<?php
/**
 * Title: Post Loop Grid (BlockWind)
 * Slug: bw/template-index-grid
 * Template Types: front-page, home, index
 * Description: Two-column grid layout for blog posts and archive pages using BlockWind flow.
 * Categories: bw/templates
 * Keywords: blog, posts, query, loop
 * Viewport Width: 1500
 * Inserter: false
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"bw-flow","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<main class="wp-block-group alignfull bw-flow" style="margin-top:0;margin-bottom:0">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">
		<!-- wp:pattern {"slug":"bw/post-loop-grid-default"} /-->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
