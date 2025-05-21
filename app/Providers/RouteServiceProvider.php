<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckVerificationCode; // <-- ¡AÑADE ESTA LÍNEA!

class RouteServiceProvider extends ServiceProvider
{
    /**
     * La ruta a la que los usuarios serán redirigidos después de iniciar sesión.
     */
    public const HOME = '/dashboard'; 

    /**
     * Define las rutas del aplicativo.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        // ✅ REGISTRA TU ALIAS DE MIDDLEWARE AQUÍ para Laravel 11.
        Route::aliasMiddleware('verificacion.codigo', CheckVerificationCode::class); // <-- ¡¡¡ASEGÚRATE DE QUE ESTA LÍNEA ESTÉ!!!

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}