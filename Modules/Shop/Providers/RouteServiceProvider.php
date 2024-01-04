<?php

namespace Modules\Shop\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Shop\Http\Controllers';

    /**
     * Api namespace
     */
     protected $apiNamespace = 'Modules\Shop\Http\Controllers\Api';

    /**
     * Vendor Api namespace
     */
     protected $vendorApiNamespace = 'Modules\Shop\Http\Controllers\Api\Vendor';

    /**
     * Vendor namespace
     */
     protected $vendorNamespace = 'Modules\Shop\Http\Controllers\Vendor';

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

        $this->mapVendorApiRoutes();

        $this->mapWebRoutes();

        $this->mapVendorRoutes();
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
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Shop', '/Routes/web.php'));
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
            ->group(module_path('Shop', '/Routes/api.php'));
    }

    /**
     * Define the "vendorApi" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapVendorApiRoutes()
    {
        Route::prefix('api\vendor')
            ->middleware('api')
            ->namespace($this->vendorApiNamespace)
            ->group(module_path('Shop', '/Routes/vendorApi.php'));
    }

    /**
     * Define the "vendor" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapVendorRoutes()
    {
        Route::prefix('vendor')
            ->middleware('web')
            ->namespace($this->vendorNamespace)
            ->group(module_path('Shop', '/Routes/vendor.php'));
    }
}
