<?php

namespace Modules\Coupon\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Coupon\Http\Controllers';

    /**
     * Vendor namespace
     */
    protected $vendorNamespace = 'Modules\Coupon\Http\Controllers\Vendor';

    /**
     * Api namespace
     */
    protected $apiNamespace = 'Modules\Coupon\Http\Controllers\Api';
    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Coupon', '/Routes/web.php'));

        Route::prefix('vendor')
            ->middleware('web')
            ->namespace($this->vendorNamespace)
            ->group(module_path('Coupon', '/Routes/vendor.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->apiNamespace)
            ->group(module_path('Coupon', '/Routes/api.php'));
    }
}
