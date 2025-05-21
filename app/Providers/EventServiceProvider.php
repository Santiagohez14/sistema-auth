<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\EnviarCodigoVerificacion;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Los eventos para los que se deben registrar los oyentes.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Login::class => [
            EnviarCodigoVerificacion::class,
        ],
    ];

    /**
     * Registrar cualquier evento para tu aplicación.
     */
    public function boot(): void
    {
        //
    }
}
