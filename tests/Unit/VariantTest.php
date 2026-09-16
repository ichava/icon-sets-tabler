<?php

declare(strict_types=1);

use Simtabi\Laranail\Ichava\TablerIcons\Enums\Variant;

/**
 * Pure-enum behaviour tests. Anything that touches config.json (default(),
 * isDefault(), getClass(), getPath()) lives in the Feature suite where the
 * Laravel container is bootstrapped.
 */
it('exposes the outline case value', function () {
    expect(Variant::OUTLINE->getValue())->toBe('outline');
});

it('exposes the filled case value', function () {
    expect(Variant::FILLED->getValue())->toBe('filled');
});

it('returns every case from values', function () {
    expect(Variant::values())->toBe(['outline', 'filled']);
});

it('resolves known values and rejects unknown ones', function () {
    expect(Variant::tryFromValue('outline'))->toBe(Variant::OUTLINE)
        ->and(Variant::tryFromValue('filled'))->toBe(Variant::FILLED)
        ->and(Variant::tryFromValue('not-a-real-variant'))->toBeNull();
});
