# Changelog

All notable changes to `ichava/tabler-icons` follow [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) and [Semantic Versioning](https://semver.org/).

## [0.2.0] - Unreleased

### Added

- PHPStan static analysis (level 0) with `composer analyse` and a code-quality CI workflow.

### Changed

- Hardened CI workflows: concurrency groups, job timeouts, problem matchers, docs-only skip paths, test coverage, and tidy composer scripts.
- Aligned Pest to `^4.6 || ^5.0`, PHPUnit strict flags, and CI branch triggers on `main` only.

### Fixed

- Icon examples now use variant-prefixed paths (`outline/home`, `filled/home`). Bare `ichava/tabler-icons::home` does not resolve.

## [0.1.0] - 2026-08-31

First open-source release. An icon pack for the Ichava ecosystem: **6,146 SVGs**, registered with
`IconRegistry` at boot and served through `ichava/core`. Outline and filled variants, customisable stroke width. Upstream: Tabler Icons (MIT).

The pack depends on `ichava/core` and never on `ichava/browser`; the browser discovers installed
packs at runtime. Categories are `outline`, `filled`.

Earlier tags existed on GitHub and were never published to Packagist. They are withdrawn: the
ecosystem restarts from a single `0.1.0` across every package.

### Added

- `IconsServiceProvider`, auto-discovered through `extra.laravel.providers`.
- `IconsConstants` reading the pack's `config.json`, and a type-safe enum implementing
  `IconSetVariantInterface`.
- An `IconComponent` extending core's base component, so `<x-ichava::icon>` resolves this pack's
  paths in both the `vendor/package::category/name` and dot forms.

### Fixed

- **`ichava/core` is pinned to a single line.** The constraint was `^1.0 || ^2.0` while
  `ichava/browser` required `^2.0`, so a resolver could legally pair core 1.x with a browser
  assuming 2.x. It is now `^0.1`, matching the rest of the ecosystem.
- **The package declares VCS repository entries for `ichava/core` and all three `laranail/*`
  dependencies.** None is published on Packagist, and Composer reads `repositories` only from the
  root package, so a pack installed as the root could not locate them at all.

### Requirements

- PHP `^8.4.1 || ^8.5`, `illuminate/support` `^13.0`, `ichava/core` `^0.1`,
  `laranail/package-tools` `^0.1.0`.
