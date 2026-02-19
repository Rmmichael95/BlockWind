/**
 * BlockWind Blocks Runner (cross-platform)
 * ---------------------------------------
 * Goal:
 *   Build or watch (“start”) ALL block packages under:
 *     /assets/blocks/<block-name>/
 *
 * Each block package is expected to look like:
 *   assets/blocks/linked-group/
 *     package.json
 *     src/...
 *     build/...
 *
 * Why do we need this file?
 *   - We do NOT want hard-coded block names in package.json scripts.
 *   - We DO want to run `npm run build` inside each block folder.
 *   - We want it to work on Windows + Linux, so we avoid Bash loops.
 *
 * Usage examples:
 *   node scripts/blocks.mjs build
 *   node scripts/blocks.mjs build --name linked-group
 *   node scripts/blocks.mjs start --name linked-group
 *   node scripts/blocks.mjs install
 *   node scripts/blocks.mjs install --name linked-group
 */

import fs from "node:fs";
import path from "node:path";
import { spawnSync } from "node:child_process";

/**
 * ROOT is the directory you run the command from.
 * In our case, it's the BlockWind theme folder (where package.json lives).
 */
const ROOT = process.cwd();

/**
 * This is the convention: all block packages live here.
 * If you ever change the folder name, update this constant only.
 */
const BLOCKS_DIR = path.join(ROOT, "assets", "blocks");

/**
 * Parse arguments from the CLI.
 *
 * - cmd: the first positional argument after the script name (build/start/install/ci)
 * - name: optional --name <block-folder-name> to target a single block package
 *
 * We keep parsing very simple on purpose: fewer moving parts, fewer bugs.
 */
function parseArgs(argv) {
  const out = {
    cmd: argv[2] || "build", // default command is "build"
    name: null, // default is "all blocks"
  };

  for (let i = 3; i < argv.length; i++) {
    if (argv[i] === "--name" && argv[i + 1]) {
      out.name = argv[i + 1];
      i++; // skip next item because we consumed it as the name value
    }
  }

  return out;
}

/**
 * Run an npm command in a specific folder (cwd).
 *
 * Why spawnSync?
 *   - It runs the command and waits until it finishes.
 *   - Builds usually must run in order and should stop on first failure.
 *
 * Why shell option?
 *   - On Windows, without `shell: true` sometimes command resolution is weird.
 *   - This makes it more reliable across OSes.
 */
function runNpm(cwd, args) {
  const res = spawnSync("npm", args, {
    cwd,
    stdio: "inherit", // show the child process output in our terminal
    shell: process.platform === "win32", // Windows-friendly
  });

  // spawnSync returns status code; normalize null/undefined to 0
  return res.status ?? 0;
}

/**
 * Discover block packages.
 *
 * We look for directories under assets/blocks/* that contain a package.json.
 * That is how we decide “this folder is a buildable package”.
 *
 * This makes the build system scalable: add a new folder with package.json
 * and it automatically becomes part of the build.
 */
function listBlockPackages() {
  if (!fs.existsSync(BLOCKS_DIR)) return [];

  return fs
    .readdirSync(BLOCKS_DIR, { withFileTypes: true })
    .filter((d) => d.isDirectory())
    .map((d) => path.join(BLOCKS_DIR, d.name))
    .filter((dir) => fs.existsSync(path.join(dir, "package.json")));
}

// Read CLI args
const { cmd, name } = parseArgs(process.argv);

// Find all packages
const all = listBlockPackages();

// If no packages exist, don't treat it as an error. Just exit.
if (all.length === 0) {
  console.log("No block packages found at assets/blocks/*/package.json");
  process.exit(0);
}

/**
 * Decide which packages we are targeting.
 *
 * - If --name was provided, we build only that folder.
 * - Otherwise, we build everything found.
 */
const targets = name ? all.filter((dir) => path.basename(dir) === name) : all;

// If user asked for a specific block but we didn't find it, that should error.
if (name && targets.length === 0) {
  console.error(`Block "${name}" not found under assets/blocks/.`);
  console.error("Available blocks:");
  for (const dir of all) console.error(`  - ${path.basename(dir)}`);
  process.exit(1);
}

/**
 * Convert our high-level command into actual npm arguments.
 *
 * - build    => npm run build
 * - start    => npm run start
 * - install  => npm install
 * - ci       => npm ci  (useful for CI pipelines)
 *
 * We keep this mapping explicit so it’s easy to read and extend.
 */
const npmArgs =
  cmd === "install"
    ? ["install"]
    : cmd === "ci"
      ? ["ci"]
      : cmd === "start"
        ? ["run", "start"]
        : ["run", "build"]; // default

// Friendly output so you know what it is about to do
console.log(`\nBlocks targets: ${targets.length}/${all.length}`);
console.log(`Command: npm ${npmArgs.join(" ")}\n`);

/**
 * Run the command for each target package.
 *
 * Important behavior:
 * - We stop immediately on first failure (exit with that error code).
 * - This keeps CI reliable and prevents partial builds that cause confusion.
 */
for (const dir of targets) {
  const blockName = path.basename(dir);
  console.log(`— ${blockName}`);

  const code = runNpm(dir, npmArgs);

  // If the build failed, stop the entire script.
  if (code !== 0) {
    console.error(`\nFailed: ${blockName}`);
    process.exit(code);
  }
}

console.log("\nDone.\n");

/**
 * How to extend this script (common upgrades):
 *
 * 1) Skip folders that start with "_" (private/disabled packages):
 *      .filter((d) => !path.basename(d).startsWith("_"))
 *
 * 2) Only build packages that changed (advanced):
 *    - Use git diff to detect changed folders and filter targets.
 *
 * 3) Parallel builds (advanced):
 *    - Use spawn (async) and a concurrency limit.
 *    - BUT be careful: parallel builds can overload CPU and interleave logs.
 */
