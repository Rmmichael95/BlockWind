# Query patterns

This directory contains **query-loop patterns** used by templates and sections.

These are “loop building blocks” (grids, lists, paginated loops) that are typically embedded via:

```html
<!-- wp:pattern {"slug":"bw/post-loop-grid-default"} /-->
```

## Intended usage

- Usually `Inserter: false` (because templates embed them), but may be enabled if you want them user-insertable.
- Should avoid hard-coded page-level wrappers.
- Can reference component patterns from `patterns/components/` (e.g. post cards).

## BlockWind Phase 2

If a query pattern needs rhythm, it may use `bw-flow` for **scope/rhythm only**.
Gutters/padding should generally be handled by the **template’s inner content wrapper**
(`bw-flow-content bw-flow-section`) unless the query pattern is explicitly standalone.
