
# BlockWind

**BlockWind** is an FSE-first WordPress block theme built around one core principle:

> **`theme.json` is the single source of truth for design tokens.**

Templates, parts, and patterns define structure and composition, while WordPress block supports and style variations handle most styling. When WordPress cannot express something cleanly, BlockWind introduces small compiled `.bw-*` classes (via Tailwind `@apply`) to bridge the gap.

ACF blocks are treated as isolated components with their own SCSS and JS pipelines, compiled in place and loaded via `block.json`.

---

## Core philosophy

### Token hierarchy

Styling follows a strict priority:

1. `theme.json` presets + `settings.custom` (semantic tokens)
2. WordPress block supports / style engine variables
3. Compiled `.bw-*` modular classes (consume WP tokens; never define them)
4. `tw.tokens.css` (Tailwind bridge — may be empty)
5. `__tokens.scss` (SCSS bridge — may be empty)
6. SCSS modules (structural styling and ACF blocks)

Tokens should only exist outside `theme.json` when they **cannot** be defined there and significantly simplify styling.

---

## Build system

BlockWind uses **Vite** as the single build tool.

### Output philosophy

- One global theme bundle
- Per-block isolated builds for ACF blocks
- All runtime assets are minified (`*.min.*`)
- Source files remain non-minified and never loaded directly

---

## Build commands

| Command | Purpose |
|--------|--------|
| `npm run dev` | Vite dev server for theme assets |
| `npm run build` | Build core theme bundle |
| `npm run build:blocks` | Build `assets/blocks/*` packages |
| `npm run build:acf` | Compile ACF SCSS + JS into per-block `*.min.*` |
| `npm run build:all` | Build theme + blocks + ACF |

---

## Runtime asset rule

Templates, patterns, and ACF blocks reference compiled outputs only.

**Theme bundle**
```
assets/dist/theme.min.css
assets/dist/theme.min.js
```

**ACF blocks**
```
acf-blocks/*/*.min.css
acf-blocks/*/*.min.js
```

If a responsibility can move into `theme.json` or block supports, custom CSS should be removed.

---

## ACF blocks

ACF blocks are **self-contained components**.

They use ACF’s extended `block.json` schema:

```json
"$schema": "https://advancedcustomfields.com/schemas/json/main/block.json"
```

Blocks are registered automatically:

```php
foreach ( glob( __DIR__ . '/acf-blocks/*', GLOB_ONLYDIR ) as $block_dir ) {
  register_block_type( $block_dir );
}
```

No custom enqueue logic is required — `block.json` handles it.

---

## ACF asset contract

Each ACF block compiles source assets back into the same directory:

| Source | Output |
|------|------|
| `style.scss` | `style.min.css` |
| `editor.scss` | `editor.min.css` |
| `view.js` | `view.min.js` |
| `editor.js` | `editor.min.js` |

`block.json` loads these via `file:` paths:

```json
{
  "style": ["file:./style.min.css"],
  "editorStyle": ["file:./editor.min.css"],
  "script": ["file:./view.min.js"],
  "editorScript": ["file:./editor.min.js"]
}
```

Non-minified files are source-only.

---

## Expected ACF block structure

```
acf-blocks/
  example/
    block.json
    block.php
    render.php

    style.scss
    style.min.css

    editor.scss
    editor.min.css

    view.js
    view.min.js

    editor.js
    editor.min.js

    scss/
      _tokens.scss
      _layout.scss
      _components.scss
      _responsive.scss
```

---

## ACF styling rules

- ACF blocks are SCSS-first
- Consume WordPress tokens via CSS variables
- Only define block-local tokens when WordPress cannot
- Prefer structural SCSS over small modular classes
- Avoid `.bw-*` dependencies inside ACF blocks

---

## ACF scripting rules

- `view.js` → frontend behavior only
- `editor.js` → editor-only behavior
- Scripts should be self-contained
- `*.asset.php` files are not required in this Vite workflow

---

## Modular class system (FSE only)

Tailwind `@apply` is used to create reusable `.bw-*` classes for:

- navigation behavior
- layout gaps WordPress cannot express
- interaction styling

These classes compile into the theme bundle and are referenced directly in templates, parts, and patterns.

---

## SCSS usage

Use SCSS when styling:

- is structural rather than reusable
- would produce overly granular utility classes
- belongs to an isolated component (ACF)

Use `.bw-*` classes when styling:

- is small and reusable
- fills a gap WordPress cannot express
- applies across templates/patterns

---

## Creating a new ACF block (quick checklist)

1. Duplicate `acf-blocks/example`
2. Update `block.json` name/title
3. Adjust PHP helper names
4. Write SCSS + optional JS
5. Run `npm run build:acf`
6. Confirm `*.min.*` outputs exist
7. Use the block in editor

---

## Architectural summary

BlockWind provides:

- semantic token contract via `theme.json`
- minimal runtime CSS
- modular Tailwind class system for FSE
- isolated SCSS-driven ACF block system
- unified Vite build pipeline
- portable block architecture
