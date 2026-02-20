/**
 * BlockWind ACF Block: About — view.js (FRONTEND)
 *
 * Purpose:
 * - Frontend-only behavior for this block instance.
 * - Loaded via "viewScript" in block.json, so it won't run in the editor.
 *
 * Guidelines:
 * - Keep behavior instance-scoped using the data attribute.
 * - Avoid global side-effects.
 * - If you need WP packages, bundle them or switch to PHP enqueue with dependencies.
 *
 * Output:
 * - Compiled by Vite to: view.min.js (same folder)
 */

function initAboutBlock(root) {
  // TODO: Add behavior here.
  // Example: toggle class, animate, bind click handlers, etc.
  // root.classList.add("is-ready");
}

document.addEventListener("DOMContentLoaded", () => {
  document
    .querySelectorAll("[data-bw-about]")
    .forEach((el) => initAboutBlock(el));
});
