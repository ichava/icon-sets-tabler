[← Package README](../README.md#pack-specific-docs)

# Customisation

*How-to guide.*

Tabler icons inherit `currentColor`, so most styling happens through normal CSS. Pack-specific knobs are listed below.

## Colour

All Tabler icons use `currentColor` for stroke (outline) or fill (filled). Set the colour via Tailwind text utilities or inline style:

```blade
<x-ichava::icon name="ichava/icon-sets-tabler::outline/heart" class="w-6 h-6 text-red-500" />
<x-ichava::icon name="ichava/icon-sets-tabler::filled/heart" style="color: #ef4444" class="w-6 h-6" />
```

With the fluent helper:

```blade
{{ ichava('ichava/icon-sets-tabler::outline/heart')->color('#ef4444')->class('w-6 h-6') }}
```

## Stroke width (outline variant only)

The default outline stroke is 2 px. Override it per-icon:

```blade
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" stroke-width="1" class="w-6 h-6" />
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" stroke-width="1.5" class="w-6 h-6" />
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" stroke-width="2.5" class="w-6 h-6" />
```

Sane range: `1` to `3`. Below 1 the lines disappear at small sizes; above 3 corners distort.

## Size

The bundled SVGs are 24×24 with `viewBox="0 0 24 24"`. Use any width/height utility:

```blade
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" class="w-4 h-4" />     {{-- 16 px --}}
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" class="w-6 h-6" />     {{-- 24 px (native) --}}
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" class="w-12 h-12" />   {{-- 48 px --}}
```

Below ~14 px outline icons start to lose definition. Switch to filled for very small sizes (favicons, density-5 tables).

## Setting a default class globally

In `config/ichava/core.php`:

```php
'components' => [
    'enabled'       => true,
    'default_class' => 'w-5 h-5 text-gray-700', // applied to every <x-ichava::icon>
],
```

Per-component `class="..."` overrides the global default.

## Accessibility

Add `aria-label` for icons that carry meaning (no adjacent text label):

```blade
<x-ichava::icon name="ichava/icon-sets-tabler::outline/trash" aria-label="Delete" class="w-5 h-5" />
```

Decorative icons (next to a text label) can omit the label, the SPA renderer adds `aria-hidden="true"`.

## See also

- [Variants](variants.md)
- [Blade components](https://github.com/ichava/documentation/blob/main/core/blade-components.md)
- [Global helper](https://github.com/ichava/documentation/blob/main/core/global-helper.md)
