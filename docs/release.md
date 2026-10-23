# Release

*Reference.* How a version of `ichava/icon-sets-tabler` is cut.

## The tag is the trigger

`.github/workflows/release.yml` runs on `push` to `vX.Y.Z` tags. A merge runs the gates; a tag
publishes. The tag is made by [release-please](https://github.com/googleapis/release-please), not by
hand:

1. Every pull request that changes behaviour adds to the one `## [Unreleased]` section of
   `CHANGELOG.md`, and uses a Conventional Commit subject.
2. Run *Release Please* from the Actions tab (it also runs every Monday). It opens or refreshes one
   release pull request that bumps `.release-please-manifest.json`, and closes `[Unreleased]` as
   `## [X.Y.Z] - date` on that branch. It fails when `[Unreleased]` is empty.
3. Merge the release pull request once CI is green. That run tags `vX.Y.Z` and creates the release;
   the tag starts `release.yml`, which publishes the changelog section as the body.

On 0.x a breaking change (`feat!:` or a `BREAKING CHANGE:` footer) bumps the minor and everything
else bumps the patch. The minor moves in lockstep across the coupled ichava packages: when one of
them needs `0.N.0`, every coupled repository gets a pull request carrying a `Release-As: 0.N.0`
footer alongside its constraint change.
Never edit the release pull request by hand: release-please rebuilds its branch and drops anything
it did not write. Change the notes on `main` instead.

If a tag ever starts nothing, run `release.yml` by hand against it:
`gh workflow run release.yml --ref vX.Y.Z`. It refuses any ref that is not a release tag.

## The changelog is the release body

The workflow extracts this version's `## [x.y.z]` section from `CHANGELOG.md` and uses it as the
GitHub release body, so **a version with no section produces a release with no description**. A
`Changelog order` job fails a pull request when `[Unreleased]` is not first or the versions do not
descend.

## The core constraint is the release decision

`composer.json` requires `ichava/core` `^0.1`. Below `1.0` a caret pins the **minor**, so a new core
minor reaches this pack only once the constraint is widened to admit it (`^0.1 || ^0.2`), never by
raising it alone, which would trap consumers who stay on the older series.

- **Widen** when a new core minor is compatible and this pack never used what changed.
- **Raise the floor** when core ships a security fix in code this pack runs -- the old constraint
  still resolves the vulnerable release otherwise.

Check before doing either:

```bash
git -C ../core diff --name-only <prev>..<new> -- src
```

An empty result means no consumed code moved.

## Refreshing the icons is not a release

New icons arrive by an upstream sync, not by cutting a tag here.
[`ichava/icon-sets-sync`](https://opensource.simtabi.com/documentation/ichava/icon-sets-sync/upstream-tracking)
polls `@tabler/icons`, refreshes the vendored SVGs, bumps `upstream.current_version` in
`resources/assets/svg/config.json` and opens a pull request. That pull request is the change; a
release follows it only if you want the new icons published under a tag.

Core's [check pack updates](https://opensource.simtabi.com/documentation/ichava/core/recipes/check-pack-updates) reports whether a newer upstream
release exists. **The vendored version lives in `config.json` and nowhere else** -- writing it into
prose as well is how a README came to advertise a release the pack did not ship.

There is no `version` field in `composer.json`; the version comes from the tag. No lock file is
committed.

## The 0.1.0 re-base

Versioning was re-based on 2026-10-23, with every other ichava package. The tags `v0.1.0` to
`v0.3.4` (2026-08-31 to 2026-09-26) and their GitHub releases were removed, and `main` was tagged `v0.1.0`. Every
commit those tags pointed at is on `main`, so no code was lost; their notes are kept in
`CHANGELOG.md` under *Archived pre-reset history*. Version numbers in older changelog entries and
issues refer to that earlier series.

---

[← Docs index](../README.md#documentation)
