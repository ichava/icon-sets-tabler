<?php

declare(strict_types=1);

use Simtabi\Laranail\Ichava\TablerIcons\Constants\IconsConstants;

/**
 * Tabler Icons configuration.
 *
 * Most settings (variants, defaults, paths, metadata) live in
 * resources/assets/svg/config.json, that file is the canonical source and
 * is read at runtime via IconsConstants. Keys here are the small subset
 * a host application may want to override per environment.
 */
return [
    'set' => [
        'name'   => IconsConstants::getPackageName(),
        'prefix' => IconsConstants::getPrefix(),
    ],
];
