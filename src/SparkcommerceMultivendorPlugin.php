<?php

namespace Rahat1994\SparkcommerceMultivendor;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\SupportTicketResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource;

class SparkcommerceMultivendorPlugin implements Plugin
{
    public function getId(): string
    {
        return 'sparkcommerce-multivendor';
    }

    public function register(Panel $panel): void
    {
        // dd("Hello");
        $panel->resources([
            VendorResource::class,
            SupportTicketResource::class,
            PayoutRequestResource::class,
            VendorRequestResource::class,
            // CategoryResource::class,
            // TagResource::class,
            // ReviewResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
