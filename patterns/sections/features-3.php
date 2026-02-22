<?php
/**
 * Title: FAQ – Accordion
 * Slug: bw/faq-accordion
 * Categories: bw-sections, bw-content
 * Keywords: faq, accordion
 */
?>

<!-- wp:group {"align":"full","className":"bw-flow","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"},"backgroundColor":"bw-base","textColor":"bw-text"} -->
<div class="wp-block-group alignfull bw-flow has-bw-text-color has-bw-base-background-color has-text-color has-background" style="margin-top:0;margin-bottom:0">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","style":{"spacing":{"blockGap":"var(--wp--custom--bw-flow--gap)"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">

	<!-- wp:group {"layout":{"type":"constrained","contentSize":"48rem"},"style":{"spacing":{"blockGap":"var:preset|spacing|fluid-l"}}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="wp-block-heading has-text-align-center">FAQ</h2>
		<!-- /wp:heading -->

		<!-- wp:details -->
		<details class="wp-block-details"><summary>What is BlockWind?</summary><p>A WordPress-first theme with a token and pattern-driven workflow.</p></details>
		<!-- /wp:details -->

		<!-- wp:details -->
		<details class="wp-block-details"><summary>Do I need Tailwind?</summary><p>No. Tailwind is optional and used only for reusable, non-token behaviors.</p></details>
		<!-- /wp:details -->

		<!-- wp:details -->
		<details class="wp-block-details"><summary>Can I build full-bleed sections?</summary><p>Yes—use alignfull outer wrappers with inner flow gutters.</p></details>
		<!-- /wp:details -->
	</div>
	<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
