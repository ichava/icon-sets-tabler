<?php

declare(strict_types=1);

/**
 * Pins what was removed from this pack as unread copies, and what it keeps.
 *
 * Removed 2026-10-30 (the wire-in plan's pack rows): the `commands` and `info`
 * translation groups, written for an update command and an about block no
 * pack ships (core's about section reads the registry instead), and the
 * `set.name` / `set.prefix` config copies. Each was read by nothing, which is
 * why none of them could fail.
 */
function tabler_translations(): array
{
    return require dirname(__DIR__, 2) . '/resources/lang/en/icons.php';
}

it(description: 'ships no translations for an update command or an about block', closure: function () {
    expect(tabler_translations())->not->toHaveKey('commands')
        ->and(tabler_translations())->not->toHaveKey('info');
});

it(description: 'keeps a description for every label core loads', closure: function () {
    // Core loads `variants`, `categories` and `sets` as labels. Each label
    // group carries a description per key, for the browser's tooltips.
    $groups = ['variants' => 'variant_descriptions', 'categories' => 'category_descriptions', 'sets' => 'set_descriptions'];
    $inspected = 0;

    foreach ($groups as $labels => $descriptions) {
        if (! array_key_exists($labels, tabler_translations())) {
            continue;
        }

        $inspected++;
        $expected = array_keys(tabler_translations()[$labels]);
        $actual = array_keys(tabler_translations()[$descriptions] ?? []);
        sort($expected);
        sort($actual);

        expect($actual)->toBe($expected);

        foreach (tabler_translations()[$descriptions] as $key => $text) {
            expect(is_string($text) && trim($text) !== '')->toBeTrue("{$descriptions}.{$key} is empty");
        }
    }

    expect($inspected)->toBeGreaterThan(0, 'no label group was inspected');
});

it(description: 'ships no config file, because the one it had held only copies', closure: function () {
    // `set.name` and `set.prefix` were the whole file, and nothing read either:
    // core takes both from config.json through IconsConstants. Decided
    // 2026-10-30 to delete a pack config file that ends up empty, rather than
    // keep an empty one with a publish tag that publishes nothing.
    expect(glob(dirname(__DIR__, 2) . '/config/*.php') ?: [])->toBe([])
        ->and(config('ichava.icon-sets-tabler'))->toBeNull();

    $provider = (string) file_get_contents(dirname(__DIR__, 2) . '/src/Providers/IconsServiceProvider.php');

    expect(str_contains($provider, 'hasConfigFile('))->toBeFalse('the provider still registers a config file');
});
