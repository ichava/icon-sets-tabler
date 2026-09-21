<?php

declare(strict_types=1);

use Simtabi\Laranail\Ichava\TablerIcons\Enums\Variant;

/**
 * Pins the canonical `resources/` shape shared by every Ichava icon pack.
 *
 * The variant assertion is the load-bearing one. bundled-icons shipped a
 * verbatim copy of metronic-icons' translation file -- wrong product, and
 * metronic's four categories against its own ten -- and nothing caught it,
 * because no pack registers translations and so nothing ever read the file.
 * Comparing keys against a real enum is what makes a copied file fail.
 */
function tabler_resources(): string
{
    return dirname(__DIR__, 2) . '/resources';
}

/** @return array<string, mixed> */
function tabler_lang(): array
{
    return require tabler_resources() . '/lang/en/icons.php';
}

it(description: 'ships every path of the canonical resource shape', closure: function () {
    foreach ([
        'assets/svg/config.json',
        'assets/svg/files',
        'lang/en/icons.php',
        'views/components',
    ] as $path) {
        expect(file_exists(tabler_resources() . '/' . $path))->toBeTrue("missing resources/{$path}");
    }
});

it(description: 'does not name the translation group after the locale', closure: function () {
    // lang/en/en.php produced `<namespace>::en.name`, with the locale doubled.
    expect(file_exists(tabler_resources() . '/lang/en/en.php'))->toBeFalse();
});

it(description: 'does not duplicate config.json metadata in english', closure: function () {
    // These drifted while nothing read them: the lang file claimed "Over 5,000
    // pixel-perfect SVG icons for web projects", config.json "Over 5,200
    // pixel-perfect icons for web apps". config.json is the one IconRegistry
    // reads, so it is the only one that may carry them.
    expect(tabler_lang())->not->toHaveKey('name')
        ->and(tabler_lang())->not->toHaveKey('description');
});

it(description: 'matches its variant keys to the Variant enum exactly', closure: function () {
    $expected = array_column(Variant::cases(), 'value');
    sort($expected);

    foreach (['variants', 'variant_descriptions'] as $group) {
        $actual = array_keys(tabler_lang()[$group]);
        sort($actual);

        expect($actual)->toBe(
            $expected,
            "resources/lang/en/icons.php [{$group}] does not match the Variant enum. "
            . 'A mismatch here usually means the file was copied from another pack.',
        );
    }
});

it(description: 'declares itself as this package in config.json', closure: function () {
    $config = json_decode(
        (string) file_get_contents(tabler_resources() . '/assets/svg/config.json'),
        true,
        flags: JSON_THROW_ON_ERROR,
    );

    expect($config['package']['name'])->toBe('ichava/tabler-icons');
});
