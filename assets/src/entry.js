// ==========================================================
// FILE: assets/src/entry.js
// Purpose: Opt-in imports (no CSS output if you import nothing)
// ==========================================================

import "./core/tw.tokens.css";
import "./core/tw.base.css";

// Optional navigation CSS bundles (after you fix their index.js paths)
// import "./view/navigation/dropdowns/styles.js";
// import "./view/navigation/dropdowns/scripts.js";

// Items
// import "./view/navigation/items/styles.js";
// import "./view/navigation/items/scripts.js";

// Offcanvas
// import "./view/navigation/offcanvas/styles.js";
// import "./view/navigation/offcanvas/scripts.js";

// Editor behavior (group variation)
import "./editor/variations/styles.js";
import "./editor/variations/scripts.js";

// SCSS entry (your preference: compiled from entry.js)
import "./scss/index.scss";

export {};
