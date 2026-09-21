[← Package README](../README.md#pack-specific-docs)

# Variants

*Reference.*

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
- [Icon path format](https://github.com/ichava/documentation/blob/main/core/icon-path-format.md)
