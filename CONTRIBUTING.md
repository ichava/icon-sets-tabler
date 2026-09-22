# Contributing to Tabler Icons

This package is a thin Ichava-ecosystem layer; the contribution process,
coding standards, branch conventions, and review workflow are shared with
the core package.

→ See **[ichava/core CONTRIBUTING.md](https://github.com/ichava/core/blob/main/CONTRIBUTING.md)** for the full guide.

## Package-specific notes

- Tests run with `vendor/bin/pest`. The CI matrix covers PHP 8.3 / 8.4 ×
  Laravel 10 / 12 / 13.
- Style: PSR-12, `declare(strict_types=1);` at the top of every PHP file.
- Conventional Commits (`feat:`, `fix:`, `docs:`, `refactor:`, `perf:`, `test:`).
- Class short names follow the ecosystem convention: `IconsServiceProvider`,
  `IconsConstants`, `Variant` / `Category`, `IconComponent`, disambiguated
  by namespace.

## Reporting issues

Use the [issue tracker](https://github.com/ichava/icon-sets-tabler/issues).
Security issues go to **security@simtabi.com** privately, not the issue tracker.
