<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;
use Simtabi\Laranail\Ichava\Services\IconRegistry;

/*
|--------------------------------------------------------------------------
| The pack's default attributes reach every way it renders
|--------------------------------------------------------------------------
|
| They live in config.json `config.defaults`, which core applies when the set
| registers, so the generic tag, the pack's own tag and render() draw the same
| markup. They used to live in this pack's IconComponent, which only its own
| tag read.
|
*/

it('renders the config.json defaults through the registry', function (): void {
    expect(app(IconRegistry::class)->render('ichava/icon-sets-tabler::filled/accessible'))
        ->toContain('stroke-linecap="round"')
        ->toContain('stroke-linejoin="round"')
        ->toContain('stroke-width="2"');
});

it('renders the config.json defaults through the generic tag', function (): void {
    expect(Blade::render('<x-ichava-core::icon name="ichava/icon-sets-tabler::filled/accessible" />'))
        ->toContain('stroke-linecap="round"')
        ->toContain('stroke-linejoin="round"')
        ->toContain('stroke-width="2"');
});
