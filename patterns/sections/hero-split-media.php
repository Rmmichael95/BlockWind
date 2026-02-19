<?php
/**
 * Title: Hero – Split with Media
 * Slug: dh/hero-split-media
 * Categories: dh-sections, dh-marketing
 * Keywords: hero, split, media, image
 * Block Types: core/group, core/columns, core/image
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|fluid-3xl","bottom":"var:preset|spacing|fluid-3xl","left":"var:preset|spacing|fluid-xl","right":"var:preset|spacing|fluid-xl"}}},"backgroundColor":"dh-surface","textColor":"dh-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-dh-text-color has-dh-surface-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--fluid-3xl);padding-right:var(--wp--preset--spacing--fluid-xl);padding-bottom:var(--wp--preset--spacing--fluid-3xl);padding-left:var(--wp--preset--spacing--fluid-xl)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|fluid-xl","left":"var:preset|spacing|fluid-xl"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
			<!-- wp:heading {"level":1} -->
			<h1 class="wp-block-heading">Build fast with patterns, not custom templates</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"fluid-default","style":{"typography":{"lineHeight":"var(--wp--custom--tokens--lineHeight--body,1.75)"}}} -->
			<p class="has-fluid-default-font-size" style="line-height:var(--wp--custom--tokens--lineHeight--body,1.75)">Use a small pattern library to compose pages. Style variations handle branding. Optional CSS modules handle only what WordPress can’t.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"dh-accent","textColor":"dh-base"} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-dh-base-color has-dh-accent-background-color has-text-color has-background wp-element-button" href="#">Primary action</a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline","textColor":"dh-text"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-dh-text-color has-text-color wp-element-button" href="#">Secondary</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"var(--wp--custom--tokens--radius--l,16px)"}}} -->
			<figure class="wp-block-image size-large" style="border-radius:var(--wp--custom--tokens--radius--l,16px)"><img src="https://via.placeholder.com/900x600" alt=""/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
