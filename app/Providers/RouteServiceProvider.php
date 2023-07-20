<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';
    public const SECRET_PAGE = '/secret-auth';
    public const SECRET_PAGE_FORBIDDEN = '/secret-forbidden';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/anggaran.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/personil.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/yankesin.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/logistik.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/matfaskes.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/dobekkes.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/kermabaktikes.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/lafibiovak.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/dukkesops.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/bangkes.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/faskes.php'));

            Route::middleware(['web', 'auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/regulasi.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
