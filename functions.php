<?php
/**
 * This file adds functions to the BlockWind WordPress theme.
 *
 * @package BlockWind
 * @author  Ryan M Sullivan
 * @license GNU General Public License v2
 * @link    https://github.com/Rmmichael95/BlockWind/
 */


if ( ! function_exists( 'blockwind_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 0.8.0
	 *
	 * @return void
	 */
	function blockwind_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'blockwind', get_template_directory() . '/languages' );

		// Enqueue editor stylesheet.
		add_editor_style( get_template_directory_uri() . '/style.css' );

		// Remove core block patterns.
		// remove_theme_support( 'core-block-patterns' );
	}
}
add_action( 'after_setup_theme', 'blockwind_setup' );

// Enqueue stylesheet.
add_action( 'wp_enqueue_scripts', 'blockwind_enqueue_stylesheet' );
function blockwind_enqueue_stylesheet() {
	wp_enqueue_style( 'blockwind', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}

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

/**
 * Shortcodes synamic block info
 */
function dhali_current_year() {
	return date_i18n( 'Y' );
}
add_shortcode( 'current_year', 'dhali_current_year' );

function dhali_site_name() {
	return get_bloginfo( 'name' );
}
add_shortcode( 'site_name', 'dhali_site_name' );
