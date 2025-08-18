<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class TenancyRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Aplica tenant automaticamente nas rotas nomeadas de auth
        if (request()->route('tenant')) {
            $tenant = request()->route('tenant');

            // Adiciona o tenant em todas as rotas nomeadas padrão
            Route::getRoutes()->refreshNameLookups();

            foreach (Route::getRoutes() as $route) {
                if ($route->getName() && in_array($route->getName(), [
                    'login',
                    'register',
                    'password.request',
                    'password.email',
                    'password.reset',
                    'password.update',
                    'verification.notice',
                    'verification.verify',
                    'verification.send',
                ])) {
                    $route->defaults('tenant', $tenant);
                }
            }
        }
    }
}