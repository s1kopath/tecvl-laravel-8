<?php

namespace App\Providers;

use Illuminate\Support\Facades\{
    Blade,
    View
};
use Illuminate\Support\ServiceProvider;
use Schema;
use App\Models\{
    Category,
    Currency,
    Language,
    Preference,
    Permission,
    Country
};
use Illuminate\Contracts\Auth\Guard;
use Cart;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Check boot method is loaded or not.
     *
     * @var boolean
     */
    public $isBooted;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        Schema::defaultStringLength(191);
        if (! $this->app->runningInConsole() && env('APP_INSTALL') == true) {
            View::composer('*', function($view) use ($auth) {
                if (!$this->isBooted) {
                    $preference = Preference::getAll()->pluck('value', 'field')->toArray();
                    $currency   = Currency::getDefault($preference);
                    $carts = Cart::cartCollection()->sortKeys();
                    $subTotal = Cart::totalPrice();
                    $allCategories  = Category::getAll()->where('status', 'Active');
                    $featureCategories  = Category::getAll()->where('status', 'Active')->where('is_featured', 1);
                    if (mb_strlen($preference['company_name']) > 17) {
                        $preference['company_name'] = mb_substr($preference['company_name'], 0, 17).'...';
                    }
                    $data = [
                        'date_format_type'   => $preference['date_format_type'],
                        'row_per_page'       => $preference['row_per_page'],
                        'dflt_lang'          => $preference['dflt_lang'],
                        'company_name'       => $preference['company_name'],
                        'company_logo'       => !empty($preference['company_logo']) ? $preference['company_logo'] : '',
                        'company_street'     => $preference['company_street'],
                        'company_city'       => $preference['company_city'],
                        'company_state'      => $preference['company_state'],
                        'company_country_id' => $preference['company_country'],
                        'company_zipCode'    => $preference['company_zip_code'],
                        'currency_symbol'    => $currency->symbol,
                        'currency_name'      => $currency->name,
                        'allCategories'      => $allCategories,
                        'featureCategories'  => $featureCategories,
                        'decimal_digits'     => $preference['decimal_digits'],
                        'thousand_separator' => $preference['thousand_separator'],
                        'symbol_position'    => $preference['symbol_position'],
                        'default_currency'   => $currency,
                        'carts'              => $carts,
                        'subTotal'           => $subTotal,
                    ];
                    $json = \Cache::get('lanObject-' . config('app.locale'));
                    if (empty($json)) {
                        $json = file_get_contents(resource_path('lang/' . config('app.locale') . '.json'));
                        \Cache::put('lanObject-' . config('app.locale'), $json, 86400);

                    }
                    $data['json'] = $json;
                    $data['company_country_name'] = Country::getCountry($data['company_country_id']);
                    $data['favicon']              = !empty($preference['company_icon']) ? $preference['company_icon'] : '';
                    $data['company_name']         = $preference['company_name'] ? $preference['company_name'] : '';
                    $data['company_email']         = $preference['company_email'] ? $preference['company_email'] : '';
                    $data['company_phone']         = $preference['company_phone'] ? $preference['company_phone'] : '';

                    $data['prms'] = Permission::getAuthUserPermmission(optional($auth->user())->id);
                    $view->with($data);
                    $this->isBooted = true;
                }
            });

            Blade::if('impersonated', function() {
                return session()->has('impersonator');
            });
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('Cart',function() {
            return new \App\Cart\Cart;
        });
    }
}
