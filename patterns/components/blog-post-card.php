<?php
/**
 * Title: Blog Post Card (BlockWind)
 * Slug: bw/blog-post-card
 * Description: Card-style post item for use in loops.
 * Categories: bw/cards, bw/posts
 * Keywords: card, post, query
 * Viewport Width: 600
 * Inserter: true
 */
?>
<!-- wp:group {"metadata":{"name":"Blog Post Card"},"style":{"spacing":{"blockGap":"var(--wp--custom--bw-flow--gap-tight)","padding":{"top":"var(--wp--custom--bw-flow--stack-padding-y)","right":"var(--wp--custom--bw-flow--panel-padding-x)","bottom":"var(--wp--custom--bw-flow--stack-padding-y)","left":"var(--wp--custom--bw-flow--panel-padding-x)"}},"border":{"radius":"var:preset|radius|bw-lg"}},"backgroundColor":"base","layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between","justifyContent":"stretch"}} -->
<div class="wp-block-group has-base-background-color has-background" style="border-radius:var(--wp--preset--border-radius--bw-lg);padding-top:var(--wp--custom--bw-flow--stack-padding-y);padding-right:var(--wp--custom--bw-flow--panel-padding-x);padding-bottom:var(--wp--custom--bw-flow--stack-padding-y);padding-left:var(--wp--custom--bw-flow--panel-padding-x)">

	<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"var:preset|radius|bw-md"}}} /-->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var(--wp--custom--bw-flow--gap-tight)"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:post-title {"isLink":true,"level":3} /-->
		<!-- wp:post-excerpt {"moreText":"Read more"} /-->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
