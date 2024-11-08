<?php

namespace Modules\Staff\Product\Database\seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products_table = __DIR__.'/../products.sql';
        DB::unprepared(file_get_contents($products_table));

        $product_has_variants = __DIR__.'/../product_has_variants.sql';
        DB::unprepared(file_get_contents($product_has_variants));
    }
}
