import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  build: {
    outDir: "assets/dist",
    emptyOutDir: true,

    // "Library mode" makes it easy to control filenames + single CSS output
    lib: {
      entry: "assets/src/entry.js",
      formats: ["es"],
      fileName: () => "theme.min.js",
      cssFileName: "theme.min",
    },

    // Optional: keep it to one CSS file
    cssCodeSplit: false,
    minify: "esbuild",
  },
});
