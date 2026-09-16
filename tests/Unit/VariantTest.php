<?php

declare(strict_types=1);

use Simtabi\Laranail\Ichava\TablerIcons\Enums\Variant;

/**
 * Pure-enum behaviour tests. Anything that touches config.json (default(),
 * isDefault(), getClass(), getPath()) lives in the Feature suite where the
 * Laravel container is bootstrapped.
 */
it(description: 'exposes the outline case value', closure: function () {
    expect(Variant::OUTLINE->getValue())->toBe('outline');
});

it(description: 'exposes the filled case value', closure: function () {
    expect(Variant::FILLED->getValue())->toBe('filled');
});

it(description: 'returns every case from values', closure: function () {
    expect(Variant::values())->toBe(['outline', 'filled']);
});

it(description: 'resolves known values and rejects unknown ones', closure: function () {
    expect(Variant::tryFromValue('outline'))->toBe(Variant::OUTLINE)
        ->and(Variant::tryFromValue('filled'))->toBe(Variant::FILLED)
        ->and(Variant::tryFromValue('not-a-real-variant'))->toBeNull();
});
