# Changelog

All notable changes to `ichava/tabler-icons` follow [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) and [Semantic Versioning](https://semver.org/).

## [0.2.4] - 2026-09-21

### Security

- **Floor raised to `ichava/core: ^0.2.5`.** Core `0.2.5` closes an address-notation gap in the
  pack update-check guard: `isPublicIp()` judged addresses by how they were written, so
  `::7f00:1` and `::a9fe:a9fe` — IPv4-compatible IPv6 spellings of `127.0.0.1` and of the
  `169.254.169.254` cloud-metadata address — were accepted while the same addresses in dotted
  form were refused. `^0.2.4` still permitted resolving to `0.2.4`, which has it.

  Weaker than the containment fixes in `0.2.4`: the notation was deprecated in 2006 and most
  stacks will not route it. The floor moves anyway, because a constraint that can resolve to a
  release with a known gap is the thing this rule exists to prevent.

## [0.2.3] - 2026-09-21

### Security

- **Floor raised to `ichava/core: ^0.2.4`.** Core `0.2.4` carries seven security fixes — post-
  sanitizer attribute gating, icon-path containment, off-document paint URLs, sanitizer policy
  flag enforcement, SVG driver containment, debug path leakage and pack update-check URL
  restriction. `^0.2.3` still permitted resolving to `0.2.3`, which has all seven. Raising a
  floor to exclude a known-broken release is not a pin; the constraint stays a range.

## [0.2.2] - 2026-09-16

### Changed

- **Requires `ichava/core: ^0.2.3`.** `0.2.2` decided readiness against columns the schema has
  never had, so `ichava::ichava-core.info status` reported `UNINITIALIZED` on a fully seeded
  database and both auto-seed listeners, which gate on the same check, never fired. The floor is
  raised rather than the range widened; it still tracks every `0.2.x` from `0.2.3` on.

## [0.2.1] - 2026-09-16

### Changed

- **Requires `ichava/core: ^0.2.2`.** The floor is raised rather than the range widened: `0.2.0`
  invoked six of its own Artisan commands by names it had just retired, and `0.2.1` still passed
  `migrate` a `--path` that resolved nowhere, so `database migrate` reported success and created
  no tables. `^0.2` admitted both. Raising a floor to exclude a known-broken release is not a
  pin — the range still tracks every `0.2.x` from `0.2.2` on.

## [0.2.0] - 2026-09-16

### Breaking

- **Requires `ichava/core: ^0.2`.** Core `0.2.0` moved its config key to `ichava.ichava-core.*`
  and renamed every Artisan command with no bare aliases, so a host application upgrading this
  package has to upgrade core with it.

### Added

- `release.yml` — a `v*.*.*` tag now publishes a release whose body is that version's CHANGELOG
  section, and fails closed when the tagged version has no section.
- PHPStan static analysis (level 0) with `composer analyse` and a code-quality CI workflow.

### Changed

- Third-party GitHub Actions pinned to the commit SHA of their latest release; `actions/*` keep
  floating on a major tag. A tag is mutable, so `@v4` is a promise the action's owner can
  rewrite; pinning GitHub's own actions inside GitHub's own runner buys nothing.
- The test harness reads `DB_CONNECTION`, so the suite targets SQLite, PostgreSQL, MySQL or
  MariaDB. SQLite runs enable `foreign_key_constraints`, which Laravel applies only when the key
  is present.
- Hardened CI workflows: concurrency groups, job timeouts, problem matchers, docs-only skip paths, test coverage, and tidy composer scripts.
- Aligned Pest to `^4.6 || ^5.0`, PHPUnit strict flags, and CI branch triggers on `main` only.
- Install command requires only the pack. `ichava/core` installs as a dependency.

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
