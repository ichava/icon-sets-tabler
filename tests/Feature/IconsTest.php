<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Ichava\TablerIcons\Tests\Feature;

use Simtabi\Laranail\Ichava\Services\IconRegistry;
use Simtabi\Laranail\Ichava\TablerIcons\Enums\Variant;
use Simtabi\Laranail\Ichava\TablerIcons\Tests\TestCase;
use Simtabi\Laranail\Ichava\TablerIcons\Constants\IconsConstants;
use Simtabi\Laranail\Ichava\TablerIcons\Providers\IconsServiceProvider;

class IconsTest extends TestCase
{
    public function test_provider_boots_without_error(): void
    {
        $providers = array_keys($this->app->getLoadedProviders());

        $this->assertContains(
            IconsServiceProvider::class,
            $providers,
        );
    }

    public function test_constants_resolve_from_config_json(): void
    {
        $this->assertSame('ichava/tabler-icons', IconsConstants::getVendorPackage());
        $this->assertSame('Tabler Icons', IconsConstants::getTitle());
        $this->assertSame('ti', IconsConstants::getPrefix());
        $this->assertSame('outline', IconsConstants::getDefaultVariant());
    }

    public function test_enum_class_helpers_use_config_prefix(): void
    {
        $this->assertSame('ti-outline', Variant::OUTLINE->getClass());
        $this->assertSame('ti-filled', Variant::FILLED->getClass());
    }

    public function test_default_variant_matches_config_json(): void
    {
        $default = Variant::default();

        $this->assertSame(Variant::OUTLINE, $default);
        $this->assertTrue(Variant::OUTLINE->isDefault());
        $this->assertFalse(Variant::FILLED->isDefault());
    }

    public function test_icon_registry_picks_up_the_package(): void
    {
        /** @var IconRegistry $registry */
        $registry = $this->app->make(IconRegistry::class);

        $this->assertTrue(
            $registry->isRegistered('ichava/tabler-icons'),
            'IconRegistry should have ichava/tabler-icons registered after boot.',
        );
    }
}
