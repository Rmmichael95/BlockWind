<?php
/**
 * Title: Contact – Split
 * Slug: dh/contact-split
 * Categories: dh-sections, dh-content
 * Keywords: contact, form, details
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|fluid-2xl","bottom":"var:preset|spacing|fluid-2xl","left":"var:preset|spacing|fluid-xl","right":"var:preset|spacing|fluid-xl"}}},"backgroundColor":"dh-surface","textColor":"dh-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-dh-text-color has-dh-surface-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--fluid-2xl);padding-right:var(--wp--preset--spacing--fluid-xl);padding-bottom:var(--wp--preset--spacing--fluid-2xl);padding-left:var(--wp--preset--spacing--fluid-xl)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|fluid-xl","left":"var:preset|spacing|fluid-xl"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"45%"} -->
		<div class="wp-block-column" style="flex-basis:45%">
			<!-- wp:heading --><h2 class="wp-block-heading">Contact</h2><!-- /wp:heading -->
			<!-- wp:paragraph --><p>Use this section with a form plugin block or a native block pattern.</p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} --><p style="font-weight:700">Email</p><!-- /wp:paragraph -->
			<!-- wp:paragraph --><p><a href="mailto:info@example.com">info@example.com</a></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} --><p style="font-weight:700">Phone</p><!-- /wp:paragraph -->
			<!-- wp:paragraph --><p><a href="tel:+17075551234">(707) 555-1234</a></p><!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"55%"} -->
		<div class="wp-block-column" style="flex-basis:55%">
			<!-- wp:group {"backgroundColor":"dh-base","style":{"spacing":{"padding":{"top":"var:preset|spacing|fluid-l","bottom":"var:preset|spacing|fluid-l","left":"var:preset|spacing|fluid-l","right":"var:preset|spacing|fluid-l"},"blockGap":"var:preset|spacing|fluid-m"},"border":{"radius":"var(--wp--custom--tokens--radius--m,12px)"}}} -->
			<div class="wp-block-group has-dh-base-background-color has-background" style="border-radius:var(--wp--custom--tokens--radius--m,12px);padding-top:var(--wp--preset--spacing--fluid-l);padding-right:var(--wp--preset--spacing--fluid-l);padding-bottom:var(--wp--preset--spacing--fluid-l);padding-left:var(--wp--preset--spacing--fluid-l)">
				<!-- wp:paragraph --><p><strong>Form placeholder</strong></p><!-- /wp:paragraph -->
				<!-- wp:paragraph --><p>Replace this card with your preferred form block.</p><!-- /wp:paragraph -->
				<!-- wp:buttons -->
				<div class="wp-block-buttons">
					<!-- wp:button {"backgroundColor":"dh-accent","textColor":"dh-base"} -->
					<div class="wp-block-button"><a class="wp-block-button__link has-dh-base-color has-dh-accent-background-color has-text-color has-background wp-element-button" href="#">Send message</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
