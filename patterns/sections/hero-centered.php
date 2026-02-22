<?php
/**
 * Title: Hero – Centered
 * Slug: bw/hero-centered
 * Categories: bw-sections, bw-marketing
 * Keywords: hero, heading, intro, call to action
 * Block Types: core/group, core/heading, core/paragraph, core/buttons
 */
?>

<!-- wp:group {"align":"full","className":"bw-flow","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"bw-base","textColor":"bw-text","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull bw-flow has-bw-text-color has-bw-base-background-color has-text-color has-background" style="margin-top:0;margin-bottom:0">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","style":{"spacing":{"blockGap":"var(--wp--custom--bw-flow--gap)"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">
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
</div>
<!-- /wp:group -->
