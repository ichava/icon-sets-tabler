# Tabler Icons for Laravel

[![Latest Version](https://img.shields.io/packagist/v/ichava/icon-sets-tabler.svg)](https://packagist.org/packages/ichava/icon-sets-tabler)
[![License](https://img.shields.io/packagist/l/ichava/icon-sets-tabler.svg)](LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/ichava/icon-sets-tabler.svg)](https://packagist.org/packages/ichava/icon-sets-tabler)

6,184 free MIT-licensed SVG icons from [Tabler Icons](https://tabler-icons.io) packaged for the [Ichava ecosystem](https://github.com/ichava/documentation). Outline + filled variants. Customisable stroke widths. Auto-updatable from upstream.

> Built on [`ichava/core`](https://github.com/ichava/core). See the [main documentation](https://github.com/ichava/documentation) for everything that applies to all icon packs.

## Install

```bash
composer require ichava/icon-sets-tabler
```

The provider auto-registers via Laravel package discovery. Seed the icon database:

```bash
php artisan ichava::ichava-core.database seed --package=ichava/icon-sets-tabler
```

For the visual icon browser, also install [`ichava/browser`](https://github.com/ichava/browser).

## Quick example

Blade component:

```blade
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" class="w-6 h-6" />
<x-ichava::icon name="ichava/icon-sets-tabler::filled/heart" class="w-6 h-6 text-red-500" />
```

Fluent helper:

```blade
{{ ichava('ichava/icon-sets-tabler::outline/home')->color('#4338ca')->class('w-6 h-6') }}
```

Custom stroke width (outline variant only):

```blade
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" stroke-width="1.5" class="w-6 h-6" />
```

## Pack-specific docs

Vendor-specific deep dives live in this repo under [`docs/`](docs/). Anything that applies to *every* Ichava icon pack lives in the [main documentation repo](https://github.com/ichava/documentation/blob/main/README.md#icon-packs).

- [Variants](docs/variants.md), outline + filled
- [Customisation](docs/customization.md), stroke width, currentColor, sizing
- [Attribution](docs/attribution.md), upstream Tabler credits + MIT terms

## Ecosystem docs

For things that apply to every Ichava icon pack:

- [Icon path format](https://github.com/ichava/documentation/blob/main/core/icon-path-format.md)
- [Blade components](https://github.com/ichava/documentation/blob/main/core/blade-components.md)
- [Global helper](https://github.com/ichava/documentation/blob/main/core/global-helper.md)
- [Database seeding](https://github.com/ichava/documentation/blob/main/icon-packs/seeding-pack-icons.md)
- [Browser SPA](https://github.com/ichava/documentation/blob/main/browser/installation.md)

## What's included

- 6,184 icons across two variants
- **Outline** (`2px` stroke, transparent fill, `currentColor` stroke, `stroke-linecap="round"`, `stroke-linejoin="round"`)
- **Filled** (`currentColor` fill, no stroke)
- All SVGs 24×24 with `viewBox="0 0 24 24"`

Browse the full library at [tabler-icons.io](https://tabler-icons.io) or visually via the [`ichava/browser`](https://github.com/ichava/browser) SPA.

## CDN endpoints (skip vendoring entirely)

If you'd rather not ship the ~5MB of bundled SVGs inside your composer install,
serve them from a CDN. The pack registers its CDN URL templates in
`config.json` so other tooling can read them too; the canonical templates are:

```
https://cdn.jsdelivr.net/npm/@tabler/icons@{version}/icons/{variant}/{name}.svg
https://unpkg.com/@tabler/icons@{version}/icons/{variant}/{name}.svg
https://raw.githubusercontent.com/tabler/tabler-icons/v{version}/icons/{variant}/{name}.svg
```

- `{variant}` is `outline` or `filled`
- `{name}` is the canonical icon slug (e.g. `home`, `arrow-right`)

## Upstream tracking

This pack participates in Ichava's upstream-tracking system. Run

```bash
php artisan ichava::ichava-core.check-updates --package=ichava/icon-sets-tabler
```

to see whether a newer `@tabler/icons` release exists. The check hits
`registry.npmjs.org` (no rate limit), caches results for 12 hours, and
dispatches `IconPackUpdateAvailable` events the host app can route to
Slack / email / dashboards.

See [`ichava/documentation/icon-pack-upstream-tracking.md`](https://github.com/ichava/documentation/blob/main/icon-pack-upstream-tracking.md)
for the full schema + how to subscribe to update events.

## Requirements

- PHP 8.3+
- Laravel 13+
- [`ichava/core`](https://github.com/ichava/core) `^1.0`

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md).

## Security

Email `security@simtabi.com` privately. See [SECURITY.md](SECURITY.md).

## License

This project is licensed under the MIT License.  

© Simtabi LLC

The bundled Tabler icon SVGs are MIT-licensed upstream; see [`docs/attribution.md`](docs/attribution.md) for upstream credits.
