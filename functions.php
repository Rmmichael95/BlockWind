<?php
/**
 * BlockWind theme functions.
 *
 * Philosophy:
 * - Token-first (theme.json is the source of truth)
 * - Keep global CSS “fixes” minimal
 * - Prefer block style variations + small, scoped CSS
 * - Patterns may live in nested folders under /patterns (custom loader included)
 * - Build system outputs: assets/inc/theme.min.css + assets/inc/editor.min.css (+ optional JS bundles)
 *
 * @package BlockWind
 * @author  Ryan M Sullivan
 * @license GNU General Public License v2
 * @link    https://github.com/Rmmichael95/BlockWind/
 */

namespace BlockWind;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
-----------------------------------------------------------------------------
 * Constants
 * -------------------------------------------------------------------------- */

const TEXT_DOMAIN = 'blockwind';
const THEME_SLUG  = 'blockwind';

/*
-----------------------------------------------------------------------------
 * Theme setup
 * -------------------------------------------------------------------------- */

/**
 * Setup theme defaults (runs before init).
 */
function blockwind_setup(): void {
	// Make theme available for translation.
	load_theme_textdomain( TEXT_DOMAIN, get_template_directory() . '/languages' );

	/**
	 * Editor stylesheet
	 * - Prefer compiled editor bundle
	 * - Fallback to theme.min.css, then style.css (compat)
	 *
	 * Note: add_editor_style expects a theme-relative path (not a full URI).
	 */
	$editor_rel = 'assets/inc/editor.min.css';
	$theme_rel  = 'assets/inc/theme.min.css';

	if ( file_exists( get_theme_file_path( $editor_rel ) ) ) {
    blockwind_enqueue_editor_assets( $theme_rel );
    blockwind_enqueue_editor_assets( $editor_rel );
	} elseif ( file_exists( get_theme_file_path( $theme_rel ) ) ) {
		add_editor_style( $theme_rel );
	} else {
		add_editor_style( 'style.css' );
	}

	// Optional: remove core patterns if you want ONLY BlockWind patterns.
	// remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\blockwind_setup' );

/*
-----------------------------------------------------------------------------
 * Frontend assets
 * -------------------------------------------------------------------------- */

/**
 * Enqueue frontend CSS/JS.
 *
 * Important:
 * - style.css is still enqueued for FSE/theme compatibility (keep it minimal)
 * - theme.min.css is the authoritative stylesheet
 * - Do not reuse the same handle for CSS + JS
 */
function blockwind_enqueue_frontend_assets(): void {
	$theme_version = wp_get_theme()->get( 'Version' );

	// 1) Compatibility stylesheet (keep minimal; header + tiny fallbacks only)
	wp_enqueue_style(
		THEME_SLUG . '-style',
		get_stylesheet_uri(),
		array(),
		$theme_version
	);

	// 2) Compiled theme bundle (authoritative)
	$css_rel = 'assets/inc/theme.min.css';
	$css_abs = get_theme_file_path( $css_rel );

	if ( file_exists( $css_abs ) && filesize( $css_abs ) > 20 ) {
		wp_enqueue_style(
			THEME_SLUG . '-theme',
			get_theme_file_uri( $css_rel ),
			array( THEME_SLUG . '-style' ), // ensure load order
			filemtime( $css_abs )
		);
	}

	// Optional frontend JS (only if you actually ship behavior)
	$js_rel = 'assets/inc/theme.min.js';
	$js_abs = get_theme_file_path( $js_rel );

	if ( file_exists( $js_abs ) && filesize( $js_abs ) > 20 ) {
		wp_enqueue_script(
			THEME_SLUG . '-theme-js',
			get_theme_file_uri( $js_rel ),
			array(),
			filemtime( $js_abs ),
			true
		);

		// If Vite outputs ESM (format: "es"), load as module.
		wp_script_add_data( THEME_SLUG . '-theme-js', 'type', 'module' );
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\blockwind_enqueue_frontend_assets' );

/*
-----------------------------------------------------------------------------
 * Editor assets
 * -------------------------------------------------------------------------- */

/**
 * Enqueue editor-only bundles (built).
 */
function blockwind_enqueue_editor_assets(): void {
	$css_rel = 'assets/inc/editor.min.css';
	$css_abs = get_theme_file_path( $css_rel );

	if ( file_exists( $css_abs ) && filesize( $css_abs ) > 20 ) {
		wp_enqueue_style(
			THEME_SLUG . '-editor',
			get_theme_file_uri( $css_rel ),
			array( 'wp-edit-blocks' ),
			filemtime( $css_abs )
		);
	}

	$js_rel = 'assets/inc/editor.min.js';
	$js_abs = get_theme_file_path( $js_rel );

	if ( file_exists( $js_abs ) && filesize( $js_abs ) > 20 ) {
		wp_enqueue_script(
			THEME_SLUG . '-editor-js',
			get_theme_file_uri( $js_rel ),
			array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
			filemtime( $js_abs ),
			true
		);

		// Vite output format is likely "es" (module)
		wp_script_add_data( THEME_SLUG . '-editor-js', 'type', 'module' );
	}
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\blockwind_enqueue_editor_assets' );

/*
-----------------------------------------------------------------------------
 * Pattern categories + recursive pattern loader
 * -------------------------------------------------------------------------- */

/**
 * Register BlockWind pattern categories (single source of truth).
 */
function blockwind_register_pattern_categories(): void {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	$categories = array(
		array(
			'slug'  => 'bw-sections',
			'label' => __( 'BlockWind Sections', TEXT_DOMAIN ),
		),
		array(
			'slug'  => 'bw-pages',
			'label' => __( 'BlockWind Page Layouts', TEXT_DOMAIN ),
		),
		array(
			'slug'  => 'bw-marketing',
			'label' => __( 'BlockWind Marketing', TEXT_DOMAIN ),
		),
		array(
			'slug'  => 'bw-content',
			'label' => __( 'BlockWind Content', TEXT_DOMAIN ),
		),
		array(
			'slug'  => 'bw-components',
			'label' => __( 'BlockWind Components', TEXT_DOMAIN ),
		),
		array(
			'slug'  => 'bw-utility',
			'label' => __( 'BlockWind Utility', TEXT_DOMAIN ),
		),
		array(
			'slug'  => 'bw-navigation',
			'label' => __( 'BlockWind Navigation', TEXT_DOMAIN ),
		),
		array(
			'slug'  => 'bw-commerce',
			'label' => __( 'BlockWind Commerce', TEXT_DOMAIN ),
		),
	);

	foreach ( $categories as $cat ) {
		register_block_pattern_category( $cat['slug'], array( 'label' => $cat['label'] ) );
	}
}
add_action( 'init', __NAMESPACE__ . '\blockwind_register_pattern_categories', 8 );

/**
 * BlockWind: Register patterns from /patterns recursively (supports subfolders).
 *
 * Pattern headers supported in each pattern PHP file:
 * - Title (required)
 * - Slug (required)
 * - Description
 * - Categories (comma-separated)
 * - Keywords (comma-separated)
 * - Block Types (comma-separated)
 * - Viewport Width
 * - Inserter (true/false; default true when omitted)
 */
function bw_register_block_patterns_from_theme(): void {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$patterns_dir = get_theme_file_path( '/patterns' );
	if ( ! is_dir( $patterns_dir ) ) {
		return;
	}

	$iterator = new \RecursiveIteratorIterator(
		new \RecursiveDirectoryIterator( $patterns_dir, \FilesystemIterator::SKIP_DOTS )
	);

	foreach ( $iterator as $file ) {
		/** @var \SplFileInfo $file */
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

		// Title + Slug are required.
		if ( empty( $headers['title'] ) || empty( $headers['slug'] ) ) {
			continue;
		}

		$categories  = array_filter( array_map( 'trim', explode( ',', (string) $headers['categories'] ) ) );
		$keywords    = array_filter( array_map( 'trim', explode( ',', (string) $headers['keywords'] ) ) );
		$block_types = array_filter( array_map( 'trim', explode( ',', (string) $headers['block_types'] ) ) );

		// Capture the pattern markup (everything after any PHP header).
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
				// Inserter defaults true when header missing/empty; otherwise parse boolean.
				'inserter'      => ( $headers['inserter'] === '' ) ? true : (bool) filter_var( $headers['inserter'], FILTER_VALIDATE_BOOLEAN ),
			)
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\bw_register_block_patterns_from_theme', 9 );

/*
-----------------------------------------------------------------------------
 * Block style variation
 * -------------------------------------------------------------------------- */

/**
 * Registers editor-selectable styles that apply `is-style-*` classes.
 * CSS is provided by your compiled theme bundle (theme.min.css / editor styling fallback).
 */
function blockwind_register_phase1_block_styles(): void {
	if ( ! function_exists( 'register_block_style' ) ) {
		return;
	}

	// core/group
	register_block_style( 'core/group', array(
		'name'  => 'bw-card',
		'label' => __( 'Card', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/group', array(
		'name'  => 'bw-subtle-border',
		'label' => __( 'Subtle Border', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/group', array(
		'name'  => 'bw-blur-panel',
		'label' => __( 'Blur Panel (Overlay)', TEXT_DOMAIN ),
	) );


	register_block_style( 'core/group', array(
		'name'  => 'bw-frosted-blur',
		'label' => __( 'Frosted Blur', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/group', array(
		'name'  => 'bw-stack-tight',
		'label' => __( 'Stack (Tight)', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/group', array(
		'name'  => 'bw-panel',
		'label' => __( 'Panel', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/group', array(
		'name'  => 'bw-stack-loose',
    'label' => __( 'Stack (Loose)', TEXT_DOMAIN ),
  ) );

	register_block_style( 'core/columns', array(
		'name'  => 'bw-stack-md',
		'label' => __( 'Stack on Mobile', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/button', array(
		'name'  => 'bw-pill',
		'label' => __( 'Pill', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/button', array(
		'name'  => 'bw-ghost',
		'label' => __( 'Ghost', TEXT_DOMAIN ),
	) );


	register_block_style( 'core/image', array(
		'name'  => 'bw-rounded',
		'label' => __( 'Rounded', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/image', array(
		'name'  => 'bw-frame',
		'label' => __( 'Frame', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/image', array(
		'name'  => 'bw-shadow',
		'label' => __( 'Shadow', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/gallery', array(
		'name'  => 'bw-rounded',
		'label' => __( 'Rounded', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/separator', array(
		'name'  => 'bw-subtle',
		'label' => __( 'Subtle', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/list', array(
		'name'  => 'bw-checklist',
		'label' => __( 'Checklist', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/list', array(
		'name'  => 'bw-inline',
		'label' => __( 'Inline', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/cover', array(
		'name'  => 'bw-hero-overlay',
		'label' => __( 'Hero Overlay', TEXT_DOMAIN ),
	) );

	register_block_style( 'core/cover', array(
		'name'  => 'bw-rounded',
		'label' => __( 'Rounded', TEXT_DOMAIN ),
	) );
}
add_action( 'init', __NAMESPACE__ . '\blockwind_register_phase1_block_styles', 20 );

/*
-----------------------------------------------------------------------------
 * Helpers
 * -------------------------------------------------------------------------- */

/**
 * Safe helper: convert absolute file path to a theme URL.
 *
 * @param string $abs_path Absolute path to a file in the theme.
 * @return string Theme URL to that file (or empty string if outside theme).
 */
function bw_path_to_theme_url( string $abs_path ): string {
	$theme_dir = wp_normalize_path( get_template_directory() );
	$abs_path  = wp_normalize_path( $abs_path );

	if ( strpos( $abs_path, $theme_dir ) !== 0 ) {
		return '';
	}

	$rel = ltrim( substr( $abs_path, strlen( $theme_dir ) ), '/' );
	return trailingslashit( get_template_directory_uri() ) . $rel;
}

/*
-----------------------------------------------------------------------------
 * ACF blocks loader (single implementation)
 * -------------------------------------------------------------------------- */

/**
 * Register ACF blocks from /acf-blocks/* (block.json based).
 *
 * - Runs only when ACF is active
 * - Sorts deterministically
 * - Only registers directories containing block.json
 */
function blockwind_register_acf_blocks(): void {
	// Only run if ACF is active.
	if ( ! function_exists( 'acf_get_setting' ) ) {
		return;
	}

	$dirs = glob( __DIR__ . '/acf-blocks/*', GLOB_ONLYDIR );
	if ( ! is_array( $dirs ) ) {
		return;
	}

	sort( $dirs );

	foreach ( $dirs as $block_dir ) {
		if ( ! file_exists( $block_dir . '/block.json' ) ) {
			continue;
		}

		register_block_type( $block_dir );
	}
}
add_action( 'init', __NAMESPACE__ . '\blockwind_register_acf_blocks' );

/*
-----------------------------------------------------------------------------
 * Block modules loader (editor enhancements + optional frontend css)
 * -------------------------------------------------------------------------- */

/**
 * Enqueue editor extensions for block packages that do NOT have block.json.
 *
 * Folder conventions per module:
 * - assets/blocks/<module-slug>/build/editor.js
 * - assets/blocks/<module-slug>/build/editor.asset.php
 * - assets/blocks/<module-slug>/build/editor.css (optional)
 *
 * IMPORTANT:
 * - Do NOT enqueue frontend.css here (avoid duplicates). Frontend styles load
 *   via enqueue_block_assets (next function).
 */
function bw_enqueue_block_modules_editor(): void {
	$base = get_template_directory() . '/assets/blocks';

	foreach ( glob( $base . '/*', GLOB_ONLYDIR ) as $dir ) {
		// Real blocks are handled via register_block_type().
		if ( file_exists( $dir . '/block.json' ) ) {
			continue;
		}

		$build_dir = $dir . '/build';
		if ( ! is_dir( $build_dir ) ) {
			continue;
		}

		$slug = basename( $dir );

		$editor_js    = $build_dir . '/editor.js';
		$editor_asset = $build_dir . '/editor.asset.php';

		if ( ! ( file_exists( $editor_js ) && file_exists( $editor_asset ) ) ) {
			continue;
		}

		$asset = include $editor_asset;

		wp_enqueue_script(
			'bw-block-module-' . $slug . '-editor',
			bw_path_to_theme_url( $editor_js ),
			$asset['dependencies'] ?? array(),
			$asset['version'] ?? filemtime( $editor_js ),
			true
		);

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
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\bw_enqueue_block_modules_editor' );

/**
 * Enqueue module frontend.css once (runs in both editor + frontend).
 *
 * Folder convention:
 * - assets/blocks/<module-slug>/build/frontend.css
 *
 * This is used for “behavioral overlays” or styles that must exist on the frontend
 * (and usually also in editor preview).
 */
function bw_enqueue_block_modules_frontend_assets(): void {
	$base = get_template_directory() . '/assets/blocks';

	foreach ( glob( $base . '/*', GLOB_ONLYDIR ) as $dir ) {
		// Real blocks are handled via register_block_type().
		if ( file_exists( $dir . '/block.json' ) ) {
			continue;
		}

		$frontend_css = $dir . '/build/frontend.css';
		if ( ! file_exists( $frontend_css ) ) {
			continue;
		}

		$slug   = basename( $dir );
		$handle = 'bw-block-module-' . $slug . '-frontend';

		// Prevent accidental double enqueue in complex hook situations.
		if ( wp_style_is( $handle, 'enqueued' ) || wp_style_is( $handle, 'done' ) ) {
			continue;
		}

		wp_enqueue_style(
			$handle,
			bw_path_to_theme_url( $frontend_css ),
			array(),
			filemtime( $frontend_css )
		);
	}
}
add_action( 'enqueue_block_assets', __NAMESPACE__ . '\bw_enqueue_block_modules_frontend_assets' );

/*
-----------------------------------------------------------------------------
 * Shortcodes
 * -------------------------------------------------------------------------- */
/**
 * Shortcode: [bw_year]
 * Use in templates/patterns instead of PHP.
 */
/* add_shortcode('bw_year', function () { */
/* 	return gmdate('Y'); */
/* }); */
/**
 * Shortcode: [current_year]
 */
function blockwind_current_year(): string {
	return (string) date_i18n( 'Y' );
}
add_shortcode( 'current_year', __NAMESPACE__ . '\blockwind_current_year' );

/**
 * Shortcode: [site_name]
 */
function blockwind_site_name(): string {
	return (string) get_bloginfo( 'name' );
}
add_shortcode( 'site_name', __NAMESPACE__ . '\blockwind_site_name' );
