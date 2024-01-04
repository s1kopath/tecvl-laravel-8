<?php

namespace Modules\Refund\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Refund\Http\Controllers';

     /**
     * Api namespace
     */
    protected $userApiNamespace = 'Modules\Refund\Http\Controllers\Api\User';

     /**
     * User namespace
     */
    protected $userNamespace = 'Modules\Refund\Http\Controllers\Site';

     /**
     * Vendor namespace
     */
    protected $vendorNamespace = 'Modules\Refund\Http\Controllers\Vendor';

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
        $this->mapUserApiRoutes();

        $this->mapWebRoutes();

        $this->mapUserRoutes();

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
            ->group(module_path('Refund', '/Routes/web.php'));
    }

    /**
     * Define the "userApi" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapUserApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->userApiNamespace)
            ->group(module_path('Refund', '/Routes/userApi.php'));
    }

    /**
     * Define the "user" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapUserRoutes()
    {
        Route::middleware('web')
            ->namespace($this->userNamespace)
            ->group(module_path('Refund', '/Routes/user.php'));
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
            ->group(module_path('Refund', '/Routes/vendor.php'));
    }
}
