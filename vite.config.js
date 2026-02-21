/**
 * BlockWind Vite Build (WordPress theme)
 * ------------------------------------------------------------
 * We build TWO separate bundles:
 *  1) theme.*  -> runs on the public site (frontend)
 *  2) editor.* -> runs only inside the WordPress block editor
 *
 * Why split them?
 *  - Frontend stays smaller/faster (no editor-only code shipped to visitors)
 *  - Editor gets its own JS/CSS for block variations and editor-only UI
 *
 * Output files (written to /assets/inc):
 *  - theme.min.js
 *  - theme.min.css
 *  - editor.min.js
 *  - editor.min.css
 *
 * Important note about CSS:
 *  - cssCodeSplit: true is required so theme + editor each get their own CSS file.
 *
 * IMPORTANT note about JS chunks:
 *  - If you want ALL code compiled into theme.min.js or editor.min.js (no /assets/*.js parts),
 *    we must run TWO separate builds (one input at a time).
 *  - This config supports that via BW_BUILD_TARGET=theme|editor.
 */

import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(() => {
  // BW_BUILD_TARGET controls which single-entry build we run.
  // Default to "theme" so `vite build` still works if someone forgets.
  const target = process.env.BW_BUILD_TARGET === "editor" ? "editor" : "theme";

  const input =
    target === "editor"
      ? { editor: "assets/src/editor.js" }
      : { theme: "assets/src/entry.js" };

  return {
    plugins: [tailwindcss()],

    build: {
      outDir: "assets/inc",

      // Theme build should clear output; editor build should not.
      emptyOutDir: target === "theme",

      // Keep theme + editor CSS separate (Vite will emit theme.css or editor.css)
      cssCodeSplit: true,
      minify: "esbuild",

      rollupOptions: {
        input,

        output: {
          format: "es",

          // Single-file bundle output (no chunks) — allowed because input is a single entry per run
          inlineDynamicImports: true,

          // Name entry JS deterministically
          entryFileNames:
            target === "editor" ? "editor.min.js" : "theme.min.js",

          // Name extracted CSS deterministically
          assetFileNames: (assetInfo) => {
            if (assetInfo.name === "theme.css") return "theme.min.css";
            if (assetInfo.name === "editor.css") return "editor.min.css";
            return "[name][extname]";
          },
        },
      },
    },
  };
});
