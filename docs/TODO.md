# TODO --- Flow Token Backlog

This file tracks **potential future `bw-flow` primitives** for
BlockWind.

The goal is to keep `bw-flow` minimal and meaningful: - `bw-flow` =
rhythm, gutters, spacing primitives\
- New tokens are added **only when reused in 3+ places**\
- Avoid duplicating component-level tweaks inside flow

------------------------------------------------------------------------

## Rhythm scale candidates

### ☐ `gap-xs`

Extra-tight rhythm for dense UI (meta rows, badges, icon+text pairs).

### ☐ `gap-xl`

Expanded rhythm for feature sections and hero compositions.

### ☐ `block-gap-tight`

Alias for tighter vertical rhythm in container variations.

### ☐ `block-gap-loose`

Alias for relaxed vertical rhythm in container variations.

------------------------------------------------------------------------

## Gutters & section spacing

### ☐ `content-padding-x-tight`

Smaller gutters for dense/mobile-first sections.

### ☐ `content-padding-x-wide`

Larger gutters for hero/marketing layouts.

### ☐ `section-padding-y-tight`

Reduced vertical spacing between stacked sections.

### ☐ `section-padding-y-loose`

Expanded vertical spacing for feature sections.

### ☐ `section-padding-y-hero`

Dedicated hero vertical spacing primitive.

------------------------------------------------------------------------

## Panel / container spacing

### ☐ `panel-padding-y`

Optional split of panel Y padding (currently inherited from
`stack-padding-y`).

### ☐ `panel-padding-x-tight`

Compact panel/card variation.

### ☐ `panel-padding-x-loose`

Feature panel/card variation.

### ☐ `panel-padding-y-tight`

Compact vertical card rhythm.

### ☐ `panel-padding-y-loose`

Relaxed vertical card rhythm.

------------------------------------------------------------------------

## Content rhythm primitives

### ☐ `content-stack-gap`

Separate prose rhythm from UI rhythm.

### ☐ `prose-spacing-y`

Paragraph/list spacing control for long-form content zones.

------------------------------------------------------------------------

## Grid & media spacing

### ☐ `grid-gap`

Dedicated grid rhythm (distinct from vertical stack gap).

### ☐ `grid-gap-tight`

Dense grid layouts.

### ☐ `grid-gap-loose`

Relaxed grid layouts.

### ☐ `media-gap`

Spacing for media/text pairs and icon+text patterns.

------------------------------------------------------------------------

## Divider / separator spacing

### ☐ `rule-margin-y`

Vertical spacing around separators and rules.

### ☐ `rule-thickness`

Optional thickness primitive (may belong in `bw-ui` or `bw-panel`
instead).

------------------------------------------------------------------------

## Interaction/control spacing (add only if standardized)

### ☐ `control-padding-x`

Inline control horizontal padding (buttons, pills, pagination, etc.).

### ☐ `control-padding-y`

Inline control vertical padding.

⚠️ Only introduce these if multiple inline controls share the same
padding scale.

------------------------------------------------------------------------

## Promotion rule (important)

A candidate moves from backlog → `bw-flow` when:

-   Used in **3+ contexts**
-   Represents a **sitewide rhythm concept**
-   Prevents repeated preset usage across components

If not, keep spacing local to the component namespace.
