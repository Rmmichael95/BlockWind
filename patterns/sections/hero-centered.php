<?php
/**
 * Title: Hero – Centered
 * Slug: bw/hero-centered
 * Categories: bw-sections, bw-marketing
 * Keywords: hero, heading, intro, call to action
 * Block Types: core/group, core/heading, core/paragraph, core/buttons
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var(--wp--custom--bw-flow--section-padding-y)","bottom":"var(--wp--custom--bw-flow--section-padding-y)","left":"var(--wp--custom--bw-flow--content-padding-x)","right":"var(--wp--custom--bw-flow--content-padding-x)"}}},"backgroundColor":"bw-base","textColor":"bw-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-bw-text-color has-bw-base-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--fluid-3xl);padding-right:var(--wp--preset--spacing--fluid-xl);padding-bottom:var(--wp--preset--spacing--fluid-3xl);padding-left:var(--wp--preset--spacing--fluid-xl)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|fluid-l"}},"layout":{"type":"constrained","contentSize":"48rem"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center","level":1} -->
		<h1 class="wp-block-heading has-text-align-center">A clean starter theme that stays WordPress-idiomatic</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"var(--wp--custom--tokens--lineHeight--body,1.75)"}},"fontSize":"fluid-default"} -->
		<p class="has-text-align-center has-fluid-default-font-size" style="line-height:var(--wp--custom--tokens--lineHeight--body,1.75)">BlockWind is FSE-first: tokens in <code>theme.json</code>, patterns for layout, and optional Tailwind modules only when needed.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"backgroundColor":"bw-primary","textColor":"bw-base"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-bw-base-color has-bw-primary-background-color has-text-color has-background wp-element-button" href="#">Get started</a></div>
			<!-- /wp:button -->

			<!-- wp:button {"className":"is-style-outline","textColor":"bw-text"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-bw-text-color has-text-color wp-element-button" href="#">View patterns</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
