// ==========================================================
// FILE: assets/src/view/navigation/dropdowns/styles.js
// Purpose: Opt-in bundle for navigation dropdown styling
// ==========================================================

// Import every .css file in ./css (eager so order is deterministic-ish by path)
const cssModules = import.meta.glob("./css/*.css", { eager: true });
void cssModules;

export {};
