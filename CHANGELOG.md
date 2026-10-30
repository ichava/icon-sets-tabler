# Changelog

All notable changes to `ichava/icon-sets-tabler` follow [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) and [Semantic Versioning](https://semver.org/).

## [Unreleased]

### Added

- **The pack declares its SVG kind.** `config.json` sets `package.kind` to `icon`, the kind ichava/core resolves for every category that names none of its own (core reads it from ichava/core#148; an older core ignores the key). `tests/Feature/SvgKindTest.php` fails on a kind core would not recognise, on a category that resolves none, and, against a core that has `IconRegistry::kindFor()`, on any category core resolves differently. `RetiredCopiesTest` also pins a non-empty description for every label core loads.
- **`SiblingConstraintsTest` keeps every `ichava/*` constraint on the released line.** At release every ichava repository becomes one commit tagged `v0.1.0`, so 0.1.0 is the only version of any sibling. The test reads `require` and `require-dev` in `composer.json`, fails on any `ichava/*` constraint that 0.1.0 does not satisfy (checked with `composer/semver`, now a direct dev requirement), and fails when it finds no constraint to check.

### Changed

- **Every workflow runs on every pull request.** The `paths-ignore: '**.md'` and `paths:` filters are removed from the `pull_request` triggers, so every check reports on every pull request and can be a required status check on `main`. A path-filtered required check never reports on the pull requests it skips, and blocks them for good.
- **PHPStan analyses at level `max`, up from 0.** `phpstan.neon.dist` now has icon-sets-bundled's shape: one counted, path-scoped ignore for the two `HasIconSetVariants` hooks PHPStan reports as unused because the trait calls them through `static::`, with `reportUnmatchedIgnoredErrors` failing the run if either stops occurring. No baseline, and no source change was needed. `PhpstanLevelTest` reads the config and fails if the level is anything but `max` or a baseline appears.
- **`sync-upstream.yml` commits as the github-actions bot's noreply address** instead of a personal GitHub login, matching packs scaffolded since icon-sets-package-scaffolder#60 and icon-sets-sync's default. The personal-contact guard now also reads `.github/` and `.dev/`.
- **The package author is Simtabi LLC, not a person.** `composer.json` named a personal maintainer and mailbox as author; it now names `Simtabi LLC` with the role address `ichava@simtabi.com` (no personal contact is published, decided 2026-10-28). `NoPersonalContactTest` reads `composer.json`, `README.md`, `LICENSE`, `docs/` and `src/`, fails on a personal name or address, and fails when it reads fewer files than it did when written.
- **CI tests against `ichava/core`'s `main`.** Every job that installs dependencies first aliases core's `main` into the 0.1 line (`composer require "ichava/core:dev-main as 0.1.99" --no-update`), prints the commit it resolved, and restores `composer.json` after the install, so the committed constraint is unchanged and the tests read it. Against that core, `SvgKindTest`'s comparison with `IconRegistry::kindFor()` runs instead of skipping.

### Removed

- **The `commands` and `info` translation groups.** They were written for an update command and an about block this pack does not ship (core's about section reads the registry), and nothing loaded them. `tests/Feature/RetiredCopiesTest.php` keeps them out.
- **`config/icon-sets-tabler.php`, its `hasConfigFile()` registration and its publish tag.** The file held only `set.name` and `set.prefix`, copies of what core reads from `config.json` through `IconsConstants`, and nothing read them; with both gone it was empty, so it is deleted rather than kept. `ichava.icon-sets-tabler` is no longer set. `docs/configuration.md` and `docs/installation.md` say so.

## [0.1.1] - 2026-10-27

### Added

- **Releases are prepared by release-please.** A *Release Please* workflow reads the Conventional Commit log, keeps one release pull request open that bumps `.release-please-manifest.json`, and tags the release when that pull request merges; the tag starts `release.yml` as before. On 0.x a breaking change bumps the minor and everything else bumps the patch. The minor moves in lockstep with the other coupled ichava packages: a breaking change anywhere in the family reaches every coupled repository as a `Release-As: 0.N.0` footer, so `^0.N` means the same line everywhere. Release notes stay hand-written: release-please is set to `skip-changelog`, and the workflow closes this `[Unreleased]` section under the new version on the release branch, failing if it is empty. It runs on `workflow_dispatch`, a weekly schedule, and the merge of a release pull request, so the only `push` trigger is still the tag. The pull request and the tag are made with a per-run Refresh Bot token, because ones made with `GITHUB_TOKEN` start no workflows. `release.yml` gains a `workflow_dispatch` recovery path for a tag push that started nothing; its first step refuses any ref that is not a `vX.Y.Z` tag.

### Changed

- **`sync-upstream.yml`'s header describes what the workflow runs.** It said the image bundles Python and that a release ships to Packagist. The image is icon-sets-sync's Go binary with git, gh and Node, built from the toolkit's `main`, and a release is the GitHub release that release-please and `release.yml` make; nothing is published to Packagist. Comments only: the workflow runs the same steps.

### Fixed

- **The package says whose icons these are.** The SVGs are Tabler Icons, © 2020-2026 Paweł Kuna, MIT; the code around them is © Simtabi LLC, MIT. Nothing in the package that reaches a consumer said so: `docs/attribution.md` is export-ignored, and it also claimed the icons' licence "does not require attribution", when MIT's one condition is that its notice accompany every copy. A new root `ATTRIBUTION.md` carries the upstream notice verbatim (from `LICENSE` at `v3.49.0`) and says Simtabi LLC claims no authorship of the icons; the README's License section and `docs/attribution.md` point at it. `LICENSE` stays the plain MIT text for the code, so licence detection keeps reading MIT. `AttributionTest` fails if `ATTRIBUTION.md` is missing, export-ignored, or loses the upstream notice, if `LICENSE` gains a second copyright holder, or if the README stops pointing at it; each was seen failing.
- **`config.json` keeps up with releases.** Release-please now moves `resources/assets/svg/config.json`'s `package.version` with each release (`extra-files`), so the version the icon registry reports stays equal to the released one. Before this it stayed at the value it had when release-please was added. `ReleaseVersionTest` fails if `package.version` differs from `.release-please-manifest.json`, if the `extra-files` entry goes missing, or if the branch alias and the `ichava/core` constraint stop naming the same minor, or drift more than one minor ahead of the released one.
- **The release pull request is found in the same run that opens it.** The step that hands the release branch to the changelog close asked `gh pr list --label 'autorelease: pending'`, which goes through GitHub's search index; on the first live run (js-motion#30) the index had not caught up with the pull request opened seconds earlier, so the close was skipped and a second dispatch was needed. It now takes the branch from release-please's own `pr` output, and only when the action reports nothing (the pull request was already current) falls back to the open pull requests, matched by the `release-please--branches--main` prefix rather than the label.

## [0.1.0] - 2026-10-23

Versioning re-based to 0.1.0. This release contains everything previously tagged v0.1.0 through v0.3.4 (2026-08-31 to 2026-09-26) plus the changes below, and requires `ichava/core` `^0.1`, the re-based core. Those tags and their GitHub releases were removed; every commit they pointed at is on `main`, and their sections are kept under *Archived pre-reset history*.

### Changed

- **References follow the repository renames.** `ichava/maintainer-toolkit` is now `ichava/icon-sets-sync`, `ichava/motion` is `ichava/js-motion` and `ichava/react-browser` is `ichava/react-icon-browser`. GitHub redirects the old names, but redirects are not permanent.
- **The sync workflow's verification step can run the suite.** It called `composer update` on
  the bare runner, with no `setup-php` and no `COMPOSER_AUTH`, so Composer could not
  authenticate against github.com for the `vcs` repositories and every verification reported
  failure without running a test. It now sets up PHP 8.5 and passes the workflow token.
- **Seeded icons now carry their variant.** This pack has always declared `outline`
  and `filled` in `config.json`, but `ichava/core` attached categories only, so
  every seeded icon came back with a null variant and the browser's variant
  filter was empty. Core's seeder now attaches variants from the first
  directory after `files/`, so `files/outline/ad-circle.svg` seeds with the
  `outline` variant and addresses as `ichava/icon-sets-tabler::outline/ad-circle`.
  No code in this package changed; this records the effect a consumer sees once
  they are on a core that does it. Existing rows keep their null variant until
  the affected icons are re-seeded.

- **`composer.json` lists `laranail/db-tools` as a VCS repository.** `ichava/core` is about to
  require it, and Composer reads `repositories` from the root package only, so a
  consumer that does not declare it cannot resolve core at all. The entry is harmless
  until then. Nothing here is on Packagist.

## [Archived pre-reset history]

> Versioning was re-based to 0.1.0 on 2026-10-23. The tags and GitHub releases below were removed;
> every commit they pointed at is on `main`. Sections reproduced verbatim, one heading level down.

### [0.3.4] - 2026-09-26

#### Added

- **A test pins the `docs/` shape, and a workflow runs it on the changes that
  break it.** `tests/Unit/DocsShapeTest.php` asserts the five concern pages the
  authoring standard requires, this pack's own addressing page, that the README
  indexes every page and lists none that is absent, and that each page opens at
  its `# ` title and carries the index link **exactly once** as its footer.

  `docs.yml` exists because of the gap it sits in: `tests.yml` and
  `code-quality.yml` both carry `paths-ignore: ['**.md']`, so a markdown-only
  pull request runs neither -- and a markdown-only pull request is exactly what
  deletes a docs page. It triggers on `**.md`, the test itself and its own file,
  and nothing else.

  Two of its assertions exist to stop the guard passing vacuously: the page glob
  is asserted non-empty before the loop reads it, and the README's page list is
  asserted non-empty before it is cross-checked. A glob that matches nothing
  otherwise makes every assertion below it true over a directory it never read.

#### Changed

- **`SECURITY.md` removed; the organization policy serves this repository now.**
  The file was byte-identical across six ichava repositories and held nothing
  specific to any of them. It was promoted into `ichava/.github` first, so the
  policy improved before any copy was removed rather than after, and GitHub
  serves that default on `/security/policy` for every repository without its
  own. The two channels and the 48-hour acknowledgement are unchanged.

- **The README's security link moved with it.** A relative
  `[SECURITY.md](SECURITY.md)` is a path into this repository's file tree, and
  the cascade does not put a file there -- it answers the policy page and
  nothing else. Left alone the link would have become a 404 the moment the file
  went, so it now points at `/security/policy` directly. `composer.json` and the
  issue-template link already did.

### [0.3.3] - 2026-09-22

#### Added

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

#### Changed

- **The "Authenticate Composer for private GitHub deps" step is gone.** It
  configured a `GH_PACKAGES_PAT` against `github-oauth.github.com` because
  `ichava/core` and `laranail/package-tools` were private. **Both are public
  now**, and so is every other dependency this pack resolves, so the step
  authenticated nothing.

  It was already dead rather than merely redundant, and the estate proved it:
  `icon-sets-emoji`'s `tests.yml` carries no such step and has been resolving
  `ichava/core` from a VCS repository on every CI run, green. Removing it is
  therefore not a gamble on rate limits -- it is matching the configuration
  that already works.

- **CI no longer builds coverage.** `setup-php` installed `pcov` and the suite
  ran `vendor/bin/pest --coverage`, but **nothing consumed the result** -- there
  is no `--min=` threshold, no Codecov upload and no artifact. Only `ichava/core`
  gates on coverage, at 80%.

  So this was an extension install and a slower run on every matrix cell, for a
  number nobody read. `coverage: none`, `vendor/bin/pest`. Two of the five packs
  were doing this; the other three already were not.

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

- **Dead links to the deleted `ichava/documentation` repository removed.** That repository no
  longer exists, so every cross-reference to it resolved to a 404. The reporting channels in
  `SECURITY.md` were already stated inline and are unchanged; the Code of Conduct now cites the
  Contributor Covenant directly. Historical mentions in this changelog are left as written.

### [0.3.2] - 2026-09-21

#### Fixed

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

### [0.3.1] - 2026-09-21

#### Changed

- **`ichava/core` `^0.4` is accepted.** The constraint read `^0.2.8 || ^0.3`, and a caret on a
  `0.x` version pins the *minor*, so `0.4.0` did not satisfy it at all. An application that wanted
  core `0.4` could not install this pack beside it, and Composer reported that as a conflict on
  `ichava/core` rather than on the pack that was holding it back.

  The branch is **added, not substituted**. `^0.2.8` and `^0.3` keep resolving, because nothing
  here calls an API that `0.4` introduced, so raising the floor would strand 0.2 and 0.3 consumers
  for no gain.

#### Fixed

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

### [0.3.0] - 2026-09-21

#### Changed

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

### [0.2.6] - 2026-09-21

#### Changed

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

#### Added

- `variant_descriptions`, so the two variants carry an explanation rather than
  just a label.
- `tests/Unit/ResourceShapeTest.php`, pinning the canonical resource shape. Its
  variant assertion compares the lang keys against the `Variant` enum, which is
  what makes a file copied from another pack fail instead of shipping silently
  -- `bundled-icons` shipped metronic's translation file for exactly that reason.

  > Nothing loads these translations yet. No pack calls `hasTranslations()`.

#### Added

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

#### Fixed

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

#### Security

- **Floor raised to `ichava/core: ^0.2.8`.** Core `0.2.8` fixes two issues a pack inherits
  through the engine: `%` and `_` in a search query acted as `LIKE` wildcards, widening results
  and forcing full-table scans; and the icon watcher followed symlinks and read files of
  unbounded size, so a link inside a watched directory pointed the reader anywhere on disk.

  `^0.2.5` still permitted resolving to `0.2.5`, `0.2.6` or `0.2.7`, all of which carry both.
  The `|| ^0.3` arm is unchanged — core `0.3.0` moved the scaffolder out but left the engine,
  registry, seeder and SVG pipeline untouched, so an installed pack is unaffected by it.

### [0.2.5] - 2026-09-21

#### Changed

- **`ichava/core` widened to `^0.2.5 || ^0.3`.** Core `0.3.0` removes the icon-package
  scaffolder and its stub tree, which moved to `ichava/icon-package-scaffolder`. This package
  never used either, so it works unchanged on both series.

  Widened rather than raised on purpose. A caret on a `0.x` version pins the minor, so plain
  `^0.2.5` cannot resolve `0.3.0` and this package would have held every consumer back on the
  0.2 series for a removal that does not affect it. Raising it to `^0.3` instead would have
  forced a core upgrade on anyone deliberately staying on 0.2.x, for the same non-reason.
  Both series genuinely work, so the constraint says so.

### [0.2.4] - 2026-09-21

#### Security

- **Floor raised to `ichava/core: ^0.2.5`.** Core `0.2.5` closes an address-notation gap in the
  pack update-check guard: `isPublicIp()` judged addresses by how they were written, so
  `::7f00:1` and `::a9fe:a9fe` — IPv4-compatible IPv6 spellings of `127.0.0.1` and of the
  `169.254.169.254` cloud-metadata address — were accepted while the same addresses in dotted
  form were refused. `^0.2.4` still permitted resolving to `0.2.4`, which has it.

  Weaker than the containment fixes in `0.2.4`: the notation was deprecated in 2006 and most
  stacks will not route it. The floor moves anyway, because a constraint that can resolve to a
  release with a known gap is the thing this rule exists to prevent.

### [0.2.3] - 2026-09-21

#### Security

- **Floor raised to `ichava/core: ^0.2.4`.** Core `0.2.4` carries seven security fixes — post-
  sanitizer attribute gating, icon-path containment, off-document paint URLs, sanitizer policy
  flag enforcement, SVG driver containment, debug path leakage and pack update-check URL
  restriction. `^0.2.3` still permitted resolving to `0.2.3`, which has all seven. Raising a
  floor to exclude a known-broken release is not a pin; the constraint stays a range.

### [0.2.2] - 2026-09-16

#### Changed

- **Requires `ichava/core: ^0.2.3`.** `0.2.2` decided readiness against columns the schema has
  never had, so `ichava::ichava-core.info status` reported `UNINITIALIZED` on a fully seeded
  database and both auto-seed listeners, which gate on the same check, never fired. The floor is
  raised rather than the range widened; it still tracks every `0.2.x` from `0.2.3` on.

### [0.2.1] - 2026-09-16

#### Changed

- **Requires `ichava/core: ^0.2.2`.** The floor is raised rather than the range widened: `0.2.0`
  invoked six of its own Artisan commands by names it had just retired, and `0.2.1` still passed
  `migrate` a `--path` that resolved nowhere, so `database migrate` reported success and created
  no tables. `^0.2` admitted both. Raising a floor to exclude a known-broken release is not a
  pin — the range still tracks every `0.2.x` from `0.2.2` on.

### [0.2.0] - 2026-09-16

#### Breaking

- **Requires `ichava/core: ^0.2`.** Core `0.2.0` moved its config key to `ichava.ichava-core.*`
  and renamed every Artisan command with no bare aliases, so a host application upgrading this
  package has to upgrade core with it.

#### Added

- `release.yml` — a `v*.*.*` tag now publishes a release whose body is that version's CHANGELOG
  section, and fails closed when the tagged version has no section.
- PHPStan static analysis (level 0) with `composer analyse` and a code-quality CI workflow.

#### Changed

- Third-party GitHub Actions pinned to the commit SHA of their latest release; `actions/*` keep
  floating on a major tag. A tag is mutable, so `@v4` is a promise the action's owner can
  rewrite; pinning GitHub's own actions inside GitHub's own runner buys nothing.
- The test harness reads `DB_CONNECTION`, so the suite targets SQLite, PostgreSQL, MySQL or
  MariaDB. SQLite runs enable `foreign_key_constraints`, which Laravel applies only when the key
  is present.
- Hardened CI workflows: concurrency groups, job timeouts, problem matchers, docs-only skip paths, test coverage, and tidy composer scripts.
- Aligned Pest to `^4.6 || ^5.0`, PHPUnit strict flags, and CI branch triggers on `main` only.
- Install command requires only the pack. `ichava/core` installs as a dependency.

#### Fixed

- Icon examples now use variant-prefixed paths (`outline/home`, `filled/home`). Bare `ichava/icon-sets-tabler::home` does not resolve.

### [0.1.0] - 2026-08-31

First open-source release. An icon pack for the Ichava ecosystem: **6,146 SVGs**, registered with
`IconRegistry` at boot and served through `ichava/core`. Outline and filled variants, customisable stroke width. Upstream: Tabler Icons (MIT).

The pack depends on `ichava/core` and never on `ichava/browser`; the browser discovers installed
packs at runtime. Categories are `outline`, `filled`.

Earlier tags existed on GitHub and were never published to Packagist. They are withdrawn: the
ecosystem restarts from a single `0.1.0` across every package.

#### Added

- `IconsServiceProvider`, auto-discovered through `extra.laravel.providers`.
- `IconsConstants` reading the pack's `config.json`, and a type-safe enum implementing
  `IconSetVariantInterface`.
- An `IconComponent` extending core's base component, so `<x-ichava::icon>` resolves this pack's
  paths in both the `vendor/package::category/name` and dot forms.

#### Fixed

- **`ichava/core` is pinned to a single line.** The constraint was `^1.0 || ^2.0` while
  `ichava/browser` required `^2.0`, so a resolver could legally pair core 1.x with a browser
  assuming 2.x. It is now `^0.1`, matching the rest of the ecosystem.
- **The package declares VCS repository entries for `ichava/core` and all three `laranail/*`
  dependencies.** None is published on Packagist, and Composer reads `repositories` only from the
  root package, so a pack installed as the root could not locate them at all.

#### Requirements

- PHP `^8.4.1 || ^8.5`, `illuminate/support` `^13.0`, `ichava/core` `^0.1`,
  `laranail/package-tools` `^0.1.0`.
