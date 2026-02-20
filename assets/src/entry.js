// ==========================================================
// FILE: assets/src/entry.js
// Purpose: Opt-in imports (no CSS output if you import nothing)
// ==========================================================

// Tailwind utilities (no preflight) + only the modules you need:
// FSE-first: if you don't import anything, you get no CSS output.
// Uncomment only when you need them:
import "./tw.base.css";
import "./tw.tokens.css";

// Navigation modules (directory opt-in)
// import "./navigation/dropdowns";
// import "./navigation/items";
// import "./navigation/offcanvas";

// Optional SCSS (organization only) – uncomment only if used.
// import "./scss/app.scss";

// add your JS here
import "./js/offcanvas-logo.js";
import "./js/offcanvas-devtools-guard.js";

export {};
