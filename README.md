# Blockwind

**Blockwind** is an **FSE-first (Full Site Editing)** WordPress block theme built around a clean separation of concerns:

- **`theme.json`** = design tokens + editor capabilities + baseline styles (**source of truth**)
- **Tailwind (optional)** = minimal responsive utility framework + migration helpers (**implementation layer when needed**)
- **SCSS (optional)** = organization (partials/mixins/components) **not a second design system**
- **Vite** = build system that outputs a single, minified `theme.min.css` (only when CSS modules are imported)

The theme is designed to be **usable with zero compiled CSS** (pure FSE + `theme.json`), while still allowing teams migrating from Bootstrap/hybrid themes to opt into a **Bootstrap-like class layer** built with Tailwind `@apply`.

---

## Goals

### ✅ FSE-first

Blockwind prioritizes WordPress core block theming:

- Templates, parts, and patterns define layout and “component library”
- `theme.json` controls the editor experience and global styling
- Minimal PHP (mostly enqueue + theme support)

### ✅ No bloat, no unused CSS by default

- If you **do not import Tailwind/SCSS modules**, Vite will **not produce CSS output**
- Your theme runs on `theme.json` and block markup alone
- When enabled, CSS compiles into **one minified file**: `assets/dist/theme.min.css`

### ✅ Migration-friendly

A modular Tailwind `@apply` layer can mimic common Bootstrap patterns:

- `.container`, `.row`, `.col-*`
- spacing utilities
- flex alignment / ordering
- `.card`, `.stretched-link`

Modules are split so you can **import only what you need** during migration.

### ✅ Single source of truth for tokens

- Tokens live in `theme.json`
- Tailwind/SCSS should reference WordPress CSS variables (`--wp--preset--*`) rather than redefining colors/type/spacing

- When you need tokens inside optional layers, **export/derive** them from `theme.json` into:
  - `assets/src/tw.tokens.css` (for Tailwind modules)
  - `assets/src/scss/_tokens.scss` (for SCSS)

---

## Theme Structure

````
blockwind/
  style.css
  theme.json

  templates/
    index.html
    page.html
    front-page.html (recommended)

  parts/
    header.html
    footer.html

  patterns/
    *.php (section/component patterns)

  assets/
    src/
      entry.js                 # opt-in imports (no CSS output if you import nothing)
      js/                      # all theme JS modules live here (optional)
        offcanvas-logo.js      # small JS module(s) (optional)
      tw.base.css              # Tailwind v4 utilities only (no Preflight)
      tw.tokens.css            # tokens exported from theme.json (overrides some Tailwind defaults)
      tw.grid.css              # Bootstrap-ish container/row/col
      tw.flex-align.css        # flex directions + alignment
      tw.spacing.css           # spacing subset (m/p)
      tw.order.css             # order subset
      tw.card.css              # cards
      tw.stretched-link.css    # stretched-link overlay
      tw.offcanvas.css         # offcanvas/mobile nav styling (layout/alignment lives here)
      tw.dropdown.css          # dropdown panel styling (box/border; not nav alignment)
      tw.reference.css         # reference/demo utilities (optional)
      scss/
        app.scss               # optional SCSS entry (organization only)
        _tokens.scss
        _mixins.scss
        components/
        utilities/
    dist/
      theme.min.css            # generated only when CSS modules are imported
      theme.min.js             # tiny build artifact (enqueue optional)```

---

## How Styling Works

### 1) `theme.json` (always on)

`theme.json` is the **contract**:

- design tokens (colors, typography, spacing)
- editor capabilities (what controls editors see)
- baseline global + block styles

This is the _preferred_ styling system for core blocks and editor consistency.

If you need those tokens available to build layers, export/derive them from `theme.json` into:
- `assets/src/tw.tokens.css` (Tailwind)
- `assets/src/scss/_tokens.scss` (SCSS)

### 2) Tailwind (optional, modular)

Tailwind is used as a **minimal responsive framework** when needed:


**Load order (when opting in):** import `tw.base.css` first, then `tw.tokens.css` (which can override some Tailwind defaults to match `theme.json`), then any feature modules.

Tailwind is used as a **minimal responsive framework** when needed:

- layout helpers
- semantic classes built with `@apply`
- migration layer for Bootstrap-like class names (optional modules)

**Preflight is intentionally disabled** to avoid fighting WordPress and `theme.json`.

### 3) SCSS (optional)

SCSS is allowed for:

- partial organization (`components/`, `utilities/`)
- mixins/functions
- cleaner code structure

SCSS should **not** introduce a separate token system—reference `theme.json` CSS vars instead.


If you want token conveniences in SCSS (maps/variables), keep them derived from `theme.json` in `assets/src/scss/_tokens.scss` and import it into `app.scss`.

---

## Requirements

- Node.js 18+ (recommended)
- npm / pnpm / yarn
- WordPress 6.x block theme compatible environment

---

## Install

From the theme root:

```bash
npm install
````

### Dev dependencies used

- `vite` (build)
- `tailwindcss` + `@tailwindcss/vite` (optional CSS framework)
- `sass-embedded` (optional SCSS compiler)

---

## Development Workflow

### A) FSE-only mode (default, no compiled CSS)

Blockwind can run purely on:

- `theme.json`
- templates/parts/patterns

✅ Leave CSS imports **disabled** in `assets/src/entry.js`:

```js
// import "./tw.base.css";
// import "./tw.tokens.css"; // tokens exported from theme.json; may override some Tailwind defaults
// import "./tw.grid.css";
// import "./scss/app.scss";
export {};
```

In this mode, `npm run build` produces no `theme.min.css` (JS output depends on whether you import any JS modules), and the theme stays clean.

---

### B) Enable Tailwind modules (migration or utility framework)

To opt in, import only what you need.

Example: Bootstrap-ish grid + cards only:

```js
// assets/src/entry.js
import "./tw.base.css";
import "./tw.tokens.css"; // exported from theme.json; may override some Tailwind defaults
import "./tw.grid.css";
import "./tw.card.css";
import "./tw.stretched-link.css";

export {};
```

---

### C) Enable SCSS (organization only)

```js
import "./tw.base.css"; // optional if you also use @apply in SCSS
import "./scss/app.scss"; // optional
export {};
```

Recommended: import `assets/src/scss/_tokens.scss` inside `app.scss` so SCSS stays aligned with `theme.json` tokens.

> If your SCSS uses `@apply`, you must have Tailwind utilities available.

---

## Build

### Production build

```bash
npm run build
```

Outputs (when CSS is imported):

- `assets/dist/theme.min.css` (single file, minified)
- `assets/dist/theme.min.js` (tiny, optional)

### Dev server (optional)

```bash
npm run dev
```

> In WordPress themes, dev server usage is optional. Many teams simply run `npm run build` and refresh.

---

## Enqueueing Output in WordPress

The theme enqueues `assets/dist/theme.min.css` **only if it exists and has content**.
This preserves the **no-bloat** default behavior.

Typical enqueue logic:

- `style.css` is header-only for compliance
- `theme.min.css` is the real stylesheet when present

---

## Scripts

Example `package.json` scripts:

```json
{
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  }
}
```

---

## Project Philosophy

- **Use blocks and `theme.json` first**
- **Add Tailwind only when it prevents custom CSS sprawl**
- **Use SCSS only for organization**
- **Ship zero extra CSS when you don’t need it**
- **Keep output simple: one minified `theme.min.css`**

---

## Suggested Migration Approach (Bootstrap → Blockwind)

1. Start with file-based templates/parts/patterns using familiar `.container/.row/.col-*`.
2. Import only the necessary Tailwind modules to support those classes.
3. Gradually refactor toward long-term theme semantics (`l-*`, `c-*`) and remove migration modules over time.
4. Keep tokens and editor styling in `theme.json` (and export/derive tokens into `assets/src/tw.tokens.css` and `assets/src/scss/_tokens.scss` when optional layers need them).

---

## License

![License: GPL v2](https://img.shields.io)
