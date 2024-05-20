<?php

namespace Rahat1994\SparkcommerceMultivendor\Http\Middleware;

use Filament\Facades\Filament;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Rahat1994\SparkcommerceMultivendor\Enums\PanelType;
use Rahat1994\SparkcommerceMultivendor\SparkcommerceMultivendorPlugin;

class AuthMiddleware extends Middleware
{
    public function authenticate($request, $next)
    {
        $panel = Filament::getCurrentPanel();
        $plugins = $panel->getPlugins();
        if (is_array($plugins) && key_exists('sparkcommerce-multivendor', $plugins)) {
            $plugin = $plugins['sparkcommerce-multivendor'];
            if ($plugin instanceof SparkcommerceMultivendorPlugin) {
                $panelType = $plugin->getPanelType();
                if ($panelType === PanelType::Vendor) {
                    $user = Filament::auth()->user();
                    if (!$user->hasRole('vendor')) {
                        abort_if(true, 403, 'access forbidden.');
                    }
                } else if ($panelType === PanelType::Admin) {
                    $user = Filament::auth()->user();
                    if (!$user->hasRole('admin')) {
                        abort_if(true, 403, 'access forbidden.');
                    }
                }
            }
        }
    }

    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }
}
