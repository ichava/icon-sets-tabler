# ichava/icon-sets-tabler

[![Tests](https://github.com/ichava/icon-sets-tabler/actions/workflows/tests.yml/badge.svg)](https://github.com/ichava/icon-sets-tabler/actions/workflows/tests.yml)
[![Code Quality](https://github.com/ichava/icon-sets-tabler/actions/workflows/code-quality.yml/badge.svg)](https://github.com/ichava/icon-sets-tabler/actions/workflows/code-quality.yml)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

> Tabler icons for the Ichava Laravel icon ecosystem — 6,184 SVGs across `outline` and `filled` variants, vendored from `@tabler/icons`.

This package is not published to Packagist, so there is no registry-version badge to show. Requires [`ichava/core`](https://opensource.simtabi.com/documentation/ichava/core/); targets PHP `^8.4.1 || ^8.5` on Laravel `^13`.

## Install

```bash
composer require ichava/icon-sets-tabler
php artisan ichava::ichava-core.database seed --package=ichava/icon-sets-tabler
```

The seed is not optional — until it runs the registry holds no rows for this pack and every lookup returns nothing. See core's [installation guide](https://opensource.simtabi.com/documentation/ichava/core/installation).

## <a name="documentation"></a>Documentation

Full documentation is at **[opensource.simtabi.com/documentation/ichava/icon-sets-tabler](https://opensource.simtabi.com/documentation/ichava/icon-sets-tabler/)**.

### This pack

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

See [CONTRIBUTING.md](CONTRIBUTING.md). Report vulnerabilities privately through [SECURITY.md](SECURITY.md) — never in a public issue.

## License

MIT. © Simtabi LLC. See [LICENSE](LICENSE).
