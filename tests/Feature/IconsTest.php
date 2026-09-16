<?php

declare(strict_types=1);

use Simtabi\Laranail\Ichava\Services\IconRegistry;
use Simtabi\Laranail\Ichava\TablerIcons\Enums\Variant;
use Simtabi\Laranail\Ichava\TablerIcons\Constants\IconsConstants;
use Simtabi\Laranail\Ichava\TablerIcons\Providers\IconsServiceProvider;

it(description: 'boots the provider without error', closure: function () {
    $providers = array_keys($this->app->getLoadedProviders());

    expect($providers)->toContain(IconsServiceProvider::class);
});

it(description: 'resolves constants from config json', closure: function () {
    expect(IconsConstants::getVendorPackage())->toBe('ichava/tabler-icons')
        ->and(IconsConstants::getTitle())->toBe('Tabler Icons')
        ->and(IconsConstants::getPrefix())->toBe('ti')
        ->and(IconsConstants::getDefaultVariant())->toBe('outline');
});

it(description: 'uses the config prefix in enum class helpers', closure: function () {
    expect(Variant::OUTLINE->getClass())->toBe('ti-outline')
        ->and(Variant::FILLED->getClass())->toBe('ti-filled');
});

it(description: 'matches the default variant to config json', closure: function () {
    expect(Variant::default())->toBe(Variant::OUTLINE)
        ->and(Variant::OUTLINE->isDefault())->toBeTrue()
        ->and(Variant::FILLED->isDefault())->toBeFalse();
});

it(description: 'picks up the package in the icon registry', closure: function () {
    $registry = $this->app->make(IconRegistry::class);

    expect($registry->isRegistered('ichava/tabler-icons'))->toBeTrue(
        'IconRegistry should have ichava/tabler-icons registered after boot.',
    );
});
