<?php

namespace Rahat1994\SparkcommerceMultivendor\Http\Middleware;

use Filament\Facades\Filament;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Rahat1994\SparkcommerceMultivendor\SparkcommerceMultivendorPlugin;

class AuthMiddleware extends Middleware
{
    public function authenticate($request, $next)
    {
        $panel = Filament::getCurrentPanel();

        // return;
        // return $next($request);

        $user = Filament::auth()->user();

        // dd($user);
    }

    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }
}
