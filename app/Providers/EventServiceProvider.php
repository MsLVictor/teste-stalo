<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * O mapeamento de eventos para os manipuladores de eventos.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        //
    ];

    /**
     * Registre quaisquer eventos para sua aplicação.
     */
    public function boot(): void
    {
        //
    }
}
