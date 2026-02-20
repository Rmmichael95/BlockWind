
# BlockWind Architecture

This document describes the structural, styling, and build architecture of the BlockWind theme.

---

## Core design principle

> **`theme.json` is the single source of truth for design tokens.**

Everything else consumes those tokens rather than redefining them.

---

## High-level architecture

```mermaid
flowchart TD
    A[theme.json] --> B[Templates / Parts / Patterns]
    A --> C[WordPress Block Supports]

    B --> D[Compiled .dh-* Modules]
    B --> E[ACF Blocks]

    D --> F[assets/dist/theme.min.css]
    D --> G[assets/dist/theme.min.js]

    E --> H[acf-blocks/*/*.min.css]
    E --> I[acf-blocks/*/*.min.js]

    F --> J[Frontend]
    G --> J
    H --> J
    I --> J
```

---

## ACF block architecture

```mermaid
flowchart TD
    A[acf-blocks/<block>] --> B[style.scss]
    A --> C[editor.scss]
    A --> D[view.js]
    A --> E[editor.js]

    B --> F[style.min.css]
    C --> G[editor.min.css]
    D --> H[view.min.js]
    E --> I[editor.min.js]

    F --> J[block.json style]
    G --> J
    H --> J
    I --> J
```

---

## Build system architecture

```mermaid
flowchart TD
    A[assets/src] --> B[Vite Theme Build]
    B --> C[assets/dist/theme.min.css]
    B --> D[assets/dist/theme.min.js]

    E[acf-blocks/*/*.scss + *.js] --> F[Vite ACF Build]
    F --> G[acf-blocks/*/*.min.css]
    F --> H[acf-blocks/*/*.min.js]
```
