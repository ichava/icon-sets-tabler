[← Package README](../README.md#pack-specific-docs)

# Attribution and licence

*Reference.*

## Upstream

[Tabler Icons](https://tabler-icons.io) is created and maintained by [Paweł Kuna](https://twitter.com/codecalm) and contributors. Source: [github.com/tabler/tabler-icons](https://github.com/tabler/tabler-icons).

## Licence

Both the upstream Tabler Icons project and this `ichava/tabler-icons` package are licensed under the **MIT License**. You may use the icons in commercial and non-commercial projects, modify them, and redistribute them, provided the licence text accompanies any redistribution.

- Upstream icon licence: [MIT](https://github.com/tabler/tabler-icons/blob/main/LICENSE)
- This package: [MIT](../LICENSE)

## Credit (optional but appreciated)

If your project's "credits" or "about" page lists icon sources, please include something like:

> Icons from [Tabler Icons](https://tabler-icons.io) (MIT)

The Tabler maintainers do not require attribution per the licence, but small credits help sustain open-source icon work.

## Updating from upstream

Asset refreshes run **maintainer-side** via
[`ichava/maintainer-toolkit`](https://github.com/ichava/maintainer-toolkit).
Cron polls `@tabler/icons` on npm, refreshes the bundled SVGs when
upstream moves, and opens a PR. A human reviews + tags a release;
Packagist + `composer update` fans the change out.

End users **don't** refresh locally -- `vendor/` is regenerated on every
`composer install`, so any local change is discarded. Run
`php artisan ichava::ichava-core.check-updates --package=ichava/tabler-icons`
to see whether a new upstream version is available.

## See also

- [Tabler website](https://tabler-icons.io)
- [Tabler GitHub](https://github.com/tabler/tabler-icons)
