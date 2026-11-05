<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Ichava\IconSetsTabler\Providers;

use Simtabi\Laranail\Ichava\Providers\IconPackServiceProvider;
use Simtabi\Laranail\Ichava\IconSetsTabler\Constants\IconsConstants;
use Simtabi\Laranail\Ichava\IconSetsTabler\View\Components\IconComponent;

/**
 * Registers the Tabler Icons set with the Ichava registry on boot.
 */
class IconsServiceProvider extends IconPackServiceProvider
{
    protected function constantsClass(): string
    {
        return IconsConstants::class;
    }

    protected function componentClass(): string
    {
        return IconComponent::class;
    }
}
