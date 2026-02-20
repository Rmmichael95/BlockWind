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
 *  - If cssCodeSplit was false, Vite would output ONE combined CSS file for both
 *    bundles, which defeats the separation.
 */

import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  build: {
    outDir: "assets/inc",
    emptyOutDir: true,

    // We want separate CSS files for each entry (theme vs editor)
    cssCodeSplit: true,
    minify: "esbuild",

    rollupOptions: {
      // These are the two "starting points" Vite will build from
      input: {
        theme: "assets/src/entry.js",
        editor: "assets/src/editor.js",
      },

      output: {
        // WordPress can load ES modules fine when enqueued correctly
        format: "es",

        // Name the JS files exactly how we want them (no hashes)
        entryFileNames: (chunk) => {
          if (chunk.name === "editor") return "editor.min.js";
          return "theme.min.js";
        },

        // Name extracted CSS (and other assets) exactly how we want them
        assetFileNames: (assetInfo) => {
          // Vite names extracted CSS after the entry: theme.css / editor.css
          if (assetInfo.name === "theme.css") return "theme.min.css";
          if (assetInfo.name === "editor.css") return "editor.min.css";

          // Fonts/images/etc keep their normal names
          return "[name][extname]";
        },
      },
    },
  },
});
