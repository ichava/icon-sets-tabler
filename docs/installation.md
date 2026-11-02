# Installation

Three steps: point Composer at the repositories, require the pack, seed it.

## Requirements

PHP `^8.4.1 || ^8.5`, Laravel `^13`, and [`ichava/core`](https://opensource.simtabi.com/documentation/ichava/core/) `^0.1` on the same application.
Core is the engine; this pack is only icons and the provider that registers them.

## The repositories block

The `ichava/*` packages are on Packagist, but the `laranail/*` packages core depends on are not yet, so Composer has to be told where to find them.
Composer reads `repositories` only from the root package, which is why the block belongs in the
**application's** `composer.json` and has to name the whole transitive closure rather than just this
pack. Core's [installation guide](https://opensource.simtabi.com/documentation/ichava/core/installation) gives the full block.

## Require it

```bash
composer require ichava/icon-sets-tabler
```

The service provider is discovered automatically.

## Seed it

```bash
php artisan ichava::ichava-core.database seed --package=ichava/icon-sets-tabler
```

**This step is not optional.** Until it runs the registry holds no rows for this pack and every
lookup returns nothing, which is the most common "it does not work" in the ecosystem. See
[seed pack icons](https://opensource.simtabi.com/documentation/ichava/core/recipes/seed-pack-icons).

---

[← Docs index](../README.md#documentation)
