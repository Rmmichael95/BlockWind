<?php
/**
 * Title: Cover – Flow Section
 * Slug: bw/cover-flow
 * Categories: bw-sections
 * Keywords: cover, hero, full width, flow
 * Block Types: core/cover
 */
?>

<!-- wp:cover {"align":"full","dimRatio":50,"minHeight":70,"minHeightUnit":"vh","isDark":false,"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-cover alignfull is-light" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:70vh">
  <span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span>
  <div class="wp-block-cover__inner-container">
    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var(--wp--custom--bw-flow--section-padding-y)","right":"var(--wp--custom--bw-flow--content-padding-x)","bottom":"var(--wp--custom--bw-flow--section-padding-y)","left":"var(--wp--custom--bw-flow--content-padding-x)"},"blockGap":"var(--wp--custom--bw-flow--gap)"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide">
      <!-- wp:heading {"level":1} -->
      <h1>Hero headline</h1>
      <!-- /wp:heading -->

      <!-- wp:paragraph -->
      <p>Add your hero copy here.</p>
      <!-- /wp:paragraph -->

      <!-- wp:buttons -->
      <div class="wp-block-buttons">
        <!-- wp:button -->
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Primary action</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
    </div>
    <!-- /wp:group -->
  </div>
</div>
<!-- /wp:cover -->
