# Changelog

All notable changes to `ichava/icon-sets-tabler` follow [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) and [Semantic Versioning](https://semver.org/).

## [Unreleased]

### Changed

- **`.editorconfig` covers JSON.** The `[*.{yml,yaml}]` section is now
  `[*.{yml,yaml,json,jsonc}]`, matching the other three packs. This is the one
  piece of scaffolding drift that ran the other way: here the convergence work
  found this pack behind, not ahead.

- **`phpunit.xml.dist` sets the test environment explicitly.** The `<php>`
  block pinning `APP_ENV`, `DB_CONNECTION` and `CACHE_DRIVER` was missing, so
  the suite inherited whatever the ambient environment held.

- **The markdown path filter now matches markdown at any depth.**
  `code-quality.yml` and `tests.yml` carried `paths-ignore: '*.md'`. In GitHub's
  filter syntax a single `*` does not cross a `/`, so that pattern matched a
  root-level `README.md` and nothing else -- every edit under `docs/` ran the
  full PHP suite and the static-analysis job, which is precisely what the filter
  existed to skip. `'**.md'` matches at any depth.

  Worth stating which direction this failed in, because it decides how urgent it
  was: a broken `paths-ignore` runs **more** than it should, never less. The cost
  was CI minutes on a free-plan allowance, not a gate that stopped firing.

### Added

- **A test pins `metadata.homepage`.** The value here was already correct; the
  guard exists because it was wrong in two of the five packs and nothing in the
  estate would have caught it.

  The rule it asserts: `metadata.homepage` is the **upstream project's** own
  site, never one of ours. `metadata.repository` is this package's repository
  and `composer.json`'s `homepage` is its landing page, so a `homepage` under
  `github.com/ichava/` makes two fields ship the same link under different
  names. It is asserted twice -- once against the exact URL, once against the
  general rule that it never contains `github.com/ichava/` -- so the guard
  survives an upstream rename.

  It drifted unnoticed because nothing renders it. `IconRegistry` reads it into
  the pack descriptor and the browser API allows it through `publicMetadata()`,
  but no frontend consumes it, so a wrong value is invisible until somebody
  reads the JSON.

## [0.3.2] - 2026-09-21

### Fixed

- **Every documentation page carried the index breadcrumb twice.**
  `[← Docs index](../README.md#documentation)` sat on line 1 as well as in its correct position
  under the closing `---`, on all 3 pages this pack ships (`attribution.md`, `customization.md`, `variants.md`). The stray copy is deleted
  and the footer is untouched.

  It shipped in `v0.3.1`. The pass that introduced it added a footer to pages that already had a
  conforming one, so the defect is **duplication, and the fix is deletion** -- the first report
  described it as a misplacement needing reversal, which would have produced two footers instead
  of two headers.

  Measured across the estate rather than from the pull requests that caused it: **16 pages over
  the five packs, which is every markdown page in `docs/` in all five.** A count taken from those
  originating diffs said 11, and a second count taken with a shell loop that defaulted a failed
  API read to zero said fewer still -- an empty response and a clean page are not the same thing,
  and only one of them is true.

## [0.3.1] - 2026-09-21

### Changed

- **`ichava/core` `^0.4` is accepted.** The constraint read `^0.2.8 || ^0.3`, and a caret on a
  `0.x` version pins the *minor*, so `0.4.0` did not satisfy it at all. An application that wanted
  core `0.4` could not install this pack beside it, and Composer reported that as a conflict on
  `ichava/core` rather than on the pack that was holding it back.

  The branch is **added, not substituted**. `^0.2.8` and `^0.3` keep resolving, because nothing
  here calls an API that `0.4` introduced, so raising the floor would strand 0.2 and 0.3 consumers
  for no gain.

### Fixed

- **`branch-alias` names the series `main` is on, not the one before it.**
  `dev-main` was aliased to `0.2.x-dev` while this package has been on the 0.3
  series since `v0.3.0`. The alias is what a path or VCS consumer sees when it
  tracks `dev-main`, so `0.2.x-dev` fails a `^0.3` constraint outright and
  Composer reports it as a conflict on this package rather than as a stale
  alias.

  Measured: `0.2.9999999.9999999-dev` does not satisfy `^0.3` or
  `^0.3 || ^0.4`; `0.3.9999999.9999999-dev` satisfies both. `demos/ichava-app`
  does not catch this because it requires every package at `*@dev`, which
  matches either alias -- the integration check is structurally blind to it.

- **The README's link label named the old central docs repo.** The URL was already correct and
  points at the hosted `maintainer-toolkit` page, while the text beside it still read
  `ichava/documentation/icon-pack-upstream-tracking.md`. The label now names the page the link
  opens.

  **No link checker sees this class.** The label is a code span, not a target, so the link
  resolves and the text next to it is wrong — `lychee` and every `](...)` sweep pass it. Found
  by grepping for `` `…documentation/….md` `` rather than for links, after the estate-wide link
  scan came back at zero.

## [0.3.0] - 2026-09-21

### Changed

- **Renamed to `ichava/icon-sets-tabler`.** The composer package, the GitHub repository and the local
  directory now all read `icon-sets-tabler`, restoring the one-name rule the ecosystem relies on.

  **Breaking, and that is why the minor moves.** A `0.x` caret pins the minor, so `^0.2` will
  not resolve to `0.3.0` -- consumers move deliberately rather than by accident.

  | Surface | Was | Now |
  |---|---|---|
  | Composer package | `ichava/icon-sets-tabler` | `ichava/icon-sets-tabler` |
  | PHP namespace | `Simtabi\Laranail\Ichava\IconSetsTabler` | `Simtabi\Laranail\Ichava\IconSetsTabler` |
  | Config file and key | `config/tabler-icons.php` | `config/icon-sets-tabler.php` |

  The config **filename** must match the package short name or the key silently doubles and
  every `config()` read returns `null` -- the `V39` defect that once left an entire shipped
  config inert.

  **Upstream references are deliberately untouched.** The vendor this pack tracks shares the
  token with our old name; a blanket rename would have aimed the update checker at a package
  that does not exist and broken the CDN templates, failing in a host app rather than in CI.

## [0.2.6] - 2026-09-21

### Changed

- **`resources/lang/en/en.php` is now `resources/lang/en/icons.php`.** The old
  path made the translation group `en`, so every key read
  `<namespace>::en.name` with the locale doubled. Renaming now is free; renaming
  after something reads these keys would not be.

- **`name` and `description` dropped from the `en` file.**
  `IconRegistry::fromDirectory()` reads both from
  `resources/assets/svg/config.json`, which is canonical, and the copy here had
  already drifted from it: the lang file said *"Over 5,000 pixel-perfect SVG
  icons for web projects"* while `config.json` says *"Over 5,200 pixel-perfect
  icons for web apps"*. Nothing noticed, because nothing loads this file. A
  non-English locale may still override them.

### Added

- `variant_descriptions`, so the two variants carry an explanation rather than
  just a label.
- `tests/Unit/ResourceShapeTest.php`, pinning the canonical resource shape. Its
  variant assertion compares the lang keys against the `Variant` enum, which is
  what makes a file copied from another pack fail instead of shipping silently
  -- `bundled-icons` shipped metronic's translation file for exactly that reason.

  > Nothing loads these translations yet. No pack calls `hasTranslations()`.

### Added

- **`actionlint` runs on every pull request.** Nothing validated the workflow files at all:
  `release.yml` triggers only on `push: tags`, so a broken workflow was first observed as a
  release that refused to start — after the decision to release had been made.

  A YAML parse is not a substitute, and that is the sharp part. `yaml.safe_load` accepts a
  duplicate key and silently keeps the last one, so a double-applied patch that left
  `continue-on-error:` twice on a single step validated clean and would have failed only at tag
  time. `actionlint` rejects what Actions rejects.

  Checked against the defect rather than assumed: injecting that duplicate key, a typo'd step
  key, and an `if:` referencing a property that does not exist are all caught, while
  `yaml.safe_load` still parses the first of them without complaint.

### Fixed

- **A failed SBOM download no longer takes the whole release down.** `release.yml` generates the
  SBOM before it publishes, and the Syft installer fetches its checksums from GitHub's
  release-asset CDN. On 2026-09-21 that answered `504` for about twenty minutes, failing the job
  four times *before* the publish step — so the tag existed with no release behind it, which is
  the drift the release table exists to catch, produced by the release machinery itself.

  Two changes. The step now retries once after 45 seconds, which covers a single transient `504`
  — the common case. And a second failure no longer fails the job: the release publishes without
  the asset and emits a `::warning::` naming the re-run.

  **The two failure states are not equally bad, and that asymmetry is the whole design.** A
  release missing an attachment is repaired by re-running this workflow, which re-attaches it. A
  tag with no release persists silently until a person notices. Preferring the recoverable one
  is worth the loss of "every release always carries an SBOM" as an absolute.

  `fail_on_unmatched_files: false` is now stated on the publish step. It is already the action's
  default, but the point of this change is that a missing SBOM must not fail the publish, so it
  should not rest on a default a future reader has to know.

### Security

- **Floor raised to `ichava/core: ^0.2.8`.** Core `0.2.8` fixes two issues a pack inherits
  through the engine: `%` and `_` in a search query acted as `LIKE` wildcards, widening results
  and forcing full-table scans; and the icon watcher followed symlinks and read files of
  unbounded size, so a link inside a watched directory pointed the reader anywhere on disk.

  `^0.2.5` still permitted resolving to `0.2.5`, `0.2.6` or `0.2.7`, all of which carry both.
  The `|| ^0.3` arm is unchanged — core `0.3.0` moved the scaffolder out but left the engine,
  registry, seeder and SVG pipeline untouched, so an installed pack is unaffected by it.

## [0.2.5] - 2026-09-21

### Changed

- **`ichava/core` widened to `^0.2.5 || ^0.3`.** Core `0.3.0` removes the icon-package
  scaffolder and its stub tree, which moved to `ichava/icon-package-scaffolder`. This package
  never used either, so it works unchanged on both series.

  Widened rather than raised on purpose. A caret on a `0.x` version pins the minor, so plain
  `^0.2.5` cannot resolve `0.3.0` and this package would have held every consumer back on the
  0.2 series for a removal that does not affect it. Raising it to `^0.3` instead would have
  forced a core upgrade on anyone deliberately staying on 0.2.x, for the same non-reason.
  Both series genuinely work, so the constraint says so.

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

- Icon examples now use variant-prefixed paths (`outline/home`, `filled/home`). Bare `ichava/icon-sets-tabler::home` does not resolve.

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
