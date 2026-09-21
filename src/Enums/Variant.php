<?php

declare(strict_types=1);

namespace Simtabi\Laranail\Ichava\IconSetsTabler\Enums;

use Simtabi\Laranail\Ichava\Traits\HasIconSetVariants;
use Simtabi\Laranail\Ichava\Contracts\IconSetVariantInterface;
use Simtabi\Laranail\Ichava\IconSetsTabler\Constants\IconsConstants;

/**
 * Type-safe variant selection for Tabler Icons (outline / filled).
 */
enum Variant: string implements IconSetVariantInterface
{
    use HasIconSetVariants;

    case OUTLINE = 'outline';
    case FILLED = 'filled';

    public function getPath(): string
    {
        return IconsConstants::getSvgPath($this->value);
    }

    private static function getDefaultValue(): string
    {
        return IconsConstants::getDefaultVariant() ?? self::OUTLINE->value;
    }

    private static function getClassPrefix(): string
    {
        return IconsConstants::getPrefix();
    }
}
