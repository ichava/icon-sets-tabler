# Variants

*Reference.*


`ichava/icon-sets-tabler` ships **6,184 icons across two variants**, relocated here from the README:

- **Outline** — `2px` stroke, transparent fill, `currentColor` stroke, `stroke-linecap="round"`, `stroke-linejoin="round"`
- **Filled** — `currentColor` fill, no stroke

Every SVG is 24×24 with `viewBox="0 0 24 24"`. Browse the full library at [tabler-icons.io](https://tabler-icons.io), or visually through the [`ichava/icon-browser`](https://opensource.simtabi.com/documentation/ichava/icon-browser/) SPA.
Tabler ships two variants. The Ichava integration treats them as separate icon "categories" under the same package, addressed by sub-path.

| Variant | Path prefix | Style |
|---|---|---|
| `outline` | `outline/<name>` | 2-px stroke, transparent fill, `currentColor` stroke, `stroke-linecap="round"`, `stroke-linejoin="round"` |
| `filled` | `filled/<name>` | `currentColor` fill, no stroke |

The default variant is `outline`. Always include the variant prefix in the icon path: `ichava/icon-sets-tabler::outline/home` for outline, `ichava/icon-sets-tabler::filled/home` for filled.

## Examples

```blade
{{-- Outline --}}
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" class="w-6 h-6" />

{{-- Filled --}}
<x-ichava::icon name="ichava/icon-sets-tabler::filled/home" class="w-6 h-6" />
<x-ichava::icon name="ichava/icon-sets-tabler::filled/heart" class="w-6 h-6 text-red-500" />
```

## Variant enum (PHP)

```php
use Simtabi\Laranail\Ichava\IconSetsTabler\Enums\Variant;

Variant::OUTLINE->value;            // 'outline'
Variant::FILLED->value;             // 'filled'
Variant::OUTLINE->isDefault();      // true
Variant::default();                 // Variant::OUTLINE
```

The enum implements `IconSetVariantInterface` from core, so it works wherever core's registry expects a variant.

## When to use which

- Use **outline** for navigation, controls, dense UI. Looks lighter, scales better at small sizes.
- Use **filled** for emphasis, status badges, brand moments. Reads more strongly at small sizes but heavier visually.

Many icons exist in both variants; not all do. Check the [Tabler website](https://tabler-icons.io) to confirm.

## See also

- [Customisation](customization.md), stroke width and colour
- [Icon path format](https://opensource.simtabi.com/documentation/ichava/core/tools/icon-path-format)

---

[← Docs index](../README.md#documentation)
