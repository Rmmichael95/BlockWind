// ==========================================================
// FILE: assets/src/view/navigation/offcanvas/scripts.js
// Purpose: Include js files for nar navigation appearence
// ==========================================================

// Import every .js file in ./js (excluding index.js itself if needed)
const jsModules = import.meta.glob("./js/*.js", { eager: true });
void jsModules;

export {};
