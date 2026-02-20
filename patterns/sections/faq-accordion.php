<?php
/**
 * Title: FAQ – Accordion
 * Slug: bw/faq-accordion
 * Categories: bw-sections, bw-content
 * Keywords: faq, accordion, details
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|fluid-2xl","bottom":"var:preset|spacing|fluid-2xl","left":"var:preset|spacing|fluid-xl","right":"var:preset|spacing|fluid-xl"}}},"backgroundColor":"bw-base","textColor":"bw-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-bw-text-color has-bw-base-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--fluid-2xl);padding-right:var(--wp--preset--spacing--fluid-xl);padding-bottom:var(--wp--preset--spacing--fluid-2xl);padding-left:var(--wp--preset--spacing--fluid-xl)">
	<!-- wp:group {"layout":{"type":"constrained","contentSize":"48rem"},"style":{"spacing":{"blockGap":"var:preset|spacing|fluid-l"}}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="wp-block-heading has-text-align-center">Frequently asked questions</h2>
		<!-- /wp:heading -->

		<!-- wp:details {"backgroundColor":"bw-surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|fluid-m","bottom":"var:preset|spacing|fluid-m","left":"var:preset|spacing|fluid-m","right":"var:preset|spacing|fluid-m"}},"border":{"radius":"var(--wp--custom--tokens--radius--m,12px)"}}} -->
		<details class="wp-block-details has-bw-surface-background-color has-background" style="border-radius:var(--wp--custom--tokens--radius--m,12px);padding-top:var(--wp--preset--spacing--fluid-m);padding-right:var(--wp--preset--spacing--fluid-m);padding-bottom:var(--wp--preset--spacing--fluid-m);padding-left:var(--wp--preset--spacing--fluid-m)"><summary>Does BlockWind require Tailwind?</summary><p>No. Tailwind modules are optional and opt-in via Vite imports.</p></details>
		<!-- /wp:details -->

		<!-- wp:details {"backgroundColor":"bw-surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|fluid-m","bottom":"var:preset|spacing|fluid-m","left":"var:preset|spacing|fluid-m","right":"var:preset|spacing|fluid-m"}},"border":{"radius":"var(--wp--custom--tokens--radius--m,12px)"}}} -->
		<details class="wp-block-details has-bw-surface-background-color has-background" style="border-radius:var(--wp--custom--tokens--radius--m,12px);padding-top:var(--wp--preset--spacing--fluid-m);padding-right:var(--wp--preset--spacing--fluid-m);padding-bottom:var(--wp--preset--spacing--fluid-m);padding-left:var(--wp--preset--spacing--fluid-m)"><summary>Where do tokens live?</summary><p>In theme.json. Use WordPress presets first and only alias when needed.</p></details>
		<!-- /wp:details -->

		<!-- wp:details {"backgroundColor":"bw-surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|fluid-m","bottom":"var:preset|spacing|fluid-m","left":"var:preset|spacing|fluid-m","right":"var:preset|spacing|fluid-m"}},"border":{"radius":"var(--wp--custom--tokens--radius--m,12px)"}}} -->
		<details class="wp-block-details has-bw-surface-background-color has-background" style="border-radius:var(--wp--custom--tokens--radius--m,12px);padding-top:var(--wp--preset--spacing--fluid-m);padding-right:var(--wp--preset--spacing--fluid-m);padding-bottom:var(--wp--preset--spacing--fluid-m);padding-left:var(--wp--preset--spacing--fluid-m)"><summary>How do I build pages quickly?</summary><p>Use section patterns and page layout patterns—then customize content in the editor.</p></details>
		<!-- /wp:details -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
