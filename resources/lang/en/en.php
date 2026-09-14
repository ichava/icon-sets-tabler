<?php

declare(strict_types=1);

return [
    'name'        => 'Tabler Icons',
    'description' => 'Over 5,000 pixel-perfect SVG icons for web projects',

    'variants' => [
        'outline' => 'Outline',
        'filled'  => 'Filled',
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
