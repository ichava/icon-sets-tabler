# Attribution and licence

*Reference.*

## Upstream

[Tabler Icons](https://tabler-icons.io) is created and maintained by [Paweł Kuna](https://twitter.com/codecalm) and contributors. Source: [github.com/tabler/tabler-icons](https://github.com/tabler/tabler-icons).

## Licence

The icons and this package are owned separately, and both are under the **MIT License**:

- **The icons** are © Paweł Kuna and the Tabler Icons contributors, [MIT](https://github.com/tabler/tabler-icons/blob/main/LICENSE). Simtabi LLC redistributes them and claims no authorship of them.
- **This package's code** (provider, enum, component, configuration) is © Simtabi LLC, [MIT](../LICENSE).

MIT allows commercial and non-commercial use, modification and redistribution, provided the copyright notice and permission notice accompany every copy. That is a condition, not a courtesy: the upstream notice is reproduced in [`ATTRIBUTION.md`](../ATTRIBUTION.md) at the package root, which ships in the dist archive (`docs/` does not). Keep it with the icons if you copy them out of the package.

## Credit

A visible credit is not required by the licence, but is welcome on a "credits" or "about" page:

> Icons from [Tabler Icons](https://tabler-icons.io) by Paweł Kuna (MIT)

## Updating from upstream

Asset refreshes run **maintainer-side** via
[`ichava/icon-sets-sync`](https://github.com/ichava/icon-sets-sync).
Cron polls `@tabler/icons` on npm, refreshes the bundled SVGs when
upstream moves, and opens a PR. A human reviews + tags a release;
Packagist + `composer update` fans the change out.

End users **don't** refresh locally -- `vendor/` is regenerated on every
`composer install`, so any local change is discarded. Run
`php artisan ichava::ichava-core.check-updates --package=ichava/icon-sets-tabler`
to see whether a new upstream version is available.

## See also

- [Tabler website](https://tabler-icons.io)
- [Tabler GitHub](https://github.com/tabler/tabler-icons)

---

[← Docs index](../README.md#documentation)
