<?php
/**
 * Title: Post Loop Grid Default (BlockWind)
 * Slug: bw/post-loop-grid-default
 * Description: Grid loop best used on index/archive templates; template provides the outer gutters/padding.
 * Categories: bw/posts
 * Keywords: blog, posts, query, loop
 * Viewport Width: 1280
 * Block Types: core/query
 * Inserter: false
 */
?>
<!-- wp:query {"query":{"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide">
	<!-- wp:group {"metadata":{"name":"Post Grid"},"align":"wide","className":"bw-flow","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide bw-flow">

		<!-- wp:post-template {"align":"wide","layout":{"type":"grid","columnCount":2}} -->
			<!-- wp:pattern {"slug":"bw/blog-post-card"} /-->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->

	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:query -->
