# ichava/icon-sets-tabler

[![Packagist](https://img.shields.io/packagist/v/ichava/icon-sets-tabler)](https://packagist.org/packages/ichava/icon-sets-tabler)
[![Tests](https://github.com/ichava/icon-sets-tabler/actions/workflows/tests.yml/badge.svg)](https://github.com/ichava/icon-sets-tabler/actions/workflows/tests.yml)
[![Static analysis](https://github.com/ichava/icon-sets-tabler/actions/workflows/code-quality.yml/badge.svg)](https://github.com/ichava/icon-sets-tabler/actions/workflows/code-quality.yml)
[![License MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

> Tabler icons for the Ichava Laravel icon ecosystem: 6,238 SVGs across `outline` (5,184) and `filled` (1,054), vendored from `@tabler/icons`.

Requires [`ichava/core`](https://opensource.simtabi.com/documentation/ichava/core/) `^0.1` on PHP `^8.4.1 || ^8.5` and Laravel `^13`.

## Install

`ichava/core` and this pack come from Packagist. The `laranail/*` packages core depends on are not on Packagist yet, so the **application's** `composer.json` names them:

```json
{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/laranail/package-tools" },
        { "type": "vcs", "url": "https://github.com/laranail/console" },
        { "type": "vcs", "url": "https://github.com/laranail/enumerator" },
        { "type": "vcs", "url": "https://github.com/laranail/db-tools" }
    ]
}
```

Then require the pack:

```bash
composer require ichava/icon-sets-tabler
```

The service provider is discovered automatically. Core's [installation guide](https://opensource.simtabi.com/documentation/ichava/core/installation) covers core's own setup.

## Quick start guide and usage

### Getting started

Seed the pack once after installing it, and again after upgrading it:

```bash
php artisan ichava::ichava-core.database seed --package=ichava/icon-sets-tabler
```

The seed is not optional: until it runs the registry holds no rows for this pack and every lookup returns nothing. No configuration is needed; the defaults are merged without publishing anything.

### Usage

Icons are addressed as `ichava/icon-sets-tabler::<variant>/<name>`. In Blade, through core's component:

```blade
<x-ichava::icon name="ichava/icon-sets-tabler::outline/home" class="w-6 h-6" />
```

Or from PHP, through core's helper:

```blade
{{ ichava('ichava/icon-sets-tabler::filled/heart')->class('w-5 h-5 text-red-600') }}
```

See [Getting started](docs/getting-started.md) for the full walkthrough, and the [Documentation](#documentation) index below for everything else.

## <a name="documentation"></a>Documentation

Full documentation is at **[opensource.simtabi.com/documentation/ichava/icon-sets-tabler](https://opensource.simtabi.com/documentation/ichava/icon-sets-tabler/)**.

### This pack

- [Installation](docs/installation.md) — requirements, the repositories block, seeding
- [Getting started](docs/getting-started.md) — your first icon from this pack
- [Configuration](docs/configuration.md) — this pack's config key, and what is core's instead
- [Architecture](docs/architecture.md) — what it ships, what it delegates, and why
- [Release](docs/release.md) — how a version is cut, and when the core floor moves
- [Variants](docs/variants.md) — the two variants, the `Variant` enum, and when to reach for which
- [Customisation](docs/customization.md) — sizing, colour, and stroke width
- [Attribution](docs/attribution.md) — upstream project, licence terms, and where the vendored version is recorded

### Shared across every pack

- [Use an icon pack](https://opensource.simtabi.com/documentation/ichava/core/recipes/use-an-icon-pack) — addressing icons, in Blade and in PHP
- [Seed pack icons](https://opensource.simtabi.com/documentation/ichava/core/recipes/seed-pack-icons) — the seeding pipeline and its options
- [Check pack updates](https://opensource.simtabi.com/documentation/ichava/core/recipes/check-pack-updates) — the update checker and what its statuses mean
- [Serve icons from a CDN](https://opensource.simtabi.com/documentation/ichava/core/recipes/serve-icons-from-a-cdn) — reading this pack's CDN templates out of `config.json`

Its upstream is `@tabler/icons`; run core's [check pack updates](https://opensource.simtabi.com/documentation/ichava/core/recipes/check-pack-updates) recipe to see whether a newer release exists.

## Contributing & security

See [CONTRIBUTING.md](CONTRIBUTING.md). Report vulnerabilities privately through [security policy](https://github.com/ichava/icon-sets-tabler/security/policy) — never in a public issue.

## License

The package code is MIT, © Simtabi LLC. See [LICENSE](LICENSE).

The icons are [Tabler Icons](https://tabler-icons.io), © Paweł Kuna, under their own MIT licence. Simtabi LLC claims no authorship of them. Their notice is in [ATTRIBUTION.md](ATTRIBUTION.md), which ships with the package and must accompany any copy of the icons.
