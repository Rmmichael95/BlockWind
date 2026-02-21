
# BlockWind

**BlockWind** is a modern WordPress block theme built for predictable layout composition, strict token-driven design, and scalable multi-site development.

It treats WordPress as a **design system platform**, not just a theme runtime.

---

## ✨ Key Highlights

- 🎨 **theme.json-first design system**
- 🧱 **Sections-first layout model**
- 📐 Predictable spacing via **flow tokens**
- 🧩 Pattern primitives for rapid page building
- ♿ Stable, accessible core block behavior
- ⚡ Unified build pipeline (Vite + block packages + ACF)
- 🧭 Navigation baseline focused on correctness before styling

---

## 🎯 Project Goals

BlockWind exists to solve common block theme problems:

- Layout spacing conflicts between templates and patterns  
- Inconsistent responsive behavior across sites  
- Token duplication between CSS, SCSS, and theme.json  
- Over-reliance on global CSS overrides  
- Fragile navigation behavior in responsive menus  

### BlockWind’s answer

- **theme.json is the single source of truth**
- Layout is composed from **predictable section primitives**
- Tokens are semantic and portable across projects
- Core block behavior is stabilized before styling layers
- Runtime CSS remains minimal and intentional

---

## 🧱 Layout Philosophy

BlockWind uses a **sections-first composition model**.

```
Flow Tokens → Section Patterns → Template Parts → Page
```

### Core rules

- Templates are structural and neutral  
- Patterns own gutters and spacing  
- Template parts behave like persistent sections  
- Flow tokens define layout rhythm  

### Section primitives

- **Cover Flow** → full-bleed media with inner gutters  
- **Group Flow** → generic section band  
- **Canvas Flow** → neutral starting section  

---

## 🎨 Design System

BlockWind follows a strict token hierarchy:

1. `theme.json` presets + custom tokens  
2. WordPress block supports  
3. `.bw-*` compiled modules (token consumers only)  
4. SCSS for structural or component styling  

This ensures tokens never drift across layers.

---

## 🧭 Navigation Philosophy

Navigation is treated as a **behavioral baseline**, not a styling problem.

### Guarantees

- Stable modal layout (no horizontal shift)  
- Constant chevron icon sizing  
- Toggle hit area ergonomics  
- No wrapper assumptions  
- Token-driven sizing and spacing  

This allows optional styling layers without breaking accessibility or layout.

---

## ⚙️ Build System

BlockWind uses a unified multi-pipeline build architecture:

### Theme bundle
- Source → `assets/src`
- Output → `assets/dist/theme.min.*`

### Custom block packages
- Location → `assets/blocks/*`
- Built via a lightweight Node runner

### ACF blocks
- Location → `acf-blocks/*`
- Compiled back into each block directory

```
npm run dev
npm run build
npm run build:blocks
npm run build:acf
npm run build:all
```

---

## 📚 Documentation

Full technical documentation lives in `/docs`:

- Layout system
- Navigation baseline
- Pattern authoring rules
- Token architecture
- Build system
- Diagrams and ownership models

---

## 🧠 Architectural Summary

| Layer | Responsibility |
|------|----------------|
| theme.json | Design tokens |
| Patterns | Layout composition |
| Templates | Structural scaffolding |
| Template Parts | Persistent layout sections |
| Navigation Base | Behavior correctness |
| Build System | Compile and isolate assets |

---

## 🚀 Intended Use

BlockWind is ideal for:

- Multi-client WordPress development
- Design-system-driven teams
- Agencies building reusable pattern libraries
- Projects requiring predictable responsive behavior
- Long-term maintainable block theme architectures

---

## 📄 License

GPL v2
