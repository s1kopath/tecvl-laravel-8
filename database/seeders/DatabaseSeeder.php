<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(EmailConfigurationsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PreferencesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VendorsTableSeeder::class);
        $this->call(RoleUsersTableSeeder::class);
        $this->call(VendorUsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(AttributeGroupsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(AttributeValuesTableSeeder::class);
        $this->call(OptionGroupsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(PackagesTableSeeder::class);
        $this->call(PackageSubscriptionsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ItemCategoriesTableSeeder::class);
        $this->call(ItemAttributesTableSeeder::class);
        $this->call(ItemOptionsTableSeeder::class);
        $this->call(WishlistsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(FilesTableSeeder::class);
        $this->call(ItemCrossSalesTableSeeder::class);
        $this->call(ItemRelatesTableSeeder::class);
        $this->call(ItemUpsalesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ItemTagsTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(OrderStatusRolesTableSeeder::class);
        $this->call(CategoryAttributesTableSeeder::class);
        $this->call(WithdrawalMethodsTableSeeder::class);
        $this->call(ItemDetailsTableSeeder::class);
        $this->call(UserWithdrawalSettingsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(ObjectFilesTableSeeder::class);
    }
}
