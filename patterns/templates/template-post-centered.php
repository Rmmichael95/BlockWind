<?php
/**
 * Title: Post Centered (BlockWind)
 * Slug: bw/template-post-centered
 * Template Types: single
 * Description: Centered post layout adapted to BlockWind flow.
 * Categories: bw/templates
 * Keywords: post, centered
 * Viewport Width: 1500
 * Inserter: false
 */
?>
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","className":"bw-flow","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<main class="wp-block-group alignfull bw-flow" style="margin-top:0;margin-bottom:0">
	<!-- wp:group {"align":"wide","className":"bw-flow-content bw-flow-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide bw-flow-content bw-flow-section">
		<!-- wp:group {"metadata":{"name":"Content Header"},"align":"full","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:post-terms {"term":"category","className":"is-style-default","style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|primary"},"hover":{"color":{"text":"var:preset|color|secondary"}}}}},"fontSize":"small"} /-->

			<!-- wp:post-title {"level":1,"style":{"typography":{"fontSize":"clamp(2.25rem, 1.125rem + 3vw, 3.25rem)","fontStyle":"normal","fontWeight":"500","lineHeight":"1.1"},"elements":{"link":{"color":{"text":"var:preset|color|main"},"hover":{"color":{"text":"var:preset|color|primary"}}}}}} /-->

			<!-- wp:group {"metadata":{"name":"Post Meta"},"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left","verticalAlignment":"center"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--large)">
				<!-- wp:post-author {"showAvatar":true,"avatarSize":32,"style":{"layout":{"selfStretch":"fit","flexSize":null},"typography":{"fontStyle":"normal","fontWeight":"500"}}} /-->

				<!-- wp:paragraph {"metadata":{"name":"Separator"},"style":{"typography":{"lineHeight":"1"},"layout":{"selfStretch":"fit","flexSize":null},"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}}}} -->
				<p style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:1">·</p>
				<!-- /wp:paragraph -->

				<!-- wp:post-date {"style":{"layout":{"selfStretch":"fit","flexSize":null},"typography":{"fontStyle":"normal","fontWeight":"500"}}} /-->

				<!-- wp:paragraph {"metadata":{"name":"Separator"},"style":{"typography":{"lineHeight":"1"},"layout":{"selfStretch":"fit","flexSize":null},"spacing":{"padding":{"right":"0","left":"0","top":"0","bottom":"0"}}}} -->
				<p style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:1">·</p>
				<!-- /wp:paragraph -->

				<!-- wp:post-time-to-read {"style":{"layout":{"selfStretch":"fit","flexSize":null},"typography":{"fontStyle":"normal","fontWeight":"500"}}} /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:post-featured-image {"aspectRatio":"16/9","style":{"spacing":{"margin":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}}}} /-->

		<!-- wp:group {"metadata":{"name":"Post Content"},"align":"full","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"metadata":{"name":"Author Box"},"align":"full","style":{"spacing":{"margin":{"top":"var:preset|spacing|xx-large","bottom":"var:preset|spacing|xx-large"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull" style="margin-top:var(--wp--preset--spacing--xx-large);margin-bottom:var(--wp--preset--spacing--xx-large)">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","right":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large","left":"var:preset|spacing|x-large"},"blockGap":"var:preset|spacing|medium"},"border":{"radius":"10px"}},"backgroundColor":"base","layout":{"type":"default"}} -->
			<div class="wp-block-group has-base-background-color has-background" style="border-radius:10px;padding-top:var(--wp--preset--spacing--x-large);padding-right:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large);padding-left:var(--wp--preset--spacing--x-large)">
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
				<div class="wp-block-group">
					<!-- wp:post-author {"showBio":true,"showAvatar":true,"avatarSize":72,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"metadata":{"name":"Comments"},"align":"full","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:comments {"style":{"spacing":{"margin":{"top":"var:preset|spacing|xx-large"}}}} -->
			<div class="wp-block-comments" style="margin-top:var(--wp--preset--spacing--xx-large)">
				<!-- wp:comments-title {"showPostTitle":false} /-->

				<!-- wp:comment-template {"style":{"spacing":{"blockGap":"var:preset|spacing|x-large"}}} -->
				<!-- wp:columns -->
				<div class="wp-block-columns">
					<!-- wp:column {"width":"64px"} -->
					<div class="wp-block-column" style="flex-basis:64px">
						<!-- wp:avatar {"size":64,"style":{"border":{"radius":"100px"}}} /-->
					</div>
					<!-- /wp:column -->

					<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
					<div class="wp-block-column">
						<!-- wp:comment-author-name {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} /-->

						<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"},"style":{"typography":{"fontSize":"0.9rem"},"spacing":{"blockGap":"0.25rem"}}} -->
						<div class="wp-block-group" style="font-size:0.9rem">
							<!-- wp:comment-date /-->
							<!-- wp:comment-edit-link /-->
						</div>
						<!-- /wp:group -->

						<!-- wp:comment-content /-->
						<!-- wp:comment-reply-link {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}}} /-->
					</div>
					<!-- /wp:column -->
				</div>
				<!-- /wp:columns -->
				<!-- /wp:comment-template -->

				<!-- wp:comments-pagination {"style":{"spacing":{"margin":{"top":"var:preset|spacing|x-large"}}}} -->
				<!-- wp:comments-pagination-previous /-->
				<!-- wp:comments-pagination-next /-->
				<!-- /wp:comments-pagination -->

				<!-- wp:post-comments-form {"style":{"spacing":{"margin":{"top":"var:preset|spacing|xx-large"}}}} /-->
			</div>
			<!-- /wp:comments -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
