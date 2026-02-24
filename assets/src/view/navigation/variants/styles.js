// ==========================================================
// FILE: assets/src/view/navigation/variants/styles.js
// Purpose: Opt-in bundle for navigation presentation variants
//          (No behavior/state mechanics in these files.)
// ==========================================================

// Import every .css file in ./css (eager so order is deterministic-ish by path)
const cssModules = import.meta.glob("./css/*.css", { eager: true });
void cssModules;

export {};
