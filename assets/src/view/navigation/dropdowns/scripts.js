// ==========================================================
// FILE: assets/src/view/navigation/dropdowns/scripts.js
// Purpose: Opt-in bundle for navigation dropdown styling
// ==========================================================

// Import every .js file in ./js (excluding index.js itself if needed)
const jsModules = import.meta.glob("./js/*.js", { eager: true });
void jsModules;

export {};
