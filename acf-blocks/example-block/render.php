<?php
/**
 * BlockWind ACF Block: Example — render.php
 *
 * Purpose:
 * - Markup template
 * - Uses block.php helpers for consistency
 */

declare(strict_types=1);

require_once __DIR__ . '/block.php';

$fields = function_exists( 'get_fields' ) ? (array) get_fields() : array();
$vm     = bw_example_prepare_view_model( $block, $fields );
?>
<section class="<?php echo esc_attr( $vm['classes'] ); ?>">
	<h2 class="bw-example__title"><?php echo esc_html( $vm['title'] ); ?></h2>
	<div class="bw-example__content"><?php echo wp_kses_post( $vm['content'] ); ?></div>
</section>
