// vite.acf.config.js
//
// PURPOSE (in plain English):
// This Vite config compiles ACF block assets IN PLACE.
//
// For every ACF block folder like:
//   acf-blocks/example-block/
//
// If it contains entry files like:
//   block-style.scss
//   block-admin-styles.scss
//   block-script.js
//
// This build will output (in the SAME folder):
//   block-style.min.css
//   block-admin-styles.min.css
//   block-script.min.js
//
// Why we do this:
// - Each ACF block is self-contained and portable.
// - WordPress can enqueue the "file:./*.min.*" assets directly from block.json.
// - The theme does NOT need a giant global CSS bundle for ACF blocks.
//
// IMPORTANT DETAIL:
// Vite/Rollup ALWAYS creates a small JS "stub" file for CSS/SCSS entrypoints.
// We do NOT want those stub JS files living inside every ACF block directory.
// So we detect SCSS entries and route their JS stubs into:
//   assets/dist/__acf/
// while still writing the compiled CSS back next to the SCSS source.

import { defineConfig } from "vite";
import fs from "node:fs";
import path from "node:path";

/**
 * Returns a list of absolute paths for each ACF block directory.
 * Example output:
 *   ["/path/to/theme/acf-blocks/example-block", "/path/to/theme/acf-blocks/hero", ...]
 */
function listBlockDirs(acfRoot) {
  if (!fs.existsSync(acfRoot)) return [];
  return fs
    .readdirSync(acfRoot, { withFileTypes: true })
    .filter((d) => d.isDirectory())
    .map((d) => path.join(acfRoot, d.name));
}

/**
 * Builds the Rollup "input" object for the ACF build.
 *
 * Rollup input format is:
 *   { "<virtualName>": "/absolute/path/to/file", ... }
 *
 * We choose <virtualName> to match the relative path WITHOUT extension, like:
 *   "acf-blocks/example-block/block-style"
 *
 * That lets us later emit outputs back to:
 *   acf-blocks/example-block/block-style.min.css
 *   acf-blocks/example-block/block-script.min.js
 */
function getAcfEntries() {
  const root = process.cwd(); // project root (theme root)
  const acfRoot = path.join(root, "acf-blocks");

  /** @type {Record<string, string>} */
  const input = {};

  /**
   * We track which inputs are SCSS so we can handle their JS "stub" outputs.
   * Key = the Rollup input key, like "acf-blocks/example-block/block-style"
   */
  /** @type {Set<string>} */
  const scssKeys = new Set();

  for (const dir of listBlockDirs(acfRoot)) {
    const files = fs.readdirSync(dir, { withFileTypes: true });

    for (const f of files) {
      if (!f.isFile()) continue;

      const abs = path.join(dir, f.name);
      const rel = path.relative(root, abs).replace(/\\/g, "/"); // normalize Windows paths

      // ✅ SCSS ENTRY FILES
      // We compile SCSS files that are "real entries":
      // - ends in .scss
      // - does NOT start with "_" (partials like _mixins.scss should not compile to their own css)
      // - does NOT end with .min.scss (we never want to treat minified sources as entries)
      if (f.name.endsWith(".scss") && !f.name.startsWith("_") && !f.name.endsWith(".min.scss")) {
        const key = rel.replace(/\.scss$/, ""); // remove extension
        input[key] = abs;
        scssKeys.add(key);
        continue;
      }

      // ✅ JS ENTRY FILES
      // We compile JS files that are "real entries":
      // - ends in .js
      // - does NOT start with "_" (treat underscore files as internal helpers)
      // - does NOT end with .min.js (ignore build outputs)
      if (f.name.endsWith(".js") && !f.name.startsWith("_") && !f.name.endsWith(".min.js")) {
        const key = rel.replace(/\.js$/, "");
        input[key] = abs;
        continue;
      }
    }
  }

  return { input, scssKeys };
}

export default defineConfig(() => {
  const { input, scssKeys } = getAcfEntries();

  return {
    build: {
      // We output into the theme directory (".") so we can write files back into acf-blocks/*
      outDir: ".",
      // Never delete the theme directory output (that would be catastrophic)
      emptyOutDir: false,

      // Keep outputs clean and production-ready
      sourcemap: false,
      minify: true,    // minify JS
      cssMinify: true, // minify CSS

      rollupOptions: {
        input,

        output: {
          /**
           * JS OUTPUT NAMING
           *
           * - For real JS entries, output:
           *     acf-blocks/<block>/<file>.min.js
           *
           * - For SCSS entries, Vite still generates a tiny JS "stub".
           *   We do NOT want:
           *     acf-blocks/<block>/<file>.js
           *   cluttering each block folder.
           *
           *   So if this entry originated from SCSS, route its JS to:
           *     assets/dist/__acf/<name>.js
           */
          entryFileNames: (chunk) => {
            // chunk.name is the Rollup input key we created above.
            // Example: "acf-blocks/example-block/block-style"
            if (scssKeys.has(chunk.name)) {
              // This is the JS stub from an SCSS entry.
              return "assets/dist/__acf/[name].js";
            }
            // This is a real JS entry. Keep it next to the source file, as .min.js
            return `${chunk.name}.min.js`;
          },

          /**
           * CHUNKS
           * If Rollup tries to create shared chunks, keep them out of block folders.
           */
          chunkFileNames: "assets/dist/__acf/[name]-[hash].js",

          /**
           * CSS OUTPUT NAMING
           *
           * Vite emits CSS assets that match the input key, e.g:
           *   "acf-blocks/example-block/block-style.css"
           *
           * We rename those to:
           *   "acf-blocks/example-block/block-style.min.css"
           */
          assetFileNames: (assetInfo) => {
            if (assetInfo.name && assetInfo.name.endsWith(".css")) {
              return assetInfo.name.replace(/\.css$/, ".min.css");
            }
            // Anything else (images, fonts, etc.) should not go inside block dirs.
            return "assets/dist/__acf/[name]-[hash][extname]";
          },

          /**
           * Prevent surprise code-splitting across multiple ACF entries.
           * ACF blocks should be self-contained.
           */
          manualChunks: () => null,
        },
      },
    },
  };
});
