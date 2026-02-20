<?php
/**
 * BlockWind ACF Block: About — render.php
 *
 * Purpose:
 * - Markup-only template.
 * - Calls helpers from block.php for view-model preparation.
 *
 * Data:
 * - $block is provided by WP.
 * - ACF fields available via get_fields().
 *
 * Security:
 * - Escape output appropriately.
 *
 * @package BlockWind
 */

declare(strict_types=1);

require_once __DIR__ . '/block.php';

$fields = function_exists( 'get_fields' ) ? (array) get_fields() : array();
$vm     = bw_about_prepare_view_model( $block, $fields );

// Used by view.js to bind behavior per block instance (optional).
$instance_attr = esc_attr( $vm['instance_id'] );
?>
<section class="<?php echo esc_attr( $vm['wrapper_classes'] ); ?>" data-bw-about="<?php echo $instance_attr; ?>">
	<div class="bw-about__inner">
		<h2 class="bw-about__title">
			<?php echo esc_html( $vm['title'] ); ?>
		</h2>

		<div class="bw-about__content">
			<?php echo wp_kses_post( $vm['content'] ); ?>
		</div>
	</div>
</section>
