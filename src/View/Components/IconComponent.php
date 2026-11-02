<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Ichava\IconSetsTabler\View\Components;

use Simtabi\Laranail\Ichava\IconSetsTabler\Constants\IconsConstants;
use Simtabi\Laranail\Ichava\View\Components\IconComponent as BaseIconComponent;

/**
 * Blade component for the Tabler Icons set. See README for usage examples
 * and accepted name formats.
 */
class IconComponent extends BaseIconComponent
{
    protected function getIconSet(): string
    {
        return IconsConstants::getPackageName();
    }

    protected function getVendorPackage(): string
    {
        return IconsConstants::getVendorPackage();
    }

    protected function getDefaultAttributes(): array
    {
        return [
            'stroke-width'    => '2',
            'stroke-linecap'  => 'round',
            'stroke-linejoin' => 'round',
        ];
    }
}
