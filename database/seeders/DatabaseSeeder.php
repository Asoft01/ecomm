<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(AdminsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(ProductsAttributesTableSeeder::class);
        // $this->call(ProductsImagesTableSeeder::class);
        // $this->call(BrandsTableSeeder::class);
        // $this->call(BannersTableSeeder::class);
        // $this->call(CouponsTableSeeder::class);
        // $this->call(DeliveryAddressTableSeeder::class);
        // $this->call(OrderStatusTableSeeder::class);
        // $this->call(CmsPagesTableSeeder::class);
        // $this->call(CurrenciesTableSeeder::class);
        // $this->call(RatingsTableSeeder::class);
        // $this->call(WishlistsTableSeeder::class);
        $this->call(ReturnRequestTableSeeder::class);
    }
}
