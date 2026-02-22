# Template patterns

This directory contains **template archetype patterns** for WordPress block themes.

These patterns are intended to provide “template-level compositions” (page, single, index, archive, search, 404, sidebar variants) in a way that is:

- **Reusable across FSE/block themes**
- **Compatible with WordPress template architecture**
- **Consistent with BlockWind Phase 2 layout rules** (bw-flow scope + inner opt-in gutters)

## Intended usage

- Most patterns in this folder are **not meant for the inserter**.
  - They typically include `Inserter: false`.
- Many define `Template Types:` so they can be used as a template base or reference.

## Layout contract (BlockWind Phase 2)

- Normal templates: a flow scope on `<main>` and a single inner content container:
  - `bw-flow` on the `<main>` wrapper (scope + rhythm)
  - `bw-flow-content bw-flow-section` on the primary inner wrapper (gutters + vertical padding)
- Full-width/canvas templates: no root flow; sections/patterns apply flow as needed:
  - header/footer apply `bw-flow` scope, and inner wrappers apply gutters/padding

## Dependencies

Template patterns may reference patterns from:

- `patterns/query/` (query-loop grids/lists)
- `patterns/components/` (cards and small composable UI parts)

Keep “template archetypes” here and move “building blocks” to their respective folders.
