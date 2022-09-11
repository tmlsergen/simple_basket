<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Product;
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
        Product::factory(30)->create();

        Coupon::create([
            'code' => '20PercentCode',
            'discount' => 20
        ]);

        Coupon::create([
            'code' => '30PercentCode',
            'discount' => 30
        ]);
    }
}
