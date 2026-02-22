# Component patterns

This directory contains **component patterns**: small, composable chunks used by:

- query loops (post cards, item rows)
- sections (feature cards, CTA blocks)
- templates (occasionally)

## Intended usage

- Components should be **portable** and **not assume page-level layout**.
- Components may contain internal spacing (e.g., card padding/radius) using theme tokens.
- Components should not apply global gutters (that’s the job of templates/sections).

## BlockWind Phase 2

- Prefer token-driven spacing (theme.json custom properties / presets).
- Avoid outer padding that could interfere with full-bleed constructs.
