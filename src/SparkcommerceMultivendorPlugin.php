<?php

namespace Rahat1994\SparkcommerceMultivendor;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Rahat1994\SparkcommerceMultivendor\Enums\PanelType;
use Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy\RegisterVendor;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\SupportTicketResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorRequestResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource;
use Rahat1994\SparkcommerceMultivendor\Http\Middleware\AuthMiddleware;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

class SparkcommerceMultivendorPlugin implements Plugin
{
    protected PanelType $panelType = PanelType::Admin;

    public function getId(): string
    {
        return 'sparkcommerce-multivendor';
    }

    public function getPanelType(): PanelType
    {
        return $this->panelType;
    }

    public function setPanelType(PanelType $panelType): static
    {
        $this->panelType = $panelType;

        return $this;
    }

    public function register(Panel $panel): void
    {
        if ($this->panelType === PanelType::Admin) {
            $panel->resources(
                $this->getResources()
            );
        } else {
            $panel->resources(
                $this->getResources()
            )
                ->tenant(SCMVVendor::class, slugAttribute: 'slug')
                ->tenantRegistration(RegisterVendor::class)
                ->authMiddleware([
                    AuthMiddleware::class,
                ]);
        }
    }

    protected function getResources(): array
    {

        if ($this->getPanelType() == PanelType::Admin) {
            return [
                VendorResource::class,
                VendorRequestResource::class,
                PayoutRequestResource::class,
                SupportTicketResource::class,
            ];
        }

        return [];
    }

    public function boot(Panel $panel): void
    {
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
