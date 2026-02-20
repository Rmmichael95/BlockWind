<?php
/**
 * Title: Utility – Section Header
 * Slug: bw/section-header
 * Categories: bw-utility, bw-components
 * Keywords: section header, heading, intro, lead
 * Block Types: core/group, core/heading, core/paragraph
 */
?>

<!-- wp:group {"layout":{"type":"constrained","contentSize":"var(--wp--preset--dimension-size--bw-readable)"}} -->
<div class="wp-block-group">
	<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|bw-sm","fontWeight":"var(--wp--custom--bw-font-weight--semi-bold)"},"color":{"text":"var:preset|color|bw-muted"}}} -->
	<p style="color:var(--wp--preset--color--bw-muted);font-size:var(--wp--preset--font-size--bw-sm);font-weight:var(--wp--custom--bw-font-weight--semi-bold)">Eyebrow label</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2} -->
	<h2>Section title</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"style":{"typography":{"lineHeight":"var(--wp--custom--bw-line-height--body)"},"color":{"text":"var:preset|color|bw-text"}}} -->
	<p style="color:var(--wp--preset--color--bw-text);line-height:var(--wp--custom--bw-line-height--body)">A short intro that explains what this section is about in one or two sentences.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
