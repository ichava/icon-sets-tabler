<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Tabler Icons -- localisable strings
|--------------------------------------------------------------------------
|
| An overlay, not a second source of truth. `name` and `description` are
| deliberately absent: IconRegistry::fromDirectory() reads those from
| resources/assets/svg/config.json, which is canonical. This file used to
| carry a copy of both, and they had already drifted -- it said "Over 5,000
| pixel-perfect SVG icons for web projects" while config.json said "Over
| 5,200 pixel-perfect icons for web apps". Nothing noticed, because nothing
| loads this file. A non-English locale may add them to override; `en` must
| not.
|
| Variant keys match Simtabi\Laranail\Ichava\IconSetsTabler\Enums\Variant.
|
*/

return [
    'variants' => [
        'outline' => 'Outline',
        'filled'  => 'Filled',
    ],

    'variant_descriptions' => [
        'outline' => 'Stroked icons with a configurable stroke width',
        'filled'  => 'Solid icons with no stroke',
    ],

    'commands' => [
        'update'   => 'Update Tabler Icons from GitHub',
        'fetching' => 'Fetching latest release of Tabler Icons...',
        'complete' => 'Tabler Icons updated successfully!',
    ],

    'info' => [
        'version'      => 'Version :version',
        'total_icons'  => ':count icons available',
        'stroke_width' => 'Stroke width: :width',
    ],
];
