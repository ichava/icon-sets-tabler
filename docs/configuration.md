# Configuration

*Reference.* Why this pack has no config file, and where its settings live instead.

## No config file

This pack ships no config file, so there is no `ichava.icon-sets-tabler` key and no publish tag. The file it used
to ship held only copies of the set name and prefix, which nothing read: core takes both from
`resources/assets/svg/config.json` through `IconsConstants`. It was removed rather than left empty.

## Where its settings live

`resources/assets/svg/config.json` is canonical for the pack's name, prefix, kind, variants and
categories, and core reads it when the provider registers the pack. A host changes behaviour through
core's configuration, below, not by editing the pack.

## What is not here

Cache, queue, database, logging, security and the `ICHAVA_*` environment surface are **core's**, and
apply to every pack at once. They are documented in core's
[configuration guide](https://opensource.simtabi.com/documentation/ichava/core/configuration) and [environment variables](https://opensource.simtabi.com/documentation/ichava/core/environment).

Nothing in this pack can change how core seeds, caches or sanitises; that is the point of the split.

---

[← Docs index](../README.md#documentation)
