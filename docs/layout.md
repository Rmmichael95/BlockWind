
# Layout System

BlockWind uses a **sections-first composition model**.

## Layout ownership diagram

```mermaid
flowchart TD
    A[theme.json Flow Tokens] --> B[Patterns]
    B --> C[Template Parts]
    B --> D[Templates]

    D --> E[Page Structure]
    C --> E
    B --> E

    subgraph Pattern Structure
        P1[alignfull Band]
        P2[alignwide Wrapper]
        P3[Content Blocks]
        P1 --> P2 --> P3
    end
```

## Principles
- Templates are neutral
- Patterns own spacing and gutters
- Template parts behave like persistent sections
- Flow tokens drive layout rhythm
