<?php
/**
 * Title: Utility – Section Header
 * Slug: dh/section-header
 * Categories: dh-utility, dh-components
 * Keywords: section header, heading, intro, lead
 * Block Types: core/group, core/heading, core/paragraph
 */
?>

<!-- wp:group {"layout":{"type":"constrained","contentSize":"var(--wp--preset--dimension-size--dh-readable)"}} -->
<div class="wp-block-group">
	<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|dh-sm","fontWeight":"var(--wp--custom--dh-font-weight--semi-bold)"},"color":{"text":"var:preset|color|dh-muted"}}} -->
	<p style="color:var(--wp--preset--color--dh-muted);font-size:var(--wp--preset--font-size--dh-sm);font-weight:var(--wp--custom--dh-font-weight--semi-bold)">Eyebrow label</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2} -->
	<h2>Section title</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"style":{"typography":{"lineHeight":"var(--wp--custom--dh-line-height--body)"},"color":{"text":"var:preset|color|dh-text"}}} -->
	<p style="color:var(--wp--preset--color--dh-text);line-height:var(--wp--custom--dh-line-height--body)">A short intro that explains what this section is about in one or two sentences.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
