<?php

namespace Modules\MenuBuilder\Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('admin_menus')->delete();

        \DB::table('admin_menus')->insert(array (
            0 =>
            array (
                'id' => 7,
                'name' => 'user',
                'slug' => 'user-list',
                'url' => 'user/list',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\UserController@index", "route_name":["users.index", "users.create", "users.edit", "users.import", "users.pdf", "users.csv", "users.verify", "users.profile"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            1 =>
            array (
                'id' => 8,
                'name' => 'vendor',
                'slug' => 'items',
                'url' => 'items',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\ItemController@index", "route_name":["item.index", "item.create", "item.edit", "item.pdf", "item.csv"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            2 =>
            array (
                'id' => 9,
                'name' => 'user',
                'slug' => 'brands',
                'url' => 'brands',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\BrandController@index", "route_name":["brands.index", "brands.create", "brands.edit", "brands.pdf", "brands.csv"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            3 =>
            array (
                'id' => 10,
                'name' => 'Categories',
                'slug' => 'categories',
                'url' => 'categories',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\CategoryController@index", "route_name":["categories.index"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            4 =>
            array (
                'id' => 11,
                'name' => 'Attributes',
                'slug' => 'attributes',
                'url' => 'attributes',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\AttributeController@index", "route_name":["attribute.index", "attribute.create", "attribute.edit", "attribute.pdf", "attribute.csv"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            5 =>
            array (
                'id' => 12,
                'name' => 'Attribute Groups',
                'slug' => 'attribute-groups',
                'url' => 'attribute-groups',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\AttributeGroupController@index", "route_name":["attributeGroup.index", "attributeGroup.create", "attributeGroup.edit", "attributeGroup.pdf", "attributeGroup.csv"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            6 =>
            array (
                'id' => 13,
                'name' => 'Options',
                'slug' => 'options',
                'url' => 'options',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\OptionController@index", "route_name":["option.index", "option.create", "option.edit", "option.pdf", "option.csv"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            7 =>
            array (
                'id' => 14,
                'name' => 'Reviews',
                'slug' => 'reviews',
                'url' => 'reviews',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\ReviewController@index", "route_name":["review.index", "review.view", "review.edit", "review.pdf", "review.csv"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            8 =>
            array (
                'id' => 15,
                'name' => 'Packages',
                'slug' => 'packages',
                'url' => 'package',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\PackageController@index", "route_name":["package.index", "package.create", "package.edit", "package.pdf", "package.csv"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            9 =>
            array (
                'id' => 16,
                'name' => 'Package-Subscription',
                'slug' => 'package-subscription',
                'url' => 'package-subscription',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\PackageSubscriptionController@index", "route_name":["packageSubscription.index", "packageSubscription.create", "packageSubscription.edit", "packageSubscription.pdf", "packageSubscription.csv", "packageSubscription.show"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            11 =>
            array (
                'id' => 18,
                'name' => 'Vendors',
                'slug' => 'vendors',
                'url' => 'vendors',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Api\\\\VendorController@index", "route_name":["vendors.index", "vendors.create", "vendors.edit", "vendors.pdf", "vendors.csv", "vendors.import"], "menu_level":"1"}',
                'is_default' => 0,
            ),
            12 =>
            array (
                'id' => 19,
                'name' => 'Addons',
                'slug' => 'addons',
                'url' => 'addons',
                'permission' => '{"permission":"Modules\\\\Addons\\\\Http\\\\Controllers\\\\AddonsController@index", "route_name":["addon.index", "addon.switch-status", "addon.remove", "addon.upload"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            13 =>
            array (
                'id' => 20,
                'name' => 'Menu Builder',
                'slug' => 'menu-builder',
                'url' => 'menu-builder',
                'permission' => '{"permission":"Modules\\\\MenuBuilder\\\\Http\\\\Controllers\\\\MenuBuilderController@index","route_name":["menu.index"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            14 =>
            array (
                'id' => 21,
                'name' => 'Company Details',
                'slug' => 'company-details',
                'url' => 'company/setting',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\CompanySettingController@index", "route_name":["companyDetails.setting"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            15 =>
            array (
                'id' => 22,
                'name' => 'General Settings',
                'slug' => 'general-settings',
                'url' => 'emailConfiguration',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\EmailConfigurationController@index","route_name":["emailConfigurations.index", "maintenance.enable", "smsConfiguration.index", "language.translation", "language.index", "currency.convert", "sso.index", "orderStatues.index"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            16 =>
            array (
                'id' => 23,
                'name' => 'Finance',
                'slug' => 'finance',
                'url' => 'currencies',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\CurrencyController@index","route_name":["currency.index","validCurrencyName", "paymentTerm.index", "paymentTerm.edit", "tax.index", "tax.edit"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            17 =>
            array (
                'id' => 24,
                'name' => 'Email Templates',
                'slug' => 'email-templates',
                'url' => 'emailTemplate/list',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\MailTemplateController@index", "route_name":["emailTemplates.index", "emailTemplates.create", "emailTemplates.edit"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            18 =>
            array (
                'id' => 25,
                'name' => 'SMS Templates',
                'slug' => 'sms-templates',
                'url' => 'smsTemplate/list',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\SmsTemplateController@index","route_name":["smsTemplates.index", "smsTemplates.create", "smsTemplates.edit"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            19 =>
            array (
                'id' => 26,
                'name' => 'Preference',
                'slug' => 'preference',
                'url' => 'preference',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\PreferenceController@index", "route_name":["preferences.index", "preferences.theme"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            20 =>
            array (
                'id' => 27,
                'name' => 'Roles',
                'slug' => 'roles',
                'url' => 'role/list',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\RoleController@index", "route_name":["roles.index", "roles.create", "roles.edit"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            21 =>
            array (
                'id' => 28,
                'name' => 'Permission Role',
                'slug' => 'permission-role',
                'url' => 'permission-role',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\PermissionRoleController@index", "route_name":["permissionRoles.index", "generatePermission.index"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            22 =>
            array (
                'id' => 29,
                'name' => 'Cache Clear',
                'slug' => 'cache-clear',
                'url' => 'clear-cache',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\DashboardController@index", "route_name":["dashboard"], "menu_level":"1"}',
                'is_default' => 1,
            ),
            23 =>
            array (
                'id' => 30,
                'name' => 'Dashboard',
                'slug' => 'user-dashboard',
                'url' => 'dashboard',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\DashboardController@index", "route_name":["site.dashboard"], "menu_level":"2"}',
                'is_default' => 1,
            ),
            24 =>
            array (
                'id' => 31,
                'name' => 'Orders',
                'slug' => 'orders',
                'url' => 'orders',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\OrderController@index", "route_name":["site.order"], "menu_level":"2"}',
                'is_default' => 1,
            ),
            25 =>
            array (
                'id' => 32,
                'name' => 'Wishlist',
                'slug' => 'wishlist',
                'url' => 'wishlists',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\WishlistController@index", "route_name":["site.wishlist"], "menu_level":"2"}',
                'is_default' => 1,
            ),
            26 =>
            array (
                'id' => 33,
                'name' => 'Review',
                'slug' => 'review',
                'url' => 'reviews',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\ReviewController@index", "route_name":["site.review"], "menu_level":"2"}',
                'is_default' => 1,
            ),
            27 =>
            array (
                'id' => 34,
                'name' => 'My Profile',
                'slug' => 'user-profile',
                'url' => 'profile',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\UserController@index", "route_name":["site.userProfile", "site.userProfileEditPassword"], "menu_level":"2"}',
                'is_default' => 1,
            ),
            28 =>
            array (
                'id' => 35,
                'name' => 'Address Books',
                'slug' => 'address-books',
                'url' => 'addresses',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\AddressController@index", "route_name":["site.address", "site.addressCreate", "site.addressEdit"], "menu_level":"2"}',
                'is_default' => 1,
            ),
            29 =>
            array (
                'id' => 36,
                'name' => 'Settings',
                'slug' => 'settings',
                'url' => 'setting',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\AddressController@index", "route_name":["site.userSetting"], "menu_level":"2"}',
                'is_default' => 1,
            ),
            30 =>
            array (
                'id' => 37,
                'name' => 'Logout',
                'slug' => 'logout',
                'url' => 'logout',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\LoginController@logout", "route_name":["site.logout"], "menu_level":"2"}',
                'is_default' => 1,
            ),
            31 =>
            array (
                'id' => 38,
                'name' => 'Dashboard',
                'slug' => 'vendor-dashboard',
                'url' => 'dashboard',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\VendorController@index", "route_name":["vendor-dashboard"], "menu_level":"3"}',
                'is_default' => 1,
            ),
            32 =>
            array (
                'id' => 39,
                'name' => 'My Subscription',
                'slug' => 'my-subscription',
                'url' => 'my-subscription',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\MySubscriptionController@index", "route_name":["vendor.my_subscription.index", "vendor.my_subscription.pricing", "vendor.payment.index", "vendor.renew"], "menu_level":"3"}',
                'is_default' => 1,
            ),
            33 =>
            array (
                'id' => 40,
                'name' => 'Review',
                'slug' => 'review',
                'url' => 'reviews',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\ReviewController@index", "route_name":["vendor.reviews", "vendor.reviewEdit", "vendor.reviewView", "vendor.reviewUpdate", "vendor.reviewDestroy", "vendor.reviewPdf", "vendor.reviewCsv"], "menu_level":"3"}',
                'is_default' => 1,
            ),
            36 =>
                array (
                    'id' => 43,
                    'name' => 'All Orders',
                    'slug' => 'all-orders',
                    'url' => 'orders',
                    'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\AdminOrderController@index", "route_name":["order.index", "order.view", "order.pdf", "order.csv"], "menu_level":"1"}',
                    'is_default' => 1,
                ),
            37 =>
                array (
                    'id' => 44,
                    'name' => 'Orders',
                    'slug' => 'vendor-orders',
                    'url' => 'orders',
                    'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\VendorOrderController@index", "route_name":["vendorOrder.index", "vendorOrder.view", "vendorOrder.pdf", "vendorOrder.csv"], "menu_level":"3"}',
                    'is_default' => 1,
                ),
            38 =>
                array (
                    'id' => 45,
                    'name' => 'Commission',
                    'slug' => 'commission',
                    'url' => 'commission',
                    'permission' => '{"permission":"Modules\\\\Commission\\\\Http\\\\Controllers\\\\CommissionController@index", "route_name":["commission.index"], "menu_level":"1"}',
                    'is_default' => 1,
                ),
            39 =>
                array (
                    'id' => 46,
                    'name' => 'Transactions',
                    'slug' => 'vendor-transactions',
                    'url' => 'transactions',
                    'permision' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\VendorTransactionController@index", "route_name":["vendorTransaction.index", "vendorTransaction.pdf", "vendorTransaction.csv"], "menu_lavel":"3"}',
                    'is_default' => 1,
                ),
        ));

    }
}
