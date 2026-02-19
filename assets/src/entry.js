// ==========================================================
// FILE: assets/src/entry.js
// Purpose: Opt-in imports (no CSS output if you import nothing)
// ==========================================================

// Tailwind utilities (no preflight) + only the modules you need:
// FSE-first: if you don't import anything, you get no CSS output.
// Uncomment only when you need them:
import "./tw.base.css";
import "./tw.tokens.css";
// import "./tw.nav-items.css";
// import "./tw.dropdowns.css";
// import "./tw.offcanvas.css";
// import "./tw.grid.css";
// import "./tw.flex-align.css";
// import "./tw.spacing.css";
// import "./tw.order.css";
// import "./tw.card.css";
import "./tw.stretched-link.css";

// Optional SCSS (organization only) – uncomment only if used.
// import "./scss/app.scss";

// add your JS here
import "./js/offcanvas-logo.js";
import "./js/offcanvas-devtools-guard.js";

export {};
