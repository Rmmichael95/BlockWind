<?php
/**
 * Title: Hero – Split with Media
 * Slug: bw/hero-split-media
 * Categories: bw-sections, bw-marketing
 * Keywords: hero, split, media, image
 * Block Types: core/group, core/columns, core/image
 */
?>

<!-- wp:group {"align":"full","className":"bw-flow","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"bw-surface","textColor":"bw-text","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull bw-flow has-bw-text-color has-bw-surface-background-color has-text-color has-background" style="margin-top:0;margin-bottom:0">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","style":{"spacing":{"blockGap":"var(--wp--custom--bw-flow--gap)"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">
		<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var(--wp--custom--bw-flow--gap)","left":"var(--wp--custom--bw-flow--gap)"}}}} -->
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
					<!-- wp:button {"backgroundColor":"bw-accent","textColor":"bw-base"} -->
					<div class="wp-block-button"><a class="wp-block-button__link has-bw-base-color has-bw-accent-background-color has-text-color has-background wp-element-button" href="#">Primary action</a></div>
					<!-- /wp:button -->

					<!-- wp:button {"className":"is-style-outline","textColor":"bw-text"} -->
					<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-bw-text-color has-text-color wp-element-button" href="#">Secondary</a></div>
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
</div>
<!-- /wp:group -->
