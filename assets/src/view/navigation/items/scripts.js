// ==========================================================
// FILE: assets/src/navigation/items/scripts.js
// Purpose: Opt-in bundle for navigation item styling
// ==========================================================

// Import every .js file in ./js (excluding index.js itself if needed)
const jsModules = import.meta.glob("./js/*.js", { eager: true });
void jsModules;

export {};
