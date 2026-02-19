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
 * BlockWind: Load blocks & editor extensions from /assets/blocks/*
 *
 * Folder conventions (per block package):
 *
 * A) Real blocks:
 *   assets/blocks/my-block/block.json
 *   assets/blocks/my-block/build/...
 *
 * B) Editor extensions (no block.json):
 *   assets/blocks/linked-group-extension/build/editor.js
 *   assets/blocks/linked-group-extension/build/editor.asset.php
 *   assets/blocks/linked-group-extension/build/editor.css (optional)
 *   assets/blocks/linked-group-extension/build/frontend.css (optional)
 */

/**
 * Safe helper: convert absolute file path to theme URL.
 */
function bw_path_to_theme_url( $abs_path ) {
	$theme_dir = wp_normalize_path( get_template_directory() );
	$abs_path  = wp_normalize_path( $abs_path );

	if ( strpos( $abs_path, $theme_dir ) !== 0 ) {
		return '';
	}

	$rel = ltrim( substr( $abs_path, strlen( $theme_dir ) ), '/' );
	return trailingslashit( get_template_directory_uri() ) . $rel;
}

/**
 * Register any blocks that have block.json
 * (mirrors the ACF "drop in folder" workflow, but Gutenberg-native).
 */
function bw_register_theme_blocks() {
	$base = get_template_directory() . '/assets/blocks';
	foreach ( glob( $base . '/*', GLOB_ONLYDIR ) as $dir ) {
		if ( file_exists( $dir . '/block.json' ) ) {
			register_block_type( $dir );
		}
	}
}
add_action( 'init', 'bw_register_theme_blocks' );

/**
 * Enqueue editor extensions + optional frontend CSS for block packages that do not have block.json.
 * We treat these as "modules" that enhance existing/core blocks (like linked-group extension).
 */
function bw_enqueue_block_modules() {
	$base = get_template_directory() . '/assets/blocks';

	foreach ( glob( $base . '/*', GLOB_ONLYDIR ) as $dir ) {
		// Skip real blocks; those should be handled via register_block_type().
		if ( file_exists( $dir . '/block.json' ) ) {
			continue;
		}

		$build_dir = $dir . '/build';
		if ( ! is_dir( $build_dir ) ) {
			continue;
		}

		$slug = basename( $dir ); // folder name becomes the unique key

		// ---------- Editor script ----------
		$editor_js    = $build_dir . '/editor.js';
		$editor_asset = $build_dir . '/editor.asset.php';

		if ( file_exists( $editor_js ) && file_exists( $editor_asset ) ) {
			$asset = include $editor_asset;

			$editor_js_url = bw_path_to_theme_url( $editor_js );

			wp_enqueue_script(
				'bw-block-module-' . $slug . '-editor',
				$editor_js_url,
				$asset['dependencies'] ?? array(),
				$asset['version'] ?? filemtime( $editor_js ),
				true
			);

			// Optional editor CSS emitted by wp-scripts (minified).
			$editor_css = $build_dir . '/editor.css';
			if ( file_exists( $editor_css ) ) {
				wp_enqueue_style(
					'bw-block-module-' . $slug . '-editor',
					bw_path_to_theme_url( $editor_css ),
					array(),
					filemtime( $editor_css )
				);
			}
		}

		// ---------- Frontend CSS (optional) ----------
		// For modules like linked-group stretched-link overlay.
		$frontend_css = $build_dir . '/frontend.css';
		if ( file_exists( $frontend_css ) ) {
			wp_enqueue_style(
				'bw-block-module-' . $slug . '-frontend',
				bw_path_to_theme_url( $frontend_css ),
				array(),
				filemtime( $frontend_css )
			);
		}
	}
}
add_action( 'enqueue_block_editor_assets', 'bw_enqueue_block_modules' );

/**
 * We also want frontend.css on the site frontend (not only in the editor).
 * enqueue_block_assets runs in both editor + frontend for block styles.
 */
function bw_enqueue_block_modules_frontend_assets() {
	$base = get_template_directory() . '/assets/blocks';

	foreach ( glob( $base . '/*', GLOB_ONLYDIR ) as $dir ) {
		if ( file_exists( $dir . '/block.json' ) ) {
			continue;
		}

		$frontend_css = $dir . '/build/frontend.css';
		if ( file_exists( $frontend_css ) ) {
			$slug = basename( $dir );

			wp_enqueue_style(
				'bw-block-module-' . $slug . '-frontend',
				bw_path_to_theme_url( $frontend_css ),
				array(),
				filemtime( $frontend_css )
			);
		}
	}
}
add_action( 'enqueue_block_assets', 'bw_enqueue_block_modules_frontend_assets' );

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

/**
 * BlockWind: Register DH pattern categories (theme.json v3-safe).
 */
add_action(
	'init',
	function () {
		if ( ! function_exists( 'register_block_pattern_category' ) ) {
			return;
		}

		$categories = array(
			array(
				'slug'  => 'dh-sections',
				'label' => __( 'Dahli Sections', 'blockwind' ),
			),
			array(
				'slug'  => 'dh-pages',
				'label' => __( 'Dahli Page Layouts', 'blockwind' ),
			),
			array(
				'slug'  => 'dh-marketing',
				'label' => __( 'Dahli Marketing', 'blockwind' ),
			),
			array(
				'slug'  => 'dh-content',
				'label' => __( 'Dahli Content', 'blockwind' ),
			),
			array(
				'slug'  => 'dh-components',
				'label' => __( 'Dahli Components', 'blockwind' ),
			),
			array(
				'slug'  => 'dh-utility',
				'label' => __( 'Dahli Utility', 'blockwind' ),
			),
			array(
				'slug'  => 'dh-navigation',
				'label' => __( 'Dahli Navigation', 'blockwind' ),
			),
			array(
				'slug'  => 'dh-commerce',
				'label' => __( 'Dahli Commerce', 'blockwind' ),
			),
		);

		foreach ( $categories as $cat ) {
			register_block_pattern_category( $cat['slug'], array( 'label' => $cat['label'] ) );
		}
	}
);
