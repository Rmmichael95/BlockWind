// ==========================================================
// FILE: assets/src/editor.js
// Purpose: Editor-only bundle (block variations, editor UI glue)
// ==========================================================

// Core CSS needed in editor (tokens + base for consistent preview)
import "./core/tw.tokens.css";
import "./core/tw.base.css";

// Editor variations (CSS + JS)
import "./editor/variations/styles.js";
import "./editor/variations/scripts.js";

// If you need SCSS in the editor too, import it here.
// Otherwise, keep SCSS only on frontend.
// import "./scss/index.scss";

export {};
