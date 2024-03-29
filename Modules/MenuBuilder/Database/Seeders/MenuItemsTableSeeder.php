<?php

namespace Modules\MenuBuilder\Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('menu_items')->delete();

        \DB::table('menu_items')->insert(array (
            0 =>
            array (
                'id' => 1,
                'label' => 'dashboard',
                'link' => 'dashboard',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\DashboardController@index","route_name":["dashboard"]}',
                'is_default' => 1,
                'icon' => 'fas fa-home',
                'parent' => 0,
                'sort' => 0,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            1 =>
            array (
                'id' => 2,
                'label' => 'User List',
                'link' => 'user/list',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\UserController@index","route_name":["users.index","users.create","users.edit","users.import","users.pdf","users.csv","users.verify","users.profile"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 27,
                'sort' => 2,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'label' => 'items',
                'link' => 'items',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\ItemController@index","route_name":["item.index","item.create","item.edit","item.pdf","item.csv"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 28,
                'sort' => 4,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'label' => 'brands',
                'link' => 'brands',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\BrandController@index","route_name":["brands.index","brands.create","brands.edit","brands.pdf","brands.csv"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 28,
                'sort' => 5,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'label' => 'categories',
                'link' => 'categories',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\CategoryController@index","route_name":["categories.index"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 28,
                'sort' => 7,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            5 =>
            array (
                'id' => 6,
                'label' => 'attributes',
                'link' => 'attributes',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\AttributeController@index","route_name":["attribute.index","attribute.create","attribute.edit","attribute.pdf","attribute.csv"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 28,
                'sort' => 6,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            6 =>
            array (
                'id' => 7,
                'label' => 'Attribute Groups',
                'link' => 'attribute-groups',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\AttributeGroupController@index","route_name":["attributeGroup.index","attributeGroup.create","attributeGroup.edit","attributeGroup.pdf","attributeGroup.csv"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 28,
                'sort' => 8,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            7 =>
            array (
                'id' => 8,
                'label' => 'options',
                'link' => 'options',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\OptionController@index","route_name":["option.index","option.create","option.edit","option.pdf","option.csv"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 28,
                'sort' => 9,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            8 =>
            array (
                'id' => 9,
                'label' => 'reviews',
                'link' => 'reviews',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\ReviewController@index","route_name":["review.index","review.view","review.edit","review.pdf","review.csv"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 28,
                'sort' => 10,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            9 =>
            array (
                'id' => 10,
                'label' => 'packages',
                'link' => 'package',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\PackageController@index","route_name":["package.index","package.create","package.edit","package.pdf","package.csv"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 30,
                'sort' => 22,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            10 =>
            array (
                'id' => 11,
                'label' => 'Package Subscription',
                'link' => 'package-subscription',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\PackageSubscriptionController@index","route_name":["packageSubscription.index","packageSubscription.create","packageSubscription.edit","packageSubscription.pdf","packageSubscription.csv","packageSubscription.show"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 30,
                'sort' => 23,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            11 =>
            array (
                'id' => 13,
                'label' => 'vendors',
                'link' => 'vendors',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Api\\\\VendorController@index","route_name":["vendors.index","vendors.create","vendors.edit","vendors.pdf","vendors.csv","vendors.import"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 30,
                'sort' => 18,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            12 =>
            array (
                'id' => 14,
                'label' => 'addons',
                'link' => 'addons',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\AddonsMangerController@index","route_name":["addon.index","addon.switch-status","addon.remove","addon.upload"]}',
                'is_default' => 1,
                'icon' => 'fas fa-chess-rook',
                'parent' => 0,
                'sort' => 51,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            13 =>
            array (
                'id' => 16,
                'label' => 'Menu Builder',
                'link' => 'menu-builder',
                'params' => '{"permission":"Modules\\\\MenuBuilder\\\\Http\\\\Controllers\\\\MenuBuilderController@index","route_name":["menu.index"]}',
                'is_default' => 1,
                'icon' => 'fas fa-bars',
                'parent' => 0,
                'sort' => 30,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            14 =>
            array (
                'id' => 18,
                'label' => 'Company Details',
                'link' => 'company/setting',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\CompanySettingController@index","route_name":["companyDetails.setting"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 43,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            15 =>
            array (
                'id' => 19,
                'label' => 'General Settings',
                'link' => 'emailConfiguration',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\EmailConfigurationController@index","route_name":["emailConfigurations.index", "maintenance.enable", "smsConfiguration.index", "language.translation", "language.index", "currency.convert", "sso.index", "orderStatues.index", "withdrawalSetting.index"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 42,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            16 =>
            array (
                'id' => 20,
                'label' => 'Product',
                'link' => 'product-setting',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\ProductSettingController@general","route_name":["product.setting.general","product.setting.inventory", "product.setting.vendor"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 44,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            17 =>
            array (
                'id' => 21,
                'label' => 'Email Templates',
                'link' => 'emailTemplate/list',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\MailTemplateController@index", "route_name":["emailTemplates.index", "emailTemplates.create", "emailTemplates.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 45,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            18 =>
            array (
                'id' => 22,
                'label' => 'Sms Templates',
                'link' => 'smsTemplate/list',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\SmsTemplateController@index","route_name":["smsTemplates.index", "smsTemplates.create", "smsTemplates.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 46,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            19 =>
            array (
                'id' => 23,
                'label' => 'preference',
                'link' => 'preference',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\PreferenceController@index","route_name":["preferences.index","preferences.theme"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 47,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            20 =>
            array (
                'id' => 24,
                'label' => 'roles',
                'link' => 'role/list',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\RoleController@index","route_name":["roles.index","roles.create","roles.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 48,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            21 =>
            array (
                'id' => 25,
                'label' => 'Permission Role',
                'link' => 'permission-role',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\PermissionRoleController@index","route_name":["permissionRoles.index","generatePermission.index"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 49,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            22 =>
            array (
                'id' => 26,
                'label' => 'Cache Clear',
                'link' => 'clear-cache',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\DashboardController@index","route_name":["clear-cache"]}',
                'is_default' => 1,
                'icon' => 'fas fa-trash-alt',
                'parent' => 0,
                'sort' => 52,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            23 =>
            array (
                'id' => 27,
                'label' => 'Personnel',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fas fa-users',
                'parent' => 0,
                'sort' => 1,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            24 =>
            array (
                'id' => 28,
                'label' => 'Items',
                'link' => 'Items main',
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fas fa-database',
                'parent' => 0,
                'sort' => 3,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            25 =>
            array (
                'id' => 29,
                'label' => 'Manage Billings',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fas fa-money-bill-alt',
                'parent' => 0,
                'sort' => 16,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            26 =>
            array (
                'id' => 30,
                'label' => 'Vendors',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fas fa-universal-access',
                'parent' => 0,
                'sort' => 17,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            27 =>
            array (
                'id' => 31,
                'label' => 'Configurations',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fas fa-cog',
                'parent' => 0,
                'sort' => 41,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            28 =>
            array (
                'id' => 32,
                'label' => 'dashboard',
                'link' => 'dashboard',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\DashboardController@index","route_name":["site.dashboard"],"menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'fas fa-align-justify',
                'parent' => 0,
                'sort' => 0,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
            29 =>
            array (
                'id' => 33,
                'label' => 'orders',
                'link' => 'orders',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\OrderController@index","route_name":["site.order", "site.orderDetails", "site.orderRefund"],"menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'fab fa-apple',
                'parent' => 0,
                'sort' => 1,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
            30 =>
            array (
                'id' => 34,
                'label' => 'wishlist',
                'link' => 'wishlists',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\WishlistController@index","route_name":["site.wishlist"],"menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'far fa-heart',
                'parent' => 0,
                'sort' => 2,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
            31 =>
            array (
                'id' => 35,
                'label' => 'review',
                'link' => 'reviews',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\ReviewController@index","route_name":["site.review"],"menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'fas fa-certificate',
                'parent' => 0,
                'sort' => 3,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
            32 =>
            array (
                'id' => 36,
                'label' => 'User Profile',
                'link' => 'profile',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\UserController@index","route_name":["site.userProfile","site.userProfileEditPassword"],"menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'fas fa-user',
                'parent' => 0,
                'sort' => 4,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
            33 =>
            array (
                'id' => 37,
                'label' => 'Address Books',
                'link' => 'addresses',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\AddressController@index","route_name":["site.address","site.addressCreate","site.addressEdit"],"menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'fas fa-phone',
                'parent' => 0,
                'sort' => 5,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
            34 =>
            array (
                'id' => 38,
                'label' => 'settings',
                'link' => 'setting',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\AddressController@index","route_name":["site.userSetting"],"menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'fas fa-cog',
                'parent' => 0,
                'sort' => 6,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
            35 =>
            array (
                'id' => 39,
                'label' => 'Logout',
                'link' => 'logout',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Site\\\\LoginController@logout", "route_name":["site.logout"], "menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'fas fa-sign-out-alt',
                'parent' => 0,
                'sort' => 7,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
            36 =>
            array (
                'id' => 40,
                'label' => 'dashboard',
                'link' => 'dashboard',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\VendorController@index","route_name":["vendor-dashboard"],"menu_level":"3"}',
                'is_default' => 1,
                'icon' => 'fas fa-home',
                'parent' => 0,
                'sort' => 0,
                'class' => NULL,
                'menu' => 3,
                'depth' => 0,
            ),
            37 =>
            array (
                'id' => 41,
                'label' => 'My Subscription',
                'link' => 'my-subscription',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\MySubscriptionController@index","route_name":["vendor.my_subscription.index","vendor.my_subscription.pricing","vendor.payment.index","vendor.renew"],"menu_level":"3"}',
                'is_default' => 1,
                'icon' => 'fas fa-life-ring',
                'parent' => 0,
                'sort' => 2,
                'class' => NULL,
                'menu' => 3,
                'depth' => 0,
            ),
            38 =>
            array (
                'id' => 42,
                'label' => 'All Orders',
                'link' => 'orders',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\AdminOrderController@index", "route_name":["order.index", "order.view", "order.pdf", "order.csv"], "menu_level":"1"}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 43,
                'sort' => 12,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            39 =>
            array (
                'id' => 43,
                'label' => 'Orders',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fas fa-dollar-sign',
                'parent' => 0,
                'sort' => 11,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            41 =>
            array (
                'id' => 47,
                'label' => 'Orders',
                'link' => 'orders',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\VendorOrderController@index", "route_name":["vendorOrder.index", "vendorOrder.view", "vendorOrder.pdf", "vendorOrder.csv"], "menu_level":"3"}',
                'is_default' => 1,
                'icon' => 'fas fa-dollar-sign',
                'parent' => 0,
                'sort' => 3,
                'class' => NULL,
                'menu' => 3,
                'depth' => 0,
            ),
            42 =>
            array (
                'id' => 48,
                'label' => 'Transaction',
                'link' => 'transactions',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\TransactionController@index", "route_name":["transaction.index", "transaction.edit"], "menu_level":"1"}',
                'is_default' => 1,
                'icon' => 'far fa-credit-card',
                'parent' => 43,
                'sort' => 13,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            43 =>
            array (
                'id' => 65,
                'label' => 'withdrawal',
                'link' => 'withdrawals',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\WithdrawalController@index","route_name":["vendorWithdrawal.index", "vendorWithdrawal.setting", "vendorWithdrawal.money"]}',
                'is_default' => 1,
                'icon' => 'far fa-credit-card',
                'parent' => 0,
                'sort' => 4,
                'class' => NULL,
                'menu' => 3,
                'depth' => 0,
            ),
            44 =>
            array (
                'id' => 66,
                'label' => 'Withdrawal',
                'link' => 'withdrawals',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\WithdrawalController@index", "route_name":["withdrawal.index", "withdrawal.edit"], "menu_level":"1"}',
                'is_default' => 1,
                'icon' => 'fas fa-credit-card',
                'parent' => 30,
                'sort' => 20,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            45 =>
            array (
                'id' => 73,
                'label' => 'Marketing',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fas fa-bullhorn',
                'parent' => 0,
                'sort' => 27,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
            46 =>
            array (
                'id' => 76,
                'label' => 'items',
                'link' => 'items',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\ItemController@index","route_name":["vendor.item.view","vendor.item.related","vendor.item.search","vendor.item.update","vendor.item.edit", "vendor.item.store", "vendor.item.create", "vendor.item.import", "vendor.itemCsv", "vendor.itemPdf", "vendor.itemDestroy", "vendor.items"]}',
                'is_default' => 1,
                'icon' =>'fas fa-database',
                'parent' => 0,
                'sort' => 1,
                'class' => NULL,
                'menu' => 3,
                'depth' => 0,
            ),
            47 =>
            array (
                'id' => 77,
                'label' => 'reviews',
                'link' => 'reviews',
                'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\ReviewController@index","route_name":["vendor.reviewCsv","vendor.reviewPdf","vendor.reviewDestroy","vendor.reviewUpdate","vendor.reviewView", "vendor.reviewEdit", "vendor.reviews"]}',
                'is_default' => 1,
                'icon' => 'fas fa-star',
                'parent' => 0,
                'sort' => 10,
                'class' => NULL,
                'menu' => 3,
                'depth' => 0,
            ),
            48 =>
            array (
                'id' => 78,
                'label' => 'about us',
                'link' => 'about-us',
                'params' => NULL,
                'is_default' => 0,
                'icon' => NULL,
                'parent' => 0,
                'sort' => 2,
                'class' => NULL,
                'menu' => 4,
                'depth' => 0,
            ),
            49 =>
            array (
                'id' => 80,
                'label' => 'Privacy Policy',
                'link' => 'privacy-policy',
                'params' => NULL,
                'is_default' => 0,
                'icon' => NULL,
                'parent' => 0,
                'sort' => 0,
                'class' => NULL,
                'menu' => 4,
                'depth' => 0,
            ),
            50 =>
            array (
                'id' => 81,
                'label' => 'Refund Policy',
                'link' => 'refund-policy',
                'params' => NULL,
                'is_default' => 0,
                'icon' => NULL,
                'parent' => 0,
                'sort' => 1,
                'class' => NULL,
                'menu' => 4,
                'depth' => 0,
            ),
            51 =>
            array (
                'id' => 82,
                'label' => 'Digital Payments',
                'link' => 'digital-payments',
                'params' => NULL,
                'is_default' => 0,
                'icon' => NULL,
                'parent' => 0,
                'sort' => 3,
                'class' => NULL,
                'menu' => 4,
                'depth' => 0,
            ),
            53 =>
                array (
                    'id' => 83,
                    'label' => 'Transaction',
                    'link' => 'transactions',
                    'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\Vendor\\\\VendorTransactionController@index", "route_name":["vendorTransaction.index", "vendorTransaction.pdf", "vendorTransaction.csv"], "menu_lavel":"3"}',
                    'is_default' => 1,
                    'icon' => 'fas fa-indent',
                    'parent' => 0,
                    'sort' => 4,
                    'class' => NULL,
                    'menu' => 3,
                    'depth' => 0,
                ),
        ));


    }
}
