<?php
/**
 * BlockWind ACF Block: Example — block.php
 *
 * Purpose:
 * - Helper functions + data normalization for render.php
 * - Keep render.php markup-focused
 */

declare(strict_types=1);

function bw_example_prepare_view_model( array $block, array $fields ): array {
	return array(
		'classes' => trim( 'bw-example ' . ( $block['className'] ?? '' ) ),
		'title'   => (string) ( $fields['title'] ?? 'Example Title' ),
		'content' => (string) ( $fields['content'] ?? 'Example content...' ),
	);
}
