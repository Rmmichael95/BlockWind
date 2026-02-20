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
	 * BlockWind: Register patterns from /patterns recursively (supports subfolders like /patterns/sections).
	 */
	function bw_register_block_patterns_from_theme() {
		if ( ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		$patterns_dir = get_theme_file_path( '/patterns' );
		if ( ! is_dir( $patterns_dir ) ) {
			return;
		}

		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $patterns_dir, FilesystemIterator::SKIP_DOTS )
		);

		foreach ( $iterator as $file ) {
			/** @var SplFileInfo $file */
			if ( $file->getExtension() !== 'php' ) {
				continue;
			}

			$path = $file->getPathname();

			$headers = get_file_data(
				$path,
				array(
					'title'          => 'Title',
					'slug'           => 'Slug',
					'description'    => 'Description',
					'categories'     => 'Categories',
					'keywords'       => 'Keywords',
					'block_types'    => 'Block Types',
					'viewport_width' => 'Viewport Width',
					'inserter'       => 'Inserter',
				)
			);

			if ( empty( $headers['title'] ) || empty( $headers['slug'] ) ) {
					continue;
			}

			$categories  = array_filter( array_map( 'trim', explode( ',', (string) $headers['categories'] ) ) );
			$keywords    = array_filter( array_map( 'trim', explode( ',', (string) $headers['keywords'] ) ) );
			$block_types = array_filter( array_map( 'trim', explode( ',', (string) $headers['block_types'] ) ) );

			// Capture the pattern markup (everything after the PHP header).
			ob_start();
			include $path;
			$content = trim( (string) ob_get_clean() );

			register_block_pattern(
				$headers['slug'],
				array(
					'title'         => $headers['title'],
					'description'   => $headers['description'],
					'categories'    => $categories,
					'keywords'      => $keywords,
					'blockTypes'    => $block_types,
					'viewportWidth' => is_numeric( $headers['viewport_width'] ) ? (int) $headers['viewport_width'] : null,
					'content'       => $content,
					'inserter'      => ( $headers['inserter'] === '' ) ? true : filter_var( $headers['inserter'], FILTER_VALIDATE_BOOLEAN ),
				)
			);
		}
	}
	add_action( 'init', 'bw_register_block_patterns_from_theme', 9 );

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
		$css_rel = 'assets/inc/theme.min.css';
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
		$js_rel = 'assets/inc/theme.min.js';
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

add_action('enqueue_block_editor_assets', function () {
  $css_rel = 'assets/inc/editor.min.css';
  $css_abs = get_theme_file_path($css_rel);

  if (file_exists($css_abs) && filesize($css_abs) > 20) {
    wp_enqueue_style(
      'blockwind-editor',
      get_theme_file_uri($css_rel),
      array('wp-edit-blocks'),
      filemtime($css_abs)
    );
  }

  $js_rel = 'assets/inc/editor.min.js';
  $js_abs = get_theme_file_path($js_rel);

  if (file_exists($js_abs) && filesize($js_abs) > 20) {
    wp_enqueue_script(
      'blockwind-editor',
      get_theme_file_uri($js_rel),
      array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
      filemtime($js_abs),
      true
    );

    // Your Vite output format is "es" (module). Ensure WP loads it as a module.
    wp_script_add_data('blockwind-editor', 'type', 'module');
  }
});

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
function blockwind_register_acf_blocks() {
	foreach ( glob( __DIR__ . '/acf-blocks/*', GLOB_ONLYDIR ) as $block_dir ) {
		register_block_type( $block_dir );
	}
}
add_action( 'init', 'blockwind_register_acf_blocks' );

/**
 * Shortcodes synamic block info
 */
function blockwind_current_year() {
	return date_i18n( 'Y' );
}
add_shortcode( 'current_year', 'blockwind_current_year' );

function blockwind_site_name() {
	return get_bloginfo( 'name' );
}
add_shortcode( 'site_name', 'blockwind_site_name' );

/**
 * BlockWind: Register BW pattern categories (theme.json v3-safe).
 */
add_action(
	'init',
	function () {
		if ( ! function_exists( 'register_block_pattern_category' ) ) {
			return;
		}

		$categories = array(
			array(
				'slug'  => 'bw-sections',
				'label' => __( 'BlockWind Sections', 'blockwind' ),
			),
			array(
				'slug'  => 'bw-pages',
				'label' => __( 'BlockWind Page Layouts', 'blockwind' ),
			),
			array(
				'slug'  => 'bw-marketing',
				'label' => __( 'BlockWind Marketing', 'blockwind' ),
			),
			array(
				'slug'  => 'bw-content',
				'label' => __( 'BlockWind Content', 'blockwind' ),
			),
			array(
				'slug'  => 'bw-components',
				'label' => __( 'BlockWind Components', 'blockwind' ),
			),
			array(
				'slug'  => 'bw-utility',
				'label' => __( 'BlockWind Utility', 'blockwind' ),
			),
			array(
				'slug'  => 'bw-navigation',
				'label' => __( 'BlockWind Navigation', 'blockwind' ),
			),
			array(
				'slug'  => 'bw-commerce',
				'label' => __( 'BlockWind Commerce', 'blockwind' ),
			),
		);

		foreach ( $categories as $cat ) {
			register_block_pattern_category( $cat['slug'], array( 'label' => $cat['label'] ) );
		}
	}
);
