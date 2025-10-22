<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard'; // Redirect home to dashboard after login

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for your application.
     */
    public function map()
    {
        $this->mapWebRoutes(); // Ensure web routes are mapped
        // Optionally map API routes if needed
        // $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     */
    // protected function mapApiRoutes()
    // {
    //     Route::prefix('api')
    //         ->middleware('api')
    //         ->namespace($this->namespace)
    //         ->group(base_path('routes/api.php'));
    // }
}
