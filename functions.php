<?php
add_action(
	'wp_enqueue_scripts',
	function () {
		$css_rel = 'assets/dist/theme.min.css';
		$css_abs = get_theme_file_path( $css_rel );

		// Enqueue only if the file exists (and isn't empty)
		if ( file_exists( $css_abs ) && filesize( $css_abs ) > 20 ) {
			wp_enqueue_style(
				'mytheme-theme',
				get_theme_file_uri( $css_rel ),
				array(),
				filemtime( $css_abs )
			);
		}

		// Only enqueue JS if/when you actually add JS behavior
		$js_rel = 'assets/dist/theme.min.js';
		$js_abs = get_theme_file_path( $js_rel );

		// If you want truly zero JS on the frontend, keep this disabled.
		if ( file_exists( $js_abs ) && filesize( $js_abs ) > 20 ) {
			wp_enqueue_script(
				'mytheme-theme',
				get_theme_file_uri( $js_rel ),
				array(),
				filemtime( $js_abs ),
				true
			);
		}
	}
);

/**
 * Load ACF Blocks
 */
function dhali_register_acf_blocks() {
	foreach ( glob( __DIR__ . '/acf-blocks/*', GLOB_ONLYDIR ) as $block_dir ) {
		register_block_type( $block_dir );
	}
}
add_action( 'init', 'dhali_register_acf_blocks' );
